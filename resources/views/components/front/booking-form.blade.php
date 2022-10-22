<form action="/payment/checkout" method="post" onsubmit="checkForm(event)">
    @csrf
    <input type="hidden" name="event_id" value="1" />
    <input type="hidden" name="promoter_id" value="{{ app('request')->input('promoter') }}" />
    <div class="modal-body p-0">
        <div class="row gx-0">
            <div class="col-md">
                <div class="bg-white rounded h-100 p-4 border"
                    style="border-style: dashed !important; ">
                    <div>
                        <h4 class="mb-0">{{ $event->name }} @ {{ $venue->name }}</h4>
                        <small class="text-muted">
                            <i class="fas fa-calendar me-2"></i>
                            16th October, 2022 | 04:00 PM Onwards
                        </small>
                    </div>
                    <table class="table table-ms mt-3">
                        @foreach ($event_tickets as $n => $event_ticket)
                            <tr data-row="ticket">
                                <td class="ps-0">
                                    <h6 class="mb-0">{{ $event_ticket->name }}</h6>
                                    <small
                                        class="text-muted">{{ $event_ticket->description }}</small><br>
                                    <span class="text-success"> @money($event_ticket->price)</span>
                                </td>
                                <td width="1%" class="align-middle">
                                    <input type="hidden"
                                        name="items[{{ $n }}][event_ticket_id]"
                                        value="{{ $event_ticket->id }}" />
                                    <input type="hidden" value="{{ $event_ticket->price }}"
                                        data-field="price" />
                                    <input type="number" class="form-control form-control-sm"
                                        data-field='quantity' placeholder="Qtde."
                                        style="min-width: 80px"
                                        name="items[{{ $n }}][quantity]" />
                                </td>
                                <td class="fs-6 align-middle pe-0 text-nowrap text-end" width="90px"
                                    data-field="total-price">
                                    @money(0)
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>



            <div class="col-md-auto">
                <div class="bg-white rounded h-100 p-4 border"
                    style="border-style: dashed !important; ">
                    <table class="table fs-6" style="min-width: 250px">
                        <tr>
                            <td class="ps-0 border-bottom-0">Total Quantity</td>
                            <td class="pe-0 border-bottom-0" id="total-quantity">0</td>
                        </tr>

                        <tr>
                            <td class="ps-0">Total Amount</td>
                            <td class="pe-0" id="total-amount">@money(0)</td>
                        </tr>

                        <tr>
                            <td class="ps-0 border-bottom-0">Grand Total</td>
                            <td class="pe-0 border-bottom-0" id="grand-total">@money(0)</td>
                        </tr>
                    </table>
                    <div>
                        @guest
                            <div>
                                <!-- Email Container -->
                                <div id="email-container">
                                    <div class="mb-3">
                                        <input type="email" id="email" name="email"
                                            placeholder="Email" class="form-control" />
                                    </div>
                                    <button class="btn btn-primary w-100" type="button">Continue</button>
                                </div>
                                <!-- login Container -->
                                <div id="login-container" style="display: none">
                                    <div class="mb-3" class="password">
                                        <input type="password" placeholder="Password" name="password"
                                            class="form-control" />
                                    </div>
                                    <button class="btn btn-primary w-100" type="button">Login</button>
                                </div>
                                <!-- register Container -->
                                <div id="register-container" style="display: none">
                                    <div class="mb-3" class="name">
                                        <input type="text" placeholder="Full name"
                                            class="form-control" name="name" />
                                    </div>
                                    <div class="mb-3" class="mobile">
                                        <input type="number" placeholder="Phone" name="mobile"
                                            class="form-control" />
                                    </div>

                                    <div class="mb-3" class="password">
                                        <input type="password" placeholder="Password" name="password"
                                            class="form-control" />
                                    </div>
                                    <button class="btn btn-primary w-100" type="button">Register</button>
                                </div>
                            </div>


                        @endguest
                        <button class="btn btn-primary w-100" style="@guest display: none @endguest" id="checkout" type="submit">Checkout</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <button type="button" class="btn btn-sm btn-default position-absolute top-0 end-0"
        aria-label="Close" data-bs-dismiss="modal"><i class="fas fa-close"></i></button>
</form>


<script>
    function calculateSummery() {
        const total_quantity_el = document.getElementById("total-quantity");
        const total_amount_el = document.getElementById("total-amount");
        const grand_total_el = document.getElementById("grand-total");

        total_quantity_el.innerHTML = (() => {
            let all = 0;
            document.querySelectorAll("[data-field=quantity]").forEach((current) => all += parseInt(current.value)>0?parseInt(current.value):0);
            return all;
        })();
        total_amount_el.innerHTML = money((() => {
            let all = 0;
            document.querySelectorAll("[data-field=total-price]").forEach((current) => all += parseInt(current.getAttribute("amount"))>0?parseInt(current.getAttribute("amount")):0);
            return all;
        })());
        grand_total_el.innerHTML = total_amount_el.innerHTML;
    }

    function checkForm(_evt){
        const total_quantity = parseInt(document.getElementById("total-quantity").innerHTML);
        if(total_quantity>0){}else{
            _evt.preventDefault();
            alert("Please select a ticket");
        }
    }


    $(function() {

        document.querySelectorAll("[data-row=ticket]").forEach(_row => {
            const _quantity_field = _row.querySelector("[data-field=quantity]");
            const _price_field = _row.querySelector("[data-field=price]");
            const _total_price_field = _row.querySelector("[data-field=total-price]");

            _quantity_field.addEventListener("keyup", (_evt) => {
                const _quantity = parseInt(_evt.target.value) < 0 ? 0 : parseInt(_evt.target
                    .value);
                const _total_price = parseInt(_price_field.value) * parseInt(_quantity) > 0 ?
                    parseInt(_price_field.value) * parseInt(_quantity) : 0;

                _quantity_field.value = _quantity;
                _total_price_field.innerHTML = money(_total_price);
                _total_price_field.setAttribute("amount", _total_price);

                calculateSummery()
            });
        });

        $('#email-container button').on('click', function(e) {
            e.preventDefault();
            const email = $("#email").val();
            if(email == "") return alert("Please enter your email");
            $.ajax({
                url: '/auth/check-user-email',
                type: 'POST',
                data: {
                    email: email
                },
                dataType: 'JSON',
                success: function(res) {
                    console.log(res);
                    if(res.data.is_existing_user){
                        $('#login-container').show();
                        $('#register-container').hide();
                    } else {
                        $('#login-container').hide();
                        $('#register-container').show();
                    }
                    $('#email-container button').hide();
                }
            });
            return false;
        });


        $('#login-container button').on('click', function(e) {
            const email = $("#email").val();
            const password = $("#login-container input[name=password]").val();
            if(password == "" ||  password.length < 8) return alert("please enter 8 alphanumeric password.");
            e.preventDefault();
            $.ajax({
                url: '/auth/try-login',
                type: 'POST',
                data: {
                    email:email,
                    password: password
                },
                dataType: 'JSON',
                success: function(res) {
                    if (res.data) {
                        $("#email-container").hide();
                        $('#login-container').hide();
                        $('#checkout').show();
                    } else {
                        alert(res.message);
                    }
                }
            });
            return false;
        });
        $('#register-container button').on('click', function(e) {
            e.preventDefault();
            const email = $("#email").val();
            const password = $("#register-container input[name=password]").val();
            const name = $("#register-container input[name=name]").val();
            const mobile = $("#register-container input[name=mobile]").val();
            console.log("");
            if(password == "" ||  password.length < 8) return alert("please enter 8 alphanumeric password.");
            if(name == "") return alert("please enter your name.");
            if(mobile == "") return alert("please enter yor mobile number.");
            $.ajax({
                url:  '/auth/try-login',
                type: 'POST',
                data: {
                    email: email,
                    name: name,
                    mobile: mobile,
                    password: password
                },
                dataType: 'JSON',
                success: function(res) {
                    if (res.data) {
                        $("#email-container").hide();
                        $('#register-container').hide();
                        $('#checkout').show();
                    } else {
                        alert(res.message);
                    }
                }
            });
            return false;
        });

    })
</script>