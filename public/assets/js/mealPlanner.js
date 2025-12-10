
//Load the page
document.addEventListener('DOMContentLoaded', event => {
    fetch("http://localhost/meal-planner.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded"
        },
        body: new URLSearchParams({
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
    const recipe_id = btn.parentElement.querySelector(".recipe-item").id
    const day = btn.closest(".day-column").id

    fetch("http://localhost/meal-planner.php",{
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded"
        },
        body: new URLSearchParams({
            action: "delete-recipe",
            recipe_id: recipe_id,
            day: day
        })
    })
    .then(res => res.json())
    .then(res => {
        if(res.status === "success"){
            showToast(true, res.message);
            btn.parentElement.parentElement.remove();
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
            removeButton.classList = "btn secondary-btn";
            removeButton.style = "margin-left: 20px;"
            


            link.classList = "recipe-item btn primary-btn";
            link.id = recipe_id;
            link.textContent = recipe_title;
            link.href = `http://final.domain.local/recipe-details.php?recipe_id=${recipe_id}`;
            removeButton.textContent = "Remove this";
            removeButton.addEventListener('click', requestRemove);

            
            listContent.appendChild(link);
            listContent.appendChild(removeButton);
            listElement.appendChild(listContent);
            contentArea.appendChild(listElement);

            contentArea.appendChild(listElement);
        })


}



