// Animation menu
const allMenu = document.querySelectorAll('.menuItem');

allMenu.forEach(menuItem => {
    menuItem.addEventListener('mouseenter',(e)=>{
        e.target.classList.add('activeGrow');
        for(let i = 0; i < allMenu.length; i++){
            if(allMenu[i] !== e.target){
                allMenu[i].classList.remove('activeGrow');
            }
        }
    })
});

// Detecter si le site est sur mobile


if(/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)){
// true for mobile device
document.getElementById('pageStyle').setAttribute('href','mobileStyle.css')
console.log("mobile device");
}else{
// false for not mobile device
console.log("not mobile device");
}