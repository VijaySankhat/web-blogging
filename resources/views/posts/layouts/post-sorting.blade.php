<div class="input-group mr-sm-3">
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