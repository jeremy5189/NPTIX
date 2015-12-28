{{ $user->name }}您好，<br/>
<br/>
您透過2016專利研討會報名系統之登錄已報名成功，請進行註冊繳費，APAA會員完成匯款後請逕向APAA祕書處報名 E-mail: apaatw@apaa.org.tw；非APAA會員請以 E-mail 掃瞄檔或照像檔將繳費單據傳至本研討會工作小組 E-mail: patentlaw2016@gmail.com。主辦單位確認您的付款後，將再寄信給您。<br/><br/>
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
是否為 APAA 會員：{{ $user->is_member }}<br/>
<br/>
【註冊繳費】<br/>
1. APAA會員一律以匯款方式繳交：<br/>
戶名：『亞洲專利代理人協會台灣總會』<br/>
帳號：14310128590<br/>
銀行：第一銀行（南京東路分行）<br/>
金額：每位 NT500元整<br/><br/>
2. 非APAA會員註冊費一律以匯款方式繳交：<br/>
戶名：『國立台灣科技大學402專戶』<br/>
帳號：17130050508<br/>
銀行：第一商業銀行（古亭分行）<br/>
金額：每位 NT1,000元整<br/><br/>
3. 研討會收據將於研討會當天領取，恕無法配合預開收據，敬請包涵。<br/>
<br/>
<br/>
如果您有任何問題，請直接聯繫主辦單位（patentlaw2016@gmail.com），不要直接回覆本郵件，謝謝<br/>
<br/>
<br/>
{{ trans('ui.title') }}
