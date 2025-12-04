//Get a bunch of recipes from the api
//Make request to some endpoint. I'll call it api?
//Parse the results


//Get the section <id = recipe-results>


const loadButton = document.querySelector("#loadButton");
function getRecipes(){
    fetch("/api/v1/dbAPI.php", {
    method: "POST",
    credentials: "include",
    headers: {
        "Content-Type": "application/json"
    },
    body: JSON.stringify({
            data: {
                "action": "add",
                "table": "favorites",
                "values": {"link":"https://google.com"}
            }
        })
    })
    .then(res => res.json())
    .then(data => console.log(data));
}

loadButton.addEventListener('click',getRecipes);

//Create a dom element and attach to recipe results

//When you click on one of the recipes, it makes a post request to recipe-details and pulls up the url and fills everything in

//the recipe details page has the make favorite button and an add to meal plan button