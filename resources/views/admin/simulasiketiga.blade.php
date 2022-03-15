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
                        <form id="formkaryawan">
                          <div class="card-body">
                            <div class="row">
                            <div class="col-md-6">
                            <div class="form-group col-md-6">
                              <label for="exampleInputEmail1">Id Karyawan</label>
                              <input type="number" class="form-control" name="id_karyawan" id="id" id="exampleInputEmail1">
                            </div>
                            <div class="form-group col-md-6">
                            <label class="form" for="exampleCheck1">Jenis Kelamin</label>
                            <div class="form-check">
                              <input type="radio" class="form-check-input" value="Laki-laki" name="jenis_kelamin" id="exampleCheck1">
                              <label class="form-check-label" for="exampleCheck1">Laki-laki</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" class="form-check-input" value="Perempuan" name="jenis_kelamin" id="exampleCheck1">
                                <label class="form-check-label" for="exampleCheck1">Perempuan</label>
                              </div>
                            </div>
                            <div class="form-group col-md-6">
                              <label for="exampleInputPassword1">Jumlah Anak</label>
                              <input type="number" class="form-control" id="" name="jumlah_anak" id="exampleInputPassword1">
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
                                <label for="exampleInputPassword1">Nama Karyawan</label>
                                <input type="text" class="form-control" id="judul_buku" name="nama_karyawan" id="exampleInputPassword1">
                              </div>
                              <div class="form-group col-md-6">
                              <label class="form" for="exampleCheck1">Status Menikah</label>
                            <div class="form-check">
                              <input type="radio" class="form-check-input" value="Single" name="status_menikah" id="exampleCheck1">
                              <label class="form-check-label" for="exampleCheck1">Single</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" class="form-check-input" value="Couple" name="status_menikah" id="exampleCheck1">
                                <label class="form-check-label" for="exampleCheck1">Couple</label>
                              </div>
                            </div>
                            <div class="form-group col-md-6">
                              <label for="exampleInputPassword1">Mulai Bekerja</label>
                              <input type="date" class="form-control" id="" name="date_kerja" id="exampleInputPassword1">
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
                              <option value="id_karyawan">ID</option>
                              <option value="jenis_kelamin">Jenis Kelamin</option>
                              <option value="jumlah_anak">Jumlah Anak</option>
                              <option value="nama_karyawan">Nama Karyawan</option>
                              <option value="status_menikah">Status menikah</option>
                              <option value="date_kerja">Date Kerja</option>
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
                            <table id="tblKaryawan" class="table table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Jumlah Anak</th>
                                        <th>Nama Karyawan</th>
                                        <th>Status</th>
                                        <th>Mulai Bekerja</th>
                                    </tr>
                                </thead>
                                <tbody>
                                        
                                </tbody>
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

  let arrKaryawan;
  let karyawanFilter;


function insert(){
    console.log('insert')
    const form = $('#formkaryawan').serializeArray()
    console.log(form)
    let newData = {}
    form.forEach(function(item, index) { 
        let name = item['name']
        let value = (name === 'id_karyawan' ||
                     name === 'jumlah_anak'
                     ? Number(item ['value']):item['value']) //
        newData[name] = value
    })
    console.log(newData)
arrKaryawan.push(newData);
localStorage.setItem('arrKaryawan',JSON.stringify(arrKaryawan));
return newData

} 
//after load
$(function(){
//initialize
arrKaryawan = karyawanFilter = JSON.parse(localStorage.getItem('arrKaryawan')) || []
    // console.log(dataBuku)
    $('#tblKaryawan tbody').html(showData())

//Events itu adalah pemicu dari perintah yang akan di panggil
//yang di panggil itu bukan tombol nya tapi yang di ambil adalah komponennya
$('#formkaryawan').on('submit', function(e){
    e.preventDefault();
    insert()
    $('#tblKaryawan tbody').html(showData())
}) 

})

function showData(){
let row =''

if(karyawanFilter.length==0){
    return row = `<tr><td colspan="6">Belum ada data</td></tr>`
}
karyawanFilter.forEach(function(item,index){
    row += `<tr>`
    row += `<td>${item['id_karyawan']}</td>`
    row += `<td>${item['jenis_kelamin']}</td>`
    row += `<td>${item['jumlah_anak']}</td>`
    row += `<td>${item['nama_karyawan']}</td>`
    row += `<td>${item['status_menikah']}</td>`
    row += `<td>${item['date_kerja']}</td>`
    row += `</tr>`
    })
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
        insertionSort(karyawanFilter, $('#sort-by').val(), $(this).val());
        $('#tblKaryawan tbody').html(showData())
    });
    $('#sort-by').on('change', function(e) {
        insertionSort(karyawanFilter, $(this).val(), $('#sort-direction').val());
        $('#tblKaryawan tbody').html(showData())
    });

    const filterkaryawan = (keyword) => {
            // Array untuk menampung data yang difilte
            let arr = [];
            // Mengecek apakah data di dalam array arrKaryawan / karyawan mengandung kata kunci yang dikirim menggunakan method .includes()
            // Karena method .includes() membandingkan string secara case sensitive, maka string diubah ke huruf kecil terlebih dahulu
            keyword = keyword.toLowerCase();
            for (let i = 0; i < arrKaryawan.length; i++) {
                // Khusus untuk id, jumlah anak, date_kerja,karena berupa number maka harus diubah ke bentuk string ".toString()" agar bisa menggunakan method .includes()
                if (arrKaryawan[i].id_karyawan.toString().toLowerCase().includes(keyword) ||
                    arrKaryawan[i].jenis_kelamin.toLowerCase().includes(keyword) ||
                    arrKaryawan[i].jumlah_anak.toString().toLowerCase().includes(keyword) ||
                    arrKaryawan[i].nama_karyawan.toLowerCase().includes(keyword) ||
                    arrKaryawan[i].status_menikah.toLowerCase().includes(keyword) ||
                    arrKaryawan[i].date_kerja.toString().toLowerCase().includes(keyword)
                ) {
                    // Jika kondisi terpenuhi, maka data array dengan index ke-i dimasukan ke dalam array penampung
                    arr.push(arrKaryawan[i]);
                }
            }
            karyawanFilter = arr;
        }

        // Event ketika inputan filter diubah / diisi
        $('#filter').on('change keydown', function() {
                setTimeout(() => {
                    filterkaryawan($(this).val());
                    console.log(karyawanFilter);
                    $('#tblKaryawan tbody').html(showData())
                });
            })

    </script>
@endpush