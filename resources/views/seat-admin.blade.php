@extends('master')

@section('content')
<style media="screen">
#note {
    margin-bottom: 50px;
}
</style>

<div class="page-header">

    <p class="pull-right" style="margin-top: 30px;">
        <a href="http://www.general.ntust.edu.tw/ezfiles/12/1012/img/426/01-1_floor_plan3.pdf" target="_blank">國際大樓一樓平面圖</a>
        <a href="http://www.general.ntust.edu.tw/ezfiles/12/1012/img/426/IB101_plan_10312.pdf" target="_blank">會議室平面圖</a>
    </p>
    <h1>座位狀況</h1>
</div>
<?php
// 5 / 1 / 7 / 1 / 5 * 14
$row_map = [5, 1, 7, 1, 5];
$row_total = 14;
$row_class = ['available', 'danger', 'available', 'danger', 'available'];
?>
<table class="table table-bordered seat-table">

    <tr>
        <td colspan="2">
            <i class="glyphicon glyphicon-log-out"></i> 前門
        </td>
        <td colspan="5">

        </td>
        <td colspan="7">
            講台
        </td>
        <td colspan="5">

        </td>
        <td colspan="2">
            前門 <i class="glyphicon glyphicon-log-out"></i>
        </td>
    </tr>
    <tr>
        <td colspan="7">

        </td>

        <td class="warning">&nbsp;</td>
        <td class="warning">&nbsp;</td>
        <td class="warning">&nbsp;</td>
        <td class="warning">&nbsp;</td>
        <td class="warning">&nbsp;</td>
        <td class="warning">&nbsp;</td>
        <td class="warning">&nbsp;</td>

        <td colspan="7">

        </td>
    </tr>
    <tr>
        <td colspan="21" id="speaker_deck">
            &nbsp;
        </td>
    </tr>

    @for( $i = 0; $i < $row_total; $i++ )

        <tr class="seat-tr">

            <td class="danger">
            @if($i == 7)
                <i class="glyphicon glyphicon-modal-window" title="講者同步顯示器"></i>
            @endif
            </td>

            <?php $row_serail = 1; ?>
            @foreach( $row_map as $index => $row_len )

                @for( $j = 0; $j < $row_len; $j++ )

                    @if ( $row_class[$index] != 'danger' )
                        <td class="{{ $row_class[$index] }} seat" id="seat-{{ chr($i+65) . $row_serail }}">
                            {{ chr($i+65) . $row_serail }}
                            @foreach ( $data as $item )
                                <?php
                                if( $item->seat == (chr($i+65) . $row_serail) )
                                    echo '<br/>'. $item->name;
                                ?>
                            @endforeach
                        </td>
                        <?php $row_serail++; ?>
                    @else
                        <td class="{{ $row_class[$index] }}">
                            &nbsp;
                        </td>
                    @endif

                @endfor

            @endforeach

        <td class="danger">
            @if($i == 7)
                <i class="glyphicon glyphicon-modal-window" title="講者同步顯示器"></i>
            @endif
        </td>

        </tr>

    @endfor


    <tr>
        <td colspan="21">
            &nbsp;
        </td>
    </tr>

    <tr>
        <td colspan="2">
            <i class="glyphicon glyphicon-log-out"></i> 後門
        </td>
        <td colspan="5">

        </td>
        <td colspan="7">
            控制室
        </td>
        <td colspan="5">

        </td>
        <td colspan="2">
            後門 <i class="glyphicon glyphicon-log-out"></i>
        </td>
    </tr>

</table>
<div id="note" class="pull-right">
    總共：238 位 / 已報名：{{ $count }} 人 / 已選位：<?php count($data); ?> 人
</div>
<script type="text/javascript">
$(function(){

    @if ( $data != null )
        @foreach ( $data as $item )
            $('#seat-{{ $item->seat }}').removeClass('available').addClass('warning');
        @endforeach
    @endif

});
</script>
@endsection
