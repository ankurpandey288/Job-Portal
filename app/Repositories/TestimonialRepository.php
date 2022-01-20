<?php

namespace App\Repositories;

use App\Models\Testimonial;
use Exception;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

/**
 * Class TestimonialRepository
 */
class TestimonialRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'customer_name',
    ];

    /**
     * @return array|string[]
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * @return string
     */
    public function model()
    {
        return Testimonial::class;
    }

    /**
     * @param $input
     *
     * @return bool
     */
    public function store($input)
    {
        try {
            /** @var Testimonial $testimonial */
            $testimonial = $this->create($input);

            if (isset($input['customer_image']) && ! empty($input['customer_image'])) {
                $testimonial->addMedia($input['customer_image'])->toMediaCollection(Testimonial::PATH,
                    config('app.media_disc'));
            }
        } catch (Exception $e) {
            throw new UnprocessableEntityHttpException($e->getMessage());
        }

        return true;
    }

    /**
     * @param $input
     *
     * @param $testimonialId
     */
    public function updateTestimonial($input, $testimonialId)
    {
        try {
            /** @var Testimonial $testimonial */
            $testimonial = $this->update($input, $testimonialId);

            if (! empty($input['customer_image'])) {
                $testimonial->clearMediaCollection(Testimonial::PATH);
                $testimonial->addMedia($input['customer_image'])->toMediaCollection(Testimonial::PATH,
                    config('app.media_disc'));
            }
        } catch (Exception $e) {
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }
}
