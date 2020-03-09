@extends('layouts.app')

<html>
<body>
<h1> create new book </h1>
<table>
  

<form method="post"  action="/admin/books" enctype="multipart/form-data">

@csrf


<label>  Title </label> <input type="text" name="title"> <br>
<label>  Description </label> <input type="text" name="description"> <br>
<label>  Author </label> <input type="text" name="author"> <br>
<label>  Quantity </label> <input type="number" name="quantity" min="0"> <br>
<label>  price </label> <input type="number" name="price" min="0"> <br>

<label>  category </label> 
<select id="categories" name="categories">
@foreach ($allCategories as $all)
<option value={{$all->name}}> {{$all->name}} </option>
@endforeach
</select>
 
<br>

<label>  Cover </label> <input type="text" name="cover"> <br>


<a href="{{url()->previous() }}" >Back</a>

<button  type="submit"> Submit </buttton>
</form>

</table>
@if ($errors->any())
        <strong>Whoops! </strong> there where some problems with your input.<br>
        <ul>
          @foreach ($errors as $error)
            <li>{{$error}}</li>
          @endforeach
        </ul>    
@endif
</body>
</html>

