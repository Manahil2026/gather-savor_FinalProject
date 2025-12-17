//When the person clicks Log In send a request to the login endpoint.


const loginForm = document.querySelector('.auth-form');
const authActionsDiv = loginForm.querySelector('.auth-actions')
const loginBtn = authActionsDiv.querySelector('.auth-btn-primary');
const errorElement = document.querySelector(".alert.error")


function requestLogin(event){
    event.preventDefault();

    const email = loginForm.querySelector('input[name="email"]').value
    const password = loginForm.querySelector('input[name="password"]').value

    fetch("http://localhost/api/v1/api.php", {
        method: "POST",
        headers: {
            'Content-Type':  "application/json"
        },
        body: JSON.stringify({
            action: "login",
            email: email,
            password: password
        })

        })
        .then(res => res.json())
        .then(res => {
            if(res.status == "success"){
                console.log('succeed')
                //I am aware that it could be intercepted to just say success
                //If it was truly successful then the person would have a session.
                //The person would hit home.php, and would be redirected
                window.location.href = "http://localhost/home.php"
            }
            else{
                errorElement.classList = "alert error visible"
                errorElement.textContent = res.message
            }            
    })

}


loginBtn.addEventListener('click', requestLogin)


