<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StadiumCategory extends Model
{
    protected $table = 'stadium_categories';
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    public $timestamps = true;
    public  $incrementing = true;
    protected $fillable = [
        'name',
        'logo',
    ];
}
