$(function () {
    new Swiper('.comments .swiper-container', {
        slidesPerView: 3,
        loop: true,
        autoplay: {
            delay: 2500,
            disableOnInteraction: false,
        },
        pagination: {
            el: '.comments .swiper-pagination',
        },
        navigation: {
            nextEl: '.comments_button--right',
            prevEl: '.comments_button--left',
        },
        breakpoints: {
            768: {
                slidesPerView: 1,
            }
        },
    });
});