@extends('admin.layouts.main')
@section('title')
   <title>Books</title> 
@endsection


@section('content')


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
<div class="container">
  <div class="container justify-content-center">
            <div class="card-body">
                <h1>Edit Book</h1>
                <hr>
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-3">
                      <div class="text-center">
                        <h6>Upload cover...</h6>
                        <img src="{{$myBook->cover}}" alt="cover" width="100%" name="oldCover">                     
                      </div>
                    </div>
                    
                    <!-- edit form column -->
                    <div class="col-md-9 personal-info">
                    
                      <h3>Book info</h3>
                      

                      <form class="form-horizontal" role="form" method="POST" action="/admin/books/{{$myBook->id}}" enctype="multipart/form-data">
                      @method('PUT')
                      @csrf
                      <div class="form-group">
                          <label class="col-lg-3 control-label">Cover:</label>
                          <div class="col-lg-8">
                          <img src="{{$myBook->cover}}" alt="cover" width="100%" name="oldCover" hidden>                     
                          <input type="file" class="form-control" name="cover" accept="image/x-png,image/gif,image/jpeg" />
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="col-lg-3 control-label">Title:</label>
                          <div class="col-lg-8">
                            <input class="form-control" type="text" name="title"  value="{{ $myBook->title }}">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-lg-3 control-label">Description:</label>
                          <div class="col-lg-8">
                            <input class="form-control"  type="text" name="description" value="{{ $myBook->description }}">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-lg-3 control-label">Author:</label>
                          <div class="col-lg-8">
                            <input class="form-control"  type="text" name="author" value="{{ $myBook->author }}">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-lg-3 control-label">Quantity:</label>
                          <div class="col-lg-8">
                            <input class="form-control"  type="number" name="quantity" value="{{ $myBook->quantity }}">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-lg-3 control-label">Price:</label>
                          <div class="col-lg-8">
                            <input class="form-control" type="number" name="price" value="{{ $myBook->price }}">
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

