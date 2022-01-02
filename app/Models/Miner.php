<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Miner extends Model
{
    use HasFactory;
    public function withdraws(){
        return $this->hasOne(Withdraw::class);
    }
    public function lastWithdraw(){
        return $this->withdraws()->where('status',false);
    }
}
