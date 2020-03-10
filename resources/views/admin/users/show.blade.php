@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h2>{{$user->name}}</h2></div>

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
                       
                    <div class="row">
                        <div class='col-lg-8 form-group'>
                            {!! Form::open(['route' => ['users.index'],'method' => "get" ]) !!}
                            {!! Form::token(); !!}
                            {!! Form::label('name', 'Name'); !!}
                            {!! Form::text('name', $user->name, array_merge(['class' => 'form-control','disabled']))  !!}
                            <br>
                            {!! Form::label('username', 'Username'); !!}
                            {!! Form::text('username', $user->username, array_merge(['class' => 'form-control','disabled'])); !!}
                            <br>
                            {!! Form::label('email', 'Email'); !!}
                            {!! Form::text('email', $user->email, array_merge(['class' => 'form-control','disabled'])); !!}
                            <br>
                            {!! Form::label('phone', 'Phone'); !!}
                            {!! Form::text('phone', $user->phone, array_merge(['class' => 'form-control','disabled'])); !!}
                            <br>
                            {!! Form::label('address', 'Address'); !!}
                            {!! Form::text('address', $user->address, array_merge(['class' => 'form-control','disabled'])); !!}
                            <br>
                            {!! Form::close() !!} 
                        </div>
                        <div class="col-lg-4">
                            <img src="{{$user->avatar}}" alt="Avatar" width="100%">
                            <div class="col-lg-12 mt-3 text-center">
                                {!! Form::open(['route' => ['user.upgrade', $user->id],'method' => "put"]) !!}
                                {!! Form::text('isAdmin', 1, array_merge(['hidden' => 'hidden']))  !!}
                                {!! Form::submit('Upgrade!',['class' => 'btn btn-success']); !!}
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
