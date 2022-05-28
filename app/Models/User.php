<?php

namespace App\Models;

use App\Models\Tag;
use App\Models\Task;
use App\Models\Category;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Collection;
use phpDocumentor\Reflection\Types\Iterable_;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use \Staudenmeir\EloquentHasManyDeep\HasRelationships;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * @property int id
 * @property string|null token
 * @property string first_name
 * @property string last_name
 * @property string email
 * @property string password
 * @property Carbon|null email_verified_at
 * @property Carbon|null created_at
 * @property Carbon|null updated_at
 * @property string|null remember_token
 * @property Collection&Iterable_<int, tag> tags
 * @property Collection&Iterable_<int, category> categories
 */
class User extends Authenticatable
{
    use HasFactory;
    use Notifiable;
    use HasApiTokens;
    use HasRelationships;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'token',
        'email_verified_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function catergories(): HasMany
    {
        return $this->hasMany(Category::class);
    }

    public function tags(): \Staudenmeir\EloquentHasManyDeep\HasManyDeep
    {
        return $this->hasManyDeep(
            Tag::class,
            [Category::class, Task::class, 'tag_task'],
            [
                'user_id',
                'category_id',
                'task_id',
                'id',
            ],
            [
                'id',
                'id',
                'id',
                'tag_id',
            ],
        );
    }
}
