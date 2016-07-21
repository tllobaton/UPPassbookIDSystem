<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CampusDepartment extends Model
{
    protected $connection = 'mysql';
    protected $primaryKey = 'id';
    protected $table = 'campus_dept';
    protected $fillable = array(
        'cname',
		'dname'
    );
    public $timestamps = false;
}