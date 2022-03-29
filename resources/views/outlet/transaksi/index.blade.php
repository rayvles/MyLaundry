@extends('admin.layouts.outlet')

@push('head')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('adminlte') }}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('adminlte') }}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{ asset('adminlte') }}/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <meta name="id_outlet" content="{{ $outlet->id }}">
@endpush

@section('content-header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Transaksi</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/">Outlet</a></li>
                    <li class="breadcrumb-item"><a href="/outlet/{{ $outlet->id }}">{{ $outlet->id }}</a></li>
                    <li class="breadcrumb-item active">Transaksi</li>
                </ol>
            </div>
        </div>
    </div>

    <!-- /.container-fluid -->

@endsection

@section('content')
    <div class="row">
        <div class="col">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                  <a class="nav-link active" id="nav-data" data-toggle="collapse" href="#dataLaundry" role="button" aria-expanded="false"
                  aria-controls="collapseExample"><i class="text-secondary">Data Laundry</i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active " id="nav-form" data-toggle="collapse" href="#formLaundry" role="button" aria-expanded="false"
                    aria-controls="collapseExample"><i class="text-secondary" ><i class="fas fa-plus nav-icon"></i>&nbsp;&nbsp;Laundry Baru</i></a>
                </li>

              </ul>

              <div class="card" style="border-top: 0px;">
                @if(session('success'))
                <div class="alert alert-success" role="alert" id="success-alert">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="close"></button>
                    <span aria-hidden="true">&times;</span>
                </div>
                @endif
                <form action="{{ route('transaksi.store',$outlet->id) }}" method="post">
                @csrf
                @include('outlet.transaksi.form')
                @include('outlet.transaksi.data')
                <input type="hidden" class="idMember" name="id_member" id="id_member" >
            </form>
            @include('outlet.transaksi.transaction_detail_modal')
            @include('outlet.transaksi.update_payment_modal')
            </div>
    </div>
</div>




@endsection

@push('script')
    <!-- DataTables  & Plugins -->
    <script src="{{ asset('js/transactions.js') }}"></script>
    <script src="{{ asset('js/apptransaksi.js') }}"></script>
    <script src="{{ asset('adminlte') }}/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ asset('adminlte') }}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ asset('adminlte') }}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="{{ asset('adminlte') }}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="{{ asset('adminlte') }}/plugins/sweetalert2/sweetalert2.min.js"></script>

    <script>
        $('#dataLaundry').collapse('show');

        $('#dataLaundry').on('show.bs.collapse',function(){
            $('#formLaundry').collapse('hide');
            $('#nav-form').removeClass('active');
            $('#nav-data').addClass('active');
        }),

        $('#formLaundry').on('show.bs.collapse',function(){
            $('#dataLaundry').collapse('hide');
            $('#nav-data').removeClass('active');
            $('#nav-form').addClass('active');
        });

        $(function () {
            $('#tblMember').DataTable({
                "paging": true,
                "aLengthMenu": [[1, 10, 25, 50, 100, -1], [5, 10, 25, 50, 100, "All"]],
                            "lengthChange": true,
                            "searching": true,
                            "ordering": true,
                            "info": true,
                            "autoWidth": false,
                            "responsive": true,
            });

        })

        // Pemilihan Member
            $('#tblMember').on('click','.pilihMemberBtn', function(){
                pilihMember(this)
                $('#modalMember').modal('hide')
            })
        //

        // Pemilihan Packet
        $('#tblPaket').on('click','.pilihPaketBtn', function(){
            pilihPaket(this)
            $('#modalPaket').modal('hide')
        })
        //


        // Function pilih member
            function pilihMember(x){
                const tr = $(x).closest('tr')
                const namaJK = tr.find('td:eq(1)').text()+"/"+tr.find('td:eq(2)').text()
                const biodata = tr.find('td:eq(4)').text()+"/"+tr.find('td:eq(3)').text()
                const idMember = tr.find('.idMember').val()
                $('#nama-pelanggan').text(namaJK)
                $('#biodata-pelanggan').text(biodata)
                $('#id_member').val(idMember)
            }
        // Function Pilih Packet
            function pilihPaket(x){
                const tr = $(x).closest('tr')
                const namaPaket = tr.find('td:eq(1)').text()
                const harga = tr.find('td:eq(2)').text()
                const idPaket = tr.find('.idPaket').val()

                let arrItemsId = $("#tblTransaksi tbody tr")
                .map(function(i, row) {
                    let id = $(row).find('input[name="id_paket[]"]').eq(0).val();
                    return parseInt(id || null);
                })
                .get();

            if (arrItemsId.some((id) => idPaket == id)) {
                let tr = $(`input[name="id_paket[]"][value="${idPaket}"]`).closest("tr");
                let inputQty = tr.find('input[name="qty[]"]');
                inputQty.val(function() {
                    return parseInt($(this).val() || 0) + 1;
                });
                inputQty.trigger("change");
            }
            else {



                let data = ''
                let tbody = $('#tblTransaksi tbody tr td').text()
                data += '<tr>'
                data += `<td> ${namaPaket} </td>`
                data += `<td>${harga}</td>`;
                data += `<input type="hidden" name="id_paket[]" value="${idPaket}">`
                data += `<td><input type="number" value="1" min="1" class="qty" name="qty[]" size="2" style="width:40px"></td>`;
                data += `<td><label name="sub_total[]" class="subTotal">${harga}</label></td>`;
                data += `<td><button type="button" class="btnRemovePaket btn btn-danger"><span class="fas fa-times-circle"></span></button></td>`;
                data += '</tr>';

                if(tbody == 'Tidak Ada Data') $('#tblTransaksi tbody tr').remove();

                $('#tblTransaksi tbody').append(data);

            }
                subtotal += Number(harga)
                total = subtotal - Number($('#diskon').val()) + Number($('#pajak-harga').val())
                $('#subtotal').text(subtotal)
                $('#total').text(total)

            }
        //

        // initialize subtotal
            let subtotal = total = 0;
            $(function(){
                $('#tblMember').DataTable();
            })

        //function hitung total
            function hitungTotalAkhir(a){
                let qty = Number($(a).closest('tr').find('.qty').val());
                let harga = Number($(a).closest('tr').find('td:eq(1)').text());
                let subTotalAwal = Number($(a).closest('tr').find('.subTotal').text());
                let count = qty * harga;
                subtotal = subtotal - subTotalAwal + count
                total = subtotal - (Number($('#diskon').val()) + Number($('#pajak-harga').val()))
                $(a).closest('tr').find('.subTotal').text(count)
                $('#subtotal').text(subtotal)
                $('#total').text(total)


            }
        //

        function hitungDiskon() {
          let diskon = $('#diskon').val()
          let totalDiskon = subtotal * (diskon / 100);
            $('#diskon').text(totalDiskon);
            total = subtotal - totalDiskon
            $('#total').text(total)
      }

      function hitungPajak() {
          let pajak = $('#pajak-persen').val()
          let totalPajak = subtotal * (pajak / 100);
            $('#pajak-harga').text(totalPajak);
            total = subtotal + totalPajak
            $('#total').text(total)
      }

      $('#tblTransaksi').on('change keydown','#pajak-persen', function(){
          hitungPajak(this)
      })

      $('#tblTransaksi').on('change keydown','#diskon', function(){
          hitungDiskon(this)
      })

        // OnChange qty
            $('#tblTransaksi').on('change','.qty',function(){
                hitungTotalAkhir(this)
            })
        //



        // Remove paket
        $('#tblTransaksi').on('click','.btnRemovePaket',function(){
            let subTotalAwal = parseFloat($(this).closest('tr').find('.subTotal').text());
            subtotal -= subTotalAwal
            total -= subTotalAwal;

            $currentRow = $(this).closest('tr').remove();
            $('#subtotal').text(subtotal)
            $('#total').text(total)
        })

        $('[name="status_pembayaran"]').on('change', function(){
        if($(this).val() === "dibayar"){
          $('[name="tgl_bayar"]').val(null)
          $('[name="tgl_bayar"]').attr('readonly', true)
        } else {
          $('[name="tgl_bayar"]').attr('readonly', false)
        }
      })


    </script>
@endpush
