<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            {{ Form::label('title', __('messages.post.title').':', ['class' => 'font-weight-bold']) }}
            <p>{{html_entity_decode($post->title)}}</p>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            {{ Form::label('blog_category', __('messages.post_category.post_category').':', ['class' => 'font-weight-bold']) }}
            <br>
            <div class="post-detail-category-badge">
                @forelse($post->postAssignCategories->pluck('name')->toArray() as $categoryBadges)
                    <span class="badge-pill badge-{{ getBadgeColor($loop->index) }}">{{$categoryBadges}}</span>
                @empty
                    {{ __('messages.employer_menu.no_data_available') }}
                @endforelse
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            {{ Form::label('attachment', __('messages.post.image').':', ['class' => 'font-weight-bold']) }}
            <br>
            @if(!empty($post->blog_image_url))
                <a href="{{$post->blog_image_url}}" target="_blank">{{ __('messages.common.view') }}</a>&nbsp;
                <a href="{{route('download.post').'/'. $post->media[0]->id}}">{{ __('messages.common.download') }}</a>
            @else
                {{ __('messages.common.n/a') }}
            @endif
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            {{ Form::label('notes', __('messages.post.description').':', ['class' => 'font-weight-bold']) }}
            {!! !empty($post->description)? nl2br($post->description): __('messages.common.n/a') !!}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            {{ Form::label('created_at', __('messages.common.created_on').':', ['class' => 'font-weight-bold']) }}
            <br>
            <span data-toggle="tooltip" data-placement="right"
                  title="{{ date('jS M, Y', strtotime($post->created_at)) }}">{{ $post->created_at->diffForHumans() }}</span>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            {{ Form::label('updated_at', __('messages.common.last_updated').':',['class'=>'font-weight-bold']) }}<br>
            <span data-toggle="tooltip" data-placement="right"
                  title="{{ date('jS M, Y', strtotime($post->updated_at)) }}">{{ $post->updated_at->diffForHumans() }}</span>
        </div>
    </div>
</div>
