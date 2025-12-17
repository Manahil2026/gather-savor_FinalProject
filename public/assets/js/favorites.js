const favoritesContainer = document.getElementById('favorites-container');
function showToast(success, text){

        const toast = document.querySelector(".toast");    
        success ? toast.style.background = "green": toast.style.background = "red";
        
        
        const toastText = toast.querySelector('p');
        toastText.textContent = text;
        toast.classList = "toast toast-show";


        const timeout = 2000;
        setTimeout(() => {
                toast.classList = "toast";
        }, timeout);
    }


function sendRemoveRequest(event){
    //don't refresh
    event.preventDefault();
    const btn = event.target;
    const recipeCard = btn.closest(".favorite-card")
    const id = recipeCard.id;


    fetch("http://localhost/api/v1/api.php", {
        credentials: "include",
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify({
            action: "delete-favorite",
            recipe_id: id
        })
    })
    .then(res => res.json())
    .then(res => {
        if(res.status == "success"){
            showToast(true, "Successfully removed the favorite!");
            recipeCard.remove();
        }
        else{
            //trigger error modal
            showToast(false, res.message);
        }

    })


}

function populateRecipes(recipes){
    recipes.message.forEach(recipe => {
        
        //Make a web request to get the details
        fetch(`https://api.spoonacular.com/recipes/${recipe['recipe_id']}/information?apiKey=79f089b8a521468eadcd3dcad358548a`)
            .then(res => res.json())
            .then(details => {

                const id = details.id
                const image = details.image
                const title = details.title

                const outerDiv = document.createElement('div');
                const imageElement = document.createElement('img');
                const cardContentDiv = document.createElement('div');
                const cardActionsDiv = document.createElement('div');
                const titleH = document.createElement('h3');
                const detailsA = document.createElement('a');
                const removeBtn = document.createElement('button');
                
            
                outerDiv.classList = "favorite-card";
                imageElement.src = image;
                imageElement.alt = title;
                cardContentDiv.classList = "card-content";
                titleH.textContent = title;
                cardActionsDiv.classList = "card-actions";
                detailsA.classList = "btn secondary-btn";
                detailsA.href = `recipe-details.php?recipe_id=${id}`
                detailsA.textContent = "View Recipe";
                removeBtn.classList = "btn secondary-btn";
                removeBtn.textContent = "Remove";
                removeBtn.addEventListener("click", sendRemoveRequest);

                
                cardActionsDiv.appendChild(detailsA);
                cardActionsDiv.appendChild(removeBtn);
                cardContentDiv.appendChild(titleH)
                cardContentDiv.appendChild(cardActionsDiv)

                outerDiv.appendChild(imageElement)
                outerDiv.appendChild(cardContentDiv);
            
                favoritesContainer.appendChild(outerDiv);
            }) 
    })
}

function loadRecipes(){
    fetch("http://localhost/api/v1/api.php",{
        credentials: "include",
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify({
            action: "load-favorites"
        })
    })
    .then(res => res.json())
    .then(res => populateRecipes(res))
}
document.addEventListener('DOMContentLoaded', loadRecipes)




