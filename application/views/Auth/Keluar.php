
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Data Barang Keluar</h6> 
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <div id="tampil_data">

                </div>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Part Number</th>
                      <th>Kode Production</th>
                      <th>Description</th>
                      <th>Quatity</th>
                      <th>Date</th>
                      <th>Location</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $i = 1; ?>
                    <?php
                    $queryMenu = "SELECT * FROM `data_barang_keluar`";
                    $data_barang_keluar = $this->db->query($queryMenu)->result_array();

                    foreach($data_barang_keluar as $dk) :?>
                    <tr>
                      <td><?= $i; ?></td>
                      <td><?= $dk['part_number']; ?></td>
                      <td><?= $dk['kode_produksi']; ?></td>
                      <td><?= $dk['diskripsi']; ?></td>
                      <td><?= $dk['quatity_total']; ?></td>
                      <td><?= $dk['tanggal']; ?></td>
                      <td><?= $dk['lokasi']; ?></td>
                      <td></div> 
                      <div class="btn-sm btn-danger" data-toggle="modal" data-target="#newAnnouncementEdit<?= $dk['id_part'] ?>"><center><i class="fa fa-trash"></i></center></td>
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

  <!-- Modal edit -->
  <?php $no = 0;
  foreach($data_barang_keluar as $dk) : $no++; ?>
  <div class="modal fade" id="newAnnouncementEdit<?= $dk['id_part'] ?>" tabindex="-1" aria-labelledby="newAnnouncementEditLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="newAnnouncementEditLabel">Apakah yakin di hapus?</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="post" action="<?php echo base_url().'Keluar/Hapus'; ?>">
            <div class="form-group">
              <input type="hidden" name="id_part" id="id_part" class="form-control" value="<?= $dk['id_part'] ?>">
              <!-- <span>Part Number</span> -->
              <input hidden readonly type="text" name="part_number" id="part_number" class="form-control" value="<?= $dk['part_number'] ?>">
            </div>
            <div class="form-group">
            <!-- <span>Kode Produksi</span> -->
              <input hidden readonly type="text" name="kode_produksi" id="kode_produksi" class="form-control" value="<?= $dk['kode_produksi'] ?>">
            </div>
            <div class="form-group">
            <!-- <span>Diskripsi</span> -->
              <input hidden readonly type="text" name="diskripsi" id="diskripsi" class="form-control" value="<?= $dk['diskripsi'] ?>">
            </div>
            <div class="form-group">
            <!-- <span>Total Dikeluarkan</span> -->
              <input hidden readonly type="text" name="quatity_total" id="quatity_total" class="form-control" value="<?= $dk['quatity_total'] ?>">
            </div>
            <div class="form-group">
            <!-- <span>Tanggal</span> -->
              <input type="text" name="tanggal" id="tanggal" class="form-control" value="<?= $dk['tanggal'] ?>" hidden>
            </div>
            <div class="form-group">
            <!-- <span>Lokasi</span> -->
              <input readonly hidden type="text" name="lokasi" id="lokasi" class="form-control" value="<?= $dk['lokasi'] ?>">
            </div>
            <button type="reset" class="btn btn-secondary mb-3" data-dismiss="modal">Reset</button>
            <button type="submit" class="btn btn-danger mb-3">Hapus</button>
          </form>
        </div>
      </div>
    </div>
  </div>
<?php endforeach; ?>