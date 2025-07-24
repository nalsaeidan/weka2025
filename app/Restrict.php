<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Restrict extends Model
{
    protected $table = 'restricts';

    protected $fillable = [
        'business_id','reference_number','notes','date','currency_id',
        'account_number1','description1','debit1','credit1' ,
        'account_number2','description2','debit2','credit2',
        'account_number3','description3','debit3','credit3',
        'account_number4','description4','debit4','credit4',
        'account_number5','description5','debit5','credit5',
        'file','status','user_id',
    ];


    public function user()
    {
        return $this->hasOne(\App\User::class, 'id', 'user_id');
    }

    

    public function business()
    {
        return $this->belongsTo(\App\Business::class);
    }

    // public function currency()
    // {
    //     return $this->belongsTo(\App\Currency::class);
    // }
}
