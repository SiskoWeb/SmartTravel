document.addEventListener('DOMContentLoaded', function () {
    let index = 0;
    const slider_hero = document.getElementById('slider_hero');

    const img_url = [
        'assets/slider/1.jpg',
        'assets/slider/2.jpg',
        'assets/slider/3.jpg',

    ];

    function sliderHeroFun(index) {
        slider_hero.style.backgroundImage = `url(${img_url[index]})`;
    }

    setInterval(() => {
        index = index + 1;
        console.log(index);
        if (index >= img_url.length) {
            index = 0;
        }

        sliderHeroFun(index);
    }, 3000);
});
