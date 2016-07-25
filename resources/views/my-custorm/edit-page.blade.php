@extends('layouts.master')
@section('title')
Edit page
@stop
@section('content')
<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-9">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Edit page</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                {!! Form::open(['url' => URL::route('edit-page-action',$page->id), 'method' => 'post', 'role' => 'form','files' => true]) !!}
                <div class="box-body">
                    
                    <div class="form-group">
                        <label for="exampleInputEmail1">Name</label>
                        {!! Form::text('name', $page->name,
                        array('required', 
                        'class'=>'form-control',
                        'placeholder'=>'Name')) !!}
                    </div>
                    <div class="form-group">
                        <label for="exampleInputFile">Content</label><br>
                        {!! Form::textarea('content', $page->content,
                        array('required', 
                        'class'=>'form-control ckeditor',
                        'placeholder'=>'Content')) !!}
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