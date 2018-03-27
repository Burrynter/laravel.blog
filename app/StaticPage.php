<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StaticPage extends Model
{
    // Table name
    protected $table = 'static';
    // Primary key
    public $primaryKey = 'id';
    // Timestamps
    public $timestamps = true;
}
