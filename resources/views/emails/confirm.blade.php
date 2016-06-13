{{ $user->name }}您好，<br/>
<br/>
您透過 {{ env('SYS_TITLE')}} 之登錄已報名成功，請進行註冊繳費。主辦單位確認您的付款後，將再寄信給您。<br/><br/>
以下是您的報名資訊：<br/>
<br/>
報名系統編號：#{{ $user->id }}<br/>
姓名：{{ $user->name }}<br/>
電話：{{ $user->cell }}<br/>
服務單位：{{ $user->unit }}<br/>
職稱：{{ $user->title }}<br/>
飲食習慣：{{ $user->meal }}<br/>
<br/>
收據抬頭：{{ $receipt['receipt_head'] }}<br/>
統一編號：{{ $receipt['receipt_serial'] }}<br/>
聯絡人：{{ $receipt['receipt_contact'] }}<br/>
電話：{{ $receipt['receipt_phone'] }}<br/>
傳真：{{ $receipt['receipt_fax'] }}<br/>
<br/>
備註：{{ json_decode($user->note) }}<br/>
<br/>
是否為會員：{{ $user->is_member }}<br/>
<br/>
<br/>
<br/>
如果您有任何問題，請直接聯繫主辦單位，不要直接回覆本郵件，謝謝<br/>
<br/>
<br/>
{{ env('SYS_TITLE') }}
