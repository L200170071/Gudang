
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Data Barang Jadi </h6> 
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Production Order</th>
                      <th>Kode Production</th>
                      <th>Part Number</th>
                      <th>Description</th>
                      <th>Date</th>
                      <th>Quantity</th>
                      <th>ACC</th>
                      <th>Reject</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $i = 1; ?>
                    <?php

                    $queryHasil = "SELECT 
                    `data_hasil_produksi`.`id_part`,
                    `data_stock_barang`.`production_order`,
                    `data_hasil_produksi`.`tanggal`,
                    `data_hasil_produksi`.`kode_produksi`,
                    `data_hasil_produksi`.`part_number`,
                    `data_hasil_produksi`.`received`,
                    `data_hasil_produksi`.`rejected`,
                    `data_hasil_produksi`.`quatity_total`,
                    `data_hasil_produksi`.`diskripsi`,
                    `data_hasil_produksi`.`ket`,
                    `data_stock_barang`.`lokasi`,
                    `data_hasil_produksi`.`sementara`
                     FROM `data_hasil_produksi`
                    INNER JOIN `data_stock_barang` ON `data_stock_barang`.`kode_produksi` = `data_hasil_produksi`.`kode_produksi` ORDER BY `data_hasil_produksi`.`id_part` DESC";
                    $data_hasil_produksi = $this->db->query($queryHasil)->result_array();

                    foreach($data_hasil_produksi as $dm) :?>
                    <tr>

                    <?php if($dm['ket'] == ''){ ?>
                      <td><?= $i; ?></td>
                      <td><?= $dm['production_order']; ?></td>
                      <td><?= $dm['kode_produksi']; ?></td>
                      <td><?= $dm['part_number']; ?></td>
                      <td><?= $dm['diskripsi']; ?></td>
                      <td><?= $dm['tanggal']; ?></td>
                      <td><?= $dm['quatity_total']; ?></td>
                      <td><?= $dm['received']; ?></td>
                      <td><?= $dm['rejected']; ?></td>
                      <td><i style="color: green; font-size: 35px;" class="fa fa-check"></i></button></td>
                      <?php }else{ ?>
                        <td style="background-color: #A9A9A9; color: red"><?= $i; ?></td>
                        <td style="background-color: #A9A9A9; color: red"><?= $dm['production_order']; ?></td>
                        <td style="background-color: #A9A9A9; color: red"><?= $dm['kode_produksi']; ?></td>
                        <td style="background-color: #A9A9A9; color: red"><?= $dm['part_number']; ?></td>
                        <td style="background-color: #A9A9A9; color: red"><?= $dm['diskripsi']; ?></td>
                        <td style="background-color: #A9A9A9; color: red"><?= $dm['tanggal']; ?></td>
                        <td style="background-color: #A9A9A9; color: red"><?= $dm['quatity_total']; ?></td>
                        <td style="background-color: #A9A9A9; color: red"><?= $dm['received']; ?></td>
                        <td style="background-color: #A9A9A9; color: red"><?= $dm['rejected']; ?></td>
                        <td style="background-color: #A9A9A9; color: red">
                          <div class="form-check">
                            <!-- <a href="<?= base_url("Jadi/Update_acc/".$dm['id_part']."/".$dm['rejected']."/".$dm['part_number']."/".$dm['kode_produksi']."/".$dm['diskripsi']."/".$dm['lokasi']) ?>"><input type="checkbox" class="form-check-input" id="acc" name="acc" value="<?= $dm['quatity_total']; ?>"></a> -->
                            <center><button class="btn-sm btn-success" data-toggle="modal" data-target="#newAnnouncementStok<?= $dm['id_part'] ?>"><i class="fa fa-plus"></i> </button></center>
                          </div> 
                        </td>
                        <?php } ?>
                    </tr>
                    <?php $i++; ?>
                    <?php endforeach ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

<!-- Modal stok -->
<?php $no = 0;
  foreach($data_hasil_produksi as $dm) : $no++; ?>
  <div class="modal fade" id="newAnnouncementStok<?= $dm['id_part'] ?>" tabindex="-1" aria-labelledby="newAnnouncementStokLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="newAnnouncementStokLabel">Memasukan barang</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <table>
              <tr>
                <td style="width: 50%;">
                  <form method="post" action="<?php echo base_url().'Jadi/Acc'; ?>">
                      <input type="hidden" name="id_part_satu" id="id_part_satu" class="form-control" value="<?= $dm['id_part'] ?>">
                      <input type="hidden" name="part_number" id="part_number" class="form-control" value="<?= $dm['part_number'] ?>">
                      <input type="hidden" name="kode_produksi" id="kode_produksi" class="form-control" value="<?= $dm['kode_produksi'] ?>">
                      <input type="hidden" name="diskripsi" id="diskripsi" class="form-control" value="<?= $dm['diskripsi'] ?>">
                      <input type="hidden" name="quatity_total" id="quatity_total" class="form-control" value="<?= $dm['quatity_total'] ?>">
                      <input type="hidden" name="tanggal" id="tanggal" class="form-control" value="<?= $dm['tanggal'] ?>">
                      <input type="hidden" name="lokasi" id="lokasi" class="form-control" value="<?= $dm['lokasi'] ?>">
                      <div class="form-group">
                        <h6>Quantity</h6>
                        <input type="text" name="quatity_masuk" id="quatity_masuk" class="form-control" value="0">
                      </div>
                      <!-- <h6>Nama Barang</h6> -->
                      <input type="text" style="width: 50%;" name="sementara_satu" hidden id="sementara_satu" readonly class="form-control" value="<?= $dm['sementara'] ?>"> <button type="submit" class="btn btn-info mb-3 btn-xs">ACC</button>
                  </form>
                </td>
                <td style="width: 50%;">
                  <!-- <form method="post" action="<?php echo base_url().'Jadi/Reject'; ?>">
                      <center><input type="hidden" name="id_part_dua" id="id_part_dua" class="form-control" value="<?= $dm['id_part'] ?>">
                      <h6>Nama Barang</h6> -->
                      <!-- <input type="text" style="width: 50%;" name="sementara_dua" hidden id="sementara_dua" readonly class="form-control" value="<?= $dm['sementara'] ?>"> <button type="submit" class="btn btn-danger mb-3 btn-xs">Reject</button></center> 
                  </form> -->
                </td>
              </tr>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php endforeach; ?>