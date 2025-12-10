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


const shoppingListArea = document.getElementById('shopping-list');


function toggleStrikeThrough(target, add){
    add ? target.style = "text-decoration: line-through;" : target.style = "";
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

    const btn = event.target;
    const recipe_id = btn.closest('div').id;
    const ingredient_name = btn.textContent;

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
                    //add strikethrough
                    toggleStrikeThrough(btn, true);

                }
                else{
                    toggleStrikeThrough(btn, false);
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
                       
                //add a div wrapping it
                const recipeDiv = document.createElement('div');
                const titleElement = document.createElement('h3');
                const imageElement = document.createElement('img');
                const ingredientsUl = document.createElement('ul');

                //add a title
                recipeDiv.id = recipe_id;
                titleElement.textContent = title;
                imageElement.src = image;

                //add the ingredients list

                ingredients.forEach(ingredient => {
                    const ingredientLi = document.createElement('li');
                    ingredientLi.textContent = ingredient.name;
                    ingredientLi.addEventListener('click', toggleIngredient);
                    ingredientsUl.appendChild(ingredientLi);
                })


                recipeDiv.appendChild(titleElement);
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

    //Get the current ingredietns that the user has
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
        //For reach one get the id and find the ingredient, if it is there put a strike through on it
        res.message.forEach(recipe => {
            const ingredient_name = recipe.ingredient_name;
            const recipe_id = recipe.recipe_id;

            console.log(possibleTargetResult);
            if(possibleTargetResult){
                const possibleTargetLis = possibleTargetResult.querySelectorAll('li');
                if(possibleTargetLis){
                    possibleTargetLis.forEach(li => {
                        if(li.textContent == ingredient_name){
                            toggleStrikeThrough(li, true);
                        }
                        else{
                        console.log(`Text content did not match for`);
                    }
                    })
                    
                }
                else{
                    console.log(`no target li for ${recipe}`);
                }
            }
            else{
                console.log(`no possible target for ${recipe}`);
                console.log(recipe.recipe_id);
            }
        })


    })

    //Find them in the buttons and toggle them as checked off
