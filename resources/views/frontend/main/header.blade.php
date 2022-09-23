<style>
    html {
  font-size: 62.5%;
}

body {
  font-family: "Montserrat", sans-serif;
}

button:focus {
  outline: none;
  -webkit-box-shadow: none;
          box-shadow: none;
}

a,
a:hover {
  text-decoration: none;
  display: inline-block;
  -webkit-transition: 0.3s ease-in-out;
  transition: 0.3s ease-in-out;
}

img {
  display: inline-block;
  max-width: 100%;
}

@media (min-width: 1200px) {
  .container {
    max-width: 1300px;
  }
}

#main-carousel {
  margin-top: 20px;
  text-shadow: 1px 2px 3px #0000001f;
}

#main-carousel h5 {
  font-size: 3rem;
  font-family: inherit;
  font-weight: 300;
  -webkit-animation: leftToRight 1s ease-in-out .5s;
          animation: leftToRight 1s ease-in-out .5s;
}

#main-carousel h2 {
  font-size: 6.6rem;
  font-weight: 900;
  font-family: inherit;
  letter-spacing: 2px;
  -webkit-animation: topToBottom 1s linear .3s;
          animation: topToBottom 1s linear .3s;
}

#main-carousel .carousel-caption {
  right: 15%;
  bottom: unset;
  top: 50%;
  -webkit-transform: translateY(-50%);
          transform: translateY(-50%);
  text-align: left;
}

#main-carousel .carousel-control-next,
#main-carousel .carousel-control-prev {
  top: 50%;
  bottom: unset;
  -webkit-transform: translateY(-50%);
          transform: translateY(-50%);
  width: 4%;
  font-size: 3.5rem;
  background-color: rgba(255, 255, 255, 0.2);
  padding: 5px;
  -webkit-transition: 5s all;
  transition: 5s all;
}

#main-carousel .carousel-control-next {
  border-top-left-radius: 50px;
  border-bottom-left-radius: 50px;
}

#main-carousel .carousel-control-prev {
  border-top-right-radius: 50px;
  border-bottom-right-radius: 50px;
}

#main-carousel .btn-info {
  background: transparent;
  text-transform: uppercase;
  border: 0;
  font-family: "helveticaregular";
  font-size: 1.8rem;
  position: relative;
  padding: 20px 0 0;
  margin: 20px 0 0;
}

#main-carousel .btn-info::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  width: 63px;
  height: 5px;
  background-color: #fff;
}

.home__form {
  padding: 1.5rem;
  background-color: #fff;
  -webkit-box-shadow: 0 0 1.5rem rgba(0, 0, 0, 0.2);
          box-shadow: 0 0 1.5rem rgba(0, 0, 0, 0.2);
  position: relative;
  z-index: 1;
  top: -50px;
  font-size: 1.6rem;
      width: 80%;
    margin: auto;
}

.home__form h3 {
  font-size: 2.6rem;
  font-weight: bold;
}

.home__form p {
  font-size: 1.4rem;
  margin-bottom: 1.5rem;
}

.home__form form {
  text-align: left;
}

.home__form form label {
  font-size: 1.4rem;
  color: rgba(0, 0, 0, 0.7);
  font-family: "helveticaregular";
}

.home__form form .input-box {
  position: relative;
}

.home__form form .input-box .fa {
  position: absolute;
  right: 0;
  top: 50%;
  -webkit-transform: translateY(-50%);
          transform: translateY(-50%);
  border-left: 1px solid #cdcdcd;
  padding: 3px 15px 3px 10px;
  color: #898989;
}

.home__form form .input-box input {
  height: 45px;
}

.home__form form .input-box textarea,
.home__form form .input-box input {
  border-color: #efefef;
  -webkit-box-shadow: inset 0 0 5px rgba(0, 0, 0, 0.05);
          box-shadow: inset 0 0 5px rgba(0, 0, 0, 0.05);
  border-radius: 5px;
  font-size: 1.6rem;
  padding: 10px;
  caret-color: #fc5546;
}

.home__form form .input-box textarea:focus + .fa,
.home__form form .input-box input:focus + .fa {
  color: #fc5546;
  border-color: #fc5546;
}

.home__form form .input-box textarea:not(:placeholder-shown),
.home__form form .input-box input:not(:placeholder-shown) {
  border-color: green;
}

.btn.btn-danger {
  width: 100%;
  height: 45px;
  font-size: 1.7rem;
  background-color: #fc5546;
  text-transform: uppercase;
  border-radius: 5px;
  border-color: transparent;
  -webkit-transition: .3s all;
  transition: .3s all;
}

.btn.btn-danger:hover {
  background: #231833;
}

.btn-more {
  font-size: 1.6rem;
  color: #000;
  font-family: "helveticaregular";
}

.btn-more span {
  border-bottom: 1px dotted #000;
}


@-webkit-keyframes leftToRight {
  0% {
    opacity: 0;
    -webkit-transform: translateX(-80px);
            transform: translateX(-80px);
  }
  80% {
    -webkit-transform: translateX(20px);
            transform: translateX(20px);
    opacity: .7;
  }
  100% {
    opacity: 1;
    -webkit-transform: translateX(0);
            transform: translateX(0);
  }
}

@keyframes leftToRight {
  0% {
    opacity: 0;
    -webkit-transform: translateX(-80px);
            transform: translateX(-80px);
  }
  80% {
    -webkit-transform: translateX(20px);
            transform: translateX(20px);
    opacity: .7;
  }
  100% {
    opacity: 1;
    -webkit-transform: translateX(0);
            transform: translateX(0);
  }
}

@-webkit-keyframes topToBottom {
  0% {
    opacity: 0;
    -webkit-transform: translateY(-50px);
            transform: translateY(-50px);
  }
  80% {
    -webkit-transform: translateY(10px);
            transform: translateY(10px);
    opacity: .7;
  }
  100% {
    opacity: 1;
    -webkit-transform: translateY(0);
            transform: translateY(0);
  }
}

@keyframes topToBottom {
  0% {
    opacity: 0;
    -webkit-transform: translateY(-50px);
            transform: translateY(-50px);
  }
  80% {
    -webkit-transform: translateY(10px);
            transform: translateY(10px);
    opacity: .7;
  }
  100% {
    opacity: 1;
    -webkit-transform: translateY(0);
            transform: translateY(0);
  }
}

</style>

<div id="main-carousel" class="carousel slide" data-ride="carousel">

            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="https://images.unsplash.com/photo-1505236858219-8359eb29e329?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxzZWFyY2h8MTV8fHBhcnR5fGVufDB8MHwwfHw%3D&auto=format&fit=crop&w=500&q=60" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>It is a long established </h5>
                        <h2> fact that a reader distracted</h2>
                        <a href="#0" class="btn btn-info">MORE INFO</a>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="https://images.unsplash.com/photo-1429962714451-bb934ecdc4ec?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxzZWFyY2h8MTB8fHBhcnR5fGVufDB8MHwwfHw%3D&auto=format&fit=crop&w=500&q=60" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                       <h5>It is a long established </h5>
                        <h2> fact that a reader distracted</h2>
                        <a href="#0" class="btn btn-info">MORE INFO</a>
                    </div>
                </div>


            </div>
            <a class="carousel-control-prev" href="#main-carousel" role="button" data-slide="prev">
                <i class="fa fa-angle-left" aria-hidden="true"></i>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#main-carousel" role="button" data-slide="next">
                <i class="fa fa-angle-right" aria-hidden="true"></i>
                <span class="sr-only">Next</span>
            </a>
        </div>
        <section class="home__form">
            <div class="container">
                <div class="home__form-container text-center">
                    <h3>Get In Touch</h3>
                    <p>Please get in touch with our support team and expect a response within 24 working hours.</p>
                    <form>
                        <div class="row">
                            <div class="col">

                                <div class="form-group">

                                    <div class="input-box ">
                                        <input type="text" class="form-control" placeholder="Name *" aria-label="Name" aria-describedby="name" required>
                                        <i class="fa fa-user" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <div class="input-box ">
                                        <input type="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" class="form-control" placeholder="Email" aria-label="email" aria-describedby="email">
                                        <i class="fa fa-envelope" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <div class="input-box ">
                                        <input type="text" class="form-control" placeholder="Phone" aria-label="phone" aria-describedby="phone">
                                        <i class="fa fa-phone" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col">

                                <div class="form-group">
                                    <div class="input-box ">

                                        <textarea class="form-control" placeholder="Message" rows="1"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-2"><button type="submit" class="btn btn-danger">Submit Now!</button></div>
                        </div>

                    </form>
                </div>
            </div>
        </section>