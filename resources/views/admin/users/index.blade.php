@extends('admin.layouts.main')
@section('title')
   <title>Users</title> 
@endsection

@section('content')
<div class="container">
    <div class="container justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">users</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                        <table class="table table-hover">
                           <thead class="thead-dark">
                            <tr>
                               <th>Name</th>
                               <th>Username</th>
                               <th>Phone</th>
                               <th width="20%">Avatar</th>
                               <th width="30%">Actions</th>
                            </tr>
                           </thead>
                            <tbody>
                                @foreach ($users as $user)
                                <tr>
                               
                                    <td>  <a href="{{route('users.show', $user->id) }}">{{$user->name}}</a></td>
                                    <td>{{$user->username}}</td>
                                    <td>{{$user->phone}}</td>
                                    <td width="20%"><img width="80%" src="{{$user->avatar}}" alt=""></td>
                                    <td>
                                        {!! Form::open(['route' => ['users.destroy', $user->id],'class'=>'d-inline','method' => "delete"]) !!}
                                        {!! Form::token(); !!}
                                        {!! Form::submit('Delete',['class' => 'btn btn-sm btn-danger']); !!}
                                        {!! Form::close() !!}
                                        {{---- Upgrade to admin----}}
                                        @if ($user->isActive==1)
                                        {!! Form::open(['route' => ['user.deactivate', $user->id],'class'=>'d-inline','method' => "put"]) !!}
                                        {!! Form::text('isActive', 0, array_merge(['hidden' => 'hidden']))  !!}
                                        {!! Form::submit('Deactivate!',['class' => 'btn  btn-sm btn-warning']); !!}
                                        {!! Form::close() !!}
                                        @else
                                        {!! Form::open(['route' => ['user.activate', $user->id],'class'=>'d-inline','method' => "put"]) !!}
                                        {!! Form::text('isActive', 1, array_merge(['hidden' => 'hidden']))  !!}
                                        {!! Form::submit('Activate!',['class' => 'btn btn-sm btn-success']); !!}
                                        {!! Form::close() !!}
                                        @endif
                                        @if ($user->isActive==1)
                                            {!! Form::open(['route' => ['user.upgrade', $user->id],'class'=>'d-inline','method' => "put"]) !!}
                                            {!! Form::text('isAdmin', 1, array_merge(['hidden' => 'hidden']))  !!}
                                            {!! Form::submit('Upgrade!',['class' => 'btn btn-sm btn-primary']); !!}
                                            {!! Form::close() !!}
                                        @endif
                                        
                                    </td>
                                </tr>
                                @endforeach
                               
                            </tbody>

                        </table>
                        <div class="col-lg-6 m-auto">
                            {{$users->links()}}
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
