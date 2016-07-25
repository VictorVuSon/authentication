@extends('layouts.master')
@section('title')
Add new page
@stop
@section('content')
<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-9">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Add page</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                {!! Form::open(['url' => URL::to('add-page'), 'method' => 'post', 'role' => 'form']) !!}
                <div class="box-body">
                    <div class="form-group">
                        <label for="exampleInputName">Name</label>
                        {!! Form::text('name', null,
                        array('required', 
                        'class'=>'form-control', 
                        'placeholder'=>'Name')) !!}
                    </div>
                    <div class="form-group">
                        <label for="exampleInputFile">Content</label>
                        {!! Form::textarea('content', null,
                            array('required', 
                        'class'=>'form-control ckeditor', 
                        'placeholder'=>'Content')) !!}
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