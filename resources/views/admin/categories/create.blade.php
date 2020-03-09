@extends('layouts.app')

@section('content')
<div class="row">
 <div class="col-sm-8 offset-sm-2">
    <h1 class="display-3">Add Category</h1>
  <div>
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div><br />
    @endif
      <form method="post" action="{{ route('categories.store') }}">
          @csrf
          <div class="form-group">    
              <label for="category_name">Category Name:</label>
              <input type="text" class="form-control" name="category_name"/>
          </div>
          <button type="submit" class="btn btn-primary ml-2 mb-2">Add Category</button>
      </form>
  </div>
</div>
</div>
@endsection