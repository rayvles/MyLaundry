{{-- <div class="collapse" id="formLaundry">
    <div class="card-body">
        <h3>form</h3> --}}

        {{-- Data Awal Pelanggan --}}

        {{-- <div class="card">
            <div class="card-body">
                <form>
                    <div class="row col-12">
                    <div class="form-group row col-md-6">
                      <label for="staticemail" class="col-sm-4 col-form-label">Transaction Date</label>
                      <div class="col-sm-6">
                        <input type="date" class="form-control" value="{{ date('Y-m-d') }}">
                      </div>
                    </div>
                    <div class="form-group row col-md-6">
                      <label for="inputPassword" class="col-4 col-form-label">Estimated Completed</label>
                      <div class="col-6">
                        <input type="date" class="form-control ml-auto" value="{{ date('Y-m-d', strtotime(date('Y-m-d'). '+3day')) }}">
                      </div>
                    </div>
                </div>
                  </form>
            </div>
        </div> --}}

        {{-- End Of Data Awal Pelanggan --}}

        {{-- Data Paket --}}

        {{-- <div class="card">
            <div class="card-body">
                <form>
                    <div class="row col-12">
                    <div class="form-group row col-md-6">
                      <label for="" class="col-sm-4 col-form-label"><button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                        data-target="#modalMember"><i class="fas fa-plus"></i></button> Chose Member</label>
                      <div class="col-sm-6"> --}}

                        <!-- Modal -->

                            {{-- <div class="modal fade" id="modalMember" tabindex="-1" aria-labelledby="exampleModalLabel">
                                <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="myModalLabel">Chose Member</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                    <div class="modal-body">
                                    <table id="tblMember" class="table table-stripped table-compact">
                                        <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Name</th>
                                            <th>Gender</th>
                                            <th>Number Phone</th>
                                            <th>Address</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($member as $b)
                                            <tr>
                                            <td>{{ $i = (!isset($i)?1:++$i) }}
                                                <input type="hidden" class="idMember" name="idMember" value="{{ $b->id }}">
                                            </td>
                                            <td>{{ $b->nama }}</td>
                                            <td>{{ $b->jenis_kelamin }}</td>
                                            <td>{{ $b->telepon }}</td>
                                            <td>{{ $b->alamat }}</td>
                                            <td> <button class="pilihMemberBtn btn-primary" type="button">Chose</button></td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    </table>
                                    </div>
                                    <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                                </div>
                            </div>
                      </div>
                    </div>
                    <div class="form-group row col-md-6">
                      <label for="inputPassword" class="col-4 col-form-label">Biodata</label>
                      <div class="col-6 ml-auto">
                        -
                      </div>
                    </div>
                </div>
                  </form>
            </div>
        </div> --}}

        {{-- End of Data Paket --}}

        {{-- Pembayaran --}}

        {{-- <div class="card">
            <div class="card-body">
                
            </div>
        </div> --}}

        {{-- End Of Pembayaran --}}

    </div>
</div>