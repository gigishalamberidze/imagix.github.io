const settingsMenu = document.querySelector('.user-profile-settings');
const settings = document.querySelector('.settings');
const header = document.querySelector('.header');


let a = 0;
settingsMenu.addEventListener('click', ()=>{
    if(a==0){
        settings.style.opacity = 1;
        settings.style.zIndex = 5;
        return a = 1;
    }
    if(a==1){
        settings.style.opacity = 0;
        settings.style.zIndex = -1;
        return a = 0;
    }
    
   
})

const SignOut = document.getElementById('Signout');

SignOut.addEventListener('click',()=>{
    window.location = 'index.php';
} )

