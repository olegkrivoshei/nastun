<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    //
    protected $table = 'comments';

    public $primaryKey = 'id';
    //Timestamps
    public $timestamps = true;

}
