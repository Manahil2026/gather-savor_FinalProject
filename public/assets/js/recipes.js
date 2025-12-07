//Apply a button to every food, get its ID and send the client to recipe-details

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
    window.location.href = `http://localhost/recipe-details.php?id=${id}`;
}