@extends('admin.layouts.main')

@section('content')
<div class="container">
    <div class="container justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h1>Admins</h1></div>

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
                        <h2><a class="btn btn-success btn-lg" href="{{route('admins.create') }}">Add Admin</a></h2>
                        <table class="table table-hover">
                           <thead class="thead-dark">
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
                                @foreach ($admins as $admin)
                                <tr>
                               
                                    <td>  <a href="{{route('admins.show', $admin->id) }}">{{$admin->name}}</a></td>
                                    <td>{{$admin->username}}</td>
                                    <td>{{$admin->email}}</td>
                                    <td>{{$admin->phone}}</td>
                                    <td>{{$admin->address}}</td>
                                    <td width="20%"><img width="80%" src="{{$admin->avatar}}" alt=""></td>
                                    <td>
                                        <a class="btn btn-sm btn-primary  " href="{{route('admins.edit', $admin->id) }}"><i class="fas fa-edit"></i></a>
                                        {!! Form::open(['route' => ['admins.destroy', $admin->id],'class'=>'d-inline','method' => "delete"]) !!}
                                        {!! Form::token(); !!}
                                        <button type="submit" class='btn btn-sm btn-danger'><i class='fa fa-trash' aria-hidden='true'></i></button>
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                                @endforeach
                               
                            </tbody>

                        </table>
                        <div class="col-lg-6 m-auto">
                            {{$admins->links()}}
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
