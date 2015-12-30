<?php

namespace App\Http\Controllers;

use Log;
use App\Register;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class SeatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($token)
    {
        Log::debug($token . ' Access Seat Selection');

        if( $token == 'Not Paid') {
            Log::debug('Access seat but not paid');
            abort(403);
        }

        $user = Register::where('token', $token)->first();
        if( $user == null ) {
            Log::debug('Access seat with invalid token: ' . $token);
            abort(404);
        } else if( $user->lock_seat == 1 ) {
            Log::debug('Lock seat forbidden');
            abort(451);
        }

        return view('seat', [
            'token'   => $token,
            'data'    => Register::where('seat', '!=', '-')->get(),
            'current' => Register::where('token', $token)->first()
        ]);
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

    public function select($token, $seat) {

        Log::debug('Select seat: ' . $seat . ' with token: ' . $token);
        $person = Register::where('token', $token)->first();

        if ( $person != null && $person->lock_seat == 0 ) {

            if( Register::where('seat', $seat)->first() == null ) {

                // Not token
                $person->seat = $seat;
                if($person->save()) {
                    Log::debug('Got seat: ' . $seat);
                    return $this->jsAlert('您已成功選到座位：' . $seat, $token);
                }
                else {
                    Log::error('Error set seat: ' . $seat);
                    return $this->jsAlert('座位選擇失敗，請重試', $token);
                }

            } else {

                // Seat taken
                Log::debug('Seat occupied: ' . $seat);
                return $this->jsAlert('座位 ' . $seat . ' 已經被選走了', $token);
            }

        }
        else if( $person->lock_seat == 1 ) {
            Log::debug('Lock seat forbidden');
            abort(451);
        }
        else {
            Log::debug('Token error');
            abort(403);
        }

    }

    private function jsAlert($str, $token) {
        return '<script>alert("'.$str.'");location.href="/seat/'.$token.'";</script>';
    }
}
