$(".burger-nav").click(function(){
    $("aside").toggleClass("shrink");
    $("main").toggleClass("expand");
    $(".box-one").toggleClass("expand");
    $(".box-two").toggleClass("expand");
    $(".chart-wrapper").toggleClass("expand");
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

// owl carousel


//weather
const weatherContainer = document.querySelector(".weather-container");
let apiKey = "5701276a9398a92040240a2437ce1148";
let api ;

function requestApi(city="yangon")
{
   api = `https://api.openweathermap.org/data/2.5/weather?q=${city}&units=metric&appid=${apiKey}`;
   fetchData();
}

function fetchData()
{
    fetch(api)
    .then(response=>response.json())
    .then(json=>weatherDetails(json));
}
function weatherDetails(info)
{
    console.log(info);  
    if(info.cod == "400"){
        weatherContainer.style.backgroundImage = "url('/assets/img/gif/dwarf.gif')";
        weatherContainer.style.backgroundSize = "cover";
        weatherContainer.style.backgroundPosition = "center";
        $(".text-container").remove();
        console.warn("the weather location is not a valid city name");
    }else{
        let {description,id} = info.weather[0];
        let city = info.name;
        let country = info.sys.country;
        let {feels_like,humidity,temp} = info.main;
        let location = city+","+country;
        $(".number").text(Math.floor(temp));
        $(".weather").text(description);
        $(".location").text(location);
        $(".feel-like .temp").text(Math.floor(feels_like)+"°C");
        $(".humidity .percent").text(humidity+"%") 
        if(id == 800){
          weatherContainer.style.backgroundImage  = "url('../img/Weather/clear.svg')";
        }else if(id >=200 && id <= 232){
            weatherContainer.style.backgroundImage  = "url('../img/Weather/storm.svg')";
        }else if(id >= 300 && id <= 321){
            weatherContainer.style.backgroundImage  = "url('../img/Weather/drizzle.png')";
        }else if(id >= 500 && id<= 531){
            weatherContainer.style.backgroundImage  = "url('../img/Weather/rain.svg')";
        }else if(id >= 600 && id<= 622){
            weatherContainer.style.backgroundImage  = "url('../img/Weather/snow.svg')";
        }else if(id >= 701 && id<= 781){
            weatherContainer.style.backgroundImage  = "url('../img/Weather/haze.svg')";
        }else if(id >= 801 && id<= 804){
            weatherContainer.style.backgroundImage  = "url('../img/Weather/cloud.svg')";
        }
    }
}

requestApi();

//Quote generator
const getQuote = async () =>{
    const data = await fetch(`https://api.quotable.io/random`);
    const result = await data.json();
    console.log(result);
    $(".quote-text .paragraph").text(result.content);
  }
  getQuote();