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
        <br />
        <form action="#">
          <div class="input-group-icon mt-10">
            <div class="icon"><i class="fa fa-user" aria-hidden="true"></i></div>
            <input type="text" name="name" placeholder="Name" id="name" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Name'" required class="single-input">
          </div>
          <div class="input-group-icon mt-10">
            <div class="icon"><i class="fa fa-envelope" aria-hidden="true"></i></div>
            <input type="email" name="email" placeholder="Email address" id="email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Email address'" required class="single-input">
          </div>
          <div class="input-group-icon mt-10">
            <div class="icon"><i class="fa fa-phone" aria-hidden="true"></i></div>
            <input type="number" name="phone" placeholder="Phone No." id="phone" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Phone no'" required class="single-input">
          </div>

          <!-- <div class="input-group-icon mt-10">
            <div class="icon"><i class="fa fa-users" aria-hidden="true"></i></div>
            <input type="number" name="persons" id="persons" placeholder="No of Persons" onfocus="this.placeholder = ''" onblur="this.placeholder = 'No of Persons is '" required class="single-input" onchange="personsChanged(this.value)">
          </div> -->

          <!-- <div class="switch-wrap d-flex justify-content-between" style="margin: 1%; margin-top: 5%; margin-bottom: 5%">
            <div class="row col-md-12">
              <div class="col-md-3">
                <p>Entry Type</p>
              </div>
              <div class="col-md-9">
                <div class="row" style="text-align: center;">
                  <div class="col-md-4">
                    <div class="form-check primary-radio">
                      <input class="form-check-input calculate" type="radio" name="type" value="299" id="female" />
                      <label class="form-check-label" for="female"><br /><span style="color: white">Female</span> </label>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-check primary-radio">
                      <input class="form-check-input calculate" type="radio" value="399" name="type" id="male" />
                      <label class="form-check-label" for="male"> <br /><span style="color: white">male</span> </label>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-check primary-radio" id="couples">
                      <input class="form-check-input calculate" type="radio" value="299.5" name="type" id="couple" />
                      <label class="form-check-label" for="couple"> <br /><span style="color: white">Couple</span> </label>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div> -->

          @if(isset($ticket_type))
          @forelse($ticket_type as $ticket)
          <formgroup onchange="calculateNoOfPersion(event)" id="quantity_selector">
            <div class="row">
              <div class="col-md-3">
                <p class="form-check-label" for="{{$ticket->name}}" style="margin-bottom: 5%;  text-align: center;"><br /><span style="color: white"><b>{{$ticket->name}}</b></span> </p>
              </div>
              <div class="col-md-4">
                <!-- <input class="form-check-input calculate" type="number" name="type" value="" id="female" />
                <span style="color: white">{{$ticket->price}}</span> -->

                <div style="width: 150px;">
                <br/>
                  <div class="input-group">
                    <span class="input-group-btn">
                      <button type="button" class="btn btn-default btn-number" data-type="minus" data-field="quant[{{$ticket->price}}]" price-field="{{$ticket->price}}" type-field="{{$ticket->name}}">
                        <span class="fa fa-minus"></span>
                      </button>
                    </span>
                    <input type="text" name="quant[{{$ticket->price}}]" class="form-control input-number" value="0" min="0" max="1000">
                    <span class="input-group-btn">
                      <button type="button" class="btn btn-default btn-number" data-type="plus" data-field="quant[{{$ticket->price}}]" price-field="{{$ticket->price}}" type-field="{{$ticket->name}}">
                        <span class="fa fa-plus"></span>
                      </button>
                    </span>
                  </div>
                </div>

              </div>
              <div class="col-md-4">
                <br/>
                <br/>
              <span style="color: white"><b>Price: </b><span id="row-total{{$ticket->name}}"></span></span>
            </div>

            </div>
          </formgroup>
          @empty
          <p>No users</p>
          @endforelse
          @endif
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
        <br />
        <button type="button" class="genric-btn primary buy_now btn-block" data-amount="1280">Buy Now <span id="package_val"></span></button>
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
  var SITEURL = "{{URL::to('http://127.0.0.1:8000')}}";

$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});

  var totalAmount = 0;
  var totalCount = 0;
  var tickets_details=[];
  $('.btn-number').click(function(e) {
    e.preventDefault();
    fieldName = $(this).attr('data-field');
    priceValue = $(this).attr('price-field');
    typeValue = $(this).attr('type-field');
    type = $(this).attr('data-type');
    var input = $("input[name='" + fieldName + "']");
    var currentVal = parseInt(input.val());
    if (!isNaN(currentVal)) {
      if (type == 'minus') {

        if (currentVal > input.attr('min')) {
          input.val(currentVal - 1).change();
        }
        if (parseInt(input.val()) == input.attr('min')) {
          $(this).attr('disabled', true);
        }

      } else if (type == 'plus') {

        if (currentVal < input.attr('max')) {
          input.val(currentVal + 1).change();
        }
        if (parseInt(input.val()) == input.attr('max')) {
          $(this).attr('disabled', true);
        }

      }
    } else {
      input.val(0);
    }
  });
  $('.input-number').focusin(function() {
    $(this).data('oldValue', $(this).val());
  });
  $('.input-number').change(function() {

    let previousTotal = document.getElementById("row-total"+typeValue).innerHTML.replace(/[- )(]/g, '');
    minValue = parseInt($(this).attr('min'));
    maxValue = parseInt($(this).attr('max'));
    valueCurrent = parseInt($(this).val());
    let rowTotal = valueCurrent * priceValue;
    document.getElementById("row-total"+typeValue).textContent = "( " + (rowTotal) + " )";
    console.log(previousTotal, rowTotal);
    tickets_details.push({'type':typeValue, 'value':valueCurrent, 'price': priceValue});
    if(previousTotal < rowTotal)
    {
      console.log('the add amount is ', totalAmount, (rowTotal-previousTotal));
      totalAmount = totalAmount + (rowTotal - previousTotal);
      totalCount = totalCount + valueCurrent;
    }else{
      console.log('the subtract amount is ', totalAmount, (previousTotal-rowTotal));
      totalAmount = totalAmount - (previousTotal - rowTotal);
      totalCount = totalCount - valueCurrent;
    }
    console.log('the total amount is', totalAmount);
    name = $(this).attr('name');
    if (valueCurrent >= minValue) {
      $(".btn-number[data-type='minus'][data-field='" + name + "']").removeAttr('disabled')
    } else {
      alert('Sorry, the minimum value was reached');
      $(this).val($(this).data('oldValue'));
    }
    if (valueCurrent <= maxValue) {
      $(".btn-number[data-type='plus'][data-field='" + name + "']").removeAttr('disabled')
    } else {
      alert('Sorry, the maximum value was reached');
      $(this).val($(this).data('oldValue'));
    }


  });
  $(".input-number").keydown(function(e) {
    // Allow: backspace, delete, tab, escape, enter and .
    if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
      // Allow: Ctrl+A
      (e.keyCode == 65 && e.ctrlKey === true) ||
      // Allow: home, end, left, right
      (e.keyCode >= 35 && e.keyCode <= 39)) {
      // let it happen, don't do anything
      return;
    }
    // Ensure that it is a number and stop the keypress
    if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
      e.preventDefault();
    }
  });

  $('body').on('click', '.buy_now', function(e) {
    var product_id = $(this).attr('type-field');
    console.log('the values sent for payment is ', totalAmount);

    $.ajax({
      url: '{{ url("payStarted") }}',
      method: 'post',
      data: {
        amount: totalAmount,
        email: document.getElementById("email").value,
        phone: document.getElementById("phone").value,
        name: document.getElementById("name").value,
        totalCount: totalCount,
        details: tickets_details,
      },
      success: (paymentRes) => {
      console.log('the payment res is', paymentRes);
        var options = {
        "key": "rzp_test_XxOiyvlaMUm4Vz",
        "amount": (totalAmount * 100), // 2000 paise = INR 20
        "name": "Eksafar",
        "description": "Dandiya 2022",
        "image": "img/ek-logo.jpg",
        // callback_url: 'http://127.0.0.1:8000/cart'+product_id,
        // redirect: true,
        "handler": function(response) {
          console.log('the payemnt response is ', response);
          console.log('callback ', SITEURL + '/' + 'paysuccess?payment_id=' + response.razorpay_payment_id + '&product_id=' + product_id + '&amount=' + totalAmount);
          if (response.razorpay_payment_id) {
            $.ajax({
              url: '{{ url("paysuccess") }}',
              method: 'post',
              data: {
                razorpay_id: response.razorpay_payment_id,
                amount: totalAmount,
                email: document.getElementById("email").value,
                phone: document.getElementById("phone").value,
                name: document.getElementById("name").value,
                order_details_id: paymentRes.order_details_id,
                order_id: paymentRes.order_id,
              },
              success: (res) => {
                window.location.href = '/payment-thank-you' + response.razorpay_payment_id;
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
          "email": document.getElementById("email").value,
        },
        "theme": {
          "color": "#528FF0"
        }
      };

    },
    error: (error) => {
        console.log(error);
    }
  });


    var rzp1 = new Razorpay(options);
    rzp1.open();
    e.preventDefault();
  });


</script>
<script>
  function personsChanged(val) {
    console.log(val % 2 == 0);
    var x = document.getElementById("couples");
    if (val % 2 == 0) {
      x.style.display = "block";
    } else {
      x.style.display = "none";
      document.getElementById("male").checked = true;
    }
    if (document.querySelector('input[name="type"]:checked').value) {
      var type = document.querySelector('input[name="type"]:checked').value;
      document.getElementById("package_val").textContent = "( " + (val * type) + " )";
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


  $('body').on('click', '.calculate', function(e) {
    var persons = document.getElementById("persons").value;
    var type = document.querySelector('input[name="type"]:checked').value;
    document.getElementById("package_val").textContent = "( " + (persons * type) + " )";
    console.log('the total val is', persons, type);
  });

  $('body').on('click', '.buy_now', function(e) {
    var totalAmount = document.getElementById("package_val").innerHTML.replace(/[- )(]/g, '');
    var product_id = document.querySelector('input[name="type"]:checked').id;
    console.log('the values sent for payment is ', totalAmount, product_id);
    var options = {
      "key": "rzp_test_XxOiyvlaMUm4Vz",
      "amount": (totalAmount * 100), // 2000 paise = INR 20
      "name": "Eksafar",
      "description": "Dandiya 2022",
      "image": "img/ek-logo.jpg",
      // callback_url: 'http://127.0.0.1:8000/cart'+product_id,
      // redirect: true,
      "handler": function(response) {
        console.log('the payemnt response is ', response);
        console.log('callback ', SITEURL + '/' + 'paysuccess?payment_id=' + response.razorpay_payment_id + '&product_id=' + product_id + '&amount=' + totalAmount);
        if (response.razorpay_payment_id) {
          $.ajax({
            url: '{{ url("paysuccess") }}',
            method: 'post',
            data: {
              razorpay_id: response.razorpay_payment_id,
              amount: totalAmount,
              email: document.getElementById("email").value,
              phone: document.getElementById("phone").value,
              name: document.getElementById("name").value,
              product_id: document.querySelector('input[name="type"]:checked').id,
              persons: document.getElementById("persons").value,
            },
            success: (res) => {
              window.location.href = '/payment-thank-you' + response.razorpay_payment_id;
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
        "email": document.getElementById("email").value,
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

<script>
  function calculateNoOfPersion(event) {
    let quantity = 0;
    document.querySelector("#quantity_selector").querySelectorAll("input[type=number]").forEach(el => {
      quantity += parseInt(el.value) > 0 ? parseInt(el.value) : 0;
    });

    console.log(quantity);
  }
</script>