<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

/**
 * App\Models\ImageSlider
 *
 * @method static \Illuminate\Database\Eloquent\Builder|ImageSlider newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ImageSlider newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ImageSlider query()
 * @mixin \Eloquent
 * @property int $id
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $image_slider_url
 * @property-read \Illuminate\Database\Eloquent\Collection|Media[] $media
 * @property-read int|null $media_count
 * @method static \Illuminate\Database\Eloquent\Builder|ImageSlider whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ImageSlider whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ImageSlider whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ImageSlider whereUpdatedAt($value)
 * @property int $is_active
 * @method static \Illuminate\Database\Eloquent\Builder|ImageSlider whereIsActive($value)
 */
class ImageSlider extends Model implements HasMedia
{
    use InteractsWithMedia;

    const STATUS = [
        1 => 'Active',
        0 => 'Deactive',
    ];

    public const PATH = 'image-sliders';

    public $table = 'image_sliders';
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
        'image_slider' => 'required',
    ];

    /**
     * @var array
     */
    protected $appends = ['image_slider_url'];

    /**
     * @return mixed
     */
    public function getImageSliderUrlAttribute()
    {
        /** @var Media $media */
        $media = $this->media->first();
        if (! empty($media)) {
            return $media->getFullUrl();
        }

        return asset('assets/img/infyom-logo.png');
    }
}
