@extends('layouts.app')

<html>
<body>
<h1> edit  book </h1>
<table>
  


<form method="POST" action="/admin/books/{{$myBook->id}}">
        @method('PUT')
        @csrf


<label>  Title </label> <input type="text" name="title"  value="{{ $myBook->title }}"> <br>
<label>  Description </label> <input type="text" name="description" value="{{ $myBook->description }}"> <br>
<label>  Author </label> <input type="text" name="author" value="{{ $myBook->author }}"> <br>
<label>  Quantity </label> <input type="number" name="quantity" min="0" value="{{ $myBook->quantity }}"> <br>
<label>  price </label> <input type="number" name="price" min="0" value="{{ $myBook->price }}"> <br>

<label>  category </label> 
<select id="categories" name="categories">
@foreach ($allCategories as $all)
<option value={{$all->name}}> {{$all->name}} </option>
@endforeach
</select>
 
<br>

<label>  Cover </label> <input type="text" name="cover" value="{{ $myBook->cover }}"> <br>



<button  type="submit"> Submit </buttton>
</form>

</body>
</html>

