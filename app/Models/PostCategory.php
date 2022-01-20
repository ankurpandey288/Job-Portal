<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * App\Models\PostCategory
 *
 * @mixin \Eloquen
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostCategory whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostCategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostCategory whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostCategory whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Post[] $postAssignCategories
 * @property-read int|null $post_assign_categories_count
 */
class PostCategory extends Model
{
    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required|max:180|unique:post_categories,name',
    ];
    public $table = 'post_categories';

    /**
     * @var string[]
     */
    public $fillable = [
        'name',
        'description',
    ];
    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'          => 'integer',
        'name'        => 'string',
        'description' => 'string',
    ];

    /**
     * @return BelongsToMany
     */
    public function postAssignCategories(): BelongsToMany
    {
        return $this->belongsToMany(Post::class, 'post_assigned_categories', 'post_categories_id');
    }
}
