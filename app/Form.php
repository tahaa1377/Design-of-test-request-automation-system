<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    protected $table='forms';
    protected $primaryKey='form_id';


    protected $fillable = [
        'user_id','type', 'place', 'description', 'total_price'
    ];

    public $timestamps=false;
}
