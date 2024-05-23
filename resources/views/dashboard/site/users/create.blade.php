@extends('dashboard.core.app')
@section('title', __('dashboard.Create') . ' ' . __('dashboard.users'))

@section('css_addons')
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('dashboard.users')</h1>
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
                        <form action="{{ route('users.store') }}" method="post" autocomplete="off"
                              enctype="multipart/form-data">
                            <input hidden="" name="company_id" value="{{request('company')}}">
                            <div class="card-header">
                                <h3 class="card-title">@lang('dashboard.Create') @lang('dashboard.user')</h3>
                            </div>
                            <div class="card-body">
                                @csrf

{{--                             {{-- type--}}
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputType1">@lang('dashboard.Type')</label>
                                            <select name="type" class="form-control" id="exampleInputType1" required>
                                                <option value=""  selected disabled>@lang('dashboard.select')</option>
                                                <option value="1" >@lang('dashboard.Male')</option>
                                                <option value="0">@lang('dashboard.Female')</option>
                                            </select>
                                        </div>

                                    </div>



                                                                {{-- postion--}}

                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="positionSelect">@lang('dashboard.postion')</label>
                                            <select name="postion" class="form-control" id="positionSelect" required>
                                                <option value=""  selected disabled>@lang('dashboard.select')</option>
                                                <option value="1" >@lang('dashboard.in')</option>
                                                <option value="0">@lang('dashboard.out')</option>
                                            </select>
                                        </div>

                                    </div>


                                    {{-- image_front--}}

                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputFile">@lang('dashboard.image_front')</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" name="image_front" class="custom-file-input" id="exampleInputFile">
                                                    <label class="custom-file-label" for="exampleInputFile">@lang('dashboard.chooseFile')</label>
                                                </div>
                                            </div>
                                        </div>




                                    </div>


                                    {{-- image_back --}}

                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputFile">@lang('dashboard.image_back')</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" name="image_back" class="custom-file-input" id="exampleInputFile">
                                                    <label class="custom-file-label" for="exampleInputFile">@lang('dashboard.chooseFile')</label>
                                                </div>
                                            </div>
                                        </div>


                                    </div>


                                    {{-- image --}}


                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputFile">@lang('dashboard.Image')</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" name="image" class="custom-file-input" id="exampleInputFile">
                                                    <label class="custom-file-label" for="exampleInputFile">@lang('dashboard.chooseFile')</label>
                                                </div>
                                            </div>
                                        </div>


                                    </div>





                                    {{-- cv --}}


                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputFile">@lang('dashboard.cv')</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" name="cv" class="custom-file-input" id="exampleInputFile">
                                                    <label class="custom-file-label" for="exampleInputFile">@lang('dashboard.chooseFile')</label>
                                                </div>
                                            </div>
                                        </div>



                                    </div>


                                    {{-- name --}}


                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputType1">@lang('dashboard.name')</label>
                                            <input name="name" type="text" class="form-control" id="exampleInputType1" required>

                                        </div>

                                    </div>


                                    {{-- national_ID --}}

                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputType1">@lang('dashboard.national_ID')</label>
                                            <input name="national_ID" type="text" class="form-control" id="exampleInputType1" required>

                                        </div>

                                    </div>

                                    {{-- card_Date --}}

                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputType1">@lang('dashboard.card_Date')</label>
                                            <input name="card_Date" type="date" class="form-control" id="exampleInputType1" required>

                                        </div>

                                    </div>




                                    {{-- governorate--}}

                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputType1">@lang('dashboard.governorates')</label>
                                            <select name="governorate_id" class="form-control" id="exampleInputType1" required>
                                                @foreach($governorates as $governorate)
                                                    <option value="{{$governorate->id}}">{{$governorate->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                    </div>






                                    {{-- address --}}

                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputType1">@lang('dashboard.address')</label>
                                            <input name="address" type="text" class="form-control" id="exampleInputType1" required>

                                        </div>

                                    </div>



                                    {{-- phone --}}

                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputType1">@lang('dashboard.phone')</label>
                                            <input name="phone" type="text" class="form-control" id="exampleInputType1" required>

                                        </div>

                                    </div>


                                  {{-- qualification --}}

                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputType1">@lang('dashboard.qualification')</label>
                                            <input name="qualification" type="text" class="form-control" id="exampleInputType1" required>

                                        </div>

                                    </div>



                                    {{-- job --}}

                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputType1">@lang('dashboard.job')</label>
                                            <input name="job" type="text" class="form-control" id="exampleInputType1" required>

                                        </div>

                                    </div>



                                    {{-- work_place --}}

                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputType1">@lang('dashboard.work_place')</label>
                                            <input name="work_place" type="text" class="form-control" id="exampleInputType1" required>

                                        </div>

                                    </div>



                                    {{-- partisan --}}

                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputType1">@lang('dashboard.partisan')</label>
                                            <input name="partisan" type="text" class="form-control" id="exampleInputType1" required>

                                        </div>

                                    </div>


                                    <div id="conditionalFields" style="display: none; width: 100%">

                                    <div class="row">
                                        {{-- countries--}}


                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="exampleInputType1">@lang('dashboard.country')</label>
                                                <select name="country_id" class="form-control" id="exampleInputType1">
                                                    @foreach($countries as $country)
                                                        <option value="{{$country->id}}">{{$country->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                        </div>



                                        {{-- Place_abroad --}}

                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="exampleInputType1">@lang('dashboard.Place_abroad')</label>
                                                <input name="Place_abroad" type="text" class="form-control" id="exampleInputType1" >

                                            </div>

                                        </div>



                                        {{-- Passport_number --}}

                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="exampleInputType1">@lang('dashboard.Passport_number')</label>
                                                <input name="Passport_number" type="text" class="form-control" id="exampleInputType1">

                                            </div>

                                        </div>

                                    </div>


                                    </div>


                                    </div>

                            </div>


                            <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-dark">@lang('dashboard.Create')</button>
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

            // Toggle visibility of conditional fields based on position select value
            $('#positionSelect').change(function () {
                if ($(this).val() === '0') {
                    $('#conditionalFields').show();
                } else {
                    $('#conditionalFields').hide();
                }
            }).trigger('change'); // Trigger change event on page load to set the correct initial state
        });
    </script>
@endsection
