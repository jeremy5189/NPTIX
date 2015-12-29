<?php

namespace App\Http\Controllers;

use Mail;
use Log;
use DB;
use Session;
use App\Register;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function __construct() {
        $this->middleware('auth', ['except' => ['login_view', 'login', 'logout']]);
    }

    public function lock() {
        // Lock all seat
        $affected = DB::table('register')->update(['lock_seat' => 1]);
        return $this->jsAlert('已鎖定 ' . $affected . ' 位參與者之座位');
    }

    public function unlock() {
        // Release all seat
        $affected = DB::table('register')->update(['lock_seat' => 0]);
        return $this->jsAlert('已允許 ' . $affected . ' 位參與者自由選位');
    }

    private function jsAlert($str) {
        return '<script>alert("'.$str.'");location.href="/admin";</script>';
    }

    public function logout() {

        Log::debug('User logout');

        Session::set('login', 'no');
        return redirect('/admin/login');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Log::debug('Access admin index');

        return view('admin', [
            'data' => Register::all()
        ]);
    }

    public function cancel($id) {

        $person = Register::find($id);

        Log::debug('Cancel payment: ');
        Log::debug($person);

        if( $person != null ) {
            $person->token = 'Not Paid';
            $person->save();
        }

        return redirect()->back();
    }

    public function confirm($id) {

        $person = Register::find($id);

        Log::debug('Confirm payment: ');
        Log::debug($person);

        if( $person != null ) {
            $person->token = sha1(uniqid().time());
            $person->save();

            // Send confirm mail
            Mail::send('emails.select-seat', ['name' => $person->name, 'url' => url() . '/seat/' . $person->token], function ($m) use ($person) {
                $m->to($person->email, $person->name)->subject(trans('ui.title') . ' 選位通知');
            });
        }

        return redirect()->back();
    }

    public function login_view() {

        Log::debug('Access login view');

        if( Session::get('login') == 'yes' )
            return redirect('/admin');

        return view('login');
    }

    public function login(Request $req) {

        Log::debug('Attempt to login');
        Log::debug($req->all());

        Log::debug(env('username'));
        Log::debug(env('password'));

        if( $req->input('username') == env('username') &&
            $req->input('password') == env('password') ) {
            Log::debug('login ok');
            Session::set('login', 'yes');
        } else {
            Log::debug('login fail');
            return redirect()->back()->withError([
                'login' => 'fail'
            ]);
        }

        return redirect('/admin');
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
        Log::debug('Delete record: ' . $id);
        Register::destroy($id);
        return redirect()->back();
    }
}
