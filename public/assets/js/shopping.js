

const shoppingListArea = document.getElementById('shopping-list-groups');



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

function toggleIngredient(event){
    //don't refresh
    event.preventDefault();

    // Use event.currentTarget to reliably reference the <li> even when the
    // user clicks the checkbox or the span inside the li.
    const checkbox = event.target
    const recipe_id = checkbox.closest('.shopping-group').id;
    const ingredientNameElement = checkbox.parentElement.querySelector('.ingredient-details').querySelector('.ingredient-name');
    const ingredientName = ingredientNameElement.textContent;

    fetch("http://localhost/api/v1/api.php", {
        credentials: "include",
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify({
            action: "toggle-ingredient",
            recipe_id: recipe_id,
            ingredient_name: ingredientName
        })
        
        })
        .then(res => res.json())
        .then(res => {
            console.log(res);
            if(res.status == "success"){
                if(res.message.added == true){
                    console.log('added');
                    
                }
                else{
                    console.log("removed");
                }
            }
            else{
                //there was an error show the error toast
                showToast(false, res.message);
            }
    })
}


async function populateRecipeDetails(recipes){
    return Promise.all(
        recipes.map(recipe => {
            const recipe_id = recipe.recipe_id;
            
            return fetch(`https://api.spoonacular.com/recipes/${recipe_id}/information?apiKey=79f089b8a521468eadcd3dcad358548a`)
                .then(res => res.json())
                .then(recipe => {    

                    //Get all variables from the api
                    const id = recipe['id'];
                    const title = recipe['title']
                    const image = recipe['image']
                    const ingredients = recipe['extendedIngredients'];


                    //construct the dom for the page    
                    const outerDiv = document.createElement('div');
                    const groupHeaderDiv = document.createElement('div');
                    const groupHeaderNameDiv = document.createElement('div');
                    const groupTitleDiv = document.createElement('div');
                    const imageElement = document.createElement('img');
                    const ingredientsUL = document.createElement('ul');


                    //set the properties for the dom
                    outerDiv.id = id;
                    outerDiv.classList = "shopping-group";
                    groupHeaderDiv.classList = "group-header";
                    groupHeaderNameDiv.classList = "group-name";
                    groupTitleDiv.classList = "group-title";
                    groupTitleDiv.textContent = title;
                    imageElement.src = image;

                    //construct and set properties for the ingredients
                    ingredients.forEach(ingredient => {

                        //Set the variables needed for the dom
                        const ingredientName = ingredient['name'];
                        const ingredientOriginal = ingredient['original'];

                        //build the dom
                        const ingredientLI = document.createElement('li');
                        const checkBoxInput = document.createElement('input');
                        const ingredientDetailsDiv = document.createElement('div');
                        const ingredientNameSpan = document.createElement('span');
                        const exactIngredientNameSpan = document.createElement('span');

                        //set the properties for the dom
                        ingredientLI.classList = "ingredient-item";
                        checkBoxInput.type = "checkbox";
                        checkBoxInput.classList = "ingredient-checkbox";
                        checkBoxInput.addEventListener('change', toggleIngredient);
                        ingredientDetailsDiv.classList = "ingredient-details"
                        ingredientNameSpan.classList = "ingredient-name";
                        ingredientNameSpan.textContent = ingredientName;
                        exactIngredientNameSpan.classList = "ingredient-quantity";
                        exactIngredientNameSpan.textContent = ingredientOriginal;

                        //append each element
                        ingredientDetailsDiv.appendChild(ingredientNameSpan);
                        ingredientDetailsDiv.appendChild(exactIngredientNameSpan);
                        ingredientLI.appendChild(checkBoxInput);
                        ingredientLI.appendChild(ingredientDetailsDiv);

                        ingredientsUL.appendChild(ingredientLI);
                    })

                    //append each element
                    groupHeaderNameDiv.appendChild(groupTitleDiv);
                    groupHeaderDiv.appendChild(groupHeaderNameDiv);
                    outerDiv.appendChild(groupHeaderDiv);
                    outerDiv.appendChild(imageElement);
                    outerDiv.appendChild(ingredientsUL);
                    shoppingListArea.appendChild(outerDiv);
            })  
        })
    )
}

function processCurrentList(){
    //Get the current ingredients that the user has and mark them checked in the UI
    return fetch("http://localhost/api/v1/api.php", {
        credentials: "include",
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify({
            action: "get-shoppingIngredients"
        })
    })
    .then(res => res.json())
    .then(res => {
        // For each returned ingredient, find the corresponding recipe block and
        res.message.forEach(recipe => {
            const ingredientName = recipe.ingredient
            const recipe_id = recipe.recipe_id;

            const recipeContainer = document.getElementById(recipe_id);
            if(!recipeContainer) {
                //skip if not found.
                console.log(`warning: no possible target for recipe id ${recipe_id}`);
                return;
            }
            
            
            const ingredients = recipeContainer.querySelector('ul').querySelectorAll('.ingredient-item');
            ingredients.forEach(ingredient => {
                const checkBox = ingredient.querySelector('.ingredient-checkbox');
                const ingredientDetails = ingredient.querySelector('.ingredient-details');
                const ingredientNameElement = ingredientDetails.querySelector('.ingredient-name');
                
                //for now just matching by the name, not great, but...
                if(ingredientNameElement.textContent == ingredientName){
                    checkBox.checked = true;
                }
            })
        })
    })
}


async function loadPage(){ 



    //Do the fetch
    const response = await fetch("http://localhost/api/v1/api.php", {
        credentials: "include",
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify({
            action: "get-shoppingList"
        })
    })

    //convert to json
    const res = await response.json();

    //Build the dom
    await populateRecipeDetails(res.message);
    
    //Process the shopping list
    processCurrentList();

}

document.addEventListener('DOMContentLoaded', (event) => {
    loadPage();
});

    

    
