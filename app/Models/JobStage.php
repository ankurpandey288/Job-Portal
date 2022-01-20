<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * App\Models\JobStage
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property int $company_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Company $company
 * @method static Builder|JobStage newModelQuery()
 * @method static Builder|JobStage newQuery()
 * @method static Builder|JobStage query()
 * @method static Builder|JobStage whereCompanyId($value)
 * @method static Builder|JobStage whereCreatedAt($value)
 * @method static Builder|JobStage whereDescription($value)
 * @method static Builder|JobStage whereId($value)
 * @method static Builder|JobStage whereName($value)
 * @method static Builder|JobStage whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class JobStage extends Model
{
    use HasFactory;

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required|max:160'
    ];
    
    public $table = 'job_stages';
    
    public $fillable = [
        'name',
        'description',
        'company_id'
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
     * @return BelongsTo
     */
    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }
}
