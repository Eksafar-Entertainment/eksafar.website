// theme switch
document.getElementById('btnSwitch').addEventListener('click',()=>{
    if (document.body.classList.contains('dark')) {
        document.body.classList.remove('dark');
    }
    else {
        document.body.classList.add('dark');
    }

    const navbar = document.querySelector("nav");

    if (navbar.classList.contains('navbar-dark')) {
        navbar.classList.remove('navbar-dark');
        navbar.classList.add('navbar-light');
    }
    else {
        navbar.classList.remove('navbar-light;')
        navbar.classList.add('navbar-dark');
    }
})