{{ $user->name }}您好，<br/>
<br/>
您透過 {{ trans('ui.title') }} 報名之活動已經報名成功，主辦單位確認您的付款後，將再寄信給您。<br/>
<br/>
以下是您的報名資訊：<br/>
<br/>
報名系統編號：#{{ $user->id }}<br/>
姓名：{{ $user->name }}<br/>
電話：{{ $user->cell }}<br/>
服務單位：{{ $user->unit }}<br/>
職稱：{{ $user->title }}<br/>
飲食習慣：{{ $user->meal }}<br/>
報到序號（手機後三碼）：{{ substr($user->cell, -3) }}<br/>
<br/>
如果您有任何問題，請直接聯繫主辦單位，不要回覆本郵件，謝謝<br/>
<br/>
<br/>
{{ trans('ui.title') }}
