@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                        
                    {!! Form::open(['route' => 'admins.store']) !!}
                    {!! Form::token(); !!}
                    {!! Form::label('name', 'Name'); !!}
                    {!! Form::text('name'); !!}
                    <br>
                    {!! Form::label('username', 'username'); !!}
                    {!! Form::text('username'); !!}
                    <br>
                    {!! Form::label('email', 'email'); !!}
                    {!! Form::text('email'); !!}
                    <br>
                    {!! Form::label('phone', 'phone'); !!}
                    {!! Form::text('phone'); !!}
                    <br>
                     {!! Form::label('address', 'address'); !!}
                    {!! Form::text('address'); !!}
                    <br>
                     {!! Form::label('avatar', 'avatar'); !!}
                    {!! Form::file('avatar'); !!}
                    <br>
                     {!! Form::label('password', 'password'); !!}
                    {!! Form::text('password'); !!}
                    <br>
                     {!! Form::label('password_confirmation', 'password_confirmation'); !!}
                    {!! Form::text('password_confirmation'); !!}


                    {!! Form::submit('Add',['class' => 'btn btn-success']); !!}
                    {!! Form::close() !!} 
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
