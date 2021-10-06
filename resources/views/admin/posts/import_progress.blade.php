@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            @csrf
            <div class="col-sm-6 text-center">
                    <p>{{__("post.post_import_progressing")}}</p>
                    <div class="loader4"></div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        window.onload = function(){
            let listUrl = "{{ route('admin.posts.index') }}";
            const intervalID = setInterval(getStatus, 3000);
            setTimeout(function() {
                clearInterval(intervalID);
                alert();
            }, 18000);
            function getStatus() {
                jQuery.ajax({
                    type:'GET',
                    url:"{{ route('admin.posts.import.status', $jobId) }}?_token={{ csrf_token() }}",
                    success:function(data){
                        if(data.success) {
                            clearInterval(intervalID);
                            alert("{{__("post.import_success")}}");
                            window.location.href = listUrl;
                        }
                    },
                    error: function(data) {
                        alert("{{__("post.import_failed")}}");
                    }
                });
            }
        };


    </script>
@endsection

