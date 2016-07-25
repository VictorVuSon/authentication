@extends('layouts.app')
@foreach($searchFoods as $f)
<b>{{$f->name}}</b>
<br>
@endforeach
