@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">

            <div class="col-md-12">
                @include ('admin.posts.layouts.post-sorting')
            </div>

            @include('admin.posts.layouts.message')

            <div class="col-md-8">
                @each('admin.posts.layouts.list-post-item', $posts, 'post', 'posts/layouts/no-post-item')
            </div>
            <div class="col-md-4 mt-2">
                @include ('admin.posts.layouts.search-form')
            </div>
            <div class="col-md-12 mt-5">
                <div class="d-flex pagination">
                    {{ $posts->appends(request()->input())->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection

