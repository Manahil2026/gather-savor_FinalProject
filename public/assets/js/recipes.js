
//Leaving this api key in the open, for a real web server hide this, or even just keep the logic on the web server not in the client.
fetch("https://api.spoonacular.com/recipes/complexSearch?apiKey=79f089b8a521468eadcd3dcad358548a&number=20")
    .then(res => res.json())
    .then(res => populateRecipes(res))


const recipeResultsSection = document.querySelector("#recipe-results");
const searchButton = document.getElementById('search-button');

function getRecipeDetails(event){
    const id = event.target.closest("div").id;
    window.location.href = `http://localhost/recipe-details.php?recipe_id=${id}`;
}


function populateRecipes(recipes){ 
    recipes['results'].forEach(recipe => {
    
    

            //html
            const recipe_id = recipe['id'];
            const image = recipe['image'];
            const recipeTitle = recipe['title'];
     

            const recipeDiv = document.createElement('div');
            const imageElement = document.createElement('img');
            const recipeTitleElement = document.createElement('p');
            const newBtn = document.createElement('button');
            

            recipeDiv.id = recipe_id;
            imageElement.src = image;
            recipeTitleElement.textContent = recipeTitle;
            recipeTitleElement.classList = "recipe-title";
            imageElement.addEventListener('click', getRecipeDetails);

            //Temporary styling
            recipeDiv.style= "text-align: center";


            recipeDiv.appendChild(recipeTitleElement);
            recipeDiv.appendChild(imageElement);
            recipeDiv.appendChild(newBtn);
            recipeResultsSection.appendChild(recipeDiv);
    })
}



function search(clickEvent){
    const recipes = document.getElementById('recipe-results').querySelectorAll('div');
    //Don't refresh the page
    clickEvent.preventDefault()

    //Reset
    recipes.forEach(recipe => {
        recipe.style.display = "block"
    })

    //do search
    recipes.forEach(recipe =>{
        //Test the search by name
        testFoodName(recipe) ? recipe.style.display = "block" : recipe.style.display = "none"
    })
}

function testFoodName(card){
    const searchBox = document.getElementById('search-box');
    //Filter for the search box
    const foodName = card.querySelector('.recipe-title').textContent
    const searchExpression = new RegExp(".*" + searchBox.value + ".*", "i")
    if(searchBox.value != ""){
        if(!searchExpression.test(foodName)){
                return false
            }
        return true 
    }
    return true //if the value is nothing just skip this check
}


searchButton.addEventListener("click", search)

//Apply a button to every food, get its ID and send the client to recipe-details


/*
const recipeData = document.querySelector("#recipe-results");

const foods = recipeData.querySelectorAll('.food-item');




foods.forEach(food => {
    const newBtn = document.createElement('button');
    newBtn.textContent = "Get Details"
    food.appendChild(newBtn);
    
    newBtn.addEventListener('click', getRecipeDetails);


})


function getRecipeDetails(event){
    const id = event.target.closest("div").id;
    window.location.href = `http://localhost/recipe-details.php?recipe_id=${id}`;
}


*/