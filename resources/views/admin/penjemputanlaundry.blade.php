@extends('admin.layouts.main')

@push('head')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('adminlte') }}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('adminlte') }}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{ asset('adminlte') }}/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <style>
        /* Labels for checked inputs */
        input[name="role"]+label {
            border: 1px solid #CED4DA;
            cursor: pointer;
            transition: .3s;
            box-shadow: none;
        }

        input[name="role"]:checked+label {
            background-color: #007BFF;
            color: #ffffff;
            border: 1px solid #007BFF;
            box-shadow: 1px 0 8px rgba(0, 0, 0, 0.1);
        }

    </style>
@endpush

@section('content-header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Penjemputan Laundry</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/admin">Admin</a></li>
                    <li class="breadcrumb-item active">Penjemputan Laundry</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
@endsection


@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Data Penjemputan Laundry</h3>
                    
                    
                    {{-- Modal Input --}}
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title-" id="exampleModalLabel">Penjemputan Laundry</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                                <div class="card card">
                                    <div class="card-header">
                                        <h3 class="card-title">Input Penjemputan Laundry</h3>
                                    </div>
                                <form action="{{ route('penjemputanlaundry.store') }}" method="POST">
                                    
                                    @csrf
                                    <!-- /.card-body -->
                                    <div class="form-group">
                                        <label for="">Nama</label>
                                        <select name="id_member" class="form-control select2" id="id-outlet" >
                                        @foreach ($members as $member)
                                            <option value="{{ $member->id }}">{{ $member->nama }}</option>
                                        @endforeach
                                        </select>
                                    </div>
                                   
                                    <div class="form-group">
                                        <label for="nama">Nama Petugas </label>
                                        <input type="text" value="" name="petugas_penjemput" class="form-control" id="nama" placeholder="" required="required">
                                        
                                    </div>
                                    
                                    <div class="form-group">
                                    <label for="nama">Status Petugas </label>
                                    <select name="status" id="jenis" class="form-control">
                                        <option selected disabled>Select Type</option>
                                        <option value="tercatat">Tercatat</option>
                                        <option value="penjemputan">Penjemputan</option>
                                        <option value="selesai">Selesai</option>
                                    </select>
                                </div> 
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>
                                </form>
                                </div>
                            </div>
                          </div>
                        </div>
                      </div>
                   
                @can('manage-user')
                    <div class="card-tools">
                        <a type="button" data-toggle="modal" data-target="#exampleModal"  class="btn btn-sm btn-primary"><i class="far fa-plus-square"></i>
                            Add</a>
                    </div>
                @endcan
                <div class="card-tools mr-2">
                    <div class="dropdown ">
                        <button class="btn btn-sm btn-success dropdown-toggle" type="button" id="dropdownMenuButton"
                            data-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-upload mr-1"></i>
                            <span>Export</span>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" 
                            href="{{ route('penjemputanlaundry.export.excel') }}"
                            >XLSX</a>
                            
                        </div>
                    </div>
                </div>
                <div class="card-tools mr-2">
                <button type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#import-modal">
                    <i class="fas fa-download mr-2"></i><span>Import</span>
                </button>

                {{-- Modal Input --}}
                    <div class="modal fade" id="import-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title-" id="exampleModalLabel">Import Excel</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                                <div class="card card-primary">
                                    <div class="card-header">
                                        <h3 class="card-title">Import</h3>
                                    </div>
                                <form action="{{ route('penjemputanlaundry.import.excel') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <!-- /.card-body -->
                                    <div class="form-group ml-2 mr-2">
                                        <label for="nama">Excel</label>
                                        <input type="file" value="" name="file_import" class=" form-control" id="file" required="required">
                                    </div>
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>
                                </form>
                                </div>
                            </div>
                          </div>
                        </div>
                      </div>
            </div>

               
            
                </div>
                
                <div class="card-body">
                    <table id="penjemputanTable" class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name Pelanggan</th>
                                <th>Alamat Pelanggan</th>
                                <th>No hp pelanggan</th>
                                <th>Petugas Penjemput</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data_penjemputanlaundry as $penjemputanlaundry)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $penjemputanlaundry->member->nama }}</td>
                                    <td>{{ $penjemputanlaundry->member->alamat }}</td>
                                    <td>{{ $penjemputanlaundry->member->telepon }}</td>
                                    <td>{{ $penjemputanlaundry->petugas_penjemput }}</td>
                                    <td>
                                        <select data-update-url="{{ route('penjemputanlaundry.updateStatus', $penjemputanlaundry->id) }}"
                                             name="status" id="jenis" class="pilih-status form-control ">
                                            <option selected disabled>{{ $penjemputanlaundry->status }}</option>
                                            <option disabled>---- Pilih Status ----</option>
                                            <option value="tercatat">Tercatat</option>
                                            <option value="penjemputan">Penjemputan</option>
                                            <option value="selesai">Selesai</option>
                                        </select>
                                        
                                    </td>
                                    <td>
                                        @can('manage-user')
                                        <div class="dropdown d-inline">
                                            <button class="btn btn-info" type="button"
                                                id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
                                               <i class="fas fa-ellipsis-v"></i>
                                            </button>
                                            
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <a href=""
                                                    class="dropdown-item" data-toggle="modal" data-target="#editmodal{{ $loop->iteration }}"><i class="fas fa-edit"></i>
                                                    Edit Outlet</a>
                                                    <button class="dropdown-item" id="deleteBtn"
                                                    onclick="deleteHandler({{ $penjemputanlaundry->id }})"><i
                                                        class="fas fa-trash"></i>
                                                    Delete Outlet</button>
                                                   
                                            </div>
                                            @endcan
                                            @can('manage-owner-kasir')
                                            <div>
                                                Not having access!
                                            </div>
                                            @endcan
                                        </div>
                                    </td>
                                </tr>
                                
                                
                                <div class="modal fade" id="editmodal{{ $loop->iteration }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h5 class="modal-title-" id="exampleModalLabel">Penjemputan Laundry</h5>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                          </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h3 class="card-title">Penjemputan Laundry Update</h3>
                                                </div>
                                                <form action="{{ route('penjemputanlaundry.update', $penjemputanlaundry->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="card-body">
                                                        <label for="nama">Member</label>
                                                        <select name="id_member" class="form-control select2" id="id-outlet" >
                                                            @foreach ($members as $member)
                                                                <option {{ $member->id === $penjemputanlaundry->id_member ? 'selected' : '' }}
                                                                value="{{ $member->id }}">{{ $member->nama }}</option>
                                                            @endforeach
                                                            </select>
                                                        <div class="form-group">
                                                            <label for="nama">Nama Petugas</label>
                                                            <input type="text" value="{{ $penjemputanlaundry->petugas_penjemput }}" name="petugas_penjemput" class="form-control" id="nama" placeholder="" required="required">
                                                            
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="nama">Status Petugas </label>
                                                            <select name="status"  id="jenis" class="form-control">
                                                                {{-- <option selected disabled>Select Type</option> --}}
                                                                <option selected disabled>{{ $penjemputanlaundry->status}}</option>
                                                                <option disabled>---- Pilih Status ----</option>
                                                                <option value="tercatat">Tercatat</option>
                                                                <option value="penjemputan">Penjemputan</option>
                                                                <option value="selesai">Selesai</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="card-footer">
                                                        <button type="submit" class="btn btn-primary">Save</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>

                            @endforeach
                        </tbody>
                    </table>
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

    <script>
       const deleteHandler = function(penjemputanlaundryId) {
                        Swal.fire({
                            title: 'Are you Sure?',
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#FF8000',
                            cancelButtonColor: '#0AC519',
                            confirmButtonText: 'Yeah',
                        }).then((result) => {
                            if (!result.isConfirmed) return;
                            $.ajax({
                                url: `/admin/penjemputanlaundry/${penjemputanlaundryId}`,
                                type: 'DELETE',
                                headers: {
                                    'X-CSRF-token': "{{ csrf_token() }}"
                                },
                                success: function(res) {
                                    Toast.fire({
                                        icon: 'success',
                                        title: res.message
                                    });
                                },
                                error: function(err) {
                                    Toast.fire({
                                        icon: 'error',
                                        title: err.responseJSON.message ?? 'Error'
                                    });
                                }
                            });
                        });
                    }

                $("#penjemputanTable").on("change", "select.pilih-status", async function() {
                let url = $(this).data("update-url");
                try {
                    let res = await $.post(url, {
                        _token: $("[name=_token]").val(),
                        _method: "PUT",
                        status: $(this).val()
                    });
                    Toast.fire({
                        icon: 'success',
                        title: res.message
                     });
                } catch (err) {
                    Toast.fire({
                        icon: 'error',
                        title: err.responseJSON.message ?? 'Error'
                    });
                }
            });

            

            

    </script>
@endpush
