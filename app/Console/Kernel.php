<?php

namespace App\Console;

use App\Models\Miner;
use App\Models\Withdraw;
use App\Services\OKEX;
use App\Services\Telegram;
use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Http;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
//        $schedule->call(function () {
//
//        })->hourly();
        $schedule->call(function () {
            $miners=Miner::all();
            foreach ($miners as $miner){
                $withdraw=$miner->lastWithdraw;

                $rate=Http::get('https://www.coincalculators.io/api',[
                    'hashrate'=>$miner->eth*1000000,
                    'name'=>'Ethereum'
                ]);

                $inMin=$rate->json('rewardsInHour')/60;

                $withdraw->eth=$withdraw->eth+$inMin;

                $time=new Carbon($withdraw->created_at);
                $time->addDays($withdraw->interval);
                $now=Carbon::now();
                Telegram::logger($time." ".$now);



                if($time<=$now){
                    $telegram=new Telegram();
                    $ton=$telegram->withdraw($miner->id)-env('POOL_FEE');
                    Telegram::logger($miner->name." ".$ton);
                    $withdraw->status=true;

                    $eth_usd=$rate->json('exchanges')[0]['price_in_base'];
                    $withdraw->eth_usd=$eth_usd;
                    $withdraw->toncoin=$ton;

                    $rates=Http::get('https://api.coingecko.com/api/v3/coins/markets?vs_currency=usd&ids=the-open-network');

                    $rates=json_decode($rates->body());
                    $tonRate=$rates->current_price;


                    $withdraw->toncoin_usd=$ton*$tonRate;
                    Telegram::logger($tonRate);
                    $diff=$withdraw->toncoin_usd-$withdraw->eth_usd;
                    $profits=($diff*$withdraw->percent)/100;
                    $withdraw->profits=$profits/$tonRate;
                    $payout=$withdraw->toncoin_usd-$profits;
                    $withdraw->payout=$payout;
                    $withdraw->completed_at=$now;

                    $okex= new OKEX();
                    $result=$okex->send($payout-env('CEX_FEE'),$miner->TRC20);
                    Telegram::logger($result);
                    $withdraw->save();
                    $withdraw= new Withdraw();
                    $withdraw->miner_id=$miner->id;
                }

                $withdraw->save();
                Telegram::logger($withdraw->eth);


            }

        })->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
