@extends('master')

@section('content')
<div class="page-header">
  <h1>填寫報名資料</h1>
</div>
<p class="lead">請填寫正確 Email，報名成功後，請檢查您的信箱收件夾或垃圾信件夾確認報名</p>

@if($errors->any())
    <div class="alert alert-warning">
        {{ trans('ui.'.$errors->keys()[0]) }}: {{ $errors->first() }}
    </div>
@endif

<form method="post" action="/register">

  <div class="form-group">
    <label for="name">姓名＊</label>
    <input type="text" class="form-control" name="name" id="name" placeholder="姓名" required="">
  </div>

  <div class="form-group">
    <label for="email">Email＊</label>
    <input type="email" class="form-control" name="email" id="email" placeholder="Email" required="">
  </div>

  <div class="form-group">
    <label for="email">手機＊</label>
    <input type="text" class="form-control" name="cell" id="cell" placeholder="手機" required="">
  </div>

  <div class="form-group">
    <label for="meal">飲食習慣＊</label>
    <select class="form-control" name="meal" id="meal" required="">
        <option value="葷食">葷食</option>
        <option value="素食">素食</option>
    </select>
  </div>

  <div class="form-group">
    <label for="unit">服務單位</label>
    <input type="text" class="form-control" name="unit" id="unit" placeholder="服務單位">
  </div>

  <div class="form-group">
    <label for="title">職稱</label>
    <input type="text" class="form-control" name="title" id="title" placeholder="職稱">
  </div>

  <button type="submit" class="btn btn-default submit">送出</button>
  {!! csrf_field() !!}
</form>
<p>回到 <a href="＃">活動網站</a> 晚點再報名</p>
@endsection
