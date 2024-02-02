<?php

namespace App\Models;

use App\Models\Base\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Field extends BaseModel
{
    use HasFactory;
    protected $table = 'fields';
    protected $fillable = [
        'name',
        'description',
        'price',
        'type_price',
        'images',
        'stadium_id',
    ];
    
    protected $casts = [
        'images' => 'array'
    ];

    public function stadium(): BelongsTo {
        return $this->belongsTo(Stadium::class, 'stadium_id', 'id');
    }
}
