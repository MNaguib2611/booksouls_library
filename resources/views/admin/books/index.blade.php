@extends('admin.layouts.main')
@section('title')
   <title>Books</title> 
@endsection
@section('content')
<div class="container">
  <div class="container justify-content-center">
      <div class="col-md-12">
          <div class="card">
            <div class="card-body">
            <h1 class="ml-2"> list all books </h1>
            @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>	
                            <strong>{{ $message }}</strong>
                    </div>
            @endif

        
            <input type="text" name="search" id="search" class="form-control" placeholder="Search" style="width:80%" />
            <br/>

            <input type="radio" name="order" value="avgRate" class="form-check-label" ></input>
              <label class="form-check-label" for="gridRadios1">
              Rate
              </label>
            <input type="radio" name="order" value="created_at" class="form-check-label" ></input>
              <label class="form-check-label" for="gridRadios2">
                Latest
              </label>

            <input type="radio" name="order" value="title" class="form-check-label" ></input>
              <label class="form-check-label" for="gridRadios2">
                Title
              </label>
            
              
            <select id="category"class="form-control" style="width:25%">
            </select>

              <br/>

            <div class="bookcontainer">
            </div>


          </div>
        </div>
    </div>
  </div>
</div>
 <!-- svg Data -->
 <svg xmlns="http://www.w3.org/2000/svg" class="icons">
<symbol id="download" viewBox="0 0 24 24"><path d="M21 14c-0.6 0-1 0.4-1 1v4c0 0.6-0.4 1-1 1h-14c-0.6 0-1-0.4-1-1v-4c0-0.6-0.4-1-1-1s-1 0.4-1 1v4c0 1.7 1.3 3 3 3h14c1.7 0 3-1.3 3-3v-4c0-0.6-0.4-1-1-1z"></path>
<path d="M11.3 15.7c0.1 0.1 0.2 0.2 0.3 0.2 0.1 0.1 0.3 0.1 0.4 0.1s0.3 0 0.4-0.1c0.1-0.1 0.2-0.1 0.3-0.2l5-5c0.4-0.4 0.4-1 0-1.4s-1-0.4-1.4 0l-3.3 3.3v-9.6c0-0.6-0.4-1-1-1s-1 0.4-1 1v9.6l-3.3-3.3c-0.4-0.4-1-0.4-1.4 0s-0.4 1 0 1.4l5 5z"></path></symbol>
<symbol id="delete" viewBox="0 0 24 24"><path d="M21 5h-4v-1c0-1.7-1.3-3-3-3h-4c-1.7 0-3 1.3-3 3v1h-4c-0.6 0-1 0.4-1 1s0.4 1 1 1h1v13c0 1.7 1.3 3 3 3h10c1.7 0 3-1.3 3-3v-13h1c0.6 0 1-0.4 1-1s-0.4-1-1-1zM9 4c0-0.6 0.4-1 1-1h4c0.6 0 1 0.4 1 1v1h-6v-1zM18 20c0 0.6-0.4 1-1 1h-10c-0.6 0-1-0.4-1-1v-13h12v13z"></path>
<path d="M10 10c-0.6 0-1 0.4-1 1v6c0 0.6 0.4 1 1 1s1-0.4 1-1v-6c0-0.6-0.4-1-1-1z"></path>
<path d="M14 10c-0.6 0-1 0.4-1 1v6c0 0.6 0.4 1 1 1s1-0.4 1-1v-6c0-0.6-0.4-1-1-1z"></path></symbol>
<symbol id="edit" viewBox="0 0 24 24"><path d="M20 13.7c-0.6 0-1 0.4-1 1v5.3c0 0.6-0.4 1-1 1h-14c-0.6 0-1-0.4-1-1v-14c0-0.6 0.4-1 1-1h5.3c0.6 0 1-0.4 1-1s-0.4-1-1-1h-5.3c-1.7 0-3 1.3-3 3v14c0 1.7 1.3 3 3 3h14c1.7 0 3-1.3 3-3v-5.3c0-0.6-0.4-1-1-1z"></path>
<path d="M22.7 5.3l-4-4c-0.4-0.4-1-0.4-1.4 0l-10 10c-0.2 0.2-0.3 0.4-0.3 0.7v4c0 0.6 0.4 1 1 1h4c0.3 0 0.5-0.1 0.7-0.3l10-10c0.4-0.4 0.4-1 0-1.4zM11.6 15h-2.6v-2.6l9-9 2.6 2.6-9 9z"></path></symbol>
</svg>
@endsection







@section('js')

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>

<script>

let orderBy="title";
let category=0;
let text="";

fetch_book_category();
fetch_book_data(orderBy,category,text);

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
      print_data(data,text)
    }
  })
}
function fetch_book_category(query = '')
{
  $.ajax({
    url:"{{ route('book.getCategories') }}",
    method:'GET',
    data:{query:query},
    dataType:'json',
    success:function(data)
    {
      $('#category').html(data.cat);
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


function print_data(data,text)
{
  jQuery('.bookcontainer').html('');

  var output="";
  if(data.total_rows > 0)
  {
    for(var row in data.selectedRows) 
    {  
      if(data.selectedRows[row].title.toLowerCase().indexOf(text.toLowerCase()) >= 0 ||data.selectedRows[row].author.toLowerCase().indexOf(text.toLowerCase()) >= 0 )       
        {
          var output =  '<div class="book">'+
                '<div class="bookpic" style="background-image: url(\''+data.selectedRows[row].cover+'\');"></div>'+
                '<div class="bookinfo">'+
                '   <div class="title">'+data.selectedRows[row].title+'</div>'+
                  '  <div class="author">'+data.selectedRows[row].author+'</div>'+
                  ' <div class="stars">'+ Math.ceil(data.selectedRows[row].avgRate)+'</div>'+
                  ' <div class="created_at">'+data.selectedRows[row].created_at+'</div>'+
                    '<ul class="controls">'+
                    '<li class="control">'+
                        '   <a href="/admin/books/'+data.selectedRows[row].myID+'">'+
                                '<img alt="Qries" src="https://cdn0.iconfinder.com/data/icons/glyphpack/167/visible-512.png"/>'+
                              ' <span class="invisible">View</span>'+
                            '</a>'+
                        '</li>'+
                        '<li class="control">'+
                        '   <a href="/admin/books/'+data.selectedRows[row].myID+'/edit">'+
                                '<svg class="icon icon--2x"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#edit"></use></svg>'+
                              ' <span class="invisible">Update</span>'+
                            '</a>'+
                        '</li>'+
                      ' <li class="control deletebutton" id= "'+data.selectedRows[row].myID+'">'+
                            '<a href="#">'+
                            '   <svg class="icon icon--2x deletesvg"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#delete"></use></svg>'+
                              '  <span class="invisible">Delete</span>'+
                          ' </a>'+
                        '</li>'+
                    '</ul>'+
                '</div>'+
            '</div>';

            $( ".bookcontainer" ).append( output );
          // console.log(output);

        }
    }
  }
  else
  {
    
    $( ".bookcontainer" ).append( "<h1>No Data Found</h1>" );

  }
  $(document).ready(function(){
    $('.deletebutton').click(function(e){
      e.preventDefault();
      $(this).parent().parent().parent().addClass("deleteme");
      
      var bookID=$(this).attr('id');
      console.log(bookID);
      $.ajax({
        url:"{{ route('book.deleteBook') }}",
        method:'GET',
        data:{bookID:bookID},
        dataType:'json',
        success:function(data)
        {
          // alert(data.message);
          //fetch_book_data(orderBy,category,text);
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) { 
           alert("Status: " + textStatus); alert("Error: " + errorThrown); 
          } 
      })
      
          
      

   
   





    });
  });
}

</script>


@endsection
