@extends('admin.adminLayouts.adminMaster')

@section('main_section')

<div class="pagetitle">
    <h1>Pending Orders</h1>

</div><!-- End Page Title -->


@if ($errors->any())
<div class="alert alert-danger alert-dismissible fade show">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

@if (session()->has('success'))
<div class="alert alert-success alert-dismissible fade show">
    @if(is_array(session('success')))
    <ul>
        @foreach (session('success') as $message)
        <li>{{ $message }}</li>
        @endforeach
    </ul>
    @else
    {{ session('success') }}
    @endif
</div>
@endif

<section class="section">
    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-body">

                    <!-- Table with stripped rows -->
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th scope="col">Affiliator</th>
                                <th scope="col">Mail</th>
                                <th scope="col">Method</th>
                                <th scope="col">Account No</th>
                                <th scope="col">Date</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                          @forelse($requests as  $order)
                                  <tr>

                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $order->user->name }} / {{ $order->user->email }}</td>
                                    <td>{{ $order->method }}</td>
                                    <td>{{ $order->account_number }}</td>
                                    <td>{{ $order->created_at }}</td>


                                      <td class="d-flex">
                                          <button class="btn btn-primary mx-1 paymentReqview" data-id="{{ $order->id }}">view</button>
                                          <button class="btn btn-warning mx-1 paymentReqAccept" data-id="{{ $order->id }}">Accept</button>
                                          <button class="btn btn-danger mx-1 paymentReqDecline" data-id="{{ $order->id }}">Decline</button>
                                          <button class="btn btn-danger mx-1 paymentReqDelete" data-id="{{ $order->id }}">Delete</button>
           
                                      </td>
                                  </tr>



                          @empty
                                  <tr>
                                      <td colspan="5" class="text-center"> No Pending Requests</td>
                                  </tr>
                          @endforelse


                        </tbody>
                    </table>
                    <!-- End Table with stripped rows -->

                </div>
            </div>

        </div>
    </div>
</section>



    {{-- Request View Modal --}}
    <div class="modal fade" id="requestViewModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Request Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                        <section class="section profile">
                            <div class="row">
    
    
                                <div class="col-xl-12">
    
                                    <div class="card">
                                        <div class="card-body pt-3">
                                            <!-- Bordered Tabs -->
                                            <ul class="nav nav-tabs nav-tabs-bordered">
    
                                                <li class="nav-item">
                                                    <button class="nav-link active" >Affiliator Request Overview</button>
                                                </li>
    
    
    
                                            </ul>
                                            <div class="tab-content pt-2">
    
                                                <div class="tab-pane fade show active profile-overview" id="profile-overview">
    
                                                    <h5 class="card-title">Request Details</h5>
    
                                                    <div class="row">
                                                        <div class="col-lg-3 col-md-4 label">Full Name</div>
                                                        <div class="col-lg-9 col-md-8" id="modal_req_name"></div>
                                                    </div>
    
                                                    <div class="row">
                                                        <div class="col-lg-3 col-md-4 label">E-mail</div>
                                                        <div class="col-lg-9 col-md-8" id="modal_req_email"></div>
                                                    </div>
    
                                                    <div class="row">
                                                        <div class="col-lg-3 col-md-4 label">Phone</div>
                                                        <div class="col-lg-9 col-md-8" id="modal_req_phone"></div>
                                                    </div>
    
                                                    <div class="row">
                                                        <div class="col-lg-3 col-md-4 label">Payment Method</div>
                                                        <div class="col-lg-9 col-md-8" id="modal_req_method"></div>
                                                    </div>
    
                                                   
                                                    <div class="row">
                                                        <div class="col-lg-3 col-md-4 label" >Amount</div>
                                                        <div class="col-lg-9 col-md-8" id="modal_req_amount"></div>
                                                    </div>
    
                                                    <div class="row">
                                                        <div class="col-lg-3 col-md-4 label">Date</div>
                                                        <div class="col-lg-9 col-md-8" id="modal_req_date"></div>
                                                    </div>
    
                                                    
    
                                                </div>
    
                                        </div>
                                    </div>
    
                                </div>
                            </div>
                        </section>
    
                </div>
                <div class="modal-footer"> 
                    
                    <button type="button" class="btn btn-success" id="modal_approveButton">Approve</button>
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">ok</button>

                 
                </div>
            </div>
        </div>
    </div>

    <form action="{{ route('affiliator-payment-request-approve') }}" method="POST" hidden id="requestApproveForm">
        @csrf
        <input type="hidden" name="request_id" id="hidden_req_id" required>
    </form>

    <form action="{{ route('affiliator-payment-request-reject') }}" method="POST" hidden id="requestRejectForm">
        @csrf
        <input type="hidden" name="request_id" id="decline_hidden_req_id" required>
    </form>

@endsection

@section('customJs')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
    // view data in modal
    $(document).on('click', '.paymentReqview', function(){
        var id = $(this).data('id');
        const allReqs = @json($requests);
        const req = allReqs.find(req => req.id == id);
        $('#hidden_req_id').val(req.id);
        $('#modal_req_name').text(req.user.name);
        $('#modal_req_email').text(req.user.email);
        $('#modal_req_phone').text(req.user.phone_number);
        $('#modal_req_method').text(req.method);
        $('#modal_req_amount').text(req.amount);
        const date = new Date(req.created_at);
        $('#modal_req_date').text(date.toLocaleString());
        $('#requestViewModal').modal('show');
    });


    // approve request
    $(document).on('click', '#modal_approveButton', function(){
        $('#requestApproveForm').submit();
    });


    $(document).on('click', '.paymentReqAccept', function(){
        var id = $(this).data('id');
        $('#hidden_req_id').val(req.id);
        $('#requestApproveForm').submit();
    });


    $(document).on('click', '.paymentReqDecline', function(){
        var id = $(this).data('id');
        $('#decline_hidden_req_id').val(req.id);
        $('#requestRejectForm').submit();
    });
       
</script>



@endsection