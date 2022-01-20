<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTestimonialRequest;
use App\Http\Requests\UpdateTestimonialRequest;
use App\Models\Testimonial;
use App\Queries\TestimonialsDataTable;
use App\Repositories\TestimonialRepository;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Yajra\DataTables\DataTables;

class TestimonialsController extends AppBaseController
{
    /**
     * @var TestimonialRepository
     */
    private $testimonialRepository;

    public function __construct(TestimonialRepository $testimonialRepository)
    {
        $this->testimonialRepository = $testimonialRepository;
    }

    /**
     * @param  Request  $request
     *
     * @throws Exception
     *
     * @return Factory|View
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of((new TestimonialsDataTable())->get())->make(true);
        }

        return view('testimonial.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateTestimonialRequest  $request
     *
     * @return Response
     */
    public function store(CreateTestimonialRequest $request)
    {
        $input = $request->all();
        $this->testimonialRepository->store($input);

        return $this->sendSuccess('Testimonial saved successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  Testimonial  $testimonial
     *
     * @return Response
     */
    public function show(Testimonial $testimonial)
    {
        return $this->sendResponse($testimonial, 'Testimonials Retrieved Successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Testimonial  $testimonial
     *
     * @return Response
     */
    public function edit(Testimonial $testimonial)
    {
        return $this->sendResponse($testimonial, 'Testimonials Retrieved Successfully.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Testimonial  $testimonial
     *
     * @param  UpdateTestimonialRequest  $request
     *
     * @return void
     */
    public function update(UpdateTestimonialRequest $request, Testimonial $testimonial)
    {
        $input = $request->all();
        $this->testimonialRepository->updateTestimonial($input, $testimonial->id);

        return $this->sendSuccess('Testimonials updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Testimonial  $testimonial
     *
     * @throws Exception
     *
     * @return Response
     */
    public function destroy(Testimonial $testimonial)
    {
        $testimonial->delete();

        return $this->sendSuccess('Testimonials deleted successfully.');
    }

    /**
     * @param  int  $media
     *
     * @return Media
     */
    public function downloadImage(Testimonial $testimonial)
    {
        $media = $testimonial->getMedia('testimonials')->first()->id;
        /** @var Media $mediaItem */
        $mediaItem = Media::findOrFail($media);

        return $mediaItem;
    }
}
