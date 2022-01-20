<?php

namespace App;

use App\Models\Candidate;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\ReportedToCandidate
 *
 * @property int $id
 * @property int $user_id
 * @property int $candidate_id
 * @property string $note
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read Candidate $candidate
 * @property-read User $user
 * @method static \Illuminate\Database\Eloquent\Builder|ReportedToCandidate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ReportedToCandidate newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ReportedToCandidate query()
 * @method static \Illuminate\Database\Eloquent\Builder|ReportedToCandidate whereCandidateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReportedToCandidate whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReportedToCandidate whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReportedToCandidate whereNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReportedToCandidate whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReportedToCandidate whereUserId($value)
 * @mixin \Eloquent
 */
class ReportedToCandidate extends Model
{
    public $table = 'reported_to_candidates';
    public $fillable = [
        'user_id',
        'candidate_id',
        'note',
    ];
    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'user_id'      => 'integer',
        'candidate_id' => 'integer',
        'note'         => 'string',
    ];

    /**
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * @return BelongsTo
     */
    public function candidate()
    {
        return $this->belongsTo(Candidate::class, 'candidate_id');
    }
}
