@extends('layouts.master')
@section('title')
Add new food
@stop
@section('content')
<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-9">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Add user</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                {!! Form::open(['url' => URL::to('/add-user'), 'method' => 'post', 'role' => 'form','files' => true]) !!}
                <div class="box-body">
                    <div class="form-group">
                        <label for="exampleInputPassword">Role</label>
                        {!! Form::select('role', ['0'=>'User','1'=>'Admin'], null, array('class' => 'form-control')) !!}
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        {!! Form::text('email', null,
                        array('required', 
                        'class'=>'form-control', 
                        'placeholder'=>'Email')) !!}
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Full Name</label>
                        {!! Form::text('fullname',null, array('class' => 'form-control','required'=>'required','placeholder'=>'Full name')) !!}
                    </div>

                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        {!! Form::password('password', array('class' => 'form-control','required'=>'required','placeholder'=>'Password')) !!}
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Re - Password</label>
                        {!! Form::password('password_confirmation', array('class' => 'form-control','required'=>'required','placeholder'=>'Password')) !!}
                    </div>
                    <div class="form-group">
                        <label for="exampleInputFile">Avatar</label>
                        {!! Form::file('avatar', array('class' => 'form-control','id'=>'exampleInputFile','required'=>'required','placeholder'=>'Re - Password')) !!}
                    </div>
                </div>
                <!-- /.box-body -->
                <div class ="clearfix"></div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
                </form>
            </div>
            <!-- /.box -->
        </div>
    </div>
</section>
@stop