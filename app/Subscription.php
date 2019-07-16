<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    //
    protected $table = 'subscriptions';
    // Primary Key
    public $primaryKey = 'subscription_id';
    // Timestamps
    public $timestamps = true;

    public function essays(){
        return $this->hasMany('App\Essay','subscription_id');
        // return $this->belongsToMany('App\Essay', 'book_essay', 'book_id', 'essay_id');

    }
}
