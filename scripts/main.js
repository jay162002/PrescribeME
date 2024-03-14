function checkvalidation(){

    let password = document.getElementById('sign_up_pass').value;
    let cpassword = document.getElementById('sign_up_confirm_pass').value;

    if(password !== cpassword){
        alert("Passwords don't match!");
    }
    
}

function close_popup(){

    let container = document.getElementById('error_popup_container');
    container.style.display = 'none';

}
