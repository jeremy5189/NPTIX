<?php

namespace App\Http\Controllers;

use Log;
use Mail;
use Validator;
use App\Register;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('register', [
            'count' => Register::count()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Log::debug('User attempt to register');
        Log::debug($request->all());

        if( Register::count() >= 194 ) {
            // Full
            Log::info('FULL: ' .  Register::count());
            return redirect()->back()
                             ->withErrors(['full': 'The registration is closed.']);
        }

        $validator = Validator::make($request->all(), [
            'name'  => 'required',
            'email' => 'required|unique:register|confirmed',
            'cell'  => 'required|numeric',
            'meal'  => 'required'
        ]);

        if ($validator->fails()) {
            Log::debug($validator->errors());
            return redirect()->back()
                             ->withErrors($validator->errors());
        }

        // Mass assign defined in Model
        $reg = Register::create($request->all());

        $reg->token = 'Not Paid';
        $reg->seat = '-';

        $receipt = [
            'receipt_head'    => $request->input('receipt_head'),
            'receipt_serial'  => $request->input('receipt_serial'),
            'receipt_contact' => $request->input('receipt_contact'),
            'receipt_phone'   => $request->input('receipt_phone'),
            'receipt_fax'     => $request->input('receipt_fax')
        ];

        $reg->receipt   = json_encode($receipt);
        $reg->note      = json_encode($request->input('note'));
        $reg->is_member = $request->input('is_member');
        $reg->lock_seat = 0;

        $msg = trans('ui.fail');

        if($reg->save()) {

            Log::debug('Prepare to send email');
            $msg = trans('ui.created');

            // Send confirm mail
            Mail::send('emails.confirm', ['user' => $reg, 'receipt' => $receipt ], function ($m) use ($reg) {
                $m->to($reg->email, $reg->name)->subject(trans('ui.title') . ' 確認信');
            });
        }

        return redirect()->back()->withErrors([
            'register' => $msg
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
