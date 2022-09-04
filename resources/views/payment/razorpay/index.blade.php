
      <!-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>   -->

        <!-- Ticket Modal -->
        <div class="modal fade" id="ticketModal" tabindex="-1" role="dialog" aria-labelledby="ticketModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <!-- <div class="modal-header">
                <h5 class="modal-title" id="ticketModalLabel">Buy Ticket</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div> -->
              <div class="modal-body">
              <div style="text-align: center">
                <h5 class="modal-title" id="ticketModalLabel">Buy Ticket</h5>
              </div>
                <br/>
              <form action="#">
					<div class="input-group-icon mt-10">
                    <div class="icon"><i class="fa fa-user" aria-hidden="true"></i></div>
						<input type="text" name="name" placeholder="Name" id="name"
							onfocus="this.placeholder = ''" onblur="this.placeholder = 'Name'" required
							class="single-input">
					</div>
					<div class="input-group-icon mt-10">
                    <div class="icon"><i class="fa fa-envelope" aria-hidden="true"></i></div>
						<input type="email" name="email" placeholder="Email address" id="email"
							onfocus="this.placeholder = ''" onblur="this.placeholder = 'Email address'" required
							class="single-input">
					</div>
					<div class="input-group-icon mt-10">
						<div class="icon"><i class="fa fa-phone" aria-hidden="true"></i></div>
						<input type="number" name="phone" placeholder="Phone No." id="phone" onfocus="this.placeholder = ''"
							onblur="this.placeholder = 'Phone no'" required class="single-input">
					</div>

					<div class="input-group-icon mt-10">
						<div class="icon"><i class="fa fa-users" aria-hidden="true"></i></div>
						<input type="number" name="persons" id="persons" placeholder="No of Persons" onfocus="this.placeholder = ''"
							onblur="this.placeholder = 'No of Persons is '" required class="single-input" onchange="personsChanged(this.value)">
					</div>

                    <div class="switch-wrap d-flex justify-content-between" style="margin: 1%; margin-top: 5%; margin-bottom: 5%">
                        <div class="row col-md-12">
                            <div class="col-md-3">
					        <p>Entry Type</p>
                            </div>
                            <div class="col-md-9">
                            <div class="row" style="text-align: center;">
                            <div class="col-md-4">
                               <div class="form-check primary-radio"> 
                              <input class="form-check-input calculate" type="radio" name="type" value="299" id="female"/>
                              <label class="form-check-label" for="female"><br/><span style="color: white">Female</span> </label>
                                </div>
                            </div>
                            <div class="col-md-4">
                            <div class="form-check primary-radio"> 
                              <input class="form-check-input calculate" type="radio" value="399" name="type" id="male"/>
                              <label class="form-check-label" for="male"> <br/><span style="color: white">male</span> </label>
                            </div>
                            </div>
                            <div class="col-md-4">
                            <div class="form-check primary-radio" id="couples"> 
                              <input class="form-check-input calculate" type="radio" value="299.5" name="type" id="couple"/>
                              <label class="form-check-label" for="couple"> <br/><span style="color: white">Couple</span> </label>
                            </div>
                            </div>
                            </div>
                            </div>
                        </div>
					</div>
					<!-- <div class="input-group-icon mt-10">
						<div class="icon"><i class="fa fa-phone" aria-hidden="true"></i></div>
						<div class="form-select" id="default-select">
									<select class="select_input">
										<option value=" 1">City</option>
							<option value="1">Dhaka</option>
							<option value="1">Dilli</option>
							<option value="1">Newyork</option>
							<option value="1">Islamabad</option>
							</select>
						</div>
					</div> -->
				</form>
                <br/>
                <button type="button" class="genric-btn primary buy_now btn-block" data-amount="1280" >Buy Now <span id="package_val"></span></button>
              </div>
              <!-- <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="genric-btn primary buy_now btn-block ml-1" data-amount="1280" >Buy Now</button>
              </div> -->
            </div>
          </div>
        </div>
        </div>


      <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
      <script>
        function personsChanged(val) {
            console.log(val%2 == 0);
            var x = document.getElementById("couples");
            if (val%2 == 0) {
              x.style.display = "block";
            } else {
              x.style.display = "none";
              document.getElementById("male").checked = true;
            }
            if(document.querySelector('input[name="type"]:checked').value)
            {
                var type = document.querySelector('input[name="type"]:checked').value;
                document.getElementById("package_val").textContent="( "+(val*type)+" )";
            }
        }
      </script>
      <script>
         var SITEURL = "{{URL::to('http://127.0.0.1:8000')}}";
        
         $.ajaxSetup({
           headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           }
         }); 
         

         $('body').on('click', '.calculate', function(e){
            var persons = document.getElementById("persons").value;
            var type = document.querySelector('input[name="type"]:checked').value;
            document.getElementById("package_val").textContent="( "+(persons*type)+" )";
            console.log('the total val is', persons, type);
         });

         $('body').on('click', '.buy_now', function(e){
           var totalAmount = document.getElementById("package_val").innerHTML.replace(/[- )(]/g,'');
           var product_id =  document.querySelector('input[name="type"]:checked').id;
           console.log('the values sent for payment is ', totalAmount, product_id);
           var options = {
           "key": "rzp_test_XxOiyvlaMUm4Vz",
           "amount": (totalAmount*100), // 2000 paise = INR 20
           "name": "Eksafar",
           "description": "Dandiya 2022",
           "image": "img/ek-logo.jpg",
            // callback_url: 'http://127.0.0.1:8000/cart'+product_id,
            // redirect: true,
             "handler": function (response){
              console.log('the payemnt response is ', response);
              console.log('callback ', SITEURL +'/'+ 'paysuccess?payment_id='+response.razorpay_payment_id+'&product_id='+product_id+'&amount='+totalAmount);
              if(response.razorpay_payment_id)
              {
                $.ajax({
                url: '{{ url("paysuccess") }}',
                method: 'post',
                data: { razorpay_id: response.razorpay_payment_id,
                   amount: totalAmount,
                   email: document.getElementById("email").value,
                   phone: document.getElementById("phone").value, 
                   name: document.getElementById("name").value,
                   product_id: document.querySelector('input[name="type"]:checked').id,
                   persons: document.getElementById("persons").value,
                  },
                success: (res) => {
                  window.location.href = '/payment-thank-you'+response.razorpay_payment_id;
                    },
                    error: (error) => {
                      console.log(error);
                    }
                });
              }
              // existing options
            },
          "prefill": {
               "contact": document.getElementById("phone").value,
               "email":   document.getElementById("email").value,
           },
           "theme": {
               "color": "#528FF0"
           }
         };
         var rzp1 = new Razorpay(options);
         rzp1.open();
         e.preventDefault();
         });
         /*document.getElementsClass('buy_plan1').onclick = function(e){
           rzp1.open();
           e.preventDefault();
         }*/
      </script>
   