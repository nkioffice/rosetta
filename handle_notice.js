document.addEventListener('DOMContentLoaded',function(){
    
    document.getElementById('close-notice').addEventListener('click',function(){
        
        document.querySelector('.notice').style.maxHeight='0px';
        document.querySelector('.nav-header').style.marginTop = '0px';
        document.querySelector('main').style.transition = 'margin-top 0.5s ease';
        document.querySelector('main').style.marginTop = '0px';
    })
})