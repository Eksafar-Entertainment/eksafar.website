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
   //ticketElm.style.transform = `perspective(1000px) rotateX(${degreeX}deg) rotateY(${degreeY}deg)`;

   ticket.style.background = `linear-gradient(
     ${(e.clientY - ticketCntr.y) % 360}deg, #111 50%, #222)`;
 });

//  $('.btn-number').click(function(e){
  
//   fieldName = $(this).attr('data-field');
//   type      = $(this).attr('data-type');
//   var input = $("input[name='"+fieldName+"']");
//   var currentVal = parseInt(input.val());
//   if (!isNaN(currentVal)) {
//       if(type == 'minus') {
          
//           if(currentVal > input.attr('min')) {
//               input.val(currentVal - 1).change();
//           } 
//           if(parseInt(input.val()) == input.attr('min')) {
//               $(this).attr('disabled', true);
//           }

//       } else if(type == 'plus') {

//           if(currentVal < input.attr('max')) {
//               input.val(currentVal + 1).change();
//           }
//           if(parseInt(input.val()) == input.attr('max')) {
//               $(this).attr('disabled', true);
//           }

//       }
//   } else {
//       input.val(0);
//   }
//   calculateSummery();
// });

// $('.input-number').focusin(function(){
//  $(this).data('oldValue', $(this).val());
//  calculateSummery();
// });

// $('.input-number').change(function() {
  
//   minValue =  parseInt($(this).attr('min'));
//   maxValue =  parseInt($(this).attr('max'));
//   valueCurrent = parseInt($(this).val());
  
//   name = $(this).attr('name');
//   if(valueCurrent >= minValue) {
//       $(".btn-number[data-type='minus'][data-field='"+name+"']").removeAttr('disabled')
//   } else {
//       alert('Sorry, the minimum value was reached');
//       $(this).val($(this).data('oldValue'));
//   }
//   if(valueCurrent <= maxValue) {
//       $(".btn-number[data-type='plus'][data-field='"+name+"']").removeAttr('disabled')
//   } else {
//       alert('Sorry, the maximum value was reached');
//       $(this).val($(this).data('oldValue'));
//   }
  
//   calculateSummery();
// });

// $(".input-number").keydown(function (e) {
//       // Allow: backspace, delete, tab, escape, enter and .
//       if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
//            // Allow: Ctrl+A
//           (e.keyCode == 65 && e.ctrlKey === true) || 
//            // Allow: home, end, left, right
//           (e.keyCode >= 35 && e.keyCode <= 39)) {
//                // let it happen, don't do anything
//                return;
//       }
//       // Ensure that it is a number and stop the keypress
//       if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
//           e.preventDefault();
//       }
//       calculateSummery();
//   });