document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('open-nav').addEventListener('click',function(){
        openNav()
    })
    document.getElementById('close-nav').addEventListener('click',function(){
        closeNav();
    })
    document.getElementById('nav-overlay').addEventListener('click',function(){
        closeNav();
    })
})

function openNav() {
    document.querySelector('.nav-window').style.left = '0'
    document.getElementById('nav-overlay').style.display = 'block'
}
function closeNav() {
    document.querySelector('.nav-window').style.left = '-100%'
    document.getElementById('nav-overlay').style.display = 'none'
}