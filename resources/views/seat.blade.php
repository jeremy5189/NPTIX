@extends('master')

@section('content')
<div class="page-header">
  <h1>#{{ $current->id }} {{ $current->name }}您好，請選擇您的座位（目前選擇：{{ $current->seat }}）</h1>
</div>
<table class="table table-bordered">
    <tr>
        <td>
            說明
        </td>
        <td>
            您的位置
        </td>
        <td class="success">

        </td>
        <td>
            可以選擇
        </td>
        <td class="available">

        </td>
        <td>
            不可選擇
        </td>
        <td class="danger">

        </td>
        <td>
            已被選取
        </td>
        <td class="warning">

        </td>
    </tr>
</table>

<div class="page-header">
    <h1>座位平面圖</h1>
</div>
<?php
// 5 / 1 / 7 / 1 / 5 * 14
$row_map = [5, 1, 7, 1, 5];
$row_total = 14;
$row_class = ['available', 'danger', 'available', 'danger', 'available'];
?>
<table class="table table-bordered seat-table">

    <tr>
        <td colspan="19">
            Speaker Deck
        </td>
    </tr>

    @for( $i = 0; $i < $row_total; $i++ )

        <tr class="seat-tr">

            <?php $row_serail = 1; ?>
            @foreach( $row_map as $index => $row_len )

                @for( $j = 0; $j < $row_len; $j++ )

                    @if ( $row_class[$index] != 'danger' )
                        <td class="{{ $row_class[$index] }} seat" id="seat-{{ chr($i+65) . $row_serail }}">
                        {{ chr($i+65) . $row_serail }}
                        </td>
                        <?php $row_serail++; ?>
                    @else
                        <td class="{{ $row_class[$index] }}"></td>
                    @endif

                @endfor

            @endforeach

        </tr>

    @endfor
</table>
<script type="text/javascript">
$(function(){
    $('.seat').click(function(){
        if( !$(this).hasClass('danger') ) {
            var id = $(this).attr('id').replace('seat-', '');
            console.log(id);
            if ( confirm('確定要選擇座位：' + id + ' 嗎？') ) {
                location.href = '/seat/{{ $token }}/' + id;
            }
        }
    });
    @if ( $data != null )
        @foreach ( $data as $item )
            $('#seat-{{ $item->seat }}').removeClass('available').addClass('warning');
        @endforeach
    @endif

    @if ( $current != null )
        $('#seat-{{ $current->seat }}').removeClass('warning').addClass('success');
    @endif
});
</script>
@endsection
