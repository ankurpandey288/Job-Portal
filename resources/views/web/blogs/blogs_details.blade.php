@extends('web.layouts.app')
@section('title')
    {{ __('messages.post.post_details') }}
@endsection
@section('page_css')
<link href="{{ asset('assets/css/sweetalert.css') }}" rel="stylesheet" type="text/css"/>
@endsection
@section('content')
    <!-- ===== Start of Candidate Profile Header Section ===== -->
    <section class="page-header blog-page-header">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>{{ __('messages.post.post_details') }}</h2>
                </div>
            </div>
        </div>
    </section>
    <!-- ===== End of Candidate Header Section ===== -->

    <section class="ptb80" id="blog-post">
        <div class="container">
            <div class="col-md-8 col-xs-12 post-content-wrapper">

                <div class="post-title">
                    <h2>{{ html_entity_decode($blog->title) }}</h2>

                    <div class="post-detail">
                        <span><i class="fa fa-user"></i>{{ $blog->user->full_name }}</span>
                        <span><i class="fa fa-clock-o"></i>{{ $blog->created_at->format('jS F, Y') }}</span>
                    </div>
                </div>

                <div class="post-content">

                    <div class="post-img">
                        <img src="{{ !empty($blog->blog_image_url)?$blog->blog_image_url:asset('web/img/blog_default_image.jpg') }}"
                             alt="">
                    </div>
                    <div class="post-detail-category-badge web-post-box">
                        @forelse($blog->postAssignCategories->pluck('name')->toArray() as $categoryBadges)
                            <span class="font-size-13px badge-pill badge-{{ getBadgeColor($loop->index) }}">{{$categoryBadges}}</span>
                        @empty
                            {{ __('messages.employer_menu.no_data_available') }}
                        @endforelse
                    </div>
                    <p>{!! !empty($blog->description)? nl2br(($blog->description)):__('messages.common.n/a') !!}</p>

                    <div>
                        <div class="col-md-8 col-12 custom-blog">
                            <div class="blog-widget">
                                <h3 class="widget-title margin-bottom-25 comment-count">{{ __('messages.post.comments') }}
                                    @if(!count($comments) == 0)
                                        <span>({{ count($comments) }})</span>
                                    @endif
                                </h3>
                                <div class="latest-comments">
                                    <ul class="comment-listing">
                                        @foreach($comments as $commentRecord)
                                            <li id="li-comment-1680">
                                                <div class="comments-box" >
                                                    <div class="comments-avatar">
                                                        @if(isset($commentRecord->user_id))
                                                            <img src="{{$commentRecord->user->avatar }}" alt="user-image">
                                                        @else
                                                            <img src="{{ asset('web/img/default-user.png')}}" alt="user-image">
                                                        @endif
                                                    </div>
                                                    <div class="comments-text">
                                                        <div class="avatar-name d-flex justify-content-between ">
                                                            <h5 class="d-flex">{{ $commentRecord->name }}
                                                                @if($commentRecord->user_id == getLoggedInUserId() && getLoggedInUser())
                                                                    <a href="javascript:void(0)" title="{{ __('messages.common.edit') }}"
                                                                       class="edit-comment-btn action-btn"
                                                                       data-id="{{$commentRecord->id}}">
                                                                        <i class="fa fa-edit edit-comment text-danger"></i>
                                                                    </a>
                                                                    <a href="javascript:void(0)" title="{{ __('messages.common.delete') }}"
                                                                       class="action-btn delete-comment-btn"
                                                                       data-id="{{$commentRecord->id}}">
                                                                        <i class="fa fa-trash delete-comment text-warning"></i>
                                                                    </a>
                                                                @endif
                                                            </h5>
                                                            <span class="date-color float-right createdTime">
                                                                {{ $commentRecord->created_at->format('d, M Y') }}</span>
                                                        </div>
                                                        <p id="comment-{{$commentRecord->id}}">{{ $commentRecord->comment }}</p>
                                                    </div>
                                                </div>
                                                <hr class="last-comment-border">
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <div class="blog-widget" id="respond">
                                <h4 class="widget-title">{{ __('messages.post.post_a_comments') }}</h4>
                                <div class="widget-content">
                                    {{ Form::open(['id' => 'commentForm']) }}
                                    {{ Form::token() }}
                                    {{ Form::hidden('comment-id', null, ['class' => 'comment-id','value' => '']) }}
                                        <div class="row">
                                            @if(!Auth::check())
                                            <div class="col-md-6">
                                                <div class="input-with-icon">
                                                    {{ Form::text('name', null, ['class' => 'with-border comment-name', 'placeholder'=>'Your Name']) }}
                                                    <i class="icon-feather-user"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="input-with-icon">
                                                    {{ Form::email('email', null, ['class' => 'with-border comment-email', 'placeholder'=>'Your E-mail']) }}
                                                    <i class="icon-feather-mail"></i>
                                                </div>
                                            </div>
                                            @endif
                                            <div class="col-md-12">
                                                {{ Form::textarea('comment', null,['class' => 'with-border comment','id' => 'comment-field',                                                                                             'placeholder'=>'Your Comment'])}}

                                                {{ Form::button(__('web.common.submit'), ['type'=>'submit','class' => 'button btn-color btn ripple-effect',                                               'id'=>'submitBtn','data-loading-text'=>"<span class='spinner-border spinner-border-sm'></span> Processing..."]) }}
                                            </div>
                                        </div>
                                    {{ Form::close() }}
                                </div>
                            </div>
                        </div>
                    </div>

                    @auth
                        @role('Candidate')
                        <ul class="social-btns list-inline mt20">
                            <li>
                                <a href="{{ $url['facebook'] }}" class="social-btn-roll facebook">
                                    <div class="social-btn-roll-icons">
                                        <i class="social-btn-roll-icon fa fa-facebook"></i>
                                        <i class="social-btn-roll-icon fa fa-facebook"></i>
                                    </div>
                                </a>
                            </li>

                            <li>
                                <a href="{{ $url['twitter'] }}" class="social-btn-roll twitter">
                                    <div class="social-btn-roll-icons">
                                        <i class="social-btn-roll-icon fa fa-twitter"></i>
                                        <i class="social-btn-roll-icon fa fa-twitter"></i>
                                    </div>
                                </a>
                            </li>

                            <li>
                                <a href="{{ $url['gmail'] }}" class="social-btn-roll">
                                    <div class="social-btn-roll-icons">
                                        <i class="social-btn-roll-icon fa fa-google"></i>
                                        <i class="social-btn-roll-icon fa fa-google"></i>
                                    </div>
                                </a>
                            </li>

                            <li>
                                <a href="{{ $url['pinterest'] }}" class="social-btn-roll pinterest">
                                    <div class="social-btn-roll-icons">
                                        <i class="social-btn-roll-icon fa fa-pinterest"></i>
                                        <i class="social-btn-roll-icon fa fa-pinterest"></i>
                                    </div>
                                </a>
                            </li>

                            <li>
                                <a href="{{ $url['linkedin'] }}" class="social-btn-roll linkedin">
                                    <div class="social-btn-roll-icons">
                                        <i class="social-btn-roll-icon fa fa-linkedin"></i>
                                        <i class="social-btn-roll-icon fa fa-linkedin"></i>
                                    </div>
                                </a>
                            </li>
                        </ul>
                        @endrole
                    @endauth
                </div>
            </div>
            @include('web.blogs.blog-sidebar')
            @include('web.blogs.templates.templates')

        </div>
    </section>

@endsection

@section('page_scripts')
    <script>
        let blogComment = "{{ route('blog.create.comment', $blog->id) }}";
        let commentUrl = "{{ url('post-comments') }}"
        let editCommentUrl = "{{ '/edit' }}"
        let defaultImage = "{{ asset('web/img/default-user.png') }}"

    </script>
    <script src="{{ asset('assets/js/sweetalert.min.js') }}"></script>
    <script src="{{ mix('assets/js/web/js/blog/blog_comments.js') }}"></script>

@endsection
