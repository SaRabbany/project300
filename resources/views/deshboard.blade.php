<!DOCTYPE html>
<html lang="zxx">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Pips Scalper</title>



    {{-- Sweet Alert Cdns --}}

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.9/sweetalert2.min.css" integrity="sha512-cyIcYOviYhF0bHIhzXWJQ/7xnaBuIIOecYoPZBgJHQKFPo+TOBA+BY1EnTpmM8yKDU4ZdI3UGccNGCEUdfbBqw==" crossorigin="anonymous" referrerpolicy="no-referrer" />



    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="{{asset('css/style.css')}}" />
    <link rel="icon" href="{{asset('favicon.ico')}}" type="image/png">


</head>
<body class="crm_body_bg">



</head>
<body class="crm_body_bg">



    <section class="main_content dashboard_part ">
        <!-- menu  -->
        <div class="container-fluid no-gutters ">
            <div class="row">
                <div class="col-lg-12 p-0">
                    <div class="header_iner  d-flex justify-content-between align-items-center">
                        <div class="sidebar_icon d-lg-none container">
                            <i class="ti-menu"></i>
                        </div>
                        <div class="profile-logo">
                            <h2>Pips Scelper</h2>
                        </div>

                        <div class="header_right d-flex justify-content-between align-items-center">
                            <div class="header_notification_warp d-flex align-items-center">
                                <div class="profile_info">

                                    <form action="{{ route('affiliator_switch') }}" method="POST">
                                        @csrf
                                        <input type="text" name="user_id" value="{{ auth()->user()->id }}" hidden>
                                    <button type="submit" class="switchToBtn" style="color: ; font-size:18px; font-width:600;">

                                        @if(auth()->user()->affiliate_status == 0)
                                            Switch to affiliator
                                            @else
                                                Switch to Buyer
                                        @endif

                                    </button>
                                    </form>
                                            <div class="profile_info_iner">
                                                <p style="color: #ffffff; font-size:16px">Join To Our Affiliate System And Earn Money</p>
                                            </div>
                                </div>

                            </div>
                            <div class="profile_info">
                                <a    href="{{ route('personal') }}"><img src="{{ auth()->user()->profile_photo_url }}" alt="#"></a>

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
                        </div>
                    </div>
                </div>
            </div>
        </div>




        @if(auth()->user()->affiliate_status == 1)

        {{-- profile view --}}
        <section class="profile-header">
            <div class="container">
                <div class="row">
                    <div class="col-md-7 d-flex profile_content">
                      <div class=" ">
                        <h2>Welcome <span>{{ auth()->user()->name }}</span>  </h2>
                        <p>You Are Now At <span class="text-warining" style="font-size: 2rem">Level 1 </span>
                            <br>
                            And Your Partnarship With us Is 20%
                            <br>
                            <span> Here is your Affiliator link</span>
                        </p>
                        @php
                            $affiliate_link = url('/').'/'.auth()->user()->reffer_code;
                        @endphp


                            <input type="text" id="myInput" readonly value="{{ $affiliate_link }}">

                            <button onclick="myFunction()">Click to Copy</button>

                      </div>

                    </div>
                    <div class="col-md-5">
                        <img src="https://cdni.iconscout.com/illustration/premium/thumb/welcome-new-friends-4575525-3798670.png" class="img-fluid" alt="">
                    </div>
                </div>
            </div>
        </section>

        @endif


        @if(auth()->user()->affiliate_status == 0)
        <div class="row">
            <div class="col-md-12 p-5 m-auto">
                <div class="card recent-sales">

                  <div class="card-body">
                      <div class="d-flex justify-content-between w-100">
                        <h5 class="card-title">Your Order </h5>
                        <a href="https://t.me/+pV51QCv5aLMxZjBl">
                            <button class="btn btn-md btn-info">contact us</button>
                        </a>

                      </div>


                    <div class="table-responsive">
                        <table class="table table-borderless datatable">
                            <thead>
                              <tr>
                                <th scope="col">id</th>
                                <th scope="col">E-mail</th>
                                <th scope="col">Payment Method </th>
                                <th scope="col">Transection Id </th>
                                <th scope="col">Price</th>
                                <th scope="col">Status</th>
                              </tr>
                            </thead>
                            <tbody>

                     @forelse ($buyer_orders as $order)
                        <tr>
                            <th scope="row">{{ $order->id }}</th>
                            <td>{{ $order->email }}</td>
                            <td>{{ $order->method }}</td>
                            <td>{{ $order->transection_id }}</td>
                            <td>{{ $order->price }}</td>

                            <td>
                                @if($order->status == 'pending')
                                    <span class="badge badge-warning">Pending</span>

                                    @elseif ($order->status == 'approved')
                                    <span class="badge bg-success">Approved</span>

                                    @elseif ($order->status == 'declined')
                                    <span class="badge bg-danger">Declined</span>

                                @endif


                            </td>
                          </tr>

                            @empty
                          <tr>
                            <th colspan="4" class="text-center">No Orders Available</th>
                          </tr>
                            @endforelse


                            </tbody>
                          </table>
                    </div>


                  </div>

                </div>
              </div>
        </div>
        @endif



        @if(auth()->user()->affiliate_status == 1)

        <!--/ menu  -->
        <div class="main_content_iner ">
            <div class="container-fluid p-0">
                <div class="row justify-content-center">
                    <div class="col-lg-12 col-xl-12">
                        <div class="white_box mb_30 ">
                            <div class="box_header border_bottom_1px  ">
                                <div class="main-title d-flex justify-content-between w-100">
                                    <h3 class="mb_25">Here is How You Are doing</h3>

                                    @if($workAnalysis['totalIncome'] < 50)
                                        <button class="btn  mb-2 text-light btn-sm btn-success btn-outline-info" onclick="withDrawReuestMin()">Withdraw Funds</button>
                                        @else
                                        <button class="btn  mb-2 text-light btn-sm btn-success btn-outline-info" data-toggle="modal" data-target="#withdrawModal">Withdraw Funds</button>
                                    @endif

                                </div>
                            </div>
                            <div class="income_servay">
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="count_content">

                                            <h3>$ <span class="counter">{{ $workAnalysis['totalIncome'] }}</span> </h3>
                                            <p> Income </p>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="count_content">
                                            <h3> <span class="counter"> {{  $workAnalysis['clicks'] }} </span> </h3>
                                            <p>clicks</p>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="count_content">
                                            <h3> <span class="counter">{{ $workAnalysis['pendingOrders'] }}</span> </h3>
                                            <p>Order (Pending)</p>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="count_content">
                                            <h3> <span class="counter">{{ $workAnalysis['approvedOrders'] }}</span> </h3>
                                            <p>Order (Approved)</p>
                                        </div>
                                    </div>


                                    <div class="col-md-2">
                                        <div class="count_content">
                                            <h3> <span class="counter">{{ $workAnalysis['rejectedOrders'] }}</span> </h3>
                                            <p>Order (Declined)</p>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="count_content">
                                            <h3> <span class="counter">{{ $workAnalysis['allOrders'] }}</span> </h3>
                                            <p>Order (Total)</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="bar_wev"></div>
                        </div>
                    </div>
                    <div class="col-xl-12">
                        <div class="white_box QA_section card_height_100">
                            <div class="white_box_tittle list_header m-0 align-items-center">
                                <div class="main-title mb-sm-15">



                                    <h3 class="m-0 nowrap">Affiliators Under You</h3>

                                </div>
                            </div>

                            <div class="QA_table ">
                                <!-- table-responsive -->
                                <div class="table-responsive">
                                    <table class="table lms_table_active2">
                                        <thead>
                                            <tr>
                                                <th scope="col"> Name</th>
                                                <th scope="col">Email</th>
                                                <th scope="col">Icome</th>
                                                <th scope="col">Level</th>
                                                <th scope="col"> Joined</th>
                                            </tr>
                                        </thead>
                                        <tbody>


                                             @forelse (auth()->user()->myChilds as $affiliator )
                                                <tr>
                                                <td> {{ $affiliator->user->name }}</td>
                                                <td>{{ $affiliator->user->name }}</td>
                                                @php
                                                    $userModel = new app\Models\User;
                                                @endphp
                                                <td>${{ $userModel->income($affiliator->user->id) }}</td>
                                                <td>1</td>
                                                <td>{{ $affiliator->user->created_at }}</td>

                                            </tr>

                                            @empty

                                            <tr>
                                                <td colspan="5" class="text-center">No Affiliators Available <br>
                                                       Invite Your friends and earn money
                                                </td>
                                            </tr>


                                            @endforelse



                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>


                    <div class="col-xl-6">
                        <div class="white_box card_height_100">
                            <div class="box_header border_bottom_1px  ">
                                <div class="main-title">
                                    <h3 class="mb_25">Recent Activity</h3>
                                </div>
                            </div>
                            <div class="Activity_timeline">
                                <ul>
                                    <li>
                                        <div class="activity_bell"></div>
                                        <div class="activity_wrap">
                                            <h6>5 min ago</h6>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque scelerisque
                                            </p>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="activity_bell"></div>
                                        <div class="activity_wrap">
                                            <h6>5 min ago</h6>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque scelerisque
                                            </p>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="activity_bell"></div>
                                        <div class="activity_wrap">
                                            <h6>5 min ago</h6>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque scelerisque
                                            </p>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="activity_bell"></div>
                                        <div class="activity_wrap">
                                            <h6>5 min ago</h6>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque scelerisque
                                            </p>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="white_box mb_30">
                            <div class="box_header border_bottom_1px  ">
                                <div class="main-title">
                                    <h3 class="mb_25">Recent Activity</h3>
                                </div>
                            </div>
                            <div class="activity_progressbar">
                                <div class="single_progressbar">
                                    <h6>USA</h6>
                                    <div id="bar1" class="barfiller">
                                        <div class="tipWrap">
                                            <span class="tip"></span>
                                        </div>
                                        <span class="fill" data-percentage="50"></span>
                                    </div>
                                </div>
                                <div class="single_progressbar">
                                    <h6>AFRICA</h6>
                                    <div id="bar2" class="barfiller">
                                        <div class="tipWrap">
                                            <span class="tip"></span>
                                        </div>
                                        <span class="fill" data-percentage="75"></span>
                                    </div>
                                </div>
                                <div class="single_progressbar">
                                    <h6>UK</h6>
                                    <div id="bar3" class="barfiller">
                                        <div class="tipWrap">
                                            <span class="tip"></span>
                                        </div>
                                        <span class="fill" data-percentage="55"></span>
                                    </div>
                                </div>
                                <div class="single_progressbar">
                                    <h6>CANADA</h6>
                                    <div id="bar4" class="barfiller">
                                        <div class="tipWrap">
                                            <span class="tip"></span>
                                        </div>
                                        <span class="fill" data-percentage="25"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- footer part -->
        <div class="footer_part">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="footer_iner text-center">
                            <p>2022 © nfx Trading - Designed by <a href="#"> <i class="ti-heart"></i> </a><a href="#"> NFX Trading</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- main content part end -->



    <div class="modal fade" id="withdrawModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">WithDraw Funds</h5>
              <p class="text-danger text-center m-auto"> <b> Make Sure You Are Providing Valid Information </b> </p>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
             <form action="{{ route('withdrawRequest') }}" method="POST" id="withdrawFunds">
                @csrf

                <input type="number" name="user_id" value="{{ auth()->user()->id }}" required hidden>
                <input type="number" name="amount" value="{{ $workAnalysis['totalIncome'] }}" required  >

                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        {{-- select method --}}
                        <div class="form-group">
                            <label for="">Select Method</label>
                            <select name="method" id="method" class="form-control" required>
                                <option value="">Select Method</option>
                                <option value="Perfect Money">Perfect Money</option>
                            </select>
                    </div>
                </div>
                    <div class="col-sm-12 col-md-6">
                        {{-- Acount Number --}}
                        <div class="form-group">
                            <label for="">Account Number</label>
                            <input type="text" name="account_number" id="account_number" class="form-control" required>
                    </div>
                </div>
        </div>
    </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">cancel</button>
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
          </div>
        </div>
      </div>





    <!-- footer  -->



    <!-- jquery slim -->
    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!-- owl carousel -->

    <script src="vendors/progressbar/jquery.barfiller.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.9/sweetalert2.all.min.js" integrity="sha512-IZ95TbsPTDl3eT5GwqTJH/14xZ2feLEGJRbII6bRKtE/HC6x3N4cHye7yyikadgAsuiddCY2+6gMntpVHL1gHw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="js/custom.js"></script>

    @if ($message = Session::get('success'))

    @if($message == 'Your request has been sent')

                <script>
                    function successMessage(){
                        Swal.fire({
                        title: '<strong>Success</u></strong>',
                        icon: 'success',
                        html: 'We Have Recived Your Request. You Will Get Fund Recive Confirmation Soon',
                        confirmButtonText: 'Thank You PipsScalper Team ',
                        footer: 'Need Any Help ?Contact Us on <b class="ml-1"> Affiliator Helpline </b>'
                        });
                    }
                    successMessage();

                </script>
    @elseif($message == 'You can not withdraw this amount')

    <script>
        function successMessage_second(){
            Swal.fire({
            title: '<strong>Error </u></strong>',
            icon: 'error',
            html: 'There is an error in your request. Please try again <br> Or Contact Us on <b class="ml-1"> Affiliator Helpline </b>',
            confirmButtonText: 'ok'
            });
        }
        successMessage_second();

    </script>


        @endif
    @endif


    <script>
        function myFunction() {
          var copyText = document.getElementById("myInput");

          copyText.select();
          copyText.setSelectionRange(0, 99999); /* For mobile devices */
          navigator.clipboard.writeText(copyText.value);
        }

        function withDrawReuestMin(){
            const currentIncome = @json($workAnalysis['totalIncome']);
            Swal.fire({
                icon: 'error',
                title: 'OPPS...',
                html: 'Minimum <b class="text-success"> $50 </b> Required To Withdraw <br> Your Current Balance is <b class="text-success"> $'+ currentIncome +'</b>',
                });
        }

        </script>

@endif

</body>


</html>
