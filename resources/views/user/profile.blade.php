@extends('layouts.app')

@section('content')
<div class="container">
    <div class="container justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">My Profile</div>

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
                            {!! Form::open(['route' => ['users.update',$user->id],'method' => "put",'enctype'=>"multipart/form-data" ]) !!}
                            {!! Form::token(); !!}
                            {!! Form::label('name', 'Name'); !!}
                            {!! Form::text('name', $user->name, array_merge(['class' => 'form-control']))  !!}
                            <br>
                            {!! Form::label('username', 'Username'); !!}
                            {!! Form::text('username', $user->username, array_merge(['class' => 'form-control'])); !!}
                            <br>
                            {!! Form::label('email', 'Email'); !!}
                            {!! Form::text('email', $user->email, array_merge(['class' => 'form-control'])); !!}
                            <br>
                            {!! Form::label('phone', 'Phone'); !!}
                            {!! Form::text('phone', $user->phone, array_merge(['class' => 'form-control'])); !!}
                            <br>
                            {!! Form::label('address', 'Address'); !!}
                            {!! Form::text('address', $user->address, array_merge(['class' => 'form-control'])); !!}
                            <br>
                            {!! Form::label('avatar', 'Avatar'); !!}
                            {!! Form::file('avatar',['class' => 'form-control']); !!}
                            <br>
                            {!! Form::label('password', 'Password'); !!}
                            {!! Form::text('password', '', array_merge(['class' => 'form-control'])); !!}
                            <br>
                            {!! Form::label('password_confirmation', 'Password Confirm'); !!}
                            {!! Form::text('password_confirmation', '', array_merge(['class' => 'form-control'])); !!}
                            
                            
                            {!! Form::submit('Update',['class' => 'btn btn-info m-3 float-right']); !!}
                            {!! Form::close() !!} 
                        </div>
                        <div class="col-lg-4">
                            <img src="{{$user->avatar}}" alt="Avatar" width="100%">
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
