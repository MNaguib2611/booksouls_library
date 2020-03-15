@extends('admin.layouts.main')

@section('content')
<div class="container">
    <div class="container justify-content-center">
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
                        
                    <div class="row">
                        <div class='col-lg-8 form-group'>
                            {!! Form::open(['route' => ['admins.update',$admin->id],'method' => "put",'enctype'=>"multipart/form-data" ]) !!}
                            {!! Form::token(); !!}
                            {!! Form::label('name', 'Name'); !!}
                            {!! Form::text('name', $admin->name, array_merge(['class' => 'form-control']))  !!}
                            <br>
                            {!! Form::label('username', 'Username'); !!}
                            {!! Form::text('username', $admin->username, array_merge(['class' => 'form-control'])); !!}
                            <br>
                            {!! Form::label('email', 'Email'); !!}
                            {!! Form::text('email', $admin->email, array_merge(['class' => 'form-control'])); !!}
                            <br>
                            {!! Form::label('phone', 'Phone'); !!}
                            {!! Form::text('phone', $admin->phone, array_merge(['class' => 'form-control'])); !!}
                            <br>
                            {!! Form::label('address', 'Address'); !!}
                            {!! Form::text('address', $admin->address, array_merge(['class' => 'form-control'])); !!}
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
                            <img src="{{$admin->avatar}}" alt="Avatar" width="100%">
                            <div class="col-lg-12 mt-3 text-center">
                                {!! Form::open(['route' => ['admin.downgrade', $admin->id],'method' => "put"]) !!}
                                {!! Form::text('isAdmin', 0, array_merge(['hidden' => 'hidden']))  !!}
                                {!! Form::submit('Downgrade!',['class' => 'btn btn-warning']); !!}
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
