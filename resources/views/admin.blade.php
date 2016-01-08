@extends('master')

@section('header')
<link rel="stylesheet" href="/css/datatables.min.css">
<link rel="stylesheet" href="/css/dataTables.tableTools.css">
<script src="/js/datatables.min.js"></script>
<script src="/js/dataTables.tableTools.js"></script>
<style media="screen">
    .btn {
        margin-top: 2.5px;
        margin-bottom: 2.5px;
    }
    .contr {
        margin-top: 25px;
    }
    #table_wrapper {
        margin-bottom: 100px;
    }
</style>
@endsection

@section('content')
<div class="page-header">
  <p class="pull-right contr" >
      <a href="/admin/lock" class="btn btn-danger btn-xs" title="禁止所有參加者選位">鎖定選位系統</a>
      <a href="/admin/unlock" class="btn btn-primary btn-xs" title="允許所有參加者自由選位">允許自由選位</a>
      <a href="/admin/seats" class="btn btn-default btn-xs" title="">顯示姓名座位表</a>
  </p>
  <h1>管理參加者</h1>
</div>
<table class="table table-striped table-hover" id="table">
    <thead>
        <tr>
            <th>#</th>

            <th>姓名</th>
            <th>信箱</th>
            <th>手機</th>
            <th>單位</th>
            <th>職稱</th>
            <th>會員</th>
            <th>葷素</th>
            <th>座位</th>

            <th>鎖定</th>
            <th>註冊時間</th>
            <th>
                抬頭統編
            </th>
            <th>操作</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $row )
        <tr>
            <td>{{ $row->id }}</td>
            <td>{{ $row->name }}</td>
            <td>{{ $row->email }}</td>
            <td>{{ $row->cell }}</td>
            <td>{{ $row->unit }}</td>
            <td>{{ $row->title }}</td>
            <td>
                {{ $row->is_member }}
            </td>
            <td>{{ $row->meal }}</td>
            <td>{{ $row->seat }}</td>

            <td>
                @if($row->lock_seat == 1)
                    鎖定
                @else
                    允許
                @endif
            </td>
            <td>{{ $row->created_at }}</td>
            <td>
                <!-- 收據 -->
                <?php
                $obj = json_decode($row->receipt);
                if( $obj->receipt_head != '' ) {
                    echo $obj->receipt_head . '<br/>' .
                         $obj->receipt_serial;
                } else {
                    echo '-';
                }
                ?>
            </td>
            <td>
                <a href="javascript:void(0);" data-name="{{ $row->name }}" data-note="{{ $row->note }}" data-id="{{ $row->id }}" data-json="{{ $row->receipt }}" class="btn btn-xs btn-<?php if( $row->note != '""' ){ echo 'danger'; }else{ echo 'default'; } ?> display-receipt">收據備註</a>
                @if ( $row->token != 'Not Paid' )
                    <a href="/admin/cancel/{{ $row->id }}" class="btn btn-xs btn-warning">取消付款</a>
                @else
                    <a href="javascript:void(0);" data-href="/admin/confirm/{{ $row->id }}" class="btn btn-xs btn-success confirm">確認付款</a>
                @endif
                <br>
                <a href="/seat/{{ $row->token }}" class="btn btn-xs btn-info">變更座位</a>
                <a href="javascript:void(0);" data-href="/admin/destroy/{{ $row->id }}" class="btn btn-xs btn-danger delete">刪除紀錄</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<script type="text/javascript">
$(function(){
    $('#table').dataTable({

        "tableTools": {
            "sSwfPath": "/swf/copy_csv_xls_pdf.swf",
            "aButtons": [ "copy", "print" ]
        },
        bFilter: false,
        paging: false,
        "dom": 'RT<"clear">lfrtip',
        "oTableTools": {
          "aButtons": [
            {'sExtends':'copy',
              "oSelectorOpts": { filter: 'applied', order: 'current' },
            },
            {'sExtends':'print',
              "oSelectorOpts": { filter: 'applied', order: 'current' },
            }
          ]
        },
    });
    $('.delete').click(function(){
        var dest = $(this).data('href');
        if( confirm('確定要刪除此紀錄？') ) {
            location.href = dest;
        }
    });
    $('.confirm').click(function(){
        var dest = $(this).data('href');
        if( confirm('系統即將寄送確認信給該參加者，請確認') ) {
            location.href = dest;
        }
    });
    $('.display-receipt').click(function() {

        var obj = $(this).data('json'),
            map = {
                'receipt_head'    : '收據抬頭',
                'receipt_serial'  : '統一編號',
                'receipt_contact' : '聯絡人',
                'receipt_phone'   : '電話',
                'receipt_fax'     : '傳真',
            },
            str = '#' + $(this).data('id')   + ' ' +
                        $(this).data('name') + ' 收據資料：\n\n';

        console.log(obj);

        for( var index in obj ) {
            str += map[index] + ': ' + obj[index] + "\n";
        }

        str += "\n備註：" + unescape(JSON.parse($(this).data('note')));

        alert(str);
    });
});
</script>
@endsection
