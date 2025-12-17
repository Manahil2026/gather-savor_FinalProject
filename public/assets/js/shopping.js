//Get everything on the person's shopping list

//A card with an image, title, ul of the ingredietns

//buttons next to ingredietns (or the ingredients themselves are the buttons) which: strike thru the text
//and they also make a request to add them to the database under ingredients

//and when clicked again remove them.


//Just need need add and delete
//If ingredient x is requried by recipe+id id, and ingredient x by recipe_id id does not exist, it's not checked off, vice versa
//handling multiple quantities:
//The server must tell us the quantity
//ingredient (1st) check off if(quantity > 1)
//ingredient (2nd) check off if(quantity > 2)
//ingredient (3rd) check off if (quantity > 3)
//?

//remove ingredient: just remove one of them, alter table set column quantity = quantity -1 where id = "12345"??
//or just have quantity field in the database, or just count the amount of entries in the sql db. like 3 duplicates, and just remove one.

//Copied some stuff from my comments in here so that full css works


const shoppingListArea = document.getElementById('shopping-list');


function toggleStrikeThrough(item, checked){
   item.classList.toggle("checked", checked);
   const checkbox = item.querySelector(".ingredient-checkbox");
   if (checkbox) checkbox.checked = checked;
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

function toggleIngredient(event){
    //don't refresh
    event.preventDefault();

    // Use event.currentTarget to reliably reference the <li> even when the
    // user clicks the checkbox or the span inside the li.
    const item = event.currentTarget || event.target.closest('li');
    const recipe_id = item.closest('div').id;
    const ingredientNameEl = item.querySelector('.ingredient-name');
    const ingredient_name = ingredientNameEl ? ingredientNameEl.textContent.trim() : item.textContent.trim();

    fetch("http://localhost/shopping-list.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded"
        },
        body: new URLSearchParams({
            action: "toggle-ingredient",
            recipe_id: recipe_id,
            ingredient_name: ingredient_name
        })
        
        })
        .then(res => res.json())
        .then(res => {
            if(res.status == "success"){
                if(res.message == "added"){
                    //add strikethrough on the list item
                    toggleStrikeThrough(item, true);
                }
                else{
                    toggleStrikeThrough(item, false);
                }
            }
            else{
                //there was an error show the error toast
                showToast(false, res.message);
            }
    })
}

function populateRecipeDetails(recipes){

    recipes.forEach(recipe => {
        const recipe_id = recipe.recipe_id;
        fetch(`https://api.spoonacular.com/recipes/${recipe_id}/information?apiKey=79f089b8a521468eadcd3dcad358548a`)
            .then(res => res.json())
            .then(recipe => {    

                const id = recipe['id'];
                const title = recipe['title']
                const image = recipe['image']
                const ingredients = recipe['extendedIngredients'];


                /*
                <div>
                    <h3>title</h3>
                    <img> 
                    <ul>
                        <li>ingredient</li>
                    </ul>

                </div>
                */
                       
                // Build DOM that matches shopping-list.css expectations
                const recipeDiv = document.createElement('div');
                const header = document.createElement('div');
                const nameWrap = document.createElement('div');
                const titleDiv = document.createElement('div');
                const imageElement = document.createElement('img');
                const ingredientsUl = document.createElement('ul');

                header.className = 'group-header';
                nameWrap.className = 'group-name';
                titleDiv.className = 'group-title';

                // set ids/classes and content
                recipeDiv.id = recipe_id;
                recipeDiv.className = 'shopping-group';
                titleDiv.textContent = title;
                imageElement.src = image;

                // assemble header
                nameWrap.appendChild(titleDiv);
                header.appendChild(nameWrap);

                // add the ingredients list
                ingredients.forEach(ingredient => {
                    const ingredientLi = document.createElement('li');
                    ingredientLi.className = 'ingredient-item';
                    // Use original text when available to show amount/unit, fall back to name
                    const quantityText = ingredient.original ? ingredient.original : '';
                    ingredientLi.innerHTML = `
                        <input type='checkbox' class='ingredient-checkbox'>
                        <div class='ingredient-details'>
                            <span class='ingredient-name'>${ingredient.name}</span>
                            <span class='ingredient-quantity'>${quantityText}</span>
                        </div>
                    `;
                    ingredientLi.addEventListener('click', toggleIngredient);
                    ingredientsUl.appendChild(ingredientLi);
                });

                // append to recipe container in order expected by css
                recipeDiv.appendChild(header);
                recipeDiv.appendChild(imageElement);
                recipeDiv.appendChild(ingredientsUl);
                shoppingListArea.appendChild(recipeDiv);
                //The main logic for this app is that the ingredients list will have buttons that interact with the db (e.g. add ingredient)
            
        })  
    })
}

document.addEventListener('DOMContentLoaded', event => {


    //First get everything that should be in the shopping list and their required ingredients (api)
    fetch("http://localhost/shopping-list.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded"
        },
        body: new URLSearchParams({
            action: "get-shoppingList"
        })
    })
    .then(res => res.json())
    .then(res => {
            populateRecipeDetails(res.message);
        })
    });

    //Get the current ingredients that the user has and mark them checked in the UI
    fetch("http://localhost/shopping-list.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded"
        },
        body: new URLSearchParams({
            action: "get-shoppingIngredients"
        })
    })
    .then(res => res.json())
    .then(res => {
        // For each returned ingredient, find the corresponding recipe block and
        // list item and mark it as checked.
        res.message.forEach(recipe => {
            const ingredient_name = recipe.ingredient_name;
            const recipe_id = recipe.recipe_id;

            const recipeContainer = document.getElementById(recipe_id);
            if(!recipeContainer) {
                // The recipe DOM may not yet be loaded; skip if not found.
                console.log(`no possible target for recipe id ${recipe_id}`);
                return;
            }

            const possibleLis = recipeContainer.querySelectorAll('li.ingredient-item');
            if(possibleLis && possibleLis.length){
                possibleLis.forEach(li => {
                    const nameEl = li.querySelector('.ingredient-name');
                    const text = nameEl ? nameEl.textContent.trim() : li.textContent.trim();
                    if(text === ingredient_name){
                        toggleStrikeThrough(li, true);
                    }
                })
            }
            else{
                console.log(`no target li for recipe id ${recipe_id}`);
            }
        })
    })

    //Find them in the buttons and toggle them as checked off
