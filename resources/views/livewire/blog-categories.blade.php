<div class="employee-card">
    <div class="row">
        @if(count($postCategories) > 0 || $searchByPostCategory != '')
            <div class="col-md-12">
                <div class="row mb-3 justify-content-end flex-wrap">
                    <div>
                        <div class="selectgroup mr-4">
                            <input wire:model.debounce.100ms="searchByPostCategory" id="searchByPostCategory"
                                   type="search"
                                   autocomplete="off"
                                   placeholder="Search" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
        @endif
        @forelse($postCategories as $postCategory)
            @include('blog_categories.post_category_card')
        @empty
            <div class="col-md-12">
                <h5 class="text-black text-center">
                    @if ($searchByPostCategory)
                        {{ __('messages.post_category.no_post_category_found') }}
                    @else
                        {{ __('messages.post_category.no_post_category_available') }}
                    @endif
                </h5>
            </div>
        @endforelse
        <div class="col-md-12">
            <div class="row mb-3 justify-content-end flex-wrap">
                @if($postCategories->count() > 0)
                    {{$postCategories->links()}}
                @endif
            </div>
        </div>
    </div>
</div>

