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
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class='col-lg-10 form-group m-auto'>
                        {!! Form::open(['route' => 'admins.store' ,'enctype'=>"multipart/form-data"]) !!}
                        {!! Form::token(); !!}
                        {!! Form::label('name', 'Name'); !!}
                        {!! Form::text('name', '', array_merge(['class' => 'form-control']))  !!}
                        <br>
                        {!! Form::label('username', 'Username'); !!}
                        {!! Form::text('username', '', array_merge(['class' => 'form-control'])); !!}
                        <br>
                        {!! Form::label('email', 'email'); !!}
                        {!! Form::text('email', '', array_merge(['class' => 'form-control'])); !!}
                        <br>
                        {!! Form::label('phone', 'phone'); !!}
                        {!! Form::text('phone', '', array_merge(['class' => 'form-control'])); !!}
                        <br>
                        {!! Form::label('address', 'address'); !!}
                        {!! Form::text('address', '', array_merge(['class' => 'form-control'])); !!}
                        <br>
                        {!! Form::label('avatar', 'avatar'); !!}
                        {!! Form::file('avatar',['class' => 'form-control']); !!}
                        <br>
                        {!! Form::label('password', 'password'); !!}
                        {!! Form::text('password', '', array_merge(['class' => 'form-control'])); !!}
                        <br>
                        {!! Form::label('password_confirmation', 'password_confirmation'); !!}
                        {!! Form::text('password_confirmation', '', array_merge(['class' => 'form-control'])); !!}
                        
                        
                        {!! Form::submit('Add',['class' => 'btn btn-success btn-lg m-3 float-right']); !!}
                        {!! Form::close() !!} 
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
