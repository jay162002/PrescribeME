const user_profile_btn=document.querySelector('.sign_in_user_profile_btn');
user_profile_btn.addEventListener("click",()=>document.querySelector(".profile_pop_up").classList.toggle("active"));

function close_popup(){

    let container = document.getElementById('error_popup_container');
    container.style.display = 'none';

}
