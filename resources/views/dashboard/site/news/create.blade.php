@extends('dashboard.core.app')
@section('title', __('dashboard.Create') . ' ' . __('dashboard.users'))

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
                        <form action="{{ route('news.store') }}" method="post" autocomplete="off"
                              enctype="multipart/form-data">
                            <div class="card-header">
                                <h3 class="card-title">@lang('dashboard.Create') @lang('dashboard.news')</h3>
                            </div>
                            <div class="card-body">
                                @csrf


                                     <div class="container">
                                    <form action="{{ route('news.store') }}" method="POST"   enctype="multipart/form-data">
                                        @csrf


                                        {{-- name --}}


                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="exampleInputType1">@lang('dashboard.title')</label>
                                                <input name="title" type="text" class="form-control" id="exampleInputType1" required>

                                            </div>

                                        </div>
                                        <input id="x" type="hidden" name="description">
                                        <label for="exampleInputType1">@lang('dashboard.description')</label>

                                        <trix-editor style="min-height: 250px" input="x"></trix-editor>




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

                                    </form>
                            </div>


                            <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-dark">@lang('dashboard.Create')</button>
                    </div>
                </div>

                <!-- /.card -->

            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
        </div>
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
    </script><!-- Include Trix JS directly if not using Laravel Mix -->
     <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.js"></script>


@endsection
