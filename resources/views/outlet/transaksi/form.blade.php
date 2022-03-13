<div class="collapse" id="formLaundry">
    <div class="card-body">
        <h3>form</h3>

        {{-- Data Awal Pelanggan --}}
      
        <div class="card">
            <div class="card-body">
                <form>
                    <div class="row col-12">
                    <div class="form-group row col-md-6">
                      <label for="staticemail" class="col-sm-4 col-form-label">Transaction Date</label>
                      <div class="col-sm-6">
                        <input type="date" class="form-control" value="{{ date('Y-m-d') }}" name="tgl">
                      </div>
                    </div>
                    <div class="form-group row col-md-6">
                      <label for="inputPassword" class="col-4 col-form-label">Estimated Completed</label>
                      <div class="col-6">
                        <input type="date" class="form-control ml-auto" value="{{ date('Y-m-d', strtotime(date('Y-m-d'). '+3day')) }}" name="deadline">
                      </div>
                    </div>
                </div>

                {{-- Modal Member --}}
                <div class="row col-12">
                  <div class="form-group row col-md-6">
                    <label for="" class="col-sm-4 col-form-label"><button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                      data-target="#modalMember"><i class="fas fa-plus"></i></button> Name Member</label>
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
                                              <input type="hidden" class="idMember" name="id_member" value="{{ $b->id }}">
                                          </td>
                                          <td>{{ $b->nama }}</td>
                                          <td>{{ $b->jenis_kelamin }}</td>
                                          <td>{{ $b->telepon }}</td>
                                          <td>{{ $b->alamat }}</td>
                                          <td> <button class="pilihMemberBtn btn btn-primary" type="button">Chose</button></td>
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
                            data-target="#modalPaket">Add Packets Laundry</button>
                        </div>
                    </div>
                    <div class="clearfix">&nbsp;</div>
                    <div class="row">
                      <table id="tblTransaksi" class="table table-striped table-bordered bulk_action">
                        <thead>
                          <tr>
                            <th>Name Packets</th>
                            <th>Price</th>
                            <th>Qty</th>
                            <th>Total</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td colspan="5" style="text-align:center;font-style:italic">There is No Data Yet</td>
                          </tr>
                        </tbody>
                        <tfoot>
                          <tr valign="bottom">
                            <td width="" colspan="3" align="right">Amount of pay</td>
                            <td><span id="subtotal">0</span></td>
                            <td rowspan="4">
                              <label for="">Payment</label>
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
                            <td colspan="3" align="right">Discount</td>
                            <td><input type="number" value="0" id="diskon" name="diskon" style="width: 140px"></td>
                          </tr>
                          <tr>
                            <td colspan="3" align="right">Tax
                              <input type="number" value="0" min="0" class="" name="pajak"
                              id="pajak-persen" size="2" style="width: 40px">
                            </td>
                            <td><span id="pajak-harga">0</span></td>
                          </tr>
                          <tr>
                            <td colspan="3" align="right">Additional costs</td>
                            <td><input type="number" name="biaya_tambahan" style="width:140px" value="0"></td>
                          </tr>
                          <tr style="background:black;color:white;font-weight:bold;font-size:1em">
                            <td colspan="3" align="right">Total Final Pay</td>
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
              <h5 class="modal-title" id="myModalLabel">Chose Packets</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
              </div>
              <div class="modal-body">
              <table id="tblPaket" class="table table-stripped table-compact">
                  <thead>
                  <tr>
                      <th>No.</th>
                      <th>Name</th>
                      <th>Price</th>
                      <th>Action</th>
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
                      <td> <button class="pilihPaketBtn btn btn-primary" type="button">Chose</button></td>
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