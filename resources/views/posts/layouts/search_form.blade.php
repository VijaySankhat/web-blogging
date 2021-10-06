{!! Form::open(['route' => 'home', 'class' => 'd-flex', 'method' => 'GET']) !!}
    <div class="input-group mr-sm-3">
        {!! Form::text('q', request('q'), ['class' => 'form-control', 'placeholder' => __('post.search_ur_post'), 'maxlength' => '255', 'minlength'=> '1']) !!}
    </div>

    <button type="submit" class="btn btn-primary">
        {{__('post.search')}}
    </button>
{!! Form::close() !!}
