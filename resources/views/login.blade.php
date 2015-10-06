@extends('master')

@section('content')
<div class="page-header">
  <h1>Login</h1>
</div>
@if($errors->any())
    <div class="alert alert-danger">
        {{ trans('ui.'.$errors->keys()[0]) }}: {{ $errors->first() }}
    </div>
@endif
<form method="post" action="/admin/login">

  <div class="form-group">
    <label for="username">Username</label>
    <input type="text" class="form-control" name="username" id="username" placeholder="Username" required="">
  </div>

  <div class="form-group">
    <label for="password">Password</label>
    <input type="password" class="form-control" name="password" id="password" placeholder="Password" required="">
  </div>

  <button type="submit" class="btn btn-default submit">送出</button>
  {!! csrf_field() !!}
</form>
@endsection
