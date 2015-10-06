<?php

namespace App\Http\Controllers;

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
        if( $token == 'Not Paid')
            abort(403);
        if( Register::where('token', $token)->first() == null )
            abort(404);

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

        $person = Register::where('token', $token)->first();

        if ( $person != null ) {

            if( Register::where('seat', $seat)->first() == null ) {

                // Not token
                $person->seat = $seat;
                if($person->save())
                    return $this->jsAlert('您已成功選到座位：' . $seat, $token);
                else {
                    return $this->jsAlert('座位選擇失敗，請重試', $token);
                }

            } else {

                // Seat taken
                return $this->jsAlert('座位 ' . $seat . ' 已經被選走了', $token);
            }

        } else {
            abort(403);
        }

    }

    private function jsAlert($str, $token) {
        return '<script>alert("'.$str.'");location.href="/seat/'.$token.'";</script>';
    }
}
