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
                        <form id="formbuku">
                          <div class="card-body">
                            <div class="form-group col-md-6">
                              <label for="exampleInputEmail1">Id</label>
                              <input type="text" class="form-control" name="id_buku" id="id" id="exampleInputEmail1">
                            </div>
                            <div class="form-group col-md-6">
                              <label for="exampleInputPassword1">Judul Buku</label>
                              <input type="text" class="form-control" id="judul_buku" name="judul_buku" id="exampleInputPassword1">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="exampleInputPassword1">Pengarang</label>
                                <input type="text" class="form-control" id="pengarang" name="pengarang" id="exampleInputPassword1">
                              </div>
                              <div class="form-group col-md-6">
                                <label for="exampleInputPassword1">Tahun Terbit</label>
                                <select name="tahun_terbit" id="" class="form-control">
                                    @for ($i = 1800; $i <= (int) date('Y'); $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                              </div>
                              <div class="form-group col-md-6">
                                <label for="exampleInputPassword1">Harga Buku</label>
                                <input type="number" class="form-control" id="" name="harga_buku" id="exampleInputPassword1">
                              </div>
                              <div class="form-group col-md-6">
                                <label for="exampleInputPassword1">Qty</label>
                                <input type="number" class="form-control" id="" name="qty" id="exampleInputPassword1">
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
                              <option value="id_buku">ID</option>
                              <option value="judul_buku">Judul Buku</option>
                              <option value="pengarang">Pengarang</option>
                              <option value="tahun_terbit">Tahun Terbit</option>
                              <option value="harga_buku">Harga Buku</option>
                              <option value="qty">Qty</option>
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
                         
                        <div class="card-tools ml-2 mt-3 col-md-3" data-widget="sidebar-search">
                            <input class="form-control form-control-sidebar" id="filter" type="search" placeholder="Search" aria-label="Search">
                        </div>
                        <div class="card-body">
                            <table id="tblBuku" class="table table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Judul Buku</th>
                                        <th>Pengarang</th>
                                        <th>Tahun Terbit</th>
                                        <th>Harga Buku</th>
                                        <th>Qty</th>
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

  let arrBuku;
  let bukuFilter;


function insert(){
    console.log('insert')
    const form = $('#formbuku').serializeArray()
    console.log(form)
    let newData = {}
    form.forEach(function(item, index) { 
        let name = item['name']
        let value = (name === 'id_buku' || 
                     name === 'qty' ||
                     name === 'harga' 
                     ? Number(item ['value']):item['value']) //ini adalah ternary operator
        newData[name] = value
    })
    console.log(newData)
arrBuku.push(newData);
localStorage.setItem('arrBuku',JSON.stringify(arrBuku));
return newData

} 
//after load
$(function(){
//initialize
arrBuku = bukuFilter = JSON.parse(localStorage.getItem('arrBuku')) || []
    // console.log(dataBuku)
    $('#tblBuku tbody').html(showData())

//Events itu adalah pemicu dari perintah yang akan di panggil
//yang di panggil itu bukan tombol nya tapi yang di ambil adalah komponennya
$('#formbuku').on('submit', function(e){
    e.preventDefault();
    insert()
    $('#tblBuku tbody').html(showData())
}) 

})

function showData(){
let row =''

if(bukuFilter.length==0){
    return row = `<tr><td colspan="6">Belum ada data</td></tr>`
}
bukuFilter.forEach(function(item,index){
    row += `<tr>`
    row += `<td>${item['id_buku']}</td>`
    row += `<td>${item['judul_buku']}</td>`
    row += `<td>${item['pengarang']}</td>`
    row += `<td>${item['tahun_terbit']}</td>`
    row += `<td>${item['harga_buku']}</td>`
    row += `<td>${item['qty']}</td>`
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

    // $('#sorting-insert').on('click',function(){
    //   event.preventDefault()
    //   insertionSort(arrBuku,'id_buku')
    //   console.log(arrBuku);
    //    $('#tblBuku tbody').html(showData())
      
    // })

    $('#sort-direction').on('change', function(e) {
        insertionSort(bukuFilter, $('#sort-by').val(), $(this).val());
        $('#tblBuku tbody').html(showData())
    });
    $('#sort-by').on('change', function(e) {
        insertionSort(bukuFilter, $(this).val(), $('#sort-direction').val());
        $('#tblBuku tbody').html(showData())
    });

    const filterbuku = (keyword) => {
            // Array untuk menampung data yang difilte
            let arr = [];
            // Mengecek apakah data di dalam array books / buku mengandung kata kunci yang dikirim menggunakan method .includes()
            // Karena method .includes() membandingkan string secara case sensitive, maka string diubah ke huruf kecil terlebih dahulu
            keyword = keyword.toLowerCase();
            for (let i = 0; i < arrBuku.length; i++) {
                // Khusus untuk id, qty, price, dan year karena berupa number maka harus diubah ke bentuk string ".toString()" agar bisa menggunakan method .includes()
                if (arrBuku[i].id_buku.toString().toLowerCase().includes(keyword) ||
                    arrBuku[i].judul_buku.toLowerCase().includes(keyword) ||
                    arrBuku[i].pengarang.toLowerCase().includes(keyword) ||
                    arrBuku[i].tahun_terbit.toString().toLowerCase().includes(keyword) ||
                    arrBuku[i].harga_buku.toString().toLowerCase().includes(keyword) ||
                    arrBuku[i].qty.toString().toLowerCase().includes(keyword)
                ) {
                    // Jika kondisi terpenuhi, maka data array dengan index ke-i dimasukan ke dalam array penampung
                    arr.push(arrBuku[i]);
                }
            }
            bukuFilter = arr;
        }

        // Event ketika inputan filter diubah / diisi
        $('#filter').on('change keydown', function() {
                setTimeout(() => {
                    filterbuku($(this).val());
                    console.log(bukuFilter);
                    $('#tblBuku tbody').html(showData())
                });
            })

    </script>
@endpush