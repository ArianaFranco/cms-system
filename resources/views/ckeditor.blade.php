<x-admin-master>

    @section('styles')
        <link rel="stylesheet" href="{{asset('css/dropzone-style.css')}}">
    @endsection

    @section('content')

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">{{ __('Wysiwyg CKEditor') }}</div>

                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif

                            {{--<div id="editor"></div>--}}

                            <form action="{{route('ckeditor.store')}}" method="post">
                                @csrf
                                <textarea name="content" id="editor">
                                    &lt;p&gt;This is some sample content.&lt;/p&gt;
                                </textarea>
                                <p><input type="submit" value="Submit" class="btn btn-primary"></p>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection

    @section('scripts')
        {{--<script src="https://cdn.ckeditor.com/ckeditor5/23.0.0/classic/ckeditor.js"></script>--}}
        <script src="https://ckeditor.com/apps/ckfinder/3.5.0/ckfinder.js"></script>
        <script>

            //$(document).ready(function() {
            $(function() {
                ClassicEditor
                    .create(document.querySelector('#editor'))
                    .catch(error => {
                        console.error(error);
                    });
            });
        </script>


    @endsection
</x-admin-master>