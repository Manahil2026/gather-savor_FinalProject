const foodCards = document.querySelectorAll(".recipe-card")

const searchBox = document.getElementById("searchName")
const ingredientFilterBox = document.getElementById("searchIngredient")

const searchButton = document.getElementById("searchBtn")
const clearButton = document.getElementById("clearFilters")
const filterButton = document.getElementById("filterFav")

//Search Button
function search(clickEvent){
    //Don't refresh the page
    clickEvent.preventDefault()

    //Reset
    foodCards.forEach(card => {
        card.style.display = "block"
    })

    //do search
    foodCards.forEach(card =>{

        //Test the search by name and search by ingredient filters
        testFoodName(card) && testIngredient(card) ? card.style.display = "block" : card.style.display = "none"
    
        //Then clear for the favorites.
        testFavorites(card)
    })
}

function testFoodName(card){
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

function testIngredient(card){
    //Filter for the ingredients
    const ingredientExpression = new RegExp(".*" + ingredientFilterBox.value + ".*", "i")
    const ingredients = card.querySelectorAll("li")
    if(ingredientFilterBox.value != ""){
        for(const ingredient of ingredients){
            if(ingredientExpression.test(ingredient.textContent)){
                return true
            }
        }
        return false
    }
    return true //If the value is nothing then skip, user didn't want to filter this.
}

function testFavorites(card){
    //Filter for the favorites
    let isFavorite = false
    if(filterButton.value == "favorites"){
        let favs = JSON.parse(localStorage.getItem("favorites"))

        favs.forEach(favObject => {
            if(card.id == favObject.id){
                isFavorite = true
            }
        })

        if(!isFavorite){
            card.style.display = "none" 
        }
    }
}


//Clear the filters
function clearFilters(clickEvent){
    clickEvent.preventDefault()
    searchBox.value = ""
    ingredientFilterBox.value = ""
    filterButton.value = "all"

    foodCards.forEach(card => {
        card.style.display = "block"
    })
}

searchButton.addEventListener("click", search)
clearButton.addEventListener("click", clearFilters)

//Add to meal plan button. 
//Get the name and add it on the meal plan <li>
