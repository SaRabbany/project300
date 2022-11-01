<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Order</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">


    {{-- Sweet Alert Cdns --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" integrity="sha512-c42qTSw/wPZ3/5LBzD+Bw5f7bSF2oxou6wEb+I/lqeaKV5FDIfMvvRp772y4jcJLKuGUOpbJMdg/BTl50fJYAw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.9/sweetalert2.min.css" integrity="sha512-cyIcYOviYhF0bHIhzXWJQ/7xnaBuIIOecYoPZBgJHQKFPo+TOBA+BY1EnTpmM8yKDU4ZdI3UGccNGCEUdfbBqw==" crossorigin="anonymous" referrerpolicy="no-referrer" />


    {{-- <link href="assets/vendor/aos/aos.css" rel="stylesheet"> --}}
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{asset('assets/css/order.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/css/style.css  ')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}" />


    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.9/sweetalert2.all.min.js" integrity="sha512-IZ95TbsPTDl3eT5GwqTJH/14xZ2feLEGJRbII6bRKtE/HC6x3N4cHye7yyikadgAsuiddCY2+6gMntpVHL1gHw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-light fixed-top">
        <div class="container">
            <h2>Online Booking System</h2>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">


                    @guest
                    <li> <button data-bs-toggle="modal" data-bs-target="#loginModal" class="nav-link btn-get-started text-white">Order Now</button>
                        @endguest

                        @auth
                    <li><a class="nav-link  btn-get-started text-white" href="{{ route('order') }}"> Order Now</a></li>
                    @endauth


                    <li>
                        @auth
                        <div class="profile_info">
                            <a href="{{ route('personal') }}"><img src="{{ auth()->user()->profile_photo_url }}" alt="#"></a>

                            <div class="profile_info_iner">
                                <p>{{ auth()->user()->email }} </p>
                                <h5>{{ auth()->user()->name }}</h5>
                                <div class="profile_info_details">

                                    <a class="nav-link active" aria-current="page"
                                    href="{{ route('personal') }}" >Profile</a>

                                </div>
                                <div class="profile_info_details">

                                    <a class="nav-link active" aria-current="page"
                                    href="{{ route('logout') }}" onclick="event.preventDefault();
                                       document.getElementById('logout-form').submit();">Logout</a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                </form>
                                </div>
                            </div>
                        </div>
                        @endauth

                        @guest
                        <button data-bs-toggle="modal" data-bs-target="#loginModal" class="nav-link  text-white" style="border: 2px solid #eb5d1e;
                        border-radius: 25px; text-decoration:none;
                        padding: 6px 20px; ">Join/Register</button>

                        @endguest
                      </li>


                </ul>

            </div>
        </div>
    </nav>



    <!-- ======= Hero Section ======= -->
    <!-- End Hero -->




    @if ($message = Session::get('success'))

    @if($message == 'orderSuccess')

                <script>
                    function successMessage(){
                        Swal.fire({
                        title: '<strong>Success</u></strong>',
                        icon: 'success',
                        html: 'We Have Recived Your Booking Request. Please Go To Your <b>Profile  </b> To Check Your Order Status',
                        showCloseButton: true,
                        showCancelButton: true,
                        focusConfirm: false,
               
                        cancelButtonText: 'Later',
                        cancelButtonAriaLabel: 'Later'});
                    }
                    successMessage();

                </script>
        @endif
    @endif
       @if($errors->any())
        <script>
            function successMessage(){
                Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Something went wrong! Try Again',
                });
            }
            successMessage();

        </script>
    </div>
    @endif







    <!-- ======= payment info Section ======= -->


    <section id="contact" class="contact mt-5">
        <div class="container" data-aos="fade-up">

            <div class="section-title">
                <h2>Book Your Ticket</h2>

            </div>
            <div class="row">


                <div class="col-3"></div>
                <div class="col-lg-6 mt-5 mt-lg-0 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="200">
                    <form action="{{ route('order-confirmation') }}" method="POST" class="php-email-form" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="date">Full Name </label>

                            <input type="text" name="name" class="form-control" id="name" placeholder="Your Full Name" required @auth value="{{ auth()->user()->name }}" @endauth>
                        </div>
                        <div class="mt-3 form-group ">
                            <label for="date">E-mail <span class="text-danger">*</span> </label>

                            <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" @auth value="{{ auth()->user()->email }}" @endauth required>
                        </div>

                        <div class="form-group mt-3">
                            <label for="date">Phone Number <span class="text-danger">*</span> </label>
                            <input type="number" class="form-control" name="phone" placeholder="Type Your phone" required>
                        </div>





                        <div class="form-group mt-3">
                            <label for="price">Price <span class="text-danger">*</span> <span>(paid total $156)</span> </label>
                            <input type="number" class="form-control" name="price" id="price" placeholder="price" required>
                        </div>



                        <div class="form-group mt-3">
                            <label for="date">Date <span class="text-danger">*</span> </label>
                            <input type="date" class="form-control" name="date" id="date" placeholder="Date of Payment" required>
                        </div>


                        <div class="form-group mt-3">
                            <label for="quantity">Quantity<span class="text-danger">*</span> </label>
                            <input type="number" class="form-control" name="quantity" placeholder="Quantity" required>
                        </div>



                        <div class="form-group mt-3">
                            <label for="starting_point">starting point<span class="text-danger">*</span> </label>
                            <input type="starting_point" class="form-control" name="starting_point" placeholder="starting point" required>
                        </div>



                        <div class="form-group mt-3">
                            <label for="destination">Destination<span class="text-danger">*</span> </label>
                            <input type="destination" class="form-control" name="destination" placeholder="destination" required>
                        </div>



                        <div class="text-center"> <button type="submit">Confirm</button></div>
                    </form>
                </div>
                <div class="col-3"></div>

            </div>

        </div>
    </section>
    <!-- End #main -->

    <!-- ======= Footer ======= -->





    <script src="https://commerce.coinbase.com/v1/checkout.js?version=201807"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/main.js"></script>



    <script>
        function pmsubmitForm() {
            document.getElementById('pm_hidden_form').submit();
        }

    </script>


</body>

</html>
