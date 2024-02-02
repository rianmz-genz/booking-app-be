<?php

namespace App\Models;

use App\Models\Base\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    public function category(): BelongsTo
    {
        return $this->belongsTo(StadiumCategory::class, 'stadium_category_id', 'id');
    }

    public function fields(): HasMany 
    {
        return $this->hasMany(Field::class, 'stadium_id', 'id');
    }
}
