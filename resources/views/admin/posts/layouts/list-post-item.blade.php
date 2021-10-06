@cannot('update', $post)
<a class="link-container" href="{{ route('admin.posts.show', $post->id) }}">
@endcannot
    <div class="card mt-2">

        <div class="card-body">
            <h2 v-pre class="card-title list">
                {{ $post->title}}
            </h2>

            <p class="card-text">
                <small v-pre class="text-muted">
                    {{ Str::limit($post->description, config('app.string_limit'), config('app.string_limit_separator')) }}
                </small>
            </p>

            <p class="card-text mb-0">
                <small class="text-muted">
                    <strong>{{__("post.author")}}</strong>
                    {{$post->author->username }},
                </small>
                <small class="text-muted">{{ humanize_date($post->publication_date) }}</small><br>
            </p>

            @can('update', $post)
                <div class=" col-md-12">
                    <div class="float-right">
                        <a class="btn btn-link text-primary d-inline"
                           href="{{ route('admin.posts.edit', $post->id) }}">Edit</a> |
                        {!! Form::model($post, [
                                'method' => 'DELETE',
                                'route' => ['admin.posts.destroy', $post],
                                'class' => 'form-inline pull-right d-inline',
                                'data-confirm' => __('post.delete'),
                                'onsubmit' => 'return confirm("'.__("post.delete_sure").'")']) !!}
                            {!! Form::button('<i class="fa fa-trash" aria-hidden="true"></i> ' . __('post.delete'), ['class' => 'btn btn-link text-danger', 'name' => 'submit', 'type' => 'submit']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            @endcan
        </div>
    </div>
@cannot('update', $post)
    </a>
@endcannot

