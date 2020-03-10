    @extends('layouts.app')
@section('content')
<div class="row">
<div class="col-sm-12">
    <h1 class="display-3" style="text-align:center;">Categories</h1>
    <div class="col-sm-12" style="text-align:center;">
        @if(session()->get('success'))
            <div class="alert alert-success">
            {{ session()->get('success') }}  
            </div>
        @endif
    </div> 
    <div style="text-align:center;">
    <a style="margin: 19px;" href="{{ route('categories.create')}}" class="btn btn-primary">Add New Category</a>
    </div>     
    <table class="table table-bordered justify-content-center text-center ">
    <thead class="thead-dark">
        <tr>
            <th>Category Name</th>
            <th><b>Update</b></th>
            <th><b>Delete</b></th>
        </tr>
    </thead>
    <tbody>
        @foreach($Categories as $category)
        <tr>
            <td class='align-middle'>{{$category->name}}</td>
            <td class='align-middle'>
                <a href="{{ route('categories.edit',$category->id)}}" class="btn btn-primary">Edit</a>
            </td>
            <td class='align-middle'>
                <form action="{{ route('categories.destroy', $category->id)}}" method="post">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-danger" type="submit">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
  </table>
<div>
</div>
@endsection