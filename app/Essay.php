<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Essay extends Model
{
    //
    protected $table = 'essays';
    // Primary Key
    public $primaryKey = 'essay_id';
    // Timestamps
    public $timestamps = true;

    protected $fillable = ['essay_id'];

    // protected $dates = ['essay_date'];
    public function user(){
        return $this->belongsTo('App\User');
    }
    public function subscription(){
        return $this->belongsTo('App\Subscription','subscription_id');
    }
    public function books(){
        // return $this->belongsToMany('App\Book');
        return $this->belongsToMany('App\Book', 'book_essay', 'essay_id', 'book_id');

    }
    public function hasBook($book)
    {
        return $this->books()->get()->contains($book); 
    }
}
