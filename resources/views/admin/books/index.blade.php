<html>
<body>
<h1> list all books </h1>
<table>

</table>
<button onclick="location.href='{{ url('admin/books/create') }}'"> Create New Book </button>
@if ($message = Session::get('success'))
      <div style="color:green">
        <p>{{$message}}</p>
      </div>
@endif



<table style="border:solid">
      <tr>
        <th width = "50px"><b>Title</b></th>
        <th width = "50px"><b>Cover</b></th>
        <th width = "50px"><b>Details</b></th>
        <th width = "50px"><b>Update</b></th>
        <th width = "50px"><b>Delete</b></th>
      </tr>

      @foreach ($allBooks as $b)
        <tr>
          <td>{{$b->title}}</td>
          <td>{{$b->cover}}</td>

          <td> <a href="{{ URL::to('admin/books/' . $b->id) }}"> <button>Show</button></a> </td>
          <td> <a href="{{ URL::to('admin/books/' . $b->id . '/edit') }}"> <button>Update</button></a> </td>
          <td>
                <form method="POST" action="/admin/books/{{$b->id}}">
              {{ csrf_field() }}
              {{ method_field('DELETE') }}
                  <button type="submit" >Delete</button>
                 </form>

                </td>


        
        </tr>
      @endforeach
    </table>


</body>
</html>

