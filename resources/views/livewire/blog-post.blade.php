<div class="section-body">

    @if(count($posts) > 0 || $searchByPost != '' || $categoryFilter != '')
    <div class="row">
        <div class="col-md-2 ml-auto float-right mb-4">
            {{Form::select('drp_category',$category,null,['id'=>'filterCategory','class'=>'form-control', 'placeholder' => 'All'])  }}
        </div>
        <div class="col-md-2 float-right mb-2">
            <input wire:model.debounce.100ms="searchByPost" type="search" id="searchByPost"
                   placeholder=" {{ __('web.common.search') }}" class="form-control">
        </div>
    </div>
    @endif
    <div class="row">
        @if( count($posts) > 0)
            @forelse($posts as $post)
                <div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-3">
                    <article class="article post-box hover-border">
                        <div class="article-header border-top-15">
                            <nav class="cd-stretchy-nav edit-content">
                                <a class="cd-nav-trigger" href="javascript:void(0)">
                                    <span aria-hidden="true"></span>
                                </a>
                                <ul>
                                    <li><a href="{{ route('posts.edit', $post->id) }}" class="edit-btn text-white">
                                            <span>{{__('messages.common.edit')}}</span>
                                            <i class="fas fa-pen"></i>
                                        </a></li>
                                    <li><a href="#" class="text-white btnDeletePost"
                                           data-id="{{ $post->id }}">
                                            <span>{{__('messages.common.delete')}}</span>
                                            <i class="fas fa-trash"></i>
                                        </a></li>
                                </ul>

                                <span aria-hidden="true" class="stretchy-nav-bg"></span>
                            </nav>
                            <img src="{{ empty($post->blog_image_url) ? asset('assets/img/article-image.png') :$post->blog_image_url }}"
                                 class="article-image" style="border-radius: inherit;"/>
                            <div class="article-title">
                                <h2>
                                    <a href="{{route('posts.show',$post->id)}}">{{ html_entity_decode($post->title) }}</a>
                                </h2>
                            </div>
                        </div>
                        <div class="article-details border-bottom-15">
                            <div class="post-detail-category-badge">
                                @foreach($post->postAssignCategories as $counter => $category)
                                    @if($counter < 1)
                                        <span class="font-size-13px post-badge badge-pill {{ $counter }} badge-{{ getBadgeColor($loop->index) }}">{{$category->name}}</span>
                                    @elseif($counter == (count($post->postAssignCategories )) - 1)
{{--                                        <a href="javascript:void(0)"--}}
{{--                                           class="font-size-13px  badge-pill badge-pill {{ $counter }} badge-{{ getBadgeColor($loop->index) }} text-decoration-none">More</a>--}}
                                        <span class="font-size-13px post-badge badge-pill badge-danger text-decoration-none font-size-13px">{{ "+" . $counter}}</span>
                                    @endif
                                @endforeach
                            </div>
                            <div class="text-left line-height-20px blog-post-description">
                                {!! !empty($post->description) ? $post->description : __('messages.common.n/a') !!}
                            </div>
                            <div class="article-cta text-right">
                                <small class="mb-0">{{$post->created_at->diffForHumans()}}</small>
                            </div>
                        </div>
                    </article>
                </div>
            @empty
            @endforelse
        @else
            @if($searchByPost == null || empty($searchByPost))
                <div class="col-lg-12 col-md-12 d-flex justify-content-center mt-4">
                    <h5>{{ __('messages.post.no_posts_available') }} </h5>
                </div>
            @else
                <div class="col-lg-12 col-md-12 d-flex justify-content-center mt-4">
                    <h5>{{ __('messages.post.no_posts_found') }} </h5>
                </div>
            @endif
        @endif
    </div>
    <div class="float-right">
        @if($posts->count() > 0)
            {{$posts->links()}}
        @endif
    </div>
</div>

