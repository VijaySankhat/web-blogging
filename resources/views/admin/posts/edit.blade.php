@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row ">
            <div class="col-md-12 mt-2">
                <a class="float-right" href="{{ route('admin.posts.index') }}">Back</a>
            </div>
            @include('admin.posts.layouts.message')
            <div class="col-md-12 mt-2">
                {!! Form::open(['url' => route('admin.posts.update', $post->id), 'class' => 'row', 'method' => 'PUT']) !!}
                    {{ Form::hidden('author_id', $post->author_id) }}
                    <div class="col-md-12 mt-2">
                        <div class="input-group mr-sm-3">
                            {!! Form::text('title', $post->title, ['class' => 'form-control', 'placeholder' => __('post.enter_post_title')]) !!}
                        </div>
                    </div>
                    <div class="col-md-12 mt-2">
                        <div class="input-group mr-sm-3">
                            {!! Form::textarea('description', $post->description, ['class' => 'form-control', 'placeholder' => __('post.enter_post_description')]) !!}
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