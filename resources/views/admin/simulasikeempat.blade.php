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
                          <h3 class="card-title">Simulasi 1</h3>
                        </div>
                        <!-- form start -->
                        <form id="formPembelianbarang">
                          <div class="card-body">
                            <div class="row">
                            <div class="col-md-6">
                            <div class="form-group col-md-6">
                              <label for="exampleInputEmail1">Id</label>
                              <input type="number" class="form-control" name="id" id="id" id="exampleInputEmail1">
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form" for="exampleCheck1">Nama Barang</label>
                                <select name="nama_barang" id="" class="form-control">
                                  <option value="Detergen">Detergen</option>
                                  <option value="Pewangi">Pewangi</option>
                                  <option value="Sepatu">Sepatu</option>
                                </select>
                              </div>
                            <div class="form-group col-md-6">
                              <label for="exampleInputPassword1">Jumlah Input</label>
                              <input type="number" class="form-control" id="" name="jumlah" id="exampleInputPassword1">
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
                                    <label for="exampleInputPassword1">Tanggal Beli</label>
                                    <input type="date" class="form-control" id="" name="tanggal_beli" id="exampleInputPassword1">
                                  </div>
                              <div class="form-group col-md-6">
                                <label for="exampleInputPassword1">Harga Barang</label>
                                <input type="number" class="form-control" id="judul_buku" name="harga_barang" id="exampleInputPassword1">
                              </div>
                              <div class="form-group col-md-6">
                                <label class="form" for="exampleCheck1">Jenis Pembayaran</label>
                                <div class="form-check">
                                  <input type="radio" class="form-check-input" value="Cash" name="jenis_pembayaran" id="exampleCheck1">
                                  <label class="form-check-label" for="exampleCheck1">Cash</label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" value="transfer" name="jenis_pembayaran" id="exampleCheck1">
                                    <label class="form-check-label" for="exampleCheck1">Transfer</label>
                                  </div>
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
                            <h3 class="card-title">Data Simulasi</h3>
                            
                        </div>
                        <div class="col-md-3 mt-2">
                            <div class="form-group">
                            <select name="jenis" id="sort-by" class="form-control">
                              <option value="id">ID</option>
                              <option value="nama_barang">Nama Barang</option>
                              <option value="jumlah">Jumlah Input</option>
                              <option value="tanggal_beli">Tanggal Beli</option>
                              <option value="harga_barang">Harga Barang</option>
                              <option value="jenis_pembayaran">Cash</option>
                              <option value="jenis_pembayaran">Transfer</option>
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

                        <div class="col-md-3">
                        <div class="form-check">
                            <input type="checkbox" id="cashfilter" class="form-check-input" value="Cash" name="jenis_pembayaran" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">Cash</label>
                          </div>
                         
                          <div class="form-check">
                            <input type="checkbox" id="transferfilter" class="form-check-input" value="Transfer" name="jenis_pembayaran" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">Transfer</label>
                          </div>
                        </div>

                        <div class="mt-3 col-md-3" data-widget="sidebar-search">
                          <div class="form-group">
                            <input class="form-control" id="filter" type="search" placeholder="Search" aria-label="Search">
                          </div>
                        </div>
                        
                        <div class="card-body">
                            <table id="tblPembelianbarang" class="table table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Tanggal Beli</th>
                                        <th>Nama Barang</th>
                                        <th>Harga</th>
                                        <th>Jumlah/Qty</th>
                                        <th>Jenis Pembayaran</th>
                                        <th>Diskon</th>
                                        <th>Total harga</th>
                                        {{-- <th>Tota Harga</th>
                                        <th>Jenis Bayar</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                        
                                </tbody>
                                <tfoot>
                                  <tr>
                                      <th colspan="6">TOTAL</th>
                                      <td id="total-diskon"></td>
                                      <td id="total-harga"></td>
                                      {{-- <td id="total-gaji-dengan-bonus"></td> --}}
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

  let arrPembelianbarang;
  let PembelianBarangFilter;
  const DISCOUNT = 15;

  

const formatter = Intl.NumberFormat("id-ID", {
  style: "currency",
  currency: "IDR",
});


function insert(){
    console.log('insert')
    const form = $('#formPembelianbarang').serializeArray()
    console.log(form)
    let newData = {}
    form.forEach(function(item, index) { 
        let name = item['name']
        let value = (name === 'id' ||
                     name === 'jumlah' ||
                     name === 'harga_barang'
                     ? Number(item ['value']):item['value']) //
        newData[name] = value
    })
    
    newData.discount = getTotalDiscount(newData.harga_barang * newData.jumlah);
    newData.totalHarga = newData.harga_barang * newData.jumlah;
    console.log(newData)
   
arrPembelianbarang.push(newData);

localStorage.setItem('arrPembelianbarang',JSON.stringify(arrPembelianbarang));
return newData

} 
//after load
$(function(){
//initialize
arrPembelianbarang = PembelianBarangFilter = JSON.parse(localStorage.getItem('arrPembelianbarang')) || []
    // console.log(dataBuku)
    $('#tblPembelianbarang tbody').html(showData())

//Events itu adalah pemicu dari perintah yang akan di panggil
//yang di panggil itu bukan tombol nya tapi yang di ambil adalah komponennya
$('#formPembelianbarang').on('submit', function(e){
    e.preventDefault();
    insert()
    
    $('#tblPembelianbarang tbody').html(showData())
    
    
}) 

})



function showData(){
  let totalDiskon = 0;
  let totalHarga = 0;
  let row =''

if(PembelianBarangFilter.length==0){
    return row = `<tr><td colspan="6">Belum ada data</td></tr>`
}
PembelianBarangFilter.forEach(function(item,index){
    row += `<tr colspan="6">`
    row += `<td>${item['id']}</td>`
    row += `<td>${item['tanggal_beli']}</td>`
    row += `<td>${item['nama_barang']}</td>`
    row += `<td>${item['harga_barang']}</td>`
    row += `<td>${item['jumlah']}</td>`
    row += `<td>${item['jenis_pembayaran']}</td>`
    row += `<td>${item['discount']}</td>`
    row += `<td>${item['totalHarga']}</td>`
    // row += `<td>${item['total_bonus']}</td>`
    // row += `<td>${item['total_gaji']}</td>`
    row += `</tr>`
    totalDiskon += item.discount;
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
        insertionSort(PembelianBarangFilter, $('#sort-by').val(), $(this).val());
        $('#tblPembelianbarang tbody').html(showData())
    });
    $('#sort-by').on('change', function(e) {
        insertionSort(PembelianBarangFilter, $(this).val(), $('#sort-direction').val());
        $('#tblPembelianbarang tbody').html(showData())
    });

    const filterPembelianbarang = (keyword) => {
            // Array untuk menampung data yang difilte
            let arr = [];
            // Mengecek apakah data di dalam array arrPembelianbarang / karyawan mengandung kata kunci yang dikirim menggunakan method .includes()
            // Karena method .includes() membandingkan string secara case sensitive, maka string diubah ke huruf kecil terlebih dahulu
            keyword = keyword.toLowerCase();
            for (let i = 0; i < arrPembelianbarang.length; i++) {
                // Khusus untuk id, jumlah anak, tanggal_beli,karena berupa number maka harus diubah ke bentuk string ".toString()" agar bisa menggunakan method .includes()
                if (arrPembelianbarang[i].id.toString().toLowerCase().includes(keyword) ||
                arrPembelianbarang[i].tanggal_beli.toString().toLowerCase().includes(keyword) ||
                    arrPembelianbarang[i].nama_barang.toLowerCase().includes(keyword) ||
                    arrPembelianbarang[i].harga_barang.toString().toLowerCase().includes(keyword) ||
                    arrPembelianbarang[i].jumlah.toString().toLowerCase().includes(keyword) ||
                    arrPembelianbarang[i].jenis_pembayaran.toString().toLowerCase().includes(keyword) ||
                    arrPembelianbarang[i].discount.toString().toLowerCase().includes(keyword) ||
                    arrPembelianbarang[i].totalHarga.toString().toLowerCase().includes(keyword)
                ) {
                    // Jika kondisi terpenuhi, maka data array dengan index ke-i dimasukan ke dalam array penampung
                    arr.push(arrPembelianbarang[i]);
                }
            }
            PembelianBarangFilter = arr;
        }

        // Event ketika inputan filter diubah / diisi
        $('#filter').on('change keydown', function() {
                setTimeout(() => {
                    filterPembelianbarang($(this).val());
                    console.log(PembelianBarangFilter);
                    $('#tblPembelianbarang tbody').html(showData())
                });
            })

            $('#cashfilter').on('change keydown', function() {
                setTimeout(() => {
                    filterPembelianbarang($(this).val());
                    console.log(PembelianBarangFilter);
                    $('#tblPembelianbarang tbody').html(showData())
                });
            })

            $('#transferfilter').on('change keydown', function() {
                setTimeout(() => {
                    filterPembelianbarang($(this).val());
                    console.log(PembelianBarangFilter);
                    $('#tblPembelianbarang tbody').html(showData())
                });
            })

      $('[name="nama_barang"]').on('change', function(){
        if($(this).val() === "Detergen" ){
          $('[name="harga_barang"]').val(15000)
        } 
      })

      $('[name="nama_barang"]').on('change', function(){
        if($(this).val() === "Pewangi"){
          $('[name="harga_barang"]').val(10000)
        }
      })

      $('[name="nama_barang"]').on('change', function(){
        if($(this).val() === "Sepatu"){
          $('[name="harga_barang"]').val(25000)
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
        // const calculateBonus = (arrPembelianbarang) => {
        //     let bonus = 0;
        //     let totalYear = calculateTotalYear(arrPembelianbarang.tanggal_beli);
        //     bonus += totalYear * BONUS_PER_TAHUN;
        //     bonus += arrPembelianbarang.jumlah <= MAX_BONUS_ANAK ?
        //         arrPembelianbarang.jumlah * BONUS_PER_ANAK :
        //         BONUS_PER_ANAK * MAX_BONUS_ANAK;
        //     bonus += arrPembelianbarang.nama_barang === 'Pewangi' ? BONUS_COUPLE : 0;
        //     return bonus;
        // }

        const getTotalDiscount = (harga_barang ) => {
            return harga_barang >= 50000 ? (DISCOUNT / 100) * harga_barang: 0;
        }

       

        
      


    </script>
@endpush