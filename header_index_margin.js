document.addEventListener('DOMContentLoaded', function () {
    document.querySelector('.nav-header').style.marginTop = document.querySelector('.notice').getBoundingClientRect().height + 'px';

    //notice分のマージン
    document.querySelector('main').style.marginTop = document.querySelector('.notice').getBoundingClientRect().height + 'px'


    //ヘッダーの透明度
    const hero = document.querySelector('.hero')
    if (hero) {
        const heroHeight = hero.getBoundingClientRect().height
        window.addEventListener('scroll', function () {
            //console.log(window.scrollY);
            //console.log(heroHeight);

            if (window.scrollY > heroHeight / 2) {
                this.document.querySelector('.nav-header').style.backgroundColor = 'rgb(0,0,0,0.7)';
                //console.log('a');

            } else {
                this.document.querySelector('.nav-header').style.backgroundColor = 'rgb(0,0,0,0.1)';
            }
        })
    }

})