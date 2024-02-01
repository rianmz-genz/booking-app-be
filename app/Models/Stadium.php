<?php

namespace App\Models;

use App\Models\Base\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stadium extends BaseModel
{
    protected $table = 'stadiums';
    protected $fillable = [
        'name',
        'address',
        'phone',
        'description',
        'images',
        'open_at',
        'closed_at',
        'stadium_category_id',
    ];
    protected $casts = [
        'images' => 'array'
    ];

    public function category()
    {
        return $this->belongsTo(StadiumCategory::class, 'stadium_category_id', 'id');
    }
}
