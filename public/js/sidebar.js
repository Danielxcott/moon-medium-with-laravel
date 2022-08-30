$(".burger-nav").click(function(){
    $("aside").toggleClass("shrink");
    $("main").toggleClass("expand");
})

//dropbox-btn
$("#dropbox-btn").click(function(){
    $(".profile-dropbox").toggleClass("show");
});

//sidebar
$(".noti-group .noti-bell").click(function(){
    $(".noti-nav").toggleClass("active");
    $("body").toggleClass("hide");
})

$(".noti-close").click(function(){
    $(".noti-nav").toggleClass("active");
    $("body").toggleClass("hide");
})

$(".nav-close").click(function(){
    $("aside").toggleClass("active");
    $("body").toggleClass("hide");
})

$("aside .sidebar-head #back-btn").click(function(){
    $("aside").toggleClass("active");
})
function change(){
    $("aside").toggleClass("active");
    $("body").toggleClass("hide");
}

$("#magic-wand").click(function(){
    $("#profile_img").click();
})
$("#cover-icon").click(function(){
    $("#cover_img").click();
})

$(".close-btn").click(function(){
    $(".post-tab .post-detail .close-btn").removeClass("active");
    $(".post-tab .post-detail .all-reaction").removeClass("active");
    $(".all-comment").removeClass("active");
})
$(".like-btn").click(function(){
    $(".post-tab .post-detail .all-reaction").toggleClass("active");
    $(".post-tab .post-detail .close-btn").toggleClass("active");
})

$("#dot").click(function(){
    $(".dropbox-list .dropbox-card").toggleClass("active");
})

$(".comment-btn").click(function(){
    $(".all-comment").toggleClass("active");
    $(".post-tab .post-detail .close-btn").toggleClass("active");
})

$("#write-comment").click(function(){
    $(".user-comment-lists .comment-box").toggleClass("active");
})

//edit profile start
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

//viewer follower
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

