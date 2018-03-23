@extends('layouts.app')

@section('content')
<div class="container">





<form action="/" method="post">
{{ csrf_field() }}
    <div class="form-group">
      <label for="email">Url-Short</label>
      <input type="text" class="form-control" id="text" placeholder="Enter your Url" name="url" value="{{old('url')}}">
      {!! $errors->first('urlVerif','<p>:message</p>') !!}
    </div>
    
   
    <button type="submit" class="btn btn-default">Submit</button>
  </form>

</div>
@stop