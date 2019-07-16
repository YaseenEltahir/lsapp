<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    //
    protected $table = 'books';
    // Primary Key
    public $primaryKey = 'book_id';
    // Timestamps
    public $timestamps = true;

    public function essays(){
        return $this->belongsToMany('App\Essay');
        // return $this->belongsToMany('App\Essay', 'book_essay', 'book_id', 'essay_id');

    }
}
