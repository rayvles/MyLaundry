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
                        <form id="add-karyawan-form">
                          <div class="card-body">
                            <div class="form-group col-md-6">
                              <label for="exampleInputEmail1">Id</label>
                              <input type="text" class="form-control" name="id" id="id" id="exampleInputEmail1">
                            </div>
                            <div class="form-group col-md-6">
                              <label for="exampleInputPassword1">Nama</label>
                              <input type="text" class="form-control" id="nama" name="nama" id="exampleInputPassword1">
                            </div>
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
                            <option value="nama">Nama</option>
                            <option value="gender">Jenis Kelamin</option>
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
                            <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                        </div>
                        <div class="card-body">
                            <table id="tableKaryawan" class="table table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Gender</th>
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
        let karyawan = [{
            'id' : 1,
            'nama' : 'Rajah Rayvles Pangkey',
            'jenis_kelamin' :'Laki-laki',
            
        }];

        $(function(){
            renderKaryawan();
        });

        const renderKaryawan = () => {
            let rows;
            karyawan.forEach(item=>{
                rows += `<tr>
                    <td>${item.id}<td>
                    <td>${item.nama}<td>
                    <td>${item.jenis_kelamin}<td>
                    <tr>`;
            });
            $('#tableKaryawan tbody').html(rows);
        }

        const addKaryawan = (data) => {
            karyawan.push(data)
            renderKaryawan();
        }

        $('#add-karyawan-form').on('submit',function(){
            event.preventDefault();
            let data = {};
            $(this).serializeArray().map((item)=>data[item.name] = item.name == 'id' ? parseInt(item.value) : item.value);
            addKaryawan(data);
        })

        // function insertionSort(arr, key)
        // {
        //     let i, j, id, value;
        //     for (i = 1; i < arr.lenght; i++)
        //     {
        //         value = arr[1];
        //         id = arr[1][key]
        //         j = i - 1;
        //         while (j >= 0 && arr[j][key] > id)
        //         {
        //             arr[j + 1] = arr[j];
        //             j = j - 1;
        //         }
        //         arr[j + 1] = value;
        //     }
        //     return arr
        // }

        // $('#sorting-insert').on('click',function(){
        //   event.preventDefault()
        //   karyawan = insertionSort(karyawan,'id')
        //   renderKaryawan()
        //   console.log(renderKaryawan);
        // })

        const swap = (arr, curr, min) => {
            let temp = arr[curr];
            arr[curr] = arr[min];
            arr[min] = temp;
        }

        const selectionSort = (arr, sortBy, sortDirection) => {
            let n = arr.length;
            for (let i = 0; i < n; i++) {
                let minIndex = i;
                for (let j = i + 1; j < n; j++) {
                    if (sortDirection === 'ASCENDING' && arr[minIndex][sortBy] > arr[j][sortBy]) {
                        minIndex = j;
                    }
                    if (sortDirection === 'DESCENDING' && arr[minIndex][sortBy] < arr[j][sortBy]) {
                        minIndex = j;
                    }
                }
                if (minIndex != i) {
                    swap(arr, i, minIndex);
                }
            }
        }

        $('#sort-direction').on('change', function(e) {
            selectionSort(karyawan, $('#sort-by').val(), $(this).val());
            renderKaryawan();
        });

        $('#sort-by').on('change', function(e) {
            selectionSort(karyawan, $(this).val(), $('#sort-direction').val());
            renderKaryawan();
        });

    </script>
@endpush