@extends('layouts.master')
@section('title')
Edit food
@stop
@section('content')
<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-9">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Edit user</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                {!! Form::open(['url' => URL::route('edit-user',$user->id), 'method' => 'post', 'role' => 'form','files' => true]) !!}
                <div class="box-body">
                    <div class="form-group">
                        <label for="exampleInputPassword">Role</label>
                        {!! Form::select('role', ['0'=>'User','1'=>'Admin'], $user->is_admin, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        {!! Form::text('email', $user->email,
                        array('required', 
                        'class'=>'form-control','disabled'=>'disabled', 
                        'placeholder'=>'Email')) !!}
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Full Name</label>
                        {!! Form::text('fullname',$user->name, array('class' => 'form-control','required'=>'required','placeholder'=>'Full name')) !!}
                    </div>

                    <div class="form-group">
                        <label for="exampleInputPassword1">Old password</label>
                        {!! Form::password('old_password', array('class' => 'form-control','required'=>'required','placeholder'=>'Password')) !!}
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">New password</label>
                        {!! Form::password('password', array('class' => 'form-control','required'=>'required','placeholder'=>'Re - Password')) !!}
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Re New password</label>
                        {!! Form::password('password_confirmation', array('class' => 'form-control','required'=>'required','placeholder'=>'Re - Password')) !!}
                    </div>
                    <div class="form-group">
                        <label for="exampleInputFile">Avatar</label><br>
                        <img style="width:400px;border-radius: 50%" src="{{URL::to('/uploads/'.$user->avatar)}}" class="user-image" alt="User Image">
                        {!! Form::file('avatar', array('class' => 'form-control','id'=>'exampleInputFile')) !!}
                    </div>
                </div>
                <!-- /.box-body -->
                <div class ='clearfix'></div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Edit</button>
                </div>
                </form>
            </div>
            <!-- /.box -->
        </div>
    </div>
</section>
@stop