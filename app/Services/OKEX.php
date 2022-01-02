<?php

namespace App\Services;

use Lin\Okex\OkexAccount;
use Lin\Okex\OkexV5;
use function Amp\Postgres\encode;

class OKEX
{

    function __construct()
    {
        $this->okex = new OkexAccount(env('OKEX_KEY'), env('OKEX_SECRET'), env('OKEX_PASS'));
    }

    public function send($amount,$address)
    {
        $okex = new OkexV5(env('OKEX_KEY'), env('OKEX_SECRET'), env('OKEX_PASS'));
        $okex->setOptions([
            //Set the request timeout to 60 seconds by default
            'timeout' => 10,
        ]);
        $result = $okex->asset()->postWithdrawal([
            'ccy'=>'USDT',
            'chain'=>'USDT-TRC20',
            'dest'=>'4',
            'fee'=>0.8,
            'pwd'=>env('OKEX_PASS'),
            'amt'=>$amount,
            'toAddr'=>$address
        ]);
        return $result;
    }


}
