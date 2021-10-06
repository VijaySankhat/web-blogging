<a class="link-container" href="{{ route('posts.show', $post->slug) }}">
    <div class="card mt-2">
        <div class="card-body">
            <h2 v-pre class="card-title list">{{ $post->title}}</h2>

            <p class="card-text">
                <small v-pre class="text-muted">
                    {{ Str::limit($post->description, config('app.string_limit'), config('app.string_limit_separator')) }}
                </small>
            </p>

            <p class="card-text">
                <small class="text-muted">
                    <strong>{{__("post.author")}}</strong>
                    {{$post->author->username }},
                </small>
                <small class="text-muted">{{ humanize_date($post->publication_date) }}</small><br>
            </p>
        </div>
    </div>
</a>
