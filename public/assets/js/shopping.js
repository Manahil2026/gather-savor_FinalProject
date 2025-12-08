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

function populateRecipeDetails(recipes){

    recipes.forEach(recipe => {
        const recipe_id = recipe.id;
        fetch(`https://api.spoonacular.com/recipes/${recipe_id}/information?apiKey=79f089b8a521468eadcd3dcad358548a`)
            .then(res => res.json())
            .then(recipe => {    
                console.log(recipe);

                const id = recipe['id'];
                const title = recipe['title']
                const image = recipe['image']
                const ingredients = recipe['extendedIngredients'];

                       
                //add a div wrapping it
                const recipeDiv = document.createElement('div');
                const titleElement = document.createElement('h3');
                const imageElement = document.createElement('img');
                const ingredientsUl = document.createElement('ul');

                //add a title
                recipeDiv.id = id;
                titleElement.textContent = title;
                imageElement.src = image;
                ingredientsUl.id = recipe_id;

                //add the ingredients list

                ingredients.forEach(ingredient => {
                    const ingredientLi = document.createElement('li');
                    ingredientLi.textContent = ingredient.name;
                    ingredientLi.addEventListener('click', event => {console.log('hi')})
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
            console.log(res);
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
    .then(res => console.log(res));

    //Find them in the buttons and toggle them as checked off
