<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $table = 'clients';
	public $primaryKey = 'id';
	public $timestamps = true;
    public $incrementing = true;
}
