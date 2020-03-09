@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Admins</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                        <table class="table table-hover">
                           <thead>
                            <tr>
                               <th>Name</th>
                               <th>Username</th>
                               <th>Email</th>
                               <th>Phone</th>
                               <th>Address</th>
                               <th width="20%">Avatar</th>
                               <th width="20%">Actions</th>
                            </tr>
                           </thead>
                            <tbody>
                                <tr>
                               
                                    <td>  <a href="{{route('admins.show', $admin->id) }}">{{$admin->name}}</a></td>
                                    <td>{{$admin->username}}</td>
                                    <td>{{$admin->email}}</td>
                                    <td>{{$admin->phone}}</td>
                                    <td>{{$admin->address}}</td>
                                    <td width="20%"><img width="80%" src="{{$admin->avatar}}" alt=""></td>
                                    <td>
                                        <a class="btn btn-sm btn-primary" href="{{route('admins.edit', $admin->id) }}">Edit</a>
                                        {!! Form::open(['route' => ['admins.destroy', $admin->id],'method' => "delete"]) !!}
                                        {!! Form::token(); !!}
                                        {!! Form::submit('Delete',['class' => 'btn btn-sm btn-danger']); !!}
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                               
                            </tbody>

                        </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
