@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 mt-2">
                <a class="float-right" href="{{ route('home') }}">Back</a>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h2 v-pre class="card-title single">{{$post->title}}</h2>
                        <p class="card-text">
                            <small v-pre class="text-muted">
                                <strong>{{__("post.author")}}</strong>
                                {{$post->author->username}}
                                <strong>
                                    {{__(", ").humanize_date($post->publication_date)}}
                                </strong>
                            </small>
                        </p>
                        <p class="card-text desc">
                            {{$post->description}}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection