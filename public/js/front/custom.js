// theme switch
document.getElementById('btnSwitch').addEventListener('click',()=>{
    const mainCss = document.querySelector("#main-css");
    mainCss.href = mainCss.href.replace("light", "dark");
})

document.onscroll = function() {
    if( $(window).scrollTop() > $('header').height() ) {
        $('nav > div.navbar').removeClass('navbar-static-top').addClass('navbar-fixed-top');
    }
    else {
        $('nav > div.navbar').removeClass('navbar-fixed-top').addClass('navbar-static-top');
    }
};