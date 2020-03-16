@extends('admin.layouts.main')

@section('content')
<div class="container">
  <div class="container justify-content-center">
      <div class="col-md-12">
          <div class="card">
            <div class="card-body h-100">
<h1 class="ml-2"> list all books </h1>

<button class="btn btn-primary ml-2 mb-2" onclick="location.href='{{ url('admin/books/create') }}'"> Create New Book </button>
@if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>	
                <strong>{{ $message }}</strong>
        </div>
@endif

<input type="text" name="search" id="search" class="form-control" placeholder="Search" style="width:40%" />
<input type="radio" name="order" value="rate">Rate</input>
<input type="radio" name="order" value="creation">Latest</input>
<br/>
<select id="category">
  
  


</select>

<br/>

<table class="table table-bordered justify-content-center text-center ">
    <thead>
      <tr class="thead-dark">
        <th><b>Title</b></th>
        <th><b>Author</b></th>
        <th><b>Rate</b></th>
        <th><b>Created_at</b></th>
        <th><b>Category_id</b></th>
        <th><b>Cover</b></th>
        <th><b>Details</b></th>
        <th><b>Update</b></th>
        <th><b>Delete</b></th>
      </tr>
    </thead>
   <tbody>
  </tbody>
  
</table>
</div>
</div>
</div>
</div>
</div>
@endsection


@section('js')
<script>

let orderBy="title";
let category=0;
let text="";

fetch_book_category();
fetch_book_data(orderBy,category,text);
//fetch_avrage_reviews();

function fetch_book_data(orderBy,category,text)
{
  console.log(orderBy,category,text);
  var filt =""+orderBy +"/"+category+"";

  $.ajax({
    url:"{{ route('book.selectedData') }}",
    method:'GET',
    data:{filt:filt,text:text},
    dataType:'json',
    success:function(data)
    {
      print_data(data)
    }
  })
}
function fetch_book_category(query = '')
{
  $.ajax({
    url:"{{ route('book.categories') }}",
    method:'GET',
    data:{query:query},
    dataType:'json',
    success:function(data)
    {
      $('#category').html(data.cat);
    }
  })
}

function fetch_avrage_reviews(orderBy,category,text)
{
  $.ajax({
    url:"{{ route('book.getAvrage') }}",
    method:'GET',
    data:{orderBy:orderBy,category:category,text:text},
    dataType:'json',
    success:function(data)
    {
      $('tbody').html(data.table_data);
    }
  })
}

$(document).on('keyup', '#search', function(){
  text = $(this).val();
  fetch_book_data(orderBy,category,text);
});

$(document).ready(function(){
  $('input:radio[name="order"]').change(
    function(){
      orderBy=this.value;
      fetch_book_data(orderBy,category,text);
    });
  });
  
$(document).ready(function(){
  $('#category').on('change', function() {
    category=this.value;
    fetch_book_data(orderBy,category,text);
  });
});


function print_data(data)
{
  $(".table > tr").remove();
  
  var output="";
  //$('tbody').html(data.table_data);
  if(data.total_rows > 1)
  {
    for(var row in data.selectedRows) 
    {
      // if(data.selectedRows[row].rate==null)
      //   rate=0;
      // else
      //   rate=row[rate];
                  
      var output = " <tr> <td class='align-middle'>"+data.selectedRows[row].title+"</td>"+
      "<td class='align-middle'>" + data.selectedRows[row].author+ "</td>"+
      "<td class='align-middle'>" + data.selectedRows[row].creation+ "</td>"+
      "<td class='align-middle'>" + data.selectedRows[row].category_id+ "</td>"+
      "<td class='align-middle'>" + data.selectedRows[row].cover+ "</td>"+

      "<td class='align-middle'> <a href=\"books/"+data.selectedRows[row].id+"\"> <button class=\"btn btn-primary\">Show</button></a></td>"+

      "<td class='align-middle'> <a href=\"books/"+data.selectedRows[row].id+"/edit\"> <button class=\"btn btn-success\">Update</button></a> </td>"+


      "<td class='align-middle'>  <button  class=\"btn btn-danger\" class=\"deleteRecord\" data-id="+data.selectedRows[row].id+"\"  >Delete</button></td>"+
      "</tr>";
        $('table').append(output);
      
    }

  }
  else
  {
    
    $('tbody').html('<tr> <td align="center" colspan="5">No Data Found</td> </tr>');
  }

}


</script>

@endsection
