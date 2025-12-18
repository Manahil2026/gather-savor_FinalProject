
document.addEventListener('DOMContentLoaded', event => {
    
    //Leaving this api key in the open, for a real web server hide this, or even just keep the logic on the web server not in the client.
    fetch("https://api.spoonacular.com/recipes/complexSearch?apiKey=79f089b8a521468eadcd3dcad358548a&number=20")
        .then(res => res.json())
        .then(res => populateRecipes(res))
})

const recipeResultsSection = document.querySelector("#recipe-results");

const searchBox = document.getElementById('search-box');
const recipeSearchForm = document.getElementById('recipe-search-form')
const filterLabels = recipeSearchForm.querySelector('.recipeFilters').querySelectorAll('label')

//Add event listener to check if it's been checked
filterLabels.forEach(label => {
    const input = label.querySelector('input');
    input.addEventListener('change', event => {
        search(event)
    })

})

//Don't refresh the page. You don't have to press enter
recipeSearchForm.addEventListener('submit', event => event.preventDefault())

function getRecipeDetails(event){
    const id = event.target.closest("div").id;
    window.location.href = `http://localhost/recipe-details.php?recipe_id=${id}`;
}



function sleep(ms){
    return new Promise(r => setTimeout(r, ms));
}


async function populateRecipes(recipes){ 


    for(recipe of recipes['results']){
        await sleep(300)

        fetch(`https://api.spoonacular.com/recipes/${recipe['id']}/information?apiKey=79f089b8a521468eadcd3dcad358548a`)
            .then(res => res.json())
            .then(res => {
                //Figure out the filters

                const potential_tags = {
                    cheap: res['cheap'],
                    dairyFree:  res['dairyFree'],
                    glutenFree: res['glutenFree'],
                    //ketogenic:  res['ketogenic'],
                    lowFodmap: res['lowFodmap'],
                    sustainable: res['sustainable'],
                    vegan: res['vegan'],
                    vegetarian: res['vegetarian'],
                    veryHealthy: res['veryHealthy'],
                    veryPopular: res['veryPopular'],
                }

                const tags = []
                for(const tag in potential_tags){
                    if(potential_tags[tag]){
                        tags.push(tag);
                    }
                }
                
                //build dom
                const recipe_id = res['id'];
                const image = res['image'];
                const recipeTitle = res['title'];

                const newArticle = document.createElement('article');
                const newImage = document.createElement('img');
                const newH3 = document.createElement('h3');
                const newP = document.createElement('p');
                const newDiv = document.createElement('div');
                const newA = document.createElement('a');
                const newBtn = document.createElement('button');

                newArticle.addEventListener('click', event => {
                    window.location.href = `http://localhost/recipe-details.php?recipe_id=${recipe_id}`
                })
                
                //Also put data-id
                newArticle.dataset.tags = tags.join(" ");

                newArticle.classList = "recipe-card"
                newArticle.id = recipe_id;
                newImage.src = image;
                newH3.textContent =  recipeTitle;
                newH3.classList = "recipe-card-title";
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
                //newArticle.appendChild(newP);
                newDiv.appendChild(newA);
                //newDiv.appendChild(newBtn);
                newArticle.appendChild(newDiv)

                recipeResultsSection.appendChild(newArticle);
            })
            //I'm rate limited
            
    }
    
}



//Does the searching

function search(clickEvent){
    
    //Don't refresh the page
    clickEvent.preventDefault()
    
    const recipes = document.getElementById('recipe-results').querySelectorAll('article');
    

    //Reset
    recipes.forEach(recipe => {
        recipe.style.display = "block"
    })

    //do search
    recipes.forEach(recipe =>{
        //Test the search by name
        (testFoodName(recipe) && testFilters(recipe)) ? recipe.style.display = "block" : recipe.style.display = "none"
    })
}

function testFilters(card){
    const desiredTags = [];
    filterLabels.forEach(label => {
        const input = label.querySelector('input')
        if(input.checked){
            desiredTags.push(input.name);
        }
    })

    const tags = card.dataset.tags.split(" ");

    //return true if there are no filters  
    if(desiredTags.length == 0){
        return true;
    }
    
    //debug
    //console.log(desiredTags);
    //console.log(tags);

    for(const desiredTag of desiredTags){
        for(const tag of tags){
            if(desiredTag === tag){
                return true
            }
        }
    }

    return false;


}

function testFoodName(card){
    
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



searchBox.addEventListener("input", search)
