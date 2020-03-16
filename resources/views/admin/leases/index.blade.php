@extends('admin.layouts.main')


@section('content')
<div class="container">
    <div class="container justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Current Leases</div>
                <div class="card-body">
                    <table class="table table-bordered justify-content-center text-center ">
                      <thead class="thead-dark">
                          <tr>
                              <th>User</th>
                              <th>Book Name</th>
                              <th>Start Date</th>
                              <th>Duration</th>
                          </tr>
                      </thead>
                      <tbody>
                          @foreach($Leases as $lease)
                          <tr>
                              <td class='align-middle'>{{$lease->user->name}}</td>
                              <td class='align-middle'>{{$lease->book->title}}</td>
                              <td class='align-middle'>{{$lease->created_at->format('d M Y')}}</td>
                              <td class='align-middle'>{{$lease->duration}} <strong>days</strong></td>
                          </tr>
                          @endforeach
                      </tbody>
                    </table>
                  
                        <div class="col-lg-6 m-auto">
                          {{$Leases->links()}}
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
