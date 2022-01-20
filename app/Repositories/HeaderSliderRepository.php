<?php

namespace App\Repositories;

use App\Models\HeaderSlider;
use Exception;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

/**
 * Class HeaderSliderRepository
 */
class HeaderSliderRepository extends BaseRepository
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
        return HeaderSlider::class;
    }

    /**
     * @param $input
     */
    public function store($input)
    {
        try {
            /** @var HeaderSlider $headerSlider */
            $headerSlider = $this->create($input);

            if (isset($input['header_slider']) && ! empty($input['header_slider'])) {
                $headerSlider->addMedia($input['header_slider'])->toMediaCollection(HeaderSlider::PATH,
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
     * @param  int  $headerSliderId
     */
    public function updateHeaderSlider($input, $headerSliderId)
    {
        try {
            /** @var HeaderSlider $headerSlider */
            $headerSlider = $this->update($input, $headerSliderId);

            if (isset($input['image_slider']) && ! empty($input['image_slider'])) {
                $headerSlider->clearMediaCollection(HeaderSlider::PATH);
                $headerSlider->addMedia($input['image_slider'])->toMediaCollection(HeaderSlider::PATH,
                    config('app.media_disc'));
            }

            return true;
        } catch (Exception $e) {
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }
}
