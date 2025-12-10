
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
    
    
            /*
            <article class="recipe-card">
				<img src="assets/images/pumpkin-soup.jpg" alt="Recipe name">
				<h3 class="recipe-card-title">Cozy Pumpkin Soup</h3>
				<p class="recipe-card-meta">30 mins . 4 servings</p>
				<div class="recipe-card-actions" style="display: block;">
					<a href="recipe.php?id=1" class="btn primary-btn">View Recipe</a>
					<button class="btn secondary-btn">Favorites</button>
				</div>
			</article>


            */

            const recipe_id = recipe['id'];
            const image = recipe['image'];
            const recipeTitle = recipe['title'];

            const newArticle = document.createElement('article');
            const newImage = document.createElement('img');
            const newH3 = document.createElement('h3');
            const newP = document.createElement('p');
            const newDiv = document.createElement('div');
            const newA = document.createElement('a');
            const newBtn = document.createElement('button');



            newArticle.classList = "recipe-card"
            newArticle.id = recipe_id;
            newImage.src = image;
            newH3.textContent =  recipeTitle;
            newP.textContent = "Placeholder" //Servings, prep time
            newDiv.classList = "recipe-card-actions"
            newDiv.style.display = "block";
            newA.href = `http://localhost/recipe-details.php?recipe_id=${recipe_id}`;
            newA.textContent = "View Recipe";
            newA.classList = "btn primary-btn";
            newBtn.classList = "btn secondary-btn";
            newBtn.textContent = "Favorite";

            newArticle.appendChild(newImage);
            newArticle.appendChild(newH3);
            newArticle.appendChild(newP);
            newDiv.appendChild(newA);
            newDiv.appendChild(newBtn);
            newArticle.appendChild(newDiv)

            recipeResultsSection.appendChild(newArticle);
    })
}



function search(clickEvent){
    const recipes = document.getElementById('recipe-results').querySelectorAll('article');
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
    const foodName = card.querySelector('.recipe-card-title').textContent
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