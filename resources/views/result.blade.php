@extends('layouts.app')

@section('content')

<div class="container text-center">





  <h2>Url-short</h2>
  <div class="card">
    <div class="card-body">
    	<a href="{{config('app/url') }} {{$short}}">
	{{config('app/url') }} {{$short}}


</a>


    </div>
  </div>
</div>

@stop