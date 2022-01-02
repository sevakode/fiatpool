<?php

namespace App\Http\Controllers;

use App\Models\Miner;
use App\Models\Withdraw;
use App\Services\Telegram;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MinerController extends Controller
{
    public function store(Request $request)
    {
        $messages = [
            'regex' => 'Введите актуальный TRC20 адрес',
        ];
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:miners|max:255',
            'address' => 'required|unique:miners|min:34|max:34|regex:/^T/',
            'percent' => 'required',
            'ethash' => 'required',
            'interval' => 'required',

        ], $messages);

        $miner = new Miner();
        $miner->address=$request->get('address');
        $miner->name=$request->get('name');
        $miner->percent=$request->get('percent');
        $miner->ethash=$request->get('ethash');
        $miner->time=Carbon::now();
        $miner->interval=$request->get('interval');
        $miner->save();
        $withdraw= new Withdraw();
        $withdraw->miner_id=$miner->id;
        $withdraw->save();
        return redirect()->route('bot',['id'=>$miner->id,'token'=>env('TOKEN')]);
    }
    public function update($id,Request $request)
    {
        $miner = Miner::find($id);
        if ($request->get('address'))
            $miner->address=$request->get('address');
        if ($request->get('percent'))
            $miner->percent=$request->get('percent');
        if ($request->get('interval'))
            $miner->address=$request->get('interval');
        $miner->save();
    }
    public function index()
    {
//        $miners=Miner::all();
        $miners=null;

        return view('miners.index',['miners'=>$miners]);
    }
    public function show($id)
    {
        $miner=Miner::find($id);
        $withdraws=$miner->withdraws;
        return view('withdraws.index',['withdraws'=>$withdraws]);
    }

}
