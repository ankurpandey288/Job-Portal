<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\Inquiry
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string|null $phone_no
 * @property string $subject
 * @property string $message
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Inquiry newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Inquiry newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Inquiry query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Inquiry whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Inquiry whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Inquiry whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Inquiry whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Inquiry whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Inquiry wherePhoneNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Inquiry whereSubject($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Inquiry whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Inquiry extends Model
{
    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name'                 => 'required',
        'email'                => 'required|regex:/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i',
        'phone_no'             => 'nullable|numeric|digits_between:10,12',
        'subject'              => 'required|max:190',
        'message'              => 'required',
        'g-recaptcha-response' => 'required',
    ];
    public $table = 'inquiries';
    public $fillable = [
        'name', 'email', 'phone_no', 'subject', 'message',
    ];
    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'       => 'integer',
        'name'     => 'string',
        'email'    => 'string',
        'phone_no' => 'string',
        'subject'  => 'string',
        'message'  => 'string',
    ];
}
