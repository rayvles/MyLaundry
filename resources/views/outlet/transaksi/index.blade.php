@extends('admin.layouts.outlet')

@push('head')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('adminlte') }}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('adminlte') }}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{ asset('adminlte') }}/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
@endpush

@section('content-header')
    {{-- <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Transaction</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/">Outlet</a></li>
                    <li class="breadcrumb-item"><a href="/outlet/{{ $outlet->id }}">{{ $outlet->id }}</a></li>
                    <li class="breadcrumb-item active">Transaction</li>
                </ol>
            </div>
        </div>
    </div> --}}
    
    <!-- /.container-fluid -->

@endsection

@section('content')
    {{-- <div class="row">
        <div class="col">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                  <a class="nav-link active" id="nav-data" data-toggle="collapse" href="#dataLaundry" role="button" aria-expanded="false"
                  aria-controls="collapseExample"><i class="text-secondary">Data Laundry</i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active " id="nav-form" data-toggle="collapse" href="#formLaundry" role="button" aria-expanded="false"
                    aria-controls="collapseExample"><i class="text-secondary" ><i class="fas fa-plus nav-icon"></i>&nbsp;&nbsp;New Laundry</i></a>
                </li>
               
              </ul>

              <div class="card" style="border-top: 0px;">
                @include('outlet.transaksi.form')
                @include('outlet.transaksi.data')
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

    <script>
        // $('#dataLaundry').collapse('show');
    
        // $('#dataLaundry').on('show.bs.collapse',function(){
        //     $('#formLaundry').collapse('hide');
        //     $('#nav-form').removeClass('active');
        //     $('#nav-data').addClass('active');
        // }),
    
        // $('#formLaundry').on('show.bs.collapse',function(){
        //     $('#dataLaundry').collapse('hide');
        //     $('#nav-data').removeClass('active');
        //     $('#nav-form').addClass('active');
        // });

        // $(function () {
        //     $('#tblMember').DataTable();
        // })
    </script>
@endpush
