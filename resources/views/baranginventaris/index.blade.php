@extends('admin.layouts.main')

@push('head')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('adminlte') }}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('adminlte') }}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('adminlte') }}/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="{{ asset('adminlte') }}/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <style>
        /* Labels for checked inputs */
        input[name="kondisi"]+label {
            border: 1px solid #CED4DA;
            cursor: pointer;
            transition: .3s;
            box-shadow: none;
        }

        input[name="kondisi"]:checked+label {
            background-color: #007BFF;
            color: #ffffff;
            border: 1px solid #007BFF;
            box-shadow: 1px 0 8px rgba(0, 0, 0, 0.1);
        }

    </style>
@endpush


@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Data Inventory Items</h3>
                    <div class="card-tools">
                        <button class="btn btn btn-primary" onclick="createHandler('{{ route('baranginventaris.store') }}')">
                            <i class="far fa-plus-square mr-1"></i><span>Add Inventory Items</span>
                        </button>
                        
                        </a>
                    </div>
                </div>
                <div class="card-body p-0">
                    <table id="baranginventaris-tb" class="table table-hover table-striped w-100">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Item Name</th>
                                <th>Brand Item</th>
                                <th>Qty</th>
                                <th>Condition</th>
                                <th>Procurement date</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Data goes here -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('bottom')
    <div class="modal fade" role="dialog" id="form-modal">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form action="#" onsubmit="submitHandler()" method="POST">
                    @method('post')
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Inventory Items</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Items Name</label>
                            <input type="text" name="nama_barang" class="form-control" id="name" placeholder="Items Name">
                        </div>
                        <div class="form-group">
                            <label for="email">Brand Items</label>
                            <input type="text" name="merk_barang" class="form-control" id="merk_barang" placeholder="Brand Items">
                        </div>
                       
                        
                        <div class="form-group">
                            <label for="password">Qty</label>
                            <input type="number" name="qty" class="form-control" id="qty">
                        </div>
                        
                        
                        <div class="form-group">
                            <label for="role">Condition</label>
                            <div class="row">
                                <div class="col-sm-4">
                                    <input class="d-none" type="radio" name="kondisi" id="kondisi-layak_pakai" value="layak_pakai">
                                    <label for="kondisi-layak_pakai" class="card">
                                        <div class="card-body">
                                            <span>Layak Pakai</span>
                                        </div>
                                    </label>
                                </div>
                                <div class="col-sm-4">
                                    <input class="d-none" type="radio" name="kondisi" id="kondisi-rusak_ringan" value="rusak_ringan">
                                    <label for="kondisi-rusak_ringan" class="card">
                                        <div class="card-body">
                                            <span>Rusak Ringan</span>
                                        </div>
                                    </label>
                                </div>
                                <div class="col-sm-4">
                                    <input class="d-none" type="radio" name="kondisi" id="kondisi-rusak_berat"
                                        value="rusak_berat">
                                    <label for="kondisi-rusak_berat" class="card">
                                        <div class="card-body">
                                            <span>Rusak Berat</span>
                                        </div>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                        <button type="submit" class="btn btn-primary modal-submit-button">Save</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endpush

@push('script')
    <!-- DataTables  & Plugins -->
    <script src="{{ asset('adminlte') }}/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ asset('adminlte') }}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js">
    </script>
    <script src="{{ asset('adminlte') }}/plugins/datatables-responsive/js/dataTables.responsive.min.js">
    </script>
    <script src="{{ asset('adminlte') }}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js">
    </script>
    <!-- Select2 -->
    <script src="{{ asset('adminlte') }}/plugins/select2/js/select2.full.min.js"></script>
    <!-- Page Script -->
    
    <script>
        let table;

        $(function() {
            const tableOptions = {
                ...DATATABLE_OPTIONS,
                ajax: '/admin/baranginventaris/datatable',
                columns: [{
                        data: 'DT_RowIndex',
                    },
                    {
                        data: 'nama_barang',
                    },
                    {
                        data: 'merk_barang',
                    },
                    {
                        data: 'qty',  
                    },
                    {
                        data: 'kondisi',
                        render: (kondisi) => {
                            let type;
                            let text;
                            switch (kondisi) {
                                case 'layak_pakai':
                                    type = 'info';
                                    text = 'Layak Pakai';
                                    break;
                                case 'rusak_ringan':
                                    type = 'warning';
                                    text = 'Rusak Ringan';
                                    break;
                                default:
                                    type = 'secondary';
                                    text = 'Rusak Berat';
                            }
                            return `<span class="badge badge-${type}">${text}</span>`;
                        }
                    },
                    {
                        data: 'tanggal_pengadaan',  
                    },
                    {
                        data: 'actions',
                        searchable: false,
                        sortable: false,
                    }
                ]
            }
            table = $('#baranginventaris-tb').DataTable(tableOptions);
            
        });
            // Initialize Select2 Elements
            // fetchOutletOptions();

        // const fetchOutletOptions = async () => {
        //     try {
        //         let res = await fetchData('/outlet/');
        //         let outletOptions = res.outlets.map((outlet, index) => {
        //             return {
        //                 id: outlet.id,
        //                 text: outlet.name,
        //             }
        //         });
        //         $('#id-outlet').select2({
        //             placeholder: "Pilih outlet",
        //             theme: 'bootstrap4',
        //             data: outletOptions,
        //         });
        //     } catch (err) {
        //         toast('Tidak dapat mengambil data outlet', 'error');
        //     }
        // }

        const createHandler = function(url) {
            clearErrors();
            const modal = $('#form-modal');
            modal.modal('show');
            modal.find('.modal-title').text('Inventory Items');
            modal.find('form')[0].reset();
            modal.find('form').attr('action', url);
            modal.find('[name=_method]').val('post');
        }


        const submitHandler = async () => {
            event.preventDefault();
            let url = $('#form-modal form').attr('action');
            let formData = $('#form-modal form').serialize();
            try {
                let res = await $.post(url, formData);
                $('#form-modal').modal('hide');
                toast(res.message, 'success');
                // table.ajax.reload();
            } catch (err) {
                if (err.status === 422) validationErrorHandler(err.responseJSON.errors);
                toast('Something went wrong!', 'error');
            }
        }

        // const editHandler = async (url) => {
        //     clearErrors();
        //     const modal = $('#form-modal');
        //     modal.modal('show');
        //     modal.find('.modal-title').text('Edit User');
        //     modal.find('form')[0].reset();
        //     modal.find('form').attr('action', url);
        //     modal.find('[name=_method]').val('put');
        //     modal.find('input').attr('disabled', true);
        //     modal.find('select').attr('disabled', true);

        //     try {
        //         let res = await fetchData(url);
        //         modal.find('[name=name]').val(res.user.name);
        //         modal.find('[name=email]').val(res.user.email);
        //         modal.find(`[name=id_outlet]`).val(res.user.id_outlet).trigger('change');
        //         modal.find(`[name=role][value='${res.user.role}']`).prop('checked', true);
        //     } catch (err) {
        //         toast('Something went Wrong!', 'error');
        //     }

        //     modal.find('input').attr('disabled', false);
        //     modal.find('select').attr('disabled', false);
        // }

        // const deleteHandler = async (url) => {
        //     let result = await Swal.fire({
        //         title: 'Delete User',
        //         text: 'Are You Sure Want To Delete This User?',
        //         icon: 'warning',
        //         showCancelButton: true,
        //         confirmButtonColor: '#FF8000',
        //         cancelButtonColor: '#0AC519',
        //         confirmButtonText: 'Delete',
        //         cancelButtonText: 'Cancel',
        //     });
        //     if (result.isConfirmed) {
        //         try {
        //             let res = await $.post(url, {
        //                 '_token': $('[name=_token]').val(),
        //                 '_method': 'delete'
        //             });
        //             toast(res.message, 'success');
        //             table.ajax.reload();
        //         } catch (err) {
        //             toast('Something Went Wrong!', 'error');
        //         }
        //     }
        // }

   
        
    </script>
@endpush
