
$(".search-btn").click(function(){
    $(".input-box").toggleClass("active");
});
try{
    $('.category-lists-mobile').slick({
        infinite: false,
        slidesToShow: 3,
        slidesToScroll: 3,
        variableWidth: true,
        responsive: [
            {
              breakpoint: 1200,
              settings: {
                slidesToShow: 2,
                slidesToScroll: 1,
              },
            },
            {
              breakpoint: 1008,
              settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
              },
            },
            {
              breakpoint: 800,
              settings: 'unslick',
            },
            {
                breakpoint: 480,
                settings: {
                  slidesToShow: 2,
                  slidesToScroll: 1,
                },
              },
          ],
      });
}catch(error)
{
    console.warn("slick carousel is not support here")
}

const nav = document.querySelector(".nav-menu"),
            toggleBtn = nav.querySelector(".toggle-btn");
            toggleBtn.addEventListener("click",()=>{
                nav.classList.toggle("open")
            })
function commentBtn(x)
{
    $(".comment-asidenav").toggleClass("active");
}

$(".comment-aside-close").click(function(){
    $(".comment-asidenav").toggleClass("active");
})
$(".close-com-btn").click(function(){
    $(".comment-asidenav").toggleClass("active");
})

$(".request-noti").click(function(){
    $(".noti-nav").toggleClass("active");
})
$(".noti-close").click(function(){
    $(".noti-nav").toggleClass("active");
})
function viewerBtn(x)
{
    const viewer = $("#viewers"+x);
    const close = $("#viewerClose"+x);
    viewer.toggleClass("active");
    close.addClass("active");
}

function closeReaction(x)
{
    const closeBtn = $("#viewerClose"+x);
    const viewer = $("#viewers"+x);
    viewer.toggleClass("active");
    closeBtn.removeClass("active");
}

function viewerFollower(x)
{
    const viewer = $("#viewerFollower"+x);
    const close = $("#viewerFollowerClose"+x);
    viewer.toggleClass("active");
    close.addClass("active");
}

function closeViewerFollower(x)
{
    const closeBtn = $("#viewerFollowerClose"+x);
    const viewer = $("#viewerFollower"+x);
    viewer.toggleClass("active");
    closeBtn.removeClass("active");
}

try{
    const exampleEl = document.getElementById('slug')
    const tooltip = new bootstrap.Tooltip(exampleEl);
}catch(error){
    console.log(error.message);
}

$(".edit-cover-photo").delegate(".edit-cover-btn","click",function(){
    let x = $(this).parent().find("#cover-input");
   $(this).parent().find("#cover-input").click();
   if(x !== "")
   {
    $(".current-img-extension").text(x.val());
   }else
   {
    $(".current-img-extension").text(x.val());
   }
})

$(".edit-profile-photo").delegate(".edit-profile-btn","click",function(){
   $(this).parent().find("#profile-input").click();
})