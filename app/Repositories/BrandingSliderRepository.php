<?php

namespace App\Repositories;

use App\Models\BrandingSliders;
use Exception;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

/**
 * Class BrandingSliderRepository
 */
class BrandingSliderRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title',
    ];

    /**
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return BrandingSliders::class;
    }

    /**
     * @param $input
     */
    public function store($input)
    {
        try {
            /** @var BrandingSliders $brandingSlider */
            $brandingSlider = $this->create($input);

            if (isset($input['branding_slider']) && ! empty($input['branding_slider'])) {
                $brandingSlider->addMedia($input['branding_slider'])->toMediaCollection(BrandingSliders::PATH,
                    config('app.media_disc'));
            }

            return true;
        } catch (Exception $e) {
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }

    /**
     * @param  array  $input
     *
     * @param  int  $brandingSliderId
     */
    public function updateBranding($input, $brandingSliderId)
    {
        try {
            /** @var BrandingSliders $brandingSlider */
            $brandingSlider = $this->update($input, $brandingSliderId);

            if (isset($input['branding_slider']) && ! empty($input['branding_slider'])) {
                $brandingSlider->clearMediaCollection(BrandingSliders::PATH);
                $brandingSlider->addMedia($input['branding_slider'])->toMediaCollection(BrandingSliders::PATH,
                    config('app.media_disc'));
            }

            return true;
        } catch (Exception $e) {
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }
}
