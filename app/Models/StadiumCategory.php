<?php

namespace App\Models;

use App\Models\Base\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StadiumCategory extends BaseModel
{
    protected $table = 'stadium_categories';
    protected $fillable = [
        'name',
        'logo',
    ];
}
