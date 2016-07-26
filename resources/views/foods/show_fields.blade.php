<!-- Id Field 
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $food->id !!}</p>
</div>-->

<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', 'Name:') !!}
    <p>{!! $food->name !!}</p>
</div>
<!-- Name Field -->
<div class="form-group">
    {!! Form::label('creator', 'Creator:') !!}
    <p>{!! $food->user->name !!}</p>
</div>

<!-- Image Field -->
<div class="form-group">
    {!! Form::label('image', 'Image:') !!}
    <p><img src ="{{url('/uploads/'.$food->image)}}" id ="" class ="img-large" /></p>
</div>
<!--
 Category Id Field 
<div class="form-group">
    {!! Form::label('category_id', 'Category Id:') !!}
    <p>{!! $food->category_id !!}</p>
</div>

 Content Field 
<div class="form-group">
    {!! Form::label('content', 'Content:') !!}
    <p>{!! $food->content !!}</p>
</div>

 Created At Field 
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $food->created_at !!}</p>
</div>

 Updated At Field 
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $food->updated_at !!}</p>
</div>-->

