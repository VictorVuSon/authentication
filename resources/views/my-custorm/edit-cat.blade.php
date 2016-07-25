@extends('layouts.master')
@section('title')
Edit cat
@stop
@section('content')
<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-9">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Edit cat</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                {!! Form::open(['url' => URL::route('edit-cat-action',$cat->id), 'method' => 'post', 'role' => 'form','files' => true]) !!}
                <div class="box-body">
                    
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        {!! Form::text('name', $cat->name,
                        array('required', 
                        'class'=>'form-control',
                        'placeholder'=>'Name')) !!}
                    </div>
                    <div class="form-group">
                        <label for="exampleInputFile">Image</label><br>
                        <img style="width:400px;border-radius: 50%" src="{{URL::to('/uploads/'.$cat->image)}}" class="user-image" alt="Cat Image">
                        {!! Form::file('image', array('class' => 'form-control','id'=>'exampleInputFile')) !!}
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