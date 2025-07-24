<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Accounts extends Model
{

    protected $table = 'accountss';

    protected $fillable = [
        'business_id','name','number','type','currency_id','accounts_id','description','account_status'
    ];

    public function scopeActive($query)
    {
        return $query->where('accountss.account_status', 'active');
    }

    public function business()
    {
        return $this->belongsTo(\App\Business::class);
    }

    public function currency()
    {
        return $this->belongsTo(\App\Currency::class);
    }

}
