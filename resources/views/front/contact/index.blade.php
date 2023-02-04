@extends('front.layouts.default')
@section('head')
    <title>Contact Us</title>
@endsection
@section('content')
    <!-- ================ contact section start ================= -->
    <section>
        <div class="container my-5">
            <h3 class="text-center">Get in touch with us</h3>
            <div class="m-auto mt-3" style="max-width: 600px">
                @if($message)
                <div class="alert alert-success" role="alert">
                    {{$message}}
                  </div>
                @endif
                <div class="card card-body p-5">
                    <form class="" id="contactForm" method="POST" action="/contact">
                        @csrf
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-4">
                                    <label class="form-label">Name</label>
                                    <input class="form-control valid" name="name" id="name" type="text" placeholder="Enter your name" required>
                                </div>
                            </div>
                            <div class="col-sm-6 mb-4">
                                <div class="form-group">
                                    <label class="form-label">Email</label>
                                    <input class="form-control valid" name="email" id="email" type="email"  placeholder="Please enter you email" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="mb-4">
                                    <label class="form-label">Subject</label>
                                    <input class="form-control" name="subject" id="subject" type="text" placeholder="Enter Subject" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="mb-4">
                                    <label class="form-label">Message</label>
                                    <textarea class="form-control w-100" name="message" id="message" cols="30" rows="7" placeholder=" Enter Message" required></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="mt-3">
                            <button type="submit" class="book_btn btn btn-primary">Send Enquiry</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="text-center">
                <div class="media contact-info">
                    <span class="contact-info__icon"><i class="ti-tablet"></i></span>
                    <div class="media-body">
                        <h4>+91 9148 158 728</h4>
                    </div>
                </div>
                <div class="media contact-info">
                    <span class="contact-info__icon"><i class="ti-email"></i></span>
                    <div class="media-body">
                        <h4>support@eksafar.club</h4>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ================ contact section end ================= -->
@endsection
