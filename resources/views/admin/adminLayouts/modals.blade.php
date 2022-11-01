

<div class="modal fade" id="view_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Order Details</h5>
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
                                                <button class="nav-link active" >Overview</button>
                                            </li>



                                        </ul>
                                        <div class="tab-content pt-2">

                                            <div class="tab-pane fade show active profile-overview" id="profile-overview">

                                                <h5 class="card-title">Order Details</h5>

                                                <div class="row">
                                                    <div class="col-lg-3 col-md-4 label ">Full Name</div>
                                                    <div class="col-lg-9 col-md-8" id="modal_full_name"></div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-lg-3 col-md-4 label">E-mail</div>
                                                    <div class="col-lg-9 col-md-8" id="modal_email"></div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-lg-3 col-md-4 label">Phone</div>
                                                    <div class="col-lg-9 col-md-8" id="modal_phone"></div>
                                                </div>




                                                <div class="row">
                                                    <div class="col-lg-3 col-md-4 label" >Price</div>
                                                    <div class="col-lg-9 col-md-8" id="modal_price"></div>
                                                </div>

                                              

                                            </div>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </section>

            </div>
            <div class="modal-footer">

                @if($page != 'Allorders')
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary " id="orderApproveButton">Approve</button>
                @else
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">ok</button>
                @endif

            </div>
        </div>
    </div>
</div>

<form action="{{ route('order-approve') }}" method="POST" id="order-approve-form" hidden>
    @csrf
    <input type="hidden" name="order_id" id="hidden_order_id">

</form>

<form action="{{ route('delete-order') }}" method="POST" id="order-delete-form" hidden>
    @csrf
    <input type="hidden" name="order_id" id="hidden_order_delete_id">

</form>

<form action="{{ route('decline-order') }}" method="POST" id="order-decline-form" hidden>
    @csrf
    <input type="hidden" name="order_id" id="hidden_order_decline_id">

</form>




