
//Load the page
document.addEventListener('DOMContentLoaded', event => {
    fetch("http://localhost/api/v1/api.php", {
        credentials: "include",
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify({
            action: "get-mealplan"
        })
    })

    .then(res => res.json())
    .then(res => populateMealPlan(res.message));
})


function toggleModal(){
    const modal = document.querySelector('#modal');
    modal.classList == "modal-hidden" ? modal.classList = "modal-visible" : modal.classList = "modal-hidden";
}


function showToast(success,text){

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


function requestRemove(event){
    //don't refresh
    event.preventDefault();


    const btn = event.target;
    const mealItem = btn.closest('.meal-item');
    const recipe_id = mealItem.querySelector(".recipe-link").id;
    const day = btn.closest(".day-column").id;

    fetch("http://localhost/api/v1/api.php",{
        credentials: "include",
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify({
            action: "delete-recipe",
            recipe_id: recipe_id,
            day: day
        })
    })
    .then(res => res.json())
    .then(res => {
        if(res.status === "success"){
            showToast(true, res.message);
            mealItem.parentElement.remove();
        }
        else{
            showToast(false, `Error: ${res.message}`);
        }
    })
}

    function populateMealPlan(recipes){
        recipes.forEach(recipe => {
            const day = recipe['day'];
            const recipe_id = recipe['recipe_id'];
            const recipe_title = recipe['recipe_title'];

            //html
            const dayElement = document.querySelector(`#${day}`);
            const daySlotElement = dayElement.querySelector(".day-slot");
            const contentArea = daySlotElement.querySelector(".plan-list");
            
            const listElement = document.createElement('li');
            const listContent = document.createElement('div');
            const link = document.createElement('a');
            const removeButton = document.createElement('button');
            removeButton.classList = "icon-btn";
           
            


            link.classList = "recipe-link";
            listContent.classList.add('meal-item');
            link.id = recipe_id;
            link.textContent = recipe_title;
            link.href = `http://localhost/recipe-details.php?recipe_id=${recipe_id}`;
            removeButton.classList.add("icon-btn");
            removeButton.innerHTML= `
                <svg xmlns="http://www.w3.org/2000/svg" width="200" height="200" viewBox="0 0 304 384">
                    <path fill="#c47a2c" d="M21 341V85h256v256q0 18-12.5 30.5T235 384H64q-18 0-30.5-12.5T21 341zM299 21v43H0V21h75L96 0h107l21 21h75z"/>
                </svg>
            `;
            removeButton.setAttribute("aria-label", "Remove recipe");
            removeButton.addEventListener('click', requestRemove);

            
            listContent.appendChild(link);
            listContent.appendChild(removeButton);
            listElement.appendChild(listContent);
            contentArea.appendChild(listElement);

            contentArea.appendChild(listElement);
        })


}



