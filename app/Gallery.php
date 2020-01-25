<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    //assign the table that the model should connect to
     public $table = "gallery";
     
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'image_filepath', 'title', 'sort_order'
    ];
    
    public function user()
    {  
        return $this->belongsTo('App\User');
    }
}
