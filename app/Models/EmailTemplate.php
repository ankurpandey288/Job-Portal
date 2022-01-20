<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\EmailTemplate
 *
 * @property int $id
 * @property string $template_name
 * @property string $subject
 * @property string $body
 * @property string $variables
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|EmailTemplate newModelQuery()
 * @method static Builder|EmailTemplate newQuery()
 * @method static Builder|EmailTemplate query()
 * @method static Builder|EmailTemplate whereBody($value)
 * @method static Builder|EmailTemplate whereCreatedAt($value)
 * @method static Builder|EmailTemplate whereId($value)
 * @method static Builder|EmailTemplate whereSubject($value)
 * @method static Builder|EmailTemplate whereTemplateName($value)
 * @method static Builder|EmailTemplate whereUpdatedAt($value)
 * @method static Builder|EmailTemplate whereVariables($value)
 * @mixin \Eloquent
 */
class EmailTemplate extends Model
{
    /**
     * @var string
     */
    public $table = 'email_templates';

    /**
     * @var array
     */
    public $fillable = [
        'template_name',
        'subject',
        'body',
        'variables',
    ];

    protected $casts = [
        'body' => 'string',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'subject' => 'required|max:150',
        'body'    => 'required',
    ];
}
