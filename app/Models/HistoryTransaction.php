<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HistoryTransaction extends Model
{
    protected $fillable = [
        'user_id', 'transid', 'telcode', 'serial', 'code', 'price', 'amount','donate_message','thucnhan','donate_name','status','message','streamer_id'
    ];
//    protected $fillable['user_id','telcode',
//                        'transid','code','serial',
//                        'price','amount','status',
//                        'message','donate_message',
//                        'donate_name','streamer_id'];

    public function streamer()
    {
        return $this->belongsTo('App\Models\StreamerInfo');
    }

}
