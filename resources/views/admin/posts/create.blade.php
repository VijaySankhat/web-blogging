@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row ">
            <div class="col-md-12 mt-2">
                <a class="float-right" href="{{ route('admin.posts.store') }}">Back</a>
            </div>
            @include('admin.posts.layouts.message')
            <div class="col-md-12 mt-2">
                {!! Form::open(['url' => route('admin.posts.store'), 'class' => 'row', 'method' => 'POST']) !!}
                    {{ Form::hidden('author_id', $author_id) }}
                    <div class="col-md-12 mt-2">
                        <div class="input-group mr-sm-3">
                            {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => __('post.enter_post_title'), 'maxlength' => '255', 'minlength'=> '1']) !!}
                            @error('title')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12 mt-2">
                        <div class="input-group mr-sm-3">
                            {!! Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => __('post.enter_post_description')]) !!}
                            @error('description')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12 mt-2">
                        <button type="submit" class="btn btn-primary">
                            {{__('post.save')}}
                        </button>
                    </div>
                {!! Form::close() !!}

            </div>
        </div>
    </div>
@endsection