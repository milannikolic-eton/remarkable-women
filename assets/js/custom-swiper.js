document.addEventListener('DOMContentLoaded', function () {
    const swiperContainers = document.querySelectorAll('.swiper-gallery');

    swiperContainers.forEach((container) => {
        new Swiper(container, {
            loop: false,
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            slidesPerView: 1,
            spaceBetween: 20,
        });
    });
});
