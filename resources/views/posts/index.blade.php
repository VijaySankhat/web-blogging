@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                @include ('posts.layouts.post-sorting')
            </div>
            <div class="col-md-8">
                @each('posts.layouts.list-post-item', $posts, 'post', 'posts/layouts/no-post-item')
            </div>
            <div class="col-md-4 mt-2">
                @include ('posts.layouts.search_form')
            </div>
            <div class="col-md-12 mt-5">
                <div class="d-flex pagination">
                    {{ $posts->appends(request()->input())->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection

