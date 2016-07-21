<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $connection = 'mysql';
    protected $primaryKey = 'id';
    protected $table = 'dept';
    protected $fillable = array(
        'dname'
    );
    public $timestamps = false;
}