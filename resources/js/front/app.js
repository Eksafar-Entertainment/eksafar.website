/**
 * First we will load all of this project's JavaScript dependencies which
 * includes React and other helpers. It's a great starting point while
 * building robust, powerful web applications using React + Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh React component instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

 const ticketElm = document.getElementById("ticket");
 const ticket = document.querySelector(".ticket__box");
 const { x, y, width, height } = ticketElm.getBoundingClientRect();
 window.addEventListener("mousemove", (e) => {
   const ticketCntr = { x: x + width / 2, y: y + height / 2 };
   const degreeY = (e.clientX - ticketCntr.x) * -0.006;
   const degreeX = (e.clientY - ticketCntr.y) * 0.006;
   console.log(degreeX, degreeY);
   //ticketElm.style.transform = `perspective(1000px) rotateX(${degreeX}deg) rotateY(${degreeY}deg)`;

   ticket.style.background = `linear-gradient(
     ${(e.clientY - ticketCntr.y) % 360}deg, #111 50%, #222)`;
 });
