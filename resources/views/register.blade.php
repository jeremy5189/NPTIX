@extends('master')

@section('content')
<script type="text/javascript">
$(function(){
    $('#form').submit(function(event) {
        if(!confirm('請再次確認報名資料是否正確？')) {
            return false;
        }
        return true;
    });
});
</script>

<div class="page-header">
  <h1>填寫報名資料</h1>
</div>
<p class="lead">請填寫正確 Email，報名成功後，請檢查您的信箱收件夾或垃圾信件夾確認報名</p>

@if($errors->any())
    <div class="alert alert-warning">
        {{ trans('ui.'.$errors->keys()[0]) }}: {{ $errors->first() }}
    </div>
@endif

@if( ($count >= intval(env('REG_LIMIT', 238)) || env('ALLOW_REG') == 'NO') && Session::get('login') != 'yes' )
    <div class="alert alert-danger">
        報名已經額滿，請洽主辦單位，謝謝
    </div>
@else

    @if( Session::get('login') == 'yes' )
        <div class="alert alert-warning">
            以管理員身份登入，允許 Bypass 報名限制
        </div>
    @endif

<form method="post" action="/register" id="form">

  <div class="form-group">
    <label for="name">姓名＊</label>
    <input type="text" class="form-control" name="name" id="name" placeholder="姓名" required="">
  </div>

  <div class="form-group">
    <label for="email">Email＊</label>
    <input type="email" class="form-control" name="email" id="email" placeholder="Email" required="">
  </div>

  <div class="form-group">
    <label for="email_confirmation">Email 確認＊</label>
    <input type="email" class="form-control" name="email_confirmation" id="email_confirmation" placeholder="Email Confirmation" required="">
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

  <div class="form-group">
    <label for="is_member">是否為 APAA 會員*</label>
    <select class="form-control" name="is_member" id="is_member" required="">
        <option value="是">是</option>
        <option value="否">否</option>
    </select>
  </div>

  <hr>

  <div class="form-group">
    <label for="receipt_head">收據抬頭 (此欄位空白將以報名者姓名開立收據)</label>
    <input type="text" class="form-control" name="receipt_head" id="receipt_head" placeholder="收據抬頭">
  </div>

  <div class="form-group">
    <label for="receipt_serial">統一編號 (收據抬頭開立公司行號請填統一編號)</label>
    <input type="text" class="form-control" name="receipt_serial" id="receipt_serial" placeholder="統一編號">
  </div>

  <div class="form-group">
    <label for="receipt_contact">聯絡人</label>
    <input type="text" class="form-control" name="receipt_contact" id="receipt_contact" placeholder="聯絡人">
  </div>

  <div class="form-group">
    <label for="receipt_phone">電話</label>
    <input type="text" class="form-control" name="receipt_phone" id="receipt_phone" placeholder="電話">
  </div>

  <div class="form-group">
    <label for="receipt_fax">傳真</label>
    <input type="text" class="form-control" name="receipt_fax" id="receipt_fax" placeholder="傳真">
  </div>

  <hr>

  <div class="form-group">
    <label for="note">備註</label>
    <textarea class="form-control" name="note" id="note" name="name" placeholder="備註" rows="4" cols="40"></textarea>
  </div>

  <hr>

  <button type="submit" class="btn btn-default submit">確認報名</button>

  {!! csrf_field() !!}

</form>
@endif
@endsection
