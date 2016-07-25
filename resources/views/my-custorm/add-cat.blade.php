@extends('layouts.master')
@section('title')
Add new cat
@stop
@section('content')
<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-9">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Add cat</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                {!! Form::open(['url' => URL::to('/add-cat'), 'method' => 'post', 'role' => 'form','files' => true]) !!}
                <div class="box-body">
                    <div class="form-group">
                        <label for="exampleInputName">Name</label>
                        {!! Form::text('name', null,
                        array('required', 
                        'class'=>'form-control', 
                        'placeholder'=>'Name')) !!}
                    </div>
                    <div class="form-group">
                        <label for="exampleInputFile">Image</label>
                        {!! Form::file('image', array('class' => 'form-control','id'=>'exampleInputFile','required'=>'required')) !!}
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