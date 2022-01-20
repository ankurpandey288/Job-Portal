<?php

namespace App\Models;



use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class CustomMedia extends Media
{
    /**
     * @return BelongsTo
     */
    public function candidate()
    {
        return $this->belongsTo(Candidate::class,'model_id');
    }
}
