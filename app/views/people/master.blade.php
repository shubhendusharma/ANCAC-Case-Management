@extends('layouts.master')

@section('nav')
<li><a href="{{{ URL::to('people') }}}">List People</a></li>
<li><a href="{{{ URL::to('people/create') }}}">Create Person</a></li>
@stop