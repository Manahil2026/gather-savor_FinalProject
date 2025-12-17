const registerForm = document.querySelector('.auth-form');
const authActionsDiv = registerForm.querySelector('.auth-actions')
const registerButton = authActionsDiv.querySelector('button');
const errorElement = document.querySelector('.alert.error');

function registerRequest(event){
    event.preventDefault();
    const name = registerForm.querySelector('input[name="name"]').value
    const email = registerForm.querySelector('input[name="email"]').value
    const password = registerForm.querySelector('input[name="password"]').value
    const confirmPassword = registerForm.querySelector('input[name="confirm_password"]').value

    try{

        fetch("http://localhost/api/v1/api.php", {
            method: "POST",
            headers: {
                'Content-Type':  "application/json"
            },
            body: JSON.stringify({
                action: "register",
                name: name,
                email: email,
                password: password,
                confirm_password: confirmPassword
                })
            })
            .then(res => res.json())
            .then(res => {
                if(res.status == "success"){
                    window.location.href = "http://localhost/home.php"
                }
                else{
                    errorElement.classList = "alert error visible"
                    errorElement.textContent = res.message
                }            
            })
    }
    catch(err) {
        console.log(err);
    }
    
}
registerButton.addEventListener('click', registerRequest);



