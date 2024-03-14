const user_profile_btn=document.querySelector('.sign_in_user_profile_btn');
user_profile_btn.addEventListener("click",()=>{
    document.getElementById("profile_pop_up").classList.toggle("active");
    document.getElementById("cred_users_container").classList.add("hide");
});

const cred_box_container = document.querySelector(".cred_box_container");
    cred_box_container.addEventListener("click", () => {
        document.getElementById("cred_users_container").classList.toggle("hide");
        document.getElementById("profile_pop_up").classList.add("hide");
        document.getElementById("profile_pop_up").classList.remove("active");
    })


    function close_popup(){

        let container = document.getElementById('error_popup_container');
        container.style.display = 'none';
    
    }