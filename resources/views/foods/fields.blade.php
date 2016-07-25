<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', isset($pass['food']) ? $pass['food']->name:null, ['class' => 'form-control']) !!}
</div>
<div class = "clearfix"></div>
<!-- Image Field -->
<div class="form-group col-sm-6">
    {!! Form::label('image', 'Image:') !!}
    
    {!! Form::file('image') !!}
    <?php
    if (isset($pass['food'])) {
        ?>
        <img src ="{{url('/uploads/'.$pass['food']->image)}}" id ="" class ="img-large" />
    <?php } ?>
</div>
<div class="clearfix"></div>

<!-- Category Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('category_id', 'Category:') !!}
    {!! Form::select('category_id',$pass['categories'],isset($pass['food']) ? $pass['food']->category_id:null   , ['class' => 'form-control']) !!}
</div>

<!-- Content Field -->

<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('content', 'Content:') !!}
    {!! Form::textarea('content', isset($pass['food']) ? $pass['food']->content:null, ['class' => 'form-control ckeditor']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('foods.index') !!}" class="btn btn-default">Cancel</a>
</div>
