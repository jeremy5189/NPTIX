<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Register extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'register';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'cell', 'unit', 'title', 'meal'];

}
