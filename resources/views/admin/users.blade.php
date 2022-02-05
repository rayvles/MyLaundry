@extends('admin.layouts.main')

@push('head')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('adminlte') }}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('adminlte') }}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{ asset('adminlte') }}/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('adminlte') }}/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="{{ asset('adminlte') }}/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <style>
        .select2-selection {
            padding-bottom: 30px !important;
        }

    </style>
@endpush

@section('content-header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>User</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/admin">Admin</a></li>
                    <li class="breadcrumb-item active">User</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
@endsection

@section('content')
<p>hallo</p>
    {{-- <div class="row">
        <div class="col">
            <!-- Card for the table -->
            <div id="tableCard" class="d-block">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Data User</h3>
                        <div class="card-tools">
                            <button onclick="createHandler('{{ route('users.store') }}')" class="btn btn-primary">
                                <i class="far fa-plus-square mr-1"></i>
                                <span>Register user</span>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="tableUser" class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Outlet</th>
                                    <th><i class="fas fa-cog"></i></th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Data goes here -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- Card for the form-->
            <div id="formCard" class="d-none">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Register User</h3>
                        <div class="card-tools">
                            <button onclick="showForm(false)" class="btn btn-secondary">Batal</button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="#" onsubmit="submitHandler()" method="POST">
                        @method('post')
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="nama">Name</label>
                                <input type="text" name="name" class="form-control" id="name" placeholder="Outlet">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" class="form-control" id="email"
                                    placeholder="name@domain.com">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="password" class="form-control" id="password"
                                    placeholder="name@domain.com">
                            </div>
                            <div class="form-group">
                                <label for="passwordConfirmation">Confirm Password</label>
                                <input type="password" name="password_confirmation" class="form-control"
                                    id="passwordConfirmation" placeholder="name@domain.com">
                            </div>
                            <div class="form-group">
                                <label for="">Penempatan Outlet</label>
                                <div>
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-link" data-toggle="modal"
                                        data-target="#selectOutletModal">
                                        &plus; Tambah
                                    </button>
                                </div>
                                <div class="row outlet-container">
                                    <!-- Outlet items goes here -->
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>

    <!-- Add outlet modal -->
    <div class="modal fade" id="selectOutletModal" tabindex="-1" aria-labelledby="selectOutletModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="selectOutletModalLabel">Pilih Outlet</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Outlet</label>
                        <select class="form-control select2" name="select_outlet"
                            style="width: 100%; padding-bottom: 50px;">
                            <option value="" disabled selected>-- Pilih Outlet --</option>
                            @foreach ($dataOutlet as $outlet)
                                <option value="{{ $outlet->id }}">{{ $outlet->nama }} - {{ $outlet->alamat }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="role">Role</label>
                        <div class="d-flex align-items-center" style="gap: 20px">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="select_role" id="roleOwner"
                                    value="owner">
                                <label class="form-check-label" for="roleOwner">
                                    <div class="card">
                                        <div class="card-body">
                                            <i class="fas fa-user-tie mr-1"></i>
                                            <span>Owner</span>
                                        </div>
                                    </div>
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="select_role" id="roleKasir"
                                    value="kasir">
                                <label class="form-check-label" for="roleKasir">
                                    <div class="card">
                                        <div class="card-body">
                                            <i class="fas fa-user mr-1"></i>
                                            <span>Kasir</span>
                                        </div>
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" onclick="addOutletHandler(this)">Tambahkan</button>
                </div>
            </div>
        </div>
    </div> --}}
@endsection

@push('script')
    <!-- DataTables  & Plugins -->
    <script src="{{ asset('adminlte') }}/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ asset('adminlte') }}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ asset('adminlte') }}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="{{ asset('adminlte') }}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="{{ asset('adminlte') }}/plugins/sweetalert2/sweetalert2.min.js"></script>
    <!-- Select2 -->
    <script src="{{ asset('adminlte') }}/plugins/select2/js/select2.full.min.js"></script>

    <script>
        // let table;
        // $(function() {
        //     const tableOptions = {
        //         paging: true,
        //         lengthChange: true,
        //         searching: true,
        //         ordering: true,
        //         autoWidth: false,
        //         responsive: true,
        //         ajax: {
        //             url: '{{ route('users.data') }}',
        //         },
        //         columns: [{
        //                 data: 'DT_RowIndex'
        //             },
        //             {
        //                 data: 'name'
        //             },
        //             {
        //                 data: 'email'
        //             },
        //             {
        //                 data: 'outlet'
        //             },
        //             {
        //                 data: 'action',
        //                 searchable: false,
        //                 sortable: false
        //             }
        //         ]
        //     }
        //     table = $('#tableUser').DataTable(tableOptions);

        //     $('.select2').select2({
        //         dropdownParent: $("#selectOutletModal")
        //     })
        // });

        // const createHandler = function(url) {
        //     clearErrors();
        //     clearOutlets();
        //     showForm(true);
        //     const card = $('#formCard');
        //     card.find('.card-title').text('Registrasi User');
        //     card.find('form')[0].reset();
        //     card.find('form').attr('action', url);
        //     card.find('[name=_method]').val('post');
        //     card.find('[name=name]').focus();
        // }

        // const editHandler = (url) => {
        //     clearErrors();
        //     clearOutlets();
        //     showForm(true);
        //     const card = $('#formCard');
        //     card.find('.card-title').text('Edit Data User');
        //     card.find('form')[0].reset();
        //     card.find('form').attr('action', url);
        //     card.find('[name=_method]').val('put');
        //     card.find('input').attr('disabled', true);
        //     card.find('select').attr('disabled', true);
        //     card.find('[name=nama]').focus();
        //     $.get(url)
        //         .done((res) => {
        //             const user = res.user;
        //             const outlet = user.outlet;
        //             console.log(outlet);
        //             card.find('[name=nama]').val(user.nama);
        //             card.find('[name=email]').val(user.email);
        //             card.find('[name=telepon]').val(user.telepon);
        //             outlet.forEach(o => {
        //                 let id = o.id;
        //                 let nama = o.nama;
        //                 let alamat = o.alamat;
        //                 let role = o.pivot.role;
        //                 renderOutletItem({
        //                     outlet_id: id,
        //                     outlet_text: `${nama} - ${alamat}`,
        //                     role
        //                 });
        //             });
        //         })
        //         .fail((err) => {
        //             Toast.fire({
        //                 icon: 'error',
        //                 title: 'Tidak dapat mengambil data'
        //             });
        //             return;
        //         }).always(() => {
        //             card.find('input').attr('disabled', false);
        //         });
        // }

        // const submitHandler = function() {
        //     event.preventDefault();
        //     const url = $('#formCard form').attr('action');
        //     const formData = $('#formCard form').serialize();
        //     $.post(url, formData)
        //         .done((res) => {
        //             table.ajax.reload();
        //             Toast.fire({
        //                 icon: 'success',
        //                 title: res.message
        //             });
        //             showForm(false);
        //         }).fail((err) => {
        //             if (err.status === 422) validationErrorHandler(err.responseJSON.errors);
        //             Toast.fire({
        //                 icon: 'error',
        //                 title: 'Data gagal disimpan'
        //             });
        //         });
        // }

        // const deleteHandler = function(url) {
        //     Swal.fire({
        //         title: 'Hapus User?',
        //         icon: 'warning',
        //         showCancelButton: true,
        //         confirmButtonColor: '#6C757D',
        //         cancelButtonColor: '#4DA3B8',
        //         confirmButtonText: 'Hapus',
        //     }).then((result) => {
        //         if (!result.isConfirmed) return;
        //         $.post(url, {
        //             '_token': $('[name=_token]').val(),
        //             '_method': 'delete'
        //         }).then((res) => {
        //             table.ajax.reload();
        //             Toast.fire({
        //                 icon: 'success',
        //                 title: res.message
        //             })
        //         }).catch((err) => {
        //             Toast.fire({
        //                 icon: 'error',
        //                 title: err.responseJSON.message ?? 'Error'
        //             });
        //         });
        //     });
        // }

        // const isOutletExist = function(id) {
        //     const outlets = $('[name="id_outlet[]"]').map(function() {
        //         return $(this).val()
        //     }).get();
        //     return outlets.some((o) => o == parseInt(id))
        // }

        // const addOutletHandler = function(el) {
        //     const modal = $(el).closest(".modal");
        //     const select_outlet = modal.find('[name="select_outlet"]');
        //     const select_role = modal.find('[name="select_role"]:checked');
        //     const outlet_id = select_outlet.val();
        //     const outlet_text = select_outlet.find('option:selected').text();
        //     const role = select_role.val();
        //     if (!role || role == '' || !outlet_id || outlet_id == '') return;
        //     if (isOutletExist(outlet_id)) {
        //         modal.modal("hide");
        //         $(select_role).prop('checked', false);
        //         $(select_outlet).val('').change();
        //         return;
        //     };
        //     renderOutletItem({
        //         outlet_id,
        //         outlet_text,
        //         role
        //     });
        //     modal.modal("hide");
        //     $(select_role).prop('checked', false);
        //     $(select_outlet).val('').change();
        //     return;
        // }

        // const renderOutletItem = function(item) {
        //     $('.outlet-container').append(`
        //     <div class="col-md-6 outlet-item">
        //         <input type="hidden" name="id_outlet[]" value="${item.outlet_id}" hidden>
        //         <input type="hidden" name="role[]" value="${item.role}" hidden>
        //         <div class="card">
        //             <div class="card-body d-flex justify-content-between">
        //                 <div>
        //                     <i class="fas fa-store mr-2" style="font-size: 24px"></i>
        //                 </div>
        //                 <div class="flex-grow-1">
        //                     <div>${item.outlet_text}</div>
        //                     <small class="d-block" style="text-transform: capitalize">${item.role}</small>
        //                 </div>
        //                 <div>
        //                     <button type="button" class="btn btn-secondary btn-sm" onclick="removeOutlet(this)"><i class="fas fa-minus"></i></button>
        //                 </div>
        //             </div>
        //         </div>
        //     </div>
        //     `);
        // }

        // const removeOutlet = function(el) {
        //     const container = $(el).closest('div.outlet-item');
        //     container.remove();
        // }

        // const clearOutlets = function() {
        //     $('.outlet-container').empty();
        // }

        // const showForm = function(show) {
        //     const formCard = $('#formCard');
        //     const tableCard = $('#tableCard');
        //     if (show) {
        //         formCard.removeClass('d-none');
        //         formCard.addClass('d-block');
        //         tableCard.removeClass('d-block');
        //         tableCard.addClass('d-none');
        //     } else {
        //         formCard.removeClass('d-block');
        //         formCard.addClass('d-none');
        //         tableCard.removeClass('d-none');
        //         tableCard.addClass('d-block');
        //     }
        // }
    </script>
@endpush
