document.addEventListener('DOMContentLoaded',function(){
    document.getElementById('close-notice').addEventListener('click',function(){
        document.querySelector('.notice').style.height='0px';
        document.querySelector('.nav-header').style.marginTop = '0px';
    })
})