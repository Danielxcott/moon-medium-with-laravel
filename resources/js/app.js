import * as bootstrap from 'bootstrap';
import Swal from 'sweetalert2/dist/sweetalert2.js';
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

  window.banConfirmRole = function(id){
    Swal.fire({
        title: 'Are you sure to ban this user?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Confirm'
      }).then((result) => {
        if (result.isConfirmed) {
          Swal.fire(
            'Banned!',
            "Current user's has been banned.",
            'success'
          )
          setTimeout(function(){
            $("#banform"+id).submit();
          },1200)
        }
      })
  }

window.unBanConfirmRole = function(id)
{
    Swal.fire({
        title: 'Are you sure to unban this user?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Confirm'
      }).then((result) => {
        if (result.isConfirmed) {
          Swal.fire(
            'Unbanned!',
            "Current user's has been unbanned.",
            'success'
          )
          setTimeout(function(){
            $("#unbanform"+id).submit();
          },1200)
        }
      })
}

window.loadmessageCount = function(articleId)
{
  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
  $.ajax({
    method: "POST",
    url: "/dashboard/load-message-count",
    data:{
      "id": articleId,
    },
    success: function(response)
    {
      $(".message-count").html(response.count);
    }
  })
}