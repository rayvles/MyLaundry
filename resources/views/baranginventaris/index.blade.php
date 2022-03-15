@extends('admin.layouts.main')

@push('head')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('adminlte') }}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('adminlte') }}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('adminlte') }}/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="{{ asset('adminlte') }}/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('adminlte') }}/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
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
                <h3 class="card-title">Data Member</h3>
                <div class="card-tools">
                    <button onclick="createHandler('{{ route('baranginventaris.store') }}')"
                        class="btn btn-primary">
                        <i class="far fa-plus-square mr-1"></i>
                        <span>Add</span>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <table id="tableBaranginventaris" class="table table-hover table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Items Name</th>
                            <th>Brand Items</th>
                            <th>Qty</th>
                            <th>Condition</th>
                            <th>procurement date</th>
                            <th>Action</th>
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



<div class="modal fade" role="dialog" id="modalForm">
<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-body">
            <div class="card card-primary">
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

                        <div class="form-group">
                            <label for="">procurement date</label>
                            <input type="date" name="tanggal_pengadaan" class="form-control" id="qty">
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
</div>
</div>
   
                                        
                                        
@endsection

@push('script')
    <!-- DataTables  & Plugins -->
    <script src="{{ asset('adminlte') }}/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ asset('adminlte') }}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ asset('adminlte') }}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="{{ asset('adminlte') }}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="{{ asset('adminlte') }}/plugins/sweetalert2/sweetalert2.min.js"></script>
    <!-- Page Script -->
    
    <script>
         let table;
        $(function() {
            const tableOptions = {
                paging: true,
                lengthChange: false,
                searching: false,
                ordering: true,
                info: true,
                autoWidth: false,
                responsive: true,
                ajax: {
                    url: '{{ route('baranginventaris.data') }}',
                },
                columns: [{
                        data: 'DT_RowIndex'
                    },
                    {
                        data: 'nama_barang'
                    },
                    {
                        data: 'merk_barang'
                    },
                    {
                        data: 'qty'
                    },
                    {
                        data: 'kondisi'
                    },
                    {
                        data: 'tanggal_pengadaan'
                    },
                    {
                        data: 'action',
                        searchable: false,
                        sortable: false
                    }
                ]
            };
            table = $('#tableBaranginventaris').DataTable(tableOptions);
        });
   
        
    </script>
@endpush
