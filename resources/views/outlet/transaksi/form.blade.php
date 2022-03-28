<div class="collapse" id="formLaundry">
    <div class="card-body">
        <h3>form</h3>

        {{-- Data Awal Pelanggan --}}

        <div class="card">
            <div class="card-body">
                <form>
                    <div class="row col-12">
                    <div class="form-group row col-md-4">
                      <label for="staticemail" class="col-sm-4 col-form-label">Tanggal Transaksi</label>
                      <div class="col-sm-6">
                        <input type="date" class="form-control" value="{{ date('Y-m-d') }}" name="tgl">
                      </div>
                    </div>
                    <div class="form-group row col-md-4">
                      <label for="inputPassword" class="col-4 col-form-label">Estimasi Selesai</label>
                      <div class="col-6">
                        <input type="date" class="form-control ml-auto" value="{{ date('Y-m-d', strtotime(date('Y-m-d'). '+3day')) }}" name="deadline">
                      </div>
                    </div>
                    <div class="form-group row col-md-4">
                      <label for="inputPassword" class="col-4 col-form-label">Tanggal Bayar</label>
                      <div class="col-6">
                        <input type="date" class="form-control ml-auto" value="{{ date('Y-m-d', strtotime(date('Y-m-d'). '+3day')) }}" name="tgl_bayar">
                      </div>
                    </div>
                    <div class="form-group row col-md-4">
                        <label for="inputPassword" class="col-4 col-form-label">Jenis Diskon</label>
                        <div class="col-6">
                          <input type="text" hidden class="form-control ml-auto" value="persen" name="jenis_diskon">
                        </div>
                      </div>
                </div>

                {{-- Modal Member --}}
                <div class="row col-12">
                  <div class="form-group row col-md-6">
                    <label for="" class="col-sm-4 col-form-label"><button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                      data-target="#modalMember"><i class="fas fa-plus"></i></button> Nama Member</label>
                    <div class="col-sm-6" id="nama-pelanggan">
                      -
                    </div>
                  </div>
                    <div class="form-group row col-md-6">
                      <label for="inputPassword" class="col-4 col-form-label">Biodata</label>
                      <div class="col-6 ml-auto" id="biodata-pelanggan">
                        -
                      </div>
                    </div>
                </div>
              </form>
            </div>
          </div>

                      <!-- Modal -->

                          <div class="modal fade" id="modalMember" tabindex="-1" aria-labelledby="exampleModalLabel">
                              <div class="modal-dialog modal-lg" role="document">
                              <div class="modal-content">
                                  <div class="modal-header">
                                  <h5 class="modal-title" id="myModalLabel">Pilih Member</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                  </button>
                                  </div>
                                  <div class="modal-body">
                                  <table id="tblMember" class="table table-stripped table-compact">
                                      <thead>
                                      <tr>
                                          <th>No.</th>
                                          <th>Nama</th>
                                          <th>Jenis Kelamin</th>
                                          <th>Nomor Handphone</th>
                                          <th>Alamat</th>
                                          <th>Aksi</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      @foreach ($members as $member)
                                          <tr>
                                          <td>{{ $i = (!isset($i)?1:++$i) }}
                                              <input type="hidden" class="idMember" name="id_member" value="{{ $member->id }}">
                                          </td>
                                          <td>{{ $member->nama }}</td>
                                          <td>{{ $member->jenis_kelamin }}</td>
                                          <td>{{ $member->telepon }}</td>
                                          <td>{{ $member->alamat }}</td>
                                          <td> <button class="pilihMemberBtn btn btn-primary" type="button">Pilih</button></td>
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




              {{-- end modal Member --}}


        {{-- End Of Data Awal Pelanggan --}}

        {{-- Data Paket --}}

        <div class="card">
            <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <button type="button" class="btn btn-primary" id="tambahPaketBtn" data-toggle="modal"
                            data-target="#modalPaket">Tambah Paket Laundry Laundry</button>
                        </div>
                    </div>
                    <div class="clearfix">&nbsp;</div>
                    <div class="row">
                      <table id="tblTransaksi" class="table table-striped table-bordered bulk_action">
                        <thead>
                          <tr>
                            <th>Name Paket</th>
                            <th>Harga</th>
                            <th>Qty</th>
                            <th>Total</th>
                            <th>Aksi</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td colspan="5" style="text-align:center;font-style:italic">Tidak Ada Data</td>
                          </tr>
                        </tbody>
                        <tfoot>
                          <tr valign="bottom">
                            <td width="" colspan="3" align="right">Jumlah Pembayaran</td>
                            <td><span id="subtotal">0</span></td>
                            <td rowspan="4">
                              <label for="">Pembayaran</label>
                              <div>
                                <input type="radio" class="" name="status_pembayaran" id="" style="width:170px" value="dibayar">Bayar
                              </div>
                              <div>
                                <input type="radio" class="" name="status_pembayaran" id="" style="width:170px" value="belum_dibayar">Belum Dibayar
                              </div>
                              <div>
                                <button class="btn btn-primary" style="margin-top: 10px;width:170px" type="submit">Pay</button>
                              </div>
                            </td>
                          </tr>
                          <tr>
                            <td colspan="3" align="right">Diskon</td>
                            <td><input type="number" value="0" id="diskon" name="diskon" style="width: 140px"></td>
                          </tr>
                          <tr>
                            <td colspan="3" align="right">Pajak
                              <input type="number" value="0" min="0" class="" name="pajak"
                              id="pajak-persen" size="2" style="width: 40px">
                            </td>
                            <td><span id="pajak-harga">0</span></td>
                          </tr>
                          <tr>
                            <td colspan="3" align="right">Biaya Tambahan</td>
                            <td><input type="number" name="biaya_tambahan" style="width:140px" value="0"></td>
                          </tr>
                          <tr style="background:black;color:white;font-weight:bold;font-size:1em">
                            <td colspan="3" align="right">Total Pembayaran Akhir</td>
                            <td><span id="total">0</span></td>
                          </tr>
                        </tfoot>
                      </table>
                    </div>
            </div>
        </div>

        {{-- Modal Packets Link --}}
        <div class="modal fade" id="modalPaket" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
              <div class="modal-header">
              <h5 class="modal-title" id="myModalLabel">Pilih Paket</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
              </div>
              <div class="modal-body">
              <table id="tblPaket" class="table table-stripped table-compact">
                  <thead>
                  <tr>
                      <th>No.</th>
                      <th>Nama</th>
                      <th>Harga</th>
                      <th>Aksi</th>
                  </tr>
              </thead>
              <tbody>
                  @foreach ($paket as $b)
                      <tr>
                      <td>{{ $j = (!isset($j)?1:++$j) }}
                          <input type="hidden" class="idPaket" value="{{ $b->id }}">
                      </td>
                      <td>{{ $b->nama_paket }}</td>
                      <td>{{ $b->harga }}</td>
                      <td> <button class="pilihPaketBtn btn btn-primary" type="button">Pilih</button></td>
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
        {{-- end --}}

        {{-- End of Data Paket --}}

        {{-- Pembayaran --}}

        <div class="card">
            <div class="card-body">

            </div>
        </div>

        {{-- End Of Pembayaran --}}

    </div>
  </div>
