<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Online Booking System</title>


    <!-- Favicons -->
    <link href="{{asset('assets/img/favicon.png')}}" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,600,600i,700,700i" rel="stylesheet">

    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">


</head>

<body>

    <nav class="navbar navbar-expand-lg  bg-light ">
        <div class="container">
          <span>  <h2 style="font-size: 24px">Online Booking System</h2></span>


          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">


              @guest
              <li> <button data-bs-toggle="modal" data-bs-target="#loginModal" class="nav-link text-dark  " style="border: 2px solid #eb5d1e;
                border-radius: 25px; text-decoration:none;
                padding: 6px 20px;   ">Order Now</button>
                </li>
              @endguest

              @auth
              <li><a class="nav-link  text-dark " href="{{ route('order') }}" style="border: 2px solid #eb5d1e;
                border-radius: 25px; text-decoration:none;
                padding: 6px 20px;   "> Order Now</a></li>
              @endauth

              <li>
                @auth
                <div class="profile_info">
                    <a href="{{ route('personal') }}"><img src="{{ auth()->user()->profile_photo_url }}" alt="#"></a>

                    <div class="profile_info_iner">
                        <p>{{ auth()->user()->email }} </p>
                        <h5>{{ auth()->user()->name }}</h5>
                        <div class="profile_info_details">

                            <a class="nav-link active text-light" aria-current="page"
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
                <button data-bs-toggle="modal" data-bs-target="#loginModal" class="nav-link  text-dark  " style="border: 2px solid #eb5d1e;
                border-radius: 25px; text-decoration:none;
                padding: 6px 20px; ">Join/Register</button>

                @endguest
              </li>

            </ul>

          </div>
        </div>
      </nav>













<x-guest-layout>

    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Pleaes Fill Basic Info</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="padding-top: 0px">
                    <x-jet-validation-errors class="" />
                    <form method="POST" action="{{ route('firstRegister') }}">
                        @csrf
                        <div class="mt-2">
                            <x-jet-label for="name" value="{{ __('Name') }}" />
                            <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                        </div>

                        <div class="mt-4">
                            <x-jet-label for="email" value="{{ __('Email') }}" />
                            <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
                        </div>

                        <div class="mt-4">
                            <x-jet-label for="password" value="{{ __('Password') }}" />
                            <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                        </div>

                        <div class="mt-4">
                            <x-jet-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                            <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
                        </div>

                            <div class="mt-4" hidden>
                                <x-jet-label for="refferCode" value="{{ __('Reffer Code') }}" /> <span class="text-info font-weight-bold"> Get 30% off Instant</span>
                                <x-jet-input id="refferCodeInputFild" class="block mt-1 w-full" type="text" name="reffer_code" autocomplete="new-password" />
                            </div>




                            <div class="flex items-center justify-end mt-4">
                                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                                    {{ __('Already registered?') }}
                                </a>

                                <x-jet-button class="ml-4" id="registerSubmitButton">
                                    {{ __('Register') }}
                                </x-jet-button>
                            </div>
                </div>
                </form>

            </div>

        </div>
    </div>
    </div>
    </x-guest-layout>



    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('assets/js/main.js') }}"></script>




</body>

</html>
