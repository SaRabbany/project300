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
                                      <th scope="col">Name</th>
                                      <th scope="col">Mail</th>
                                      <th scope="col">Method</th>
                                      <th scope="col">Date</th>
                                      <th scope="col">Action</th>
                                  </tr>
                              </thead>
                              <tbody>

                                @forelse($pendingOrders as  $order)
                                        <tr>

                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $order->name }}</td>
                                            <td>{{ $order->email }}</td>
                                            <td>{{ $order->method }}</td>
                                            <td>{{ $order->date }}</td>


                                            <td class="d-flex">
                                                <button class="btn btn-primary mx-1 orderViewButton" data-id="{{ $order->id }}">view</button>
                                                <button class="btn btn-warning mx-1 orderApproveButtonClass" data-id="{{ $order->id }}">Accept</button>
                                                <button class="btn btn-danger mx-1 orderDeleteButton" data-id="{{ $order->id }}">Delete</button>

                                            </td>
                                        </tr>



                                @empty
                                        <tr>
                                            <td colspan="6" class="text-center"> No Pending Orders</td>



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

      @include('admin.adminLayouts.modals',['page'=>'pendingOrders'])


@endsection

@section('customJs')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>

    $(document).ready(function(){


    $('.orderViewButton').on('click', function(){

        const allData = @json($pendingOrders);
            const selected_id = $(this).attr('data-id');
            const selectd_order = allData.find(data => data.id == selected_id);

            elementFinder('hidden_order_id').value = selected_id;
            elementFinder('modal_full_name').innerHTML = selectd_order.name;
            elementFinder('modal_email').innerHTML = selectd_order.email;
            elementFinder('modal_phone').innerHTML = selectd_order.phone;



            elementFinder('modal_price').innerHTML = selectd_order.price;
            var viewModal = new bootstrap.Modal(document.getElementById('view_modal'), {});
            viewModal.show();

    });

    function elementFinder(id){
        return document.getElementById(id);
    }


    $('#orderApproveButton').on('click', function(){

        if(confirm('Are you sure to accept this order ?')){
            elementFinder('order-approve-form').submit();
        }else{
            return false;
        }

    });

    $('.orderApproveButtonClass').on('click', function(){

        if(confirm('Are you sure to accept this order ?')){
            selecedId = $(this).attr('data-id');
            elementFinder('hidden_order_id').value = selecedId;
            elementFinder('order-approve-form').submit();
        }else{
            return false;
        }

    });


    $('.orderDeleteButton').on('click', function(){

       if(confirm('Are you sure to delete this order ?')){
           selecedId = $(this).attr('data-id');
           elementFinder('hidden_order_delete_id').value = selecedId;
           elementFinder('order-delete-form').submit();
       }else{
           return false;
       }

   });



   $('.orderDeclineButton').on('click', function(){

       if(confirm('Are you sure to Decline this order ?')){
           selecedId = $(this).attr('data-id');
           elementFinder('hidden_order_decline_id').value = selecedId;
           elementFinder('order-decline-form').submit();
       }else{
           return false;
       }
    });



    });


</script>

@endsection


