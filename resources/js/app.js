import * as bootstrap from 'bootstrap';
import "../../node_modules/jquery/dist/jquery";
import "../../node_modules/slick-carousel/slick/slick";
import "../../node_modules/owl.carousel/dist/owl.carousel";

$('.post-content .trend-post .trend-carousel').owlCarousel({
    loop:true,
    margin:20,
    autoWidth:true,
    nav:false,
    dots:false,
    touchDrag:true,
    responsiveClass:true,
    responsive:{
        0:{
            items:1
        },
        200:{
            items:1
        },
        340:{
            items:2
        },
        400:{
            items:1
        },
        540:{
            itema:1
        },
        800:{
            items:2
        }
    }
})

//slick
$('.user-profile-left').slick({
    slidesToShow: 7,
    slidesToScroll: 1,
    nextArrow: false,
    prevArrow: false,
    autoplay: true,
    autoplaySpeed: 900,
    accessibility: false,
    useTransform: false,
    responsive: [
        {
            breakpoint: 800,
            settings: {
                slidesToShow: 3,
                slidesToScroll: 1,
              },
          },
          {
            breakpoint: 300,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 1,
              },
          },
          
    ]
  });
  $('.user-profile-box').slick({
    slidesToShow: 2,
    slidesToScroll: 1,
    nextArrow: false,
    prevArrow: false,
    autoplay: true,
    autoplaySpeed: 500,
    accessibility: false,
    useTransform: false,
  }); 