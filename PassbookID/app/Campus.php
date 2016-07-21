<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Campus extends Model
{
    protected $connection = 'mysql';
    protected $primaryKey = 'id';
    protected $table = 'campus';
    protected $fillable = array(
        'cname'
    );
    public $timestamps = false;
}