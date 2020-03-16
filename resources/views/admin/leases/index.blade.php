@extends('admin.layouts.main')
@section('content')
<div class="container">
<div class="container justify-content-center">
    <div class="col-md-12">
        <div class="card">
          <div class="card-body h-100">
    <h1 class="display-3" style="text-align:center;">Current Leases</h1>
    <table class="table table-bordered justify-content-center text-center ">
    <thead class="thead-dark">
        <tr>
            <th>Guest</th>
            <th>Book Name</th>
            <th>Duration</th>
        </tr>
    </thead>
    <tbody>
        @foreach($Leases as $lease)
        <tr>
            <td class='align-middle'>{{$lease->user->name}}</td>
            <td class='align-middle'>{{$lease->book->title}}</td>
            <td class='align-middle'>{{$lease->duration}}</td>
        </tr>
        @endforeach
    </tbody>
  </table>
<?php echo $Leases->render(); ?>
</div>
</div>
</div>
  </div>
<div>
</div>
@endsection