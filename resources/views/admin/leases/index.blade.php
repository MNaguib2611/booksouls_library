@extends('admin.layouts.main')
@section('title')
   <title>Leases</title> 
@endsection
@section('css')
<link href="{{ asset('css/searchLeases.css') }}" rel="stylesheet">
@endsection
@section('content')
<div class="container">
    <div class="container justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="topnav">
                    <h1>Current Leases</h1>
                    <hr>
                    <small>Order by</small>
                    <div class="row p-2">
                        <div class="col-lg-6 col-sm-12">
                            <a   class="{{ $byStart ? 'active' : '' }}" 
                                 href="{{route('admin.leases.index').'?orderBy=startDate'}}">
                                Start Date 
                            </a>
                            &nbsp;
                            <a 
                                class="{{ $byStart ? '' : 'active' }}"
                                href="{{route('admin.leases.index').'?orderBy=endDate'}}">
                                End Date
                            </a>
                        </div>
                        <form class="col-lg-6 col-sm-12" action="{{route('admin.leases.index')}}" method="get">
                            @csrf
                            <input type="submit" class="btn btn-sm btn-info"  value="Search">
                            <input type="text" name="search" placeholder="Search..">
                        </form>
                        </div>
                        <br>
                    </div>
                <div class="card-body {{$paginate?'':'overflow-auto'}}">
                    <table class="table table-bordered justify-content-center text-center ">
                      <thead class="thead-dark">
                          <tr>
                              <th>User</th>
                              <th>Book Name</th>
                              <th>Start Date</th>
                              <th>Duration</th>
                              <th>End Date</th>
                          </tr>
                      </thead>
                      <tbody>
                          @foreach($Leases as $lease)
                          <tr>
                              <td class='align-middle'>{{$lease->user->name}}</td>
                              <td class='align-middle'>{{$lease->book->title}}</td>
                              <td class='align-middle'>{{$lease->created_at->format('d M Y')}}</td>
                              <td class='align-middle'>{{$lease->duration}} <strong>days</strong></td>
                              <td class='align-middle'>{{$lease->end_date->format('d M Y')}}</td>
                          </tr>
                          @endforeach
                      </tbody>
                    </table>
                  
                        <div class="col-lg-6 m-auto">
                          {{$paginate? $Leases->appends(request()->except('page'))->links():''}}
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
