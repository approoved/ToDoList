<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @property int id
 * @property string name
 * @property string notes
 * @property int category_id
 * @property Carbon|null created_at
 * @property Carbon|null updated_at
 * @property Category category
 */
class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category_id',
        'notes',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
