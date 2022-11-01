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
                                    <th>id</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">e-mail</th>
                                    <th scope="col">Orders</th>
                                    <th scope="col">Total Income (20%)</th>
                                </tr>
                            </thead>
                            <tbody>

                              @forelse($affilators as  $affiliator)

                                @if ($affiliator->id != 1)
                                      <tr>
                                          <td>{{ $affiliator->id }}</td>
                                          <td>{{ $affiliator->name }}</td>
                                          <td>{{ $affiliator->email }}</td> 
                                          <td>{{ $affiliator->orders }}</td>
                                          <td>${{ $affiliator->income }}</td>
                                      </tr>
                                    @endif
                              @empty
                                      <tr>
                                          <td colspan="3" class="text-center"> No Affiliators </td>
                                      </tr>
                              @endforelse


                            </tbody>
                        </table>
                        <!-- End Table with stripped rows -->

                    </div>


                    <nav aria-label="Page navigation example" style="float: right" >
                        <ul class="pagination">
                            @if($affilators->onFirstPage())
                            <li class="page-item disabled"> <a class="page-link" >Previous</a></li>
                            @else
                            <li class="page-item"> <a class="page-link" href="{{ $affilators->previousPageUrl() }}" >Previous</a></li>
                            @endif

                            @if ($affilators->hasMorePages())
                                <li class="page-item"> <a class="page-link" href="{{ $affilators->nextPageUrl() }}">Next</a></li>
                            @else
                                <li class="page-item disabled"> <a class="page-link">Next</a></li>
                            @endif

                        </ul>
                    </nav>


                </div>

            </div>
        </div>
    </section>





      @endsection
