<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

/**
 * App\Models\HeaderSlider
 *
 * @property int $id
 * @property string|null $description
 * @property int $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $header_slider_url
 * @property-read \Illuminate\Database\Eloquent\Collection|Media[] $media
 * @property-read int|null $media_count
 * @method static \Illuminate\Database\Eloquent\Builder|HeaderSlider newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|HeaderSlider newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|HeaderSlider query()
 * @method static \Illuminate\Database\Eloquent\Builder|HeaderSlider whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HeaderSlider whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HeaderSlider whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HeaderSlider whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HeaderSlider whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class HeaderSlider extends Model implements HasMedia
{
    use InteractsWithMedia;

    const STATUS = [
        1 => 'Active',
        0 => 'Deactive',
    ];

    public const PATH = 'header-sliders';

    /**
     * @var string
     */
    public $table = 'header_sliders';

    /**
     * @var string[]
     */
    public $fillable = [
        'description',
        'is_active',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'header_slider' => 'required',
    ];

    /**
     * @var array
     */
    protected $appends = ['header_slider_url'];

    /**
     * @return mixed
     */
    public function getHeaderSliderUrlAttribute()
    {
        /** @var Media $media */
        $media = $this->media->first();
        if (! empty($media)) {
            return $media->getFullUrl();
        }

        return asset('assets/img/infyom-logo.png');
    }
}
