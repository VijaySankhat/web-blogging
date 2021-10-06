<div class="input-group mr-sm-3 second-top-header">
    <div class="float-right col-md-4 pl-0">
        <span class="btn btn-outline-secondary sort-title">
        <strong>{{__("post.sort_by")}}:</strong>
    </span>
        <a href="{{ request()->fullUrlWithQuery(['sort' => 'desc'])}}"
           class="btn btn-outline-secondary m-1 {{((request('sort') && request('sort') === 'desc') || empty(request('sort'))) ?"active": ''}}">
            {{__("post.sort_latest_first")}}
        </a>
        <a href="{{request()->fullUrlWithQuery(['sort' => 'asc'])}}"
           class="btn btn-outline-secondary m-1 {{((request('sort') && request('sort') === 'asc')) ?"active": ''}}">
            {{__("post.sort_older_first")}}
        </a>
    </div>


    <div class="float-right row col-md-8">
        @if(Auth::user()->isAdmin())
            <div class="col-md-8 mt-2">
            {!! Form::open(['url' => route('admin.posts.import', null, true), 'class' => '', 'method' => 'POST']) !!}

                    <div class="input-group mr-sm-3">
                        {!! Form::text('url', null, ['class' => 'form-control', 'placeholder' => __('post.enter_url'), 'maxlength' => '1024']) !!}
                        @error('import')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                        <button type="submit" class="btn btn-primary">
                            {{__('post.import')}}
                        </button>
                    </div>

            {!! Form::close() !!}
            </div>
        @endif

        <div class="col-md-4">
            <a href="{{ route('admin.posts.create') }}" class="float-right btn btn-outline-secondary m-1">Create New</a>
        </div>
    </div>


</div>