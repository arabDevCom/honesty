@extends('dashboard.core.app')
@section('title', __('dashboard.Edit') . ' ' . __('dashboard.news'))

@section('css_addons')
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- Include Trix CSS directly if not using Laravel Mix -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.css">
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('dashboard.news')</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <form action="{{ route('news.update', $news->id) }}" method="post" autocomplete="off"
                              enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card-header">
                                <h3 class="card-title">@lang('dashboard.Edit') @lang('dashboard.news')</h3>
                            </div>
                            <div class="card-body">
                                <div class="container">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputType1">@lang('dashboard.title')</label>
                                            <input name="title" type="text" class="form-control" id="exampleInputType1" value="{{ $news->title }}" required>
                                        </div>
                                    </div>
                                    <label for="exampleInputType1">@lang('dashboard.description')</label>
                                    <trix-editor style="min-height: 250px" input="x">{{ $news->description }}</trix-editor>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputFile">@lang('dashboard.image')</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" name="image" class="custom-file-input" id="exampleInputFile">
                                                    <label class="custom-file-label" for="exampleInputFile">@lang('dashboard.chooseFile')</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-dark">@lang('dashboard.update')</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection

@section('js_addons')
    <script src="{{ asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
    <script>
        $(function () {
            bsCustomFileInput.init();
            $('.select2').select2({
                language: {
                    searching: function () {
                    }
                },
            });


        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var descriptionEditor = document.getElementById('descriptionEditor');
            var descriptionInput = document.getElementById('descriptionInput');

            // Check if descriptionInput exists and has a value
            if (descriptionInput && descriptionInput.value.trim() !== '') {
                // If descriptionInput has a value, load it into the Trix editor
                descriptionEditor.editor.loadHTML(descriptionInput.value);
            } else {
                // If descriptionInput is empty or does not exist, initialize the Trix editor with an empty value
                descriptionEditor.editor.loadHTML('');
            }
        });
    </script>

    <!-- Include Trix JS directly if not using Laravel Mix -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.js"></script>
@endsection
