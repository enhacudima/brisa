<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produtos extends Model
{
    protected $table = 'produtos';
    protected $guarded =array();
        protected $hidden = [
        'remember_token',
    ];

    public $primaryKey = 'id';

    public $timestamps=true;
}
