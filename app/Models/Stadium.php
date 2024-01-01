<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stadium extends Model
{
    protected $table = 'stadiums';
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    public $timestamps = true;
    public  $incrementing = true;
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
