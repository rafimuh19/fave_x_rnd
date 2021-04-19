<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Order;
use Auth;

class OrderController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index(Request $request) {
        $user = $request->user();
        return view('checkorder', compact('user'));
    }

    public function store(Request $request) {
        $request->validate([
            'from' => 'required',
            'to' => 'required',
            'adult' => 'required',
            'child' => 'required',
            'departure' => 'required',
            'seatclass' => 'required',
        ]);
        Order::create([
            'user_id' => \Auth::user()->id,
            'from' => $request->from,
            'to' => $request->to,
            'adult' => $request->adult,
            'child' =>$request->child,
            'departure' => $request->departure,
            'seatclass' =>$request->seatclass,
        ]);
        return redirect('/user/checkorder');
    }
}
