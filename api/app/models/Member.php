<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    //
    protected $table = 'members';
    public $timestamps = true;
    protected $fillable = ['uName','uPassword'];
    protected $hidden = ['uPassword','created_at','updated_at'];

}
