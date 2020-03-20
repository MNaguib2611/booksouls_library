@extends('admin.layouts.main')
@section('title')
   <title>Books</title> 
@endsection
@section('content')
<div class="container">
  <div class="container justify-content-center">
      <div class="col-md-12">
          <div class="card">
            <div class="card-body ">
<h1> create new book </h1>

@if ($errors->any())
        <strong>Whoops! </strong>
        <div class="alert alert-danger">
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{$error}}</li>
          @endforeach
        </ul>    
        </div>
@endif


<form class="form-horizontal" role="form" method="POST" action="/admin/books/"  enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label class="col-lg-3 control-label">Cover:</label>
        <div class="col-lg-8">
        <input type="file" class="form-control" name="cover" accept="image/x-png,image/gif,image/jpeg" />

        </div>
      </div>
      <div class="form-group">
        <label class="col-lg-3 control-label">Title:</label>
        <div class="col-lg-8">
          <input class="form-control" type="text" name="title"  >
        </div>
      </div>
      <div class="form-group">
        <label class="col-lg-3 control-label">Description:</label>
        <div class="col-lg-8">
          <input class="form-control"  type="text" name="description" >
        </div>
      </div>
      <div class="form-group">
        <label class="col-lg-3 control-label">Author:</label>
        <div class="col-lg-8">
          <input class="form-control"  type="text" name="author" >
        </div>
      </div>
      <div class="form-group">
        <label class="col-lg-3 control-label">Quantity:</label>
        <div class="col-lg-8">
          <input class="form-control"  type="number" name="quantity" min="0">
        </div>
      </div>
      <div class="form-group">
        <label class="col-lg-3 control-label">Price:</label>
        <div class="col-lg-8">
          <input class="form-control" type="number" name="price" min="0">
        </div>
      </div>
      <div class="form-group">
        <label class="col-lg-3 control-label">Category:</label>
        <div class="col-lg-8">
          <div class="ui-select">
            <select id="categories" name="categories" class="form-control">
            @foreach ($allCategories as $all)
            <option value={{$all->name}}> {{$all->name}} </option>
            @endforeach
            </select>
          </div>
        </div>
      </div>
      <div class="form-group">
        <label class="col-md-3 control-label"></label>
        <div class="col-md-8">
          <input type="submit" class="btn btn-primary" value="Save Changes">
          <span></span>
          <input type="reset" class="btn btn-default" value="Cancel">
        </div>
      </div>
    </form>



</div>
</div>
</div>
</div>
</div>
@endsection


