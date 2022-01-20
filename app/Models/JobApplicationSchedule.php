<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * App\Models\JobApplicationSchedule
 *
 * @property int $id
 * @property int $job_application_id
 * @property string $time
 * @property string $date
 * @property string|null $notes
 * @property int|null $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection|JobApplication[] $jobApplication
 * @property-read int|null $job_application_count
 * @method static Builder|JobApplicationSchedule newModelQuery()
 * @method static Builder|JobApplicationSchedule newQuery()
 * @method static Builder|JobApplicationSchedule query()
 * @method static Builder|JobApplicationSchedule whereCreatedAt($value)
 * @method static Builder|JobApplicationSchedule whereDate($value)
 * @method static Builder|JobApplicationSchedule whereId($value)
 * @method static Builder|JobApplicationSchedule whereJobApplicationId($value)
 * @method static Builder|JobApplicationSchedule whereNotes($value)
 * @method static Builder|JobApplicationSchedule whereStatus($value)
 * @method static Builder|JobApplicationSchedule whereTime($value)
 * @method static Builder|JobApplicationSchedule whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property int|null $batch
 * @property string|null $rejected_slot_notes
 * @property string|null $employer_cancel_slot_notes
 * @method static Builder|JobApplicationSchedule whereBatch($value)
 * @method static Builder|JobApplicationSchedule whereEmployerCancelSlotNotes($value)
 * @method static Builder|JobApplicationSchedule whereRejectedSlotNotes($value)
 */
class JobApplicationSchedule extends Model
{
    use HasFactory;

    public $table = 'job_application_schedules';

    const STATUS_SEND = 1;
    const STATUS_SELECTED = 2;
    const STATUS_REJECTED = 3;
    const STATUS_NOT_SEND = 4;

    const STATUS = [
        1 => 'Send',
        2 => 'Selected',
        3 => 'Rejected',
        4 => 'Not Send',
    ];
    
    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'time' => 'required',
        'date' => 'required',
        'notes' => 'required',
    ];
    
    public $fillable = [
        'job_application_id',
        'time',
        'date',
        'notes',
        'status',
        'batch',
        'rejected_slot_notes',
        'employer_cancel_slot_notes',
        'stage_id',
    ];

    /**
     * @return BelongsTo
     */
    public function jobApplication()
    {
        return $this->belongsTo(JobApplication::class);
    }
}
