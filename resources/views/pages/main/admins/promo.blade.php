@extends('layouts.mst_admin')
@section('title', 'Admin '.env('APP_NAME').': Promo | '.env('APP_TITLE'))
@push('styles')
    <link rel="stylesheet" href="{{asset('admins/modules/datatables/datatables.min.css')}}">
    <link rel="stylesheet"
          href="{{asset('admins/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('admins/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('admins/modules/datatables/Buttons-1.5.6/css/buttons.dataTables.min.css')}}">
    <link rel="stylesheet" href="{{asset('admins/modules/summernote/summernote-bs4.css')}}">
    <style>
        .modal-header {
            padding: 1rem !important;
            border-bottom: 1px solid #e9ecef !important;
        }

        .modal-footer {
            padding: 1rem !important;
            border-top: 1px solid #e9ecef !important;
        }
    </style>
@endpush
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Daftar Voucher </h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{route('admin.dashboard')}}">Dashboard</a></div>
                <div class="breadcrumb-item">Tables</div>
                <div class="breadcrumb-item">Lain-Lain</div>
                <div class="breadcrumb-item">Promo</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-header-form">
                                <button id="btn_create" class="btn btn-primary text-uppercase">
                                    <strong><i class="fas fa-plus mr-2"></i>Tambah Voucher</strong>
                                </button>
                            </div>
                        </div>

                        <div class="card-body">
                            <div id="content1" class="table-responsive">
                                <table class="table table-striped" id="dt-buttons">
                                    <thead>
                                    <tr>
                                        <th class="text-center" width="10%">
                                            <div class="custom-checkbox custom-control">
                                                <input type="checkbox" class="custom-control-input" id="cb-all">
                                                <label for="cb-all" class="custom-control-label">#</label>
                                            </div>
                                        </th>
                                        <th class="text-center">ID</th>
                                        <th width="15%">Kode Voucher</th>
                                        <th width="20%">Deskripsi</th>
                                        <th>Besar Diskon (Rp)</th>
                                        <th width="15%">Minimal pembelian (Rp)</th>
                                        <th class="text-center" width="15%">Mulai</th>
                                        <th class="text-center" width="15%">Selesai</th>
                                        <th class="text-center" width="15%">Status</th>
                                        <th width="25%">Aksi</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php $no = 1; @endphp
                                    @foreach($kategori as $row)
                                        <tr>
                                            <td style="vertical-align: middle" align="center">
                                                <div class="custom-checkbox custom-control">
                                                    <input type="checkbox" id="cb-{{$row->id}}"
                                                           class="custom-control-input dt-checkboxes">
                                                    <label for="cb-{{$row->id}}"
                                                           class="custom-control-label">{{$no++}}</label>
                                                </div>
                                            </td>
                                            <td style="vertical-align: middle" align="center">{{$row->id}}</td>
                                            <td style="vertical-align: middle">
                                                <strong>{{$row->promo_code}}</strong>
                                                @if(!is_null($row->banner))
                                                    <img alt="thumb" class="img-thumbnail" width="100"
                                                         src="{{asset('storage/voucher/banner/'.$row->banner)}}">
                                                @endif
                                            </td>
                                            <td style="vertical-align: middle">
                                                {{$row->description}}
                                            </td>
                                            <td style="vertical-align: middle">
                                                {{number_format($row->discount)}}
                                            </td>

                                            <td style="vertical-align: middle">
                                                {{number_format($row->minim_beli)}}
                                            </td>

                                            <td style="vertical-align: middle" align="center">
                                                {{\Carbon\Carbon::parse($row->start)->format('j F Y')}}</td>
                                            <td style="vertical-align: middle" align="center">
                                                {{\Carbon\Carbon::parse($row->end)->format('j F Y')}}</td>
                                            <td style="vertical-align: middle">
                                                @if(now() < $row->start || now() > $row->end)
                                                    <span
                                                        class="badge badge-warning"> Telah Berjalan / Belum Berjalan</span>
                                                @else
                                                    <span class="badge badge-info">  Sedang Bejalan</span>
                                                @endif
                                            </td>
                                            <td style="vertical-align: middle" align="center">
                                                <div class="btn-group" role="group" aria-label="Basic example">
                                                    @if(now() < $row->start || now() > $row->end)
                                                        <button data-placement="left" data-toggle="tooltip" title="Edit"
                                                                type="button" class="btn btn-warning mr-1"
                                                                onclick="editBlogPost('{{$row->id}}','{{route('get.promo', ['id' => $row->id])}}')">
                                                            <i class="fa fa-edit"></i></button>
                                                    @endif
                                                    {{--                                                <form action="{{route('admin.reset')}}" id="update_form_{{$row->id}}"--}}
                                                    {{--                                                      method="post">--}}
                                                    {{--                                                    @CSRF--}}
                                                    {{--                                                    <input type="hidden" name="id" value="{{$row->id}}">--}}
                                                    {{--                                                </form>--}}
                                                    @if(\Illuminate\Support\Facades\Auth::user()->role == \App\Support\Role::OWNER)
                                                        @if(now() < $row->start || now() > $row->end)
                                                            <a href="{{route('delete.promo', ['id' => encrypt($row->id)])}}"
                                                               class="btn btn-danger delete-data" data-toggle="tooltip"
                                                               title="Delete" data-placement="right">
                                                                <i class="fas fa-trash-alt"></i></a>
                                                        @else
                                                            <a data-placement="top" data-toggle="tooltip" href="{{route('user.promo',['id' => encrypt($row->id)])}}"
                                                                    title="Daftar Penerima Voucher"
                                                                    type="button" class="btn btn-info mr-1">
                                                                <i class="fa fa-users"></i></a>

                                                            <button data-placement="top" data-toggle="tooltip"
                                                                    title="Sedang berjalan"
                                                                    type="button" class="btn btn-success mr-1">
                                                                <i class="fa fa-info"></i></button>
                                                        @endif
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <form method="post" id="form-mass">
                                    {{csrf_field()}}
                                    <input type="hidden" name="category_ids">
                                </form>
                                <form method="post" id="form-mass">
                                    {{csrf_field()}}
                                    <input type="hidden" name="post_ids">
                                </form>
                            </div>

                            <div id="content2" style="display: none;">
                                <form id="form-blogPost" method="post" action="{{route('add.promo')}}"
                                      enctype="multipart/form-data">
                                    {{csrf_field()}}
                                    <input type="hidden" name="_method">
                                    <input type="hidden" name="id">
                                    <input type="hidden" name="admin_id">

                                    <div class="row form-group">
                                        <div class="col has-feedback">
                                            <label for="promo_code">Voucher</label>
                                            <input id="promo_code" type="text" maxlength="191" name="promo_code"
                                                   class="form-control"
                                                   placeholder="Write its Voucher Name  here&hellip;" required>
                                            <span class="glyphicon glyphicon-text-width form-control-feedback"></span>
                                        </div>
                                    </div>

                                    <div class="row form-group has-feedback">
                                        <div class="col">
                                            <label for="description">Deskripsi</label>
                                            <textarea id="description" type="text" name="description"
                                                      class="summernote form-control"
                                                      placeholder="Write something about your post here&hellip;"></textarea>
                                            <span class="glyphicon glyphicon-text-height form-control-feedback"></span>
                                        </div>
                                    </div>

                                    <div class="row form-group">
                                        <div class="col">
                                            <label for="start-date">Dimulai Pada</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                </div>
                                                <input type="date" name="start" class="form-control"
                                                       onblur="set_end_date(this.value)"
                                                       id="start-date" required>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <label for="end-date">Berakhir Pada</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                </div>
                                                <input type="date" name="end" class="form-control"
                                                       id="end-date" required>

                                            </div>
                                        </div>

                                    </div>

                                    <div class="row form-group">
                                        <div class="col">
                                            <label for="discount">Besar Diskon</label>
                                            <div class="input-group mb-2">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><b>Rp</b></span>
                                                </div>
                                                <input id="discount" type="number" name="discount"
                                                       class="form-control" placeholder="1xxxxxx" required>
                                            </div>
                                        </div>

                                        <div class="col">
                                            <label for="discount">Minimal Belanja untuk mendapatkan voucher</label>
                                            <div class="input-group mb-2">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><b>Rp</b></span>
                                                </div>
                                                <input id="minim_beli" type="number" name="minim_beli"
                                                       class="form-control" placeholder="1xxxxxx" required>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row form-group">
                                        <div class="col">
                                            <label for="banner">Banner</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fa fa-images"></i></span>
                                                </div>
                                                <div class="custom-file">
                                                    <input id="banner" type="file" name="banner"
                                                           class="custom-file-input" accept="image/*"
                                                           onchange="readURL(this)" required>
                                                    <label class="custom-file-label" id="txt_banner">
                                                        Choose File</label>
                                                </div>
                                            </div>
                                            <div class="form-text text-muted">
                                                Ekstensi : jpg, jpeg, gif, png. Allowed size: < 5 MB
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col">
                                            <img src="" alt="" id="img_preview" class="img-thumbnail">
                                        </div>
                                    </div>

                                    <div class="row form-group">
                                        <div class="col">
                                            <button type="submit" class="btn btn-primary btn-block text-uppercase"
                                                    style="font-weight: 900">Submit
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="modal fade " id="blogCategoryModal" tabindex="-1" role="dialog"
         aria-labelledby="blogCategoryModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document" style="width: 100%">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Create Form</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form-blogCategory" method="post" action="{{route('admin.add')}}">
                    {{csrf_field()}}
                    <input type="hidden" name="_method">
                    <input type="hidden" name="id">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col">
                                <label for="name">Name <sup class="text-danger">*</sup></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-user"></i></span>
                                    </div>
                                    <input id="name" type="text" maxlength="191" name="name" class="form-control"
                                           placeholder="Write its name here&hellip;" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label for="name">Username <sup class="text-danger">*</sup></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-user"></i></span>
                                    </div>
                                    <input id="name_id" type="text" maxlength="191" name="username" class="form-control"
                                           placeholder="Write its name here&hellip;" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label for="name">email <sup class="text-danger">*</sup></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                                    </div>
                                    <input id="name_id" type="email" maxlength="191" name="email" class="form-control"
                                           placeholder="Write its name here&hellip;" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push("scripts")
    <script src="{{asset('admins/modules/datatables/datatables.min.js')}}"></script>
    <script src="{{asset('admins/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('admins/modules/datatables/Select-1.2.4/js/dataTables.select.min.js')}}"></script>
    <script src="{{asset('admins/modules/datatables/Buttons-1.5.6/js/buttons.dataTables.min.js')}}"></script>
    <script src="{{asset('admins/modules/jquery-ui/jquery-ui.min.js')}}"></script>
    <script src="{{asset('admins/modules/summernote/summernote-bs4.js')}}"></script>
    <script>
        $(function () {
            $('#start-date').attr({
                "min": new Date().toISOString().split("T")[0]
            });

            var export_filename = 'Blog Categories Table ({{now()->format('j F Y')}})',
                table = $("#dt-buttons").DataTable({
                    dom: "<'row'<'col-sm-12 col-md-3'l><'col-sm-12 col-md-5'B><'col-sm-12 col-md-4'f>>" +
                        "<'row'<'col-sm-12'tr>><'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                    columnDefs: [
                        {sortable: false, targets: 5},
                        {targets: 1, visible: false, searchable: false}
                    ],
                    buttons: [
                        {
                            text: '<strong class="text-uppercase"><i class="far fa-clipboard mr-2"></i>Copy</strong>',
                            extend: 'copy',
                            exportOptions: {
                                columns: [0, 2, 3, 4]
                            },
                            className: 'btn btn-warning assets-export-btn export-copy ttip'
                        }, {
                            text: '<strong class="text-uppercase"><i class="far fa-file-excel mr-2"></i>Excel</strong>',
                            extend: 'excel',
                            exportOptions: {
                                columns: [0, 2, 3, 4]
                            },
                            className: 'btn btn-success assets-export-btn export-xls ttip',
                            title: export_filename,
                            extension: '.xls'
                        }, {
                            text: '<strong class="text-uppercase"><i class="fa fa-print mr-2"></i>Print</strong>',
                            extend: 'print',
                            exportOptions: {
                                columns: [0, 2, 3, 4]
                            },
                            className: 'btn btn-info assets-select-btn export-print'
                        }, {
                            text: '<strong class="text-uppercase"><i class="fa fa-trash-alt mr-2"></i>Deletes</strong>',
                            className: 'btn btn-danger btn_massDelete'
                        }
                    ],
                    fnDrawCallback: function (oSettings) {
                        $('.use-nicescroll').getNiceScroll().resize();
                        $('[data-toggle="tooltip"]').tooltip();

                        $("#cb-all").on('click', function () {
                            if ($(this).is(":checked")) {
                                $("#dt-buttons tbody tr").addClass("terpilih")
                                    .find('.dt-checkboxes').prop("checked", true).trigger('change');
                            } else {
                                $("#dt-buttons tbody tr").removeClass("terpilih")
                                    .find('.dt-checkboxes').prop("checked", false).trigger('change');
                            }
                        });

                        $("#dt-buttons tbody tr").on("click", function () {
                            $(this).toggleClass("terpilih");
                            if ($(this).hasClass('terpilih')) {
                                $(this).find('.dt-checkboxes').prop("checked", true).trigger('change');
                            } else {
                                $(this).find('.dt-checkboxes').prop("checked", false).trigger('change');
                            }
                        });

                        $('.dt-checkboxes').on('click', function () {
                            if ($(this).is(':checked')) {
                                $(this).parent().parent().parent().addClass("terpilih");
                            } else {
                                $(this).parent().parent().parent().removeClass("terpilih");
                            }
                        });
                    },
                });
        });

        $("#btn_create").on('click', function () {
            $("#content1").toggle(300);
            $("#content2").toggle(300);
            $(this).toggleClass('btn-primary btn-outline-primary');
            $("#btn_create strong").html(function (i, v) {
                return v === '<i class="fas fa-plus mr-2"></i>Tambah Voucher' ?
                    '<i class="fas fa-th-list mr-2"></i>Daftar Voucher' : '<i class="fas fa-plus mr-2"></i>Tambah Voucher';
            });

            $(".fix-label-group .bootstrap-select").addClass('p-0');
            $(".fix-label-group .bootstrap-select button").css('border-color', '#e4e6fc');

            $("#form-blogPost").attr('action', '{{route('add.promo')}}');
            $("#form-blogPost input[name=_method], #form-blogPost input[name=id], #form-blogPost input[name=admin_id]").val(null);
            $("#promo_code, #start-date, #end-date, #discount, #banner").val(null);
            $('#description').summernote('code', null);
            $("#banner").attr('required', 'required');
            $("#txt_banner").text('Choose File');
            $("#form-blogPost button[type=submit]").text('Submit');
        });

        function set_end_date(value) {
            $('#end-date').attr({
                "min": value
            });
        }


        function createBlogCategory() {
            $("#blogCategoryModal").modal('show');
        }

        function editBlogCategory(id, name, name_id, caption) {
            $("#blogCategoryModal .modal-title").text('Edit Form');
            $("#form-blogCategory").attr('action', '{{route('update.promo')}}');
            $("#form-blogCategory input[name=_method]").val('PUT');
            $("#form-blogCategory input[name=id]").val(id);
            $("#form-blogCategory button[type=submit]").text('Save Changes');
            $('#_content').summernote('code', caption);
            $("#name").val(name);
            $("#name_id").val(name_id);
            $("#blogCategoryModal").modal('show');
        }

        function editBlogPost(id, url) {
            $("#content1").toggle(300);
            $("#content2").toggle(300);
            $("#btn_create").toggleClass('btn-primary btn-outline-primary');
            $("#btn_create strong").html(function (i, v) {
                return v === '<i class="fas fa-plus mr-2"></i>Tambah Promo' ?
                    '<i class="fas fa-th-list mr-2"></i>Daftar Promo' : '<i class="fas fa-plus mr-2"></i>Tambah Promo';
            });

            $(".fix-label-group .bootstrap-select").addClass('p-0');
            $(".fix-label-group .bootstrap-select button").css('border-color', '#e4e6fc');

            $("#form-blogPost").attr('action', '{{route('update.promo')}}');
            $("#form-blogPost input[name=_method]").val('PUT');
            $("#form-blogPost input[name=id]").val(id);
            $("#form-blogPost button[type=submit]").text('Save Changes');

            $.get(url, function (data) {
                // console.log(data.name.id);
                $("#form-blogPost input[name=admin_id]").val(data.admin_id);
                $("#promo_code").val(data.promo_code);
                $("#discount").val(data.discount);
                $("#start-date").val(data.start);
                $("#minim_beli").val(data.minim_beli);
                $("#end-date").attr({
                    "min": data.start,
                    "value": data.end
                });
                $('#description').summernote('code', data.description);
                $("#txt_banner").text(data.banner);
                $("#img_preview").attr('src', '{{asset('storage/voucher/banner')}}/' + data.banner);

            }).fail(function () {
                swal("Error!", "There's no any selected record!", "error");
            });
        }

        function show_swal_reset(id) {
            swal({
                title: 'Reset Password',
                text: 'Are you sure want to reset this users password? ' +
                    'Password will be set same with username',
                icon: 'warning',
                dangerMode: true,
                buttons: ["No", "Yes"],
                closeOnEsc: false,
                closeOnClickOutside: false,
            }).then((confirm) => {
                if (confirm) {
                    swal({icon: "success", buttons: false});
                    document.getElementById('update_form_' + id).submit();
                }
            });
        }

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $("#txt_banner").text(input.files[0].name);
                    $('#img_preview').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]); // convert to base64 string
            }
        }
    </script>
@endpush
