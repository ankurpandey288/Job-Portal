<?php

namespace App\Queries;

use App\Models\Testimonial;

/**
 * Class TestimonialsDataTable
 */
class TestimonialsDataTable
{
    /**
     * @return Testimonial
     */
    public function get()
    {
        /** @var Testimonial $query */
        $query = Testimonial::query()->select('testimonials.*');

        return $query;
    }
}
