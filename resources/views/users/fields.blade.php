<!-- Email Field -->
<div class="form-group col-sm-12">
    {!! Form::label('email', 'Email:') !!}
    <?php
    if (isset($user)) {
        ?>
        <h4>{{$user->email}}</h4>
    <?php } else { ?>
        {!! Form::text('email', null, ['class' => 'form-control']) !!}
    <?php } ?>
</div>

<!-- Password Field -->
<div class="form-group col-sm-12">
    {!! Form::label('password', 'Password:') !!}
    {!! Form::password('password', ['class' => 'form-control']) !!}
</div>
<!-- Password Field -->
<div class="form-group col-sm-12">
    {!! Form::label('password_confirmation', 'Password_confirmation:') !!}
    {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
</div>

<!-- Name Field -->
<div class="form-group col-sm-12">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Avatar Field -->
<div class="form-group col-sm-12">
    {!! Form::label('avatar', 'Avatar:') !!}

    <?php if (isset($user)) {
        if($user->avatar == null){
        ?>
        <img src ="{{url('/uploads/no-image.png')}}"  class ="img-large" />
    <?php
        }else{
        ?>
        <img src ="{{url('/uploads/'.$user->avatar)}}"  class ="img-large" />
        <?php
    }}
    ?>
    {!! Form::file('avatar') !!}
</div>
<div class="clearfix"></div>

<!-- Is Admin Field -->
<div class="form-group col-sm-12">
    {!! Form::label('is_admin', 'Is Admin:') !!}
    {!! Form::select('is_admin', array('0' => 'User', '1' => 'Admin'),isset($user)?$user->is_admin:null) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('users.index') !!}" class="btn btn-default">Cancel</a>
</div>
