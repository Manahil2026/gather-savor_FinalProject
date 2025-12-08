const recipe_id = document.getElementById('recipe_id');


//Initial setup
const modalBtn = document.getElementById('showModal');
const closeModalBtn = document.getElementById('close modal');
modalBtn.addEventListener('click',toggleModal);
closeModalBtn.addEventListener('click', toggleModal);
const toggleFavoriteBtn = document.getElementById('toggleFavorite');
const toggleShoppingListBtn = document.getElementById('toggleShoppingList');

if(recipe_id.value !== ""){
    setFavoriteStatus(toggleFavoriteBtn);
    setShoppingListStatus(toggleShoppingListBtn);
    fetch(`https://api.spoonacular.com/recipes/${recipe_id.value}/information?apiKey=79f089b8a521468eadcd3dcad358548a`)
        .then(res => res.json())
        .then(res => {    
            populateRecipeDetails(res)}
        )
}



//Togglemodal and showtoast are for css
function toggleModal(){
    const modal = document.querySelector('#modal');
    modal.classList == "modal-hidden" ? modal.classList = "modal-visible" : modal.classList = "modal-hidden";
}


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


//more dynamic page content, need to know if the recipe is CURRENTLY a favorite or in the shopping list
function setFavoriteStatus(btn){
    fetch("http://localhost/recipe-details.php",{
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded"
        },
        body: new URLSearchParams({
            action: "checkfavorite",
            recipe_id: recipe_id.value
        })

    })
    .then(res => res.json())
    .then(res => {
        res.message ? btn.textContent = "Remove from favorites" : btn.textContent = "Add to favorites"
    })
}

function setShoppingListStatus(btn){
    fetch("http://localhost/recipe-details.php",{
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded"
        },
        body: new URLSearchParams({
            action: "check-shoppingList",
            recipe_id: recipe_id.value
        })

    })
    .then(res => res.json())
    .then(res => {
        if(res.status == "success"){
            res.message ? btn.textContent = "Remove from Shopping List" : btn.textContent = "Add to shopping List"
        }
        else {
            const error = res.message;
            console.log(`There was an error: ${error}`)
        }
        
    })
}


//toggle favorites and shopping lists. If it's there, delete, if not, add
function toggleFavoriteRequest(event){

    //don't refresh
    event.preventDefault();
    //fetch to recipe-details.php as POST
    //there should be a success or error message as a response, trigger modal
    fetch("http://localhost/recipe-details.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded"
        },
        body: new URLSearchParams({
            action: "toggle-favorite",
            recipe_id: recipe_id.value
        })
    })
    .then(res => res.json())
    .then(res => {
        if(res.status == "success"){
            showToast(true, res.message);
            setFavoriteStatus(toggleFavoriteBtn);
        }
        else{
            showToast(false, `Error: ${res.message}`);
        }
    })
}

function toggleShoppingListRequest(event){

    //don't refresh
    event.preventDefault();
    //fetch to recipe-details.php as POST
    //there should be a success or error message as a response, trigger modal
    fetch("http://localhost/recipe-details.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded"
        },
        body: new URLSearchParams({
            action: "toggle-shoppingList",
            recipe_id: recipe_id.value
        })
    })
    .then(res => res.json())
    .then(res => {
        //console.log(res); //debug
        if(res.status == "success"){
            showToast(true, res.message);
            setShoppingListStatus(toggleShoppingListBtn);
        }
        else{
            showToast(false, `Error: ${res.message}`);
        }
    })
}

//Add something to meal plan. removing is done in meal planner page.
function addMealPlanRequest(event){
    //fetch to recipe-details.php as POST
    //there should be a success or error message as a response, trigger modal

    //don't refresh
    event.preventDefault();

    const dayElement = document.getElementById('day-selection');
    const day = dayElement.value
    if(day === ""){ 
        showToast(false, "Please select a day");
        return
    }
    
    const recipeTitleElement = document.getElementById('recipe-title');

    //Yes, you could change it with inspect, no I don't care because all of this is client side anyways.
    const recipeTitle = recipeTitleElement.textContent;

    fetch("http://localhost/recipe-details.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded"
        },
        body: new URLSearchParams({
            action: "add-mealPlan",
            recipe_id: recipe_id.value,
            day: day,
            recipe_title: recipeTitle
        })
    })
    .then(res => res.json())
    .then(res => {
        if(res.status === "success"){
            toggleModal();
            showToast(true, res.message);
        }
        else{
            toggleModal();
            showToast(false, `Error: ${res.message}`);
        }
    })
    
}


//The recipe id is in a hidden variable on the page, defined above. Use this to get all the recipe details using the api
function populateRecipeDetails(recipe){
    //Title, picture, etc.
    const recipeElement = document.getElementById('recipe-title');
    recipeElement.textContent = recipe['title'];
    
    const imageElement = document.getElementById('recipe-image');
    imageElement.src = recipe['image'];

    //Ingredients list
    const ingredientsList = document.getElementById('recipe-ingredients');
    recipe['extendedIngredients'].forEach(ingredient => {
        const ingredientName = ingredient['original'];
        const ingredientElement = document.createElement('li');
        ingredientElement.textContent = ingredientName;

        ingredientsList.appendChild(ingredientElement);
        
    })

    //instructions
    const instructionsElement = document.getElementById("recipe-instructions")
    instructionsElement.innerHTML = recipe['instructions'];

    //favorite button
    toggleFavoriteBtn.addEventListener('click', toggleFavoriteRequest);

    //meal plan button
    const mealPlanButton = document.getElementById('add-mealplan-button');
    mealPlanButton.addEventListener('click', addMealPlanRequest);


    //shopping-list button
    
    toggleShoppingListBtn.addEventListener('click', toggleShoppingListRequest);
}

