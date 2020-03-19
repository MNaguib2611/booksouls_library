@extends('admin.layouts.main')

@section('content')
<div class="container">
  <div class="container justify-content-center">
      <div class="col-md-15">
          <div class="card">
            <div class="card-body">
                <h1>Edit Profile</h1>
                <hr>
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-3">
                      <div class="text-center">
                        <img src="//placehold.it/100" class="avatar img-circle" alt="avatar">
                        <h6>Upload a different cover...</h6>
                        
                        <input type="file" class="form-control" name="cover" accept="image/x-png,image/gif,image/jpeg"  value="{{ $myBook->cover }}">
                      </div>
                    </div>
                    
                    <!-- edit form column -->
                    <div class="col-md-9 personal-info">
                    
                      <h3>Book info</h3>
                      

                      <form class="form-horizontal" role="form" method="POST" action="/admin/books/{{$myBook->id}}">
                      @method('PUT')
                      @csrf
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
                            <input type="button" class="btn btn-primary" value="Save Changes">
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
    </div>
  
</div>



            


@endsection

