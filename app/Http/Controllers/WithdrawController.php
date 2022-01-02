<?php

namespace App\Http\Controllers;

use App\Models\Miner;
use Illuminate\Http\Request;

class WithdrawController extends Controller
{
    public function index($id){
        $miner=Miner::find($id);
        $withdraws=$miner->withdraws;
        return view('withdraws.index',['withdraws'=>$withdraws]);
    }
}
