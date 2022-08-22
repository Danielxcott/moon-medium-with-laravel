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

//login gsap
const containers = document.querySelectorAll(".input-container");
const form = document.querySelector("section");
const checkbox = document.querySelector(".checkbox");

containers.forEach((container)=>{
  const input = container.querySelector(".login-input");
  const placeholder = container.querySelector(".placeholder");

  input.addEventListener("focus",()=>{
    if(!input.value)
    {
      placeholder.classList.add("active");
    }
  })
})
form.addEventListener("click",()=>{
    containers.forEach((container)=>{
      const input = container.querySelector(".login-input");
      const placeholder = container.querySelector(".placeholder");
      if(document.activeElement !== input)
      {
      if(!input.value)
      {
        placeholder.classList.remove("active");
      }
      }
    })
});
checkbox.addEventListener("click",()=>{
  if(checkbox.checked)
  {
    $(".checkbox-fill").addClass("active");
  }else{
    $(".checkbox-fill").removeClass("active");
  }
})

const tl = gsap.timeline({defaults: {duration: 1}});
const start =  "M0 0.999512C0 0.999512 60.5 0.999512 150 0.999512C239.5 0.999512 300 0.999512 300 0.999512";
const end =
  "M1 0.999512C1 0.999512 61.5 7.5 151 7.5C240.5 7.5 301 0.999512 301 0.999512";


  containers.forEach((container)=>{
    const input = container.querySelector(".login-input");
    const line = container.querySelector(".elastic-line");
    const placeholder = container.querySelector(".placeholder");
    input.addEventListener("focus", () => {
        if (!input.value) {
          tl.fromTo(
            line,
            { attr: { d: start } },
            { attr: { d: end }, ease: "Power2.easeOut", duration: 0.75 }
          );
          tl.to(line, { attr: { d: start }, ease: "elastic.out(3,0.5)" }, "<50%");
    
          //placeholder
          tl.to(
            placeholder,
            {
              top: -18,
              left: 0,
              scale:0.8,
              duration: 0.5,
              ease: "Power2.easeOut",
            },
            "<15%"
          );
        }
      });
  })

  form.addEventListener("click", () => {
    containers.forEach((container) => {
      const input = container.querySelector(".login-input");
      const line = container.querySelector(".elastic-line");
      const placeholder = container.querySelector(".placeholder");
  
      if (document.activeElement !== input) {
        if (!input.value) {
          gsap.to(placeholder, {
            top: 0,
            left: 0,
            scale: 1,
            duration: 0.5,
            ease: "Power2.easeOut",
          });
          colorize("#777474", line, placeholder);
        }
      }
      input.addEventListener("input", (e) => {
        //Name Validation
        if (e.target.type === "text") {
          let text = e.target.value;
          if (text.length > 2) {
            colorize("#6391E8", line, placeholder);
          } else {
            colorize("#FE8C99", line, placeholder);
          }
        }
        //Email Validation
        if (e.target.type === "email") {
          let mail = validateEmail(e.target.value);
          if (mail) {
            colorize("#6391E8", line, placeholder);
          } else {
            colorize("#FE8C99", line, placeholder);
          }
        }
      });
    });
  })
    function validateEmail(email) {
        let re = /\S+@\S+\.\S+/;
        return re.test(email);
      }

      function colorize(color, line, placeholder) {
        gsap.to(line, { stroke: color, duration: 0.75 });
        gsap.to(placeholder, { color: color, duration: 0.75 });
      }  


const tl2 = gsap.timeline({
  default: { duration: 0.5, ease: "Power2.easeOut" },
});
const tickMark = document.querySelector(".tick-mark path");
const pathLength = tickMark.getTotalLength();
console.log(pathLength);

gsap.set(tickMark, {
  strokeDashoffset: pathLength,
  strokeDasharray: pathLength,
});

checkbox.addEventListener("click", () => {
  if (checkbox.checked) {
    tl2.to(".checkbox-fill", { top: 0 });
    tl2.fromTo(
      tickMark,
      {
        strokeDashoffset: pathLength,
      },
      { strokeDashoffset: 0 },
      "<50%"
    );
    tl2.to(".checkbox-label", { color: "#204ea7" }, "<");
  } else {
    tl2.to(".checkbox-fill", { top: "100%" });
    tl2.fromTo(
      tickMark,
      { strokeDashoffset: 0 },
      { strokeDashoffset: pathLength },
      "<50%"
    );
    tl2.to(".checkbox-label", { color: "#4c4c4c" }, "<");
  }
});