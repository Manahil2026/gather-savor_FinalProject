//Tell the page to load the favorites

//Take the response, use the api to get the details for the id

//fill in the cards


/*
    <div>
        <h3>recipe title</h3>
        <img src=image link>
        <button>Remove Favorite</button> 
    </div>
*/


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


    fetch("http://localhost/favorites.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded"
        },
        body: new URLSearchParams({
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
                const card = document.createElement('div');
                card.className = 'favorite-card';
                card.id = details.id;

                card.innerHTML = `
                    <img src="${details.image}" alt="${details.title}">
                    <div class="card-content">
                        <h3>${details.title}</h3>

                        <div class ='card-actions'>
                            <a href='recipe-details.php?recipe_id=${details.id}'
                                class='btn secondary-btn'>View Recipe</a>

                            <button class = 'remove-btn'>Remove</button>
                        </div>
                    </div>
                `;
                card.querySelector(".remove-btn").addEventListener("click", sendRemoveRequest);

                favoritesContainer.appendChild(card);
            }) 
    })
}

function loadRecipes(){
    fetch("http://localhost/favorites.php",{
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded"
        },
        body: new URLSearchParams({
            action: "load-favorites"
        })
    })
    .then(res => res.json())
    .then(res => populateRecipes(res))
}
document.addEventListener('DOMContentLoaded', loadRecipes)




