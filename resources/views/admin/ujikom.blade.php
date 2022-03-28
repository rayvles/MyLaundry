@extends('admin.layouts.main')

@section('content-header')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Simulasi</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Simulasi</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->
@endsection

@section('content')
        <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
          <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                          <h3 class="card-title">Ujikom Programan Dasar</h3>
                        </div>
                        <!-- form start -->
                        <form id="formTransaksibarang">
                          <div class="card-body">
                            <div class="row">
                            <div class="col-md-6">
                            <div class="form-group col-md-6">
                              <label for="exampleInputEmail1">Id Transaksi</label>
                              <input type="number" class="form-control" name="id" id="id" id="exampleInputEmail1">
                            </div>

                            <div class="form-group col-md-6">
                              <label for="exampleInputPassword1">No Hp/Wa</label>
                              <input type="teks" class="form-control" id="" name="no_hp" id="exampleInputPassword1">
                            </div>
                            <div class="form-group col-md-6">
                                <label class="" for="exampleCheck1">Jenis Cucian</label>
                                <select name="jenis_cucian" id="" class="form-control">
                                  <option value="express">Express</option>
                                  <option value="standar">Standar</option>
                                </select>
                              </div>
                              <div class="form-group col-md-6">
                                <label for="exampleInputPassword1">Harga Barang</label>
                                <input type="number" class="form-control" id="judul_buku" name="harga_barang" id="exampleInputPassword1">
                              </div>
                            </div>
                              {{-- <div class="form-group col-md-6">
                                <label for="exampleInputPassword1">Tahun Terbit</label>
                                <select name="tahun_terbit" id="" class="form-control">
                                    @for ($i = 1800; $i <= (int) date('Y'); $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                              </div> --}}
                              <div class="col-md-6">
                                <div class="form-group col-md-6">
                                    <label for="exampleInputPassword1">Nama Pelanggan</label>
                                    <input type="teks" class="form-control" id="" name="nama_pelanggan" id="exampleInputPassword1">
                                  </div>
                                  <div class="form-group col-md-6">
                                    <label for="exampleInputPassword1">Tanggal Cucian</label>
                                    <input type="date" class="form-control" id="" name="tanggal_cucian" id="exampleInputPassword1">
                                  </div>
                                  <div class="form-group col-md-6">
                                    <label for="exampleInputEmail1">Berat</label>
                                    <input type="number" class="form-control" name="berat" id="berat" id="exampleInputEmail1">
                                  </div>
                            </div>
                          </div>

                          </div>


                          <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                          </div>
                        </form>
                      </div>

                      {{-- Data Table --}}
                      <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Data Transaksi Ujikom</h3>

                        </div>
                        <div class="col-md-3 mt-2">
                            <div class="form-group">
                            <select name="jenis" id="sort-by" class="form-control">
                              <option value="id">ID Transaksi</option>
                              <option value="no_hp">No Hp/Wa</option>
                              <option value="jenis_cucian">Jenis Cucian</option>
                              <option value="nama_pelanggan">Nama Pelanggan</option>
                              <option value="tanggal_cucian">Tanggal Cucian</option>
                              <option value="berat">Berat</option>
                            </select>
                          </div>
                        </div>

                          <div class="col-md-3">
                            <div class="form-group">
                            <select name="jenis" id="sort-direction" class="form-control">
                              <option value="ASCENDING">ASCENDING</option>
                              <option value="DESCENDING">DESCENDING</option>
                            </select>
                          </div>
                        </div>



                        <div class="mt-3 col-md-3" data-widget="sidebar-search">
                          <div class="form-group">
                            <input class="form-control" id="filter" type="search" placeholder="Search" aria-label="Search">
                          </div>
                        </div>

                        <div class="card-body">
                            <table id="tblTransaksi" class="table table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>Id Transaksi</th>
                                        <th>Nama Pelanggan</th>
                                        <th>Kontak</th>
                                        <th>Tanggal Cucian</th>
                                        <th>Jenis Cucian</th>
                                        <th>Berat</th>
                                        <th>Harga</th>
                                        <th>Diskon</th>
                                        <th>Total Harga</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                                <tfoot>
                                  <tr>
                                      <th colspan="7">TOTAL</th>
                                      <td id="total-diskon"></td>
                                      <td id="total-harga"></td>

                                  </tr>
                              </tfoot>
                            </table>
                        </div>
                    </div>


                </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>
@endsection

@push('script')
    <script>
        //method

  let arrTransaksi;
  let TransaksiFilter;
  const DISCOUNT = 10;



const formatter = Intl.NumberFormat("id-ID", {
  style: "currency",
  currency: "IDR",
});


function insert(){
    console.log('insert')
    const form = $('#formTransaksibarang').serializeArray()
    console.log(form)
    let newData = {}
    form.forEach(function(item, index) {
        let name = item['name']
        let value = (name === 'id' ||
                     name === 'no_hp' ||
                     name === 'harga_barang'
                     ? Number(item ['value']):item['value']) //
        newData[name] = value
    })

    newData.discount = getTotalDiscount(newData.harga_barang * newData.berat);
    newData.totalHarga = newData.harga_barang * newData.berat;
    // console.log(newData)

arrTransaksi.push(newData);

localStorage.setItem('arrTransaksi',JSON.stringify(arrTransaksi));
return newData

}
//after load
$(function(){
//initialize
arrTransaksi = TransaksiFilter = JSON.parse(localStorage.getItem('arrTransaksi')) || []
    // console.log(dataBuku)
    $('#tblTransaksi tbody').html(showData())

//Events itu adalah pemicu dari perintah yang akan di panggil
//yang di panggil itu bukan tombol nya tapi yang di ambil adalah komponennya
$('#formTransaksibarang').on('submit', function(e){
    e.preventDefault();
    insert()

    $('#tblTransaksi tbody').html(showData())


})

})



function showData(){
  let totalDiskon = 0;
  let totalHarga = 0;
  let row =''

if(TransaksiFilter.length==0){
    return row = `<tr><td colspan="6">Belum ada data</td></tr>`
}
TransaksiFilter.forEach(function(item,index){
    row += `<tr colspan="6">`
    row += `<td>${item['id']}</td>`
    row += `<td>${item['nama_pelanggan']}</td>`
    row += `<td>${item['no_hp']}</td>`
    row += `<td>${item['tanggal_cucian']}</td>`
    row += `<td>${item['jenis_cucian']}</td>`
    row += `<td>${item['berat']}</td>`
    row += `<td>${item['harga_barang']}</td>`
    row += `<td>${item['discount']}</td>`
    row += `<td>${item['totalHarga']}</td>`
    // row += `<td>${item['total_bonus']}</td>`
    // row += `<td>${item['total_gaji']}</td>`
    row += `</tr>`
        totalDiskon += item.discount;
        console.log(item.discount);
        totalHarga += item.totalHarga;
    // totalGaji += item.total_gaji;
    })
    $('#total-diskon').html(formatter.format(totalDiskon));
            $('#total-harga').html(formatter.format(totalHarga));
    //         $('#total-gaji-dengan-bonus').html(formatter.format(totalGaji));

return row

}

function insertionSort(arr,key, SortingInsert)
    {
        let i, j, current;

        for (i = 1; i < arr.length; i++)
        {

            current = arr[i];
            j = i - 1;
            if(SortingInsert == 'ASCENDING'){
            while (j >= 0 && arr[j][key] > current[key])
            {
                arr[j + 1] = arr[j];
                j = j - 1;
            }
          } else {
            while (j >= 0 && arr[j][key] < current[key])
            {
                arr[j + 1] = arr[j];
                j = j - 1;
            }

          }
          arr[j + 1] = current;
        }

    }

    $('#sort-direction').on('change', function(e) {
        insertionSort(TransaksiFilter, $('#sort-by').val(), $(this).val());
        $('#tblTransaksi tbody').html(showData())
    });
    $('#sort-by').on('change', function(e) {
        insertionSort(TransaksiFilter, $(this).val(), $('#sort-direction').val());
        $('#tblTransaksi tbody').html(showData())
    });

    const filterPembelianbarang = (keyword) => {
            // Array untuk menampung data yang difilte
            let arr = [];
            // Mengecek apakah data di dalam array arrTransaksi / karyawan mengandung kata kunci yang dikirim menggunakan method .includes()
            // Karena method .includes() membandingkan string secara case sensitive, maka string diubah ke huruf kecil terlebih dahulu
            keyword = keyword.toLowerCase();
            for (let i = 0; i < arrTransaksi.length; i++) {
                // Khusus untuk id, berat anak, tanggal_beli,karena berupa number maka harus diubah ke bentuk string ".toString()" agar bisa menggunakan method .includes()
                if (arrTransaksi[i].id.toString().toLowerCase().includes(keyword) ||
                arrTransaksi[i].no_hp.toString().toLowerCase().includes(keyword) ||
                    arrTransaksi[i].jenis_cucian.toLowerCase().includes(keyword) ||
                    arrTransaksi[i].nama_pelanggan.toLowerCase().includes(keyword) ||
                    arrTransaksi[i].tanggal_cucian.toString().toLowerCase().includes(keyword) ||
                    arrTransaksi[i].berat.toString().toLowerCase().includes(keyword)
                    // arrTransaksi[i].discount.toString().toLowerCase().includes(keyword) ||
                    // arrTransaksi[i].totalHarga.toString().toLowerCase().includes(keyword)
                ) {
                    // Jika kondisi terpenuhi, maka data array dengan index ke-i dimasukan ke dalam array penampung
                    arr.push(arrTransaksi[i]);
                }
            }
            TransaksiFilter = arr;
        }

        // Event ketika inputan filter diubah / diisi
        $('#filter').on('change keydown', function() {
                setTimeout(() => {
                    filterPembelianbarang($(this).val());
                    console.log(TransaksiFilter);
                    $('#tblTransaksi tbody').html(showData())
                });
            })

            // $('#cashfilter').on('change keydown', function() {
            //     setTimeout(() => {
            //         filterPembelianbarang($(this).val());
            //         console.log(TransaksiFilter);
            //         $('#tblTransaksi tbody').html(showData())
            //     });
            // })

            // $('#transferfilter').on('change keydown', function() {
            //     setTimeout(() => {
            //         filterPembelianbarang($(this).val());
            //         console.log(TransaksiFilter);
            //         $('#tblTransaksi tbody').html(showData())
            //     });
            // })



      $('[name="jenis_cucian"]').on('change', function(){
        if($(this).val() === "express" ){
          $('[name="harga_barang"]').val(10000);

        }
      })

      $('[name="jenis_cucian"]').on('change', function(){
        if($(this).val() === "standar"){
          $('[name="harga_barang"]').val(7500);
        }
      })


    //    Menghitung lama bekerja dalam satuan tahun
    //    const calculateTotalYear = (tanggal_beli) => {
    //         tanggal_beli = new Date(tanggal_beli);
    //         let ageDifMs = Date.now() - tanggal_beli.getTime();
    //         if (ageDifMs > 0) {
    //             let ageDate = new Date(ageDifMs);
    //             return Math.abs(ageDate.getUTCFullYear() - 1970);
    //         }
    //         return 0;
    //     }
        // // Mengithung total tunjangan karyawan
        // const calculateBonus = (arrTransaksi) => {
        //     let bonus = 0;
        //     let totalYear = calculateTotalYear(arrTransaksi.tanggal_beli);
        //     bonus += totalYear * BONUS_PER_TAHUN;
        //     bonus += arrTransaksi.berat <= MAX_BONUS_ANAK ?
        //         arrTransaksi.berat * BONUS_PER_ANAK :
        //         BONUS_PER_ANAK * MAX_BONUS_ANAK;
        //     bonus += arrTransaksi.nama_barang === 'Pewangi' ? BONUS_COUPLE : 0;
        //     return bonus;
        // }

        const getTotalDiscount = (harga_barang ) => {
            return harga_barang >= 50000 ? (DISCOUNT / 100) * harga_barang: 0;
        }







    </script>
@endpush
