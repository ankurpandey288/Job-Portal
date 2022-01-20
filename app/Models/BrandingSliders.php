<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

/**
 * App\Models\BrandingSliders
 *
 * @property int $id
 * @property string $title
 * @property int $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $branding_slider_url
 * @property-read \Illuminate\Database\Eloquent\Collection|Media[] $media
 * @property-read int|null $media_count
 * @method static \Illuminate\Database\Eloquent\Builder|BrandingSliders newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BrandingSliders newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BrandingSliders query()
 * @method static \Illuminate\Database\Eloquent\Builder|BrandingSliders whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BrandingSliders whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BrandingSliders whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BrandingSliders whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BrandingSliders whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class BrandingSliders extends Model implements HasMedia
{
    use InteractsWithMedia;

    const STATUS = [
        1 => 'Active',
        0 => 'Deactive',
    ];

    public const PATH = 'branding-sliders';

    public $table = 'branding_sliders';
    public $fillable = [
        'title',
        'is_active',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'title'           => 'required|max:150',
        'branding_slider' => 'required',
    ];

    /**
     * @var array
     */
    protected $appends = ['branding_slider_url'];

    /**
     * @return mixed
     */
    public function getBrandingSliderUrlAttribute()
    {
        /** @var Media $media */
        $media = $this->media->first();
        if (! empty($media)) {
            return $media->getFullUrl();
        }

        return asset('assets/img/infyom-logo.png');
    }
}
