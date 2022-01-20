<?php

namespace App\Repositories;

use App\Models\ImageSlider;
use Exception;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

/**
 * Class ImageSliderRepository
 */
class ImageSliderRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'description',
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
        return ImageSlider::class;
    }

    /**
     * @param $input
     */
    public function store($input)
    {
        try {
            /** @var ImageSlider $imageSlider */
            $imageSlider = $this->create($input);

            if (isset($input['image_slider']) && ! empty($input['image_slider'])) {
                $imageSlider->addMedia($input['image_slider'])->toMediaCollection(ImageSlider::PATH, config('app.media_disc'));
            }

            return true;
        } catch (Exception $e) {
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }

    /**
     * @param array $input
     *
     * @param int $imageSliderId
     */
    public function updateImageSlider($input, $imageSliderId)
    {
        try {
            /** @var ImageSlider $imageSlider */
            $imageSlider = $this->update($input, $imageSliderId);

            if (isset($input['image_slider']) && ! empty($input['image_slider'])) {
                $imageSlider->clearMediaCollection(ImageSlider::PATH);
                $imageSlider->addMedia($input['image_slider'])->toMediaCollection(ImageSlider::PATH, config('app.media_disc'));
            }

            return true;
        } catch (Exception $e) {
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }
}
