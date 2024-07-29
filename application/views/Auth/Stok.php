
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Data Stok Barang </h6> 
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Production Order</th>
                      <th>Kode Production</th>
                      <th>Total</th>
                      <th>Part Number</th>
                      <th>Diskripsi</th>
                      <th>Tanggal</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $i = 1; ?>
                    <?php

                    foreach($data_stock_barang as $dm) :?>
                    <tr>
                      <td><?= $i; ?></td>
                      <td><?= $dm['production_order']; ?></td>
                      <td><?= $dm['kode_produksi']; ?></td>
                      <td><?= $dm['quatity']; ?></td>
                      <td><?= $dm['part_number']; ?></td>
                      <td><?= $dm['diskripsi']; ?></td>
                      <td><?= $dm['tanggal']; ?></td>
                      <td><!-- <div class="btn-sm btn-success" data-toggle="modal" data-target="#newAnnouncementEdit<?= $dm['id_part'] ?>"><i class="far fa-check-circle"></i> ACC</div> 
                      <div class="btn-sm btn-danger" data-toggle="modal" data-target="#newAnnouncementEditsatu<?= $dm['id_part'] ?>"><i class="fas fa-redo-alt"></i> Reject</div> -->
                      <center><button class="btn-sm btn-success" data-toggle="modal" data-target="#newAnnouncementStok<?= $dm['id_part'] ?>"><i class="fa fa-plus"></i> </button></center></td>
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
  foreach($data_stock_barang as $dm) : $no++; ?>
  <div class="modal fade" id="newAnnouncementEdit<?= $dm['id_part'] ?>" tabindex="-1" aria-labelledby="newAnnouncementEditLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="newAnnouncementEditLabel">Barang ACC</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="post" action="<?php echo base_url().'Stok/Update'; ?>">
            <div class="form-group">
              <input type="hidden" name="id_part" id="id_part" class="form-control" value="<?= $dm['id_part'] ?>">
              <h6>Nama Barang</h6>
              <input type="text" name="production_order" id="production_order" readonly class="form-control" value="<?= $dm['production_order'] ?>">
            </div>
            <div class="form-group">
              <h6>Kode Barang</h6>
              <input type="text" name="kode_produksi" id="kode_produksi" readonly class="form-control" value="<?= $dm['kode_produksi'] ?>">
            </div>
            <div class="form-group">
              <input type="text" name="diskripsi" hidden id="diskripsi" class="form-control" value="<?= $dm['diskripsi'] ?>">
            </div>
            <div class="form-group">
              <h6>Jumlah Stok</h6>
              <input type="text" name="quatity" readonly id="quatity" class="form-control" value="<?= $dm['quatity'] ?>">
            </div>
            <div class="form-group">
              <input type="text" name="part_number" hidden id="part_number" class="form-control" value="<?= $dm['part_number'] ?>">
            </div>
            <div class="form-group">
              <input type="text" name="tanggal" id="tanggal" hidden class="form-control" value="<?= $dm['tanggal'] ?>">
            </div>
            <div class="form-group">
              <input type="text" name="lokasi" id="lokasi" hidden class="form-control" value="<?= $dm['lokasi'] ?>">
            </div>
            <div class="form-group">
              <h6>Jumlah di ACC</h6>
              <input type="text" name="received" id="received" class="form-control">
            </div>
            <button type="reset" class="btn btn-secondary mb-3" data-dismiss="modal">Reset</button>
            <button type="submit" class="btn btn-success mb-3">Save</button>
          </form>
        </div>
      </div>
    </div>
  </div>
<?php endforeach; ?>

<!-- Modal edit -->
<?php $no = 0;
  foreach($data_stock_barang as $dm) : $no++; ?>
  <div class="modal fade" id="newAnnouncementEditsatu<?= $dm['id_part'] ?>" tabindex="-1" aria-labelledby="newAnnouncementEditsatuLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="newAnnouncementEditsatuLabel">Barang Rejected</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="post" action="<?php echo base_url().'Stok/Update_reject'; ?>">
            <div class="form-group">
              <input type="hidden" name="id_part" id="id_part" class="form-control" value="<?= $dm['id_part'] ?>">
              <h6>Nama Barang</h6>
              <input type="text" name="production_order" id="production_order" readonly class="form-control" value="<?= $dm['production_order'] ?>">
            </div>
            <div class="form-group">
              <h6>Kode Barang</h6>
              <input type="text" name="kode_produksi" id="kode_produksi" readonly class="form-control" value="<?= $dm['kode_produksi'] ?>">
            </div>
            <div class="form-group">
              <input type="text" name="diskripsi" hidden id="diskripsi" class="form-control" value="<?= $dm['diskripsi'] ?>">
            </div>
            <div class="form-group">
              <h6>Jumlah Stok</h6>
              <input type="text" name="quatity" readonly id="quatity" class="form-control" value="<?= $dm['quatity'] ?>">
            </div>
            <div class="form-group">
              <input type="text" name="part_number" hidden id="part_number" class="form-control" value="<?= $dm['part_number'] ?>">
            </div>
            <div class="form-group">
              <input type="text" name="tanggal" id="tanggal" hidden class="form-control" value="<?= $dm['tanggal'] ?>">
            </div>
            <div class="form-group">
              <input type="text" name="lokasi" id="lokasi" hidden class="form-control" value="<?= $dm['lokasi'] ?>">
            </div>
            <div class="form-group">
              <h6>Jumlah Barang Reject</h6>
              <input type="text" name="rejected" id="rejected" class="form-control">
            </div>
            <button type="reset" class="btn btn-secondary mb-3" data-dismiss="modal">Reset</button>
            <button type="submit" class="btn btn-danger mb-3">Save</button>
          </form>
        </div>
      </div>
    </div>
  </div>
<?php endforeach; ?>

<!-- Modal stok -->
<?php $no = 0;
  foreach($data_stock_barang as $dm) : $no++; ?>
  <div class="modal fade" id="newAnnouncementStok<?= $dm['id_part'] ?>" tabindex="-1" aria-labelledby="newAnnouncementStokLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="newAnnouncementStokLabel">Input Stok</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="post" action="<?php echo base_url().'Stok/Input_cek'; ?>">
            <div class="form-group">
              <input type="hidden" name="id_part" id="id_part" class="form-control" value="<?= $dm['id_part'] ?>">
              <!-- <h6>Nama Barang</h6> -->
              <input type="text" name="production_order" hidden id="production_order" readonly class="form-control" value="<?= $dm['production_order'] ?>">
            </div>
            <div class="form-group">
              <!-- <h6>Kode Barang</h6> -->
              <input type="text" name="kode_produksi" hidden id="kode_produksi" readonly class="form-control" value="<?= $dm['kode_produksi'] ?>">
            </div>
            <div class="form-group">
              <input type="text" name="diskripsi" hidden id="diskripsi" class="form-control" value="<?= $dm['diskripsi'] ?>">
            </div>
            <div class="form-group">
              <h6>Quantity</h6>
              <input type="text" name="quatity_total" id="quatity_total" class="form-control" value="0">
            </div>
            <div class="form-group">
              <input type="text" name="part_number" hidden id="part_number" class="form-control" value="<?= $dm['part_number'] ?>">
            </div>
            <div class="form-group">
              <input type="text" name="tanggal" id="tanggal" hidden class="form-control" value="<?= date("Y-m-d H:i:s") ?>">
            </div>
            <div class="form-group">
              <input type="text" name="lokasi" id="lokasi" hidden class="form-control" value="<?= $dm['lokasi'] ?>">
            </div>
            <div class="form-group">
              <!-- <h6>Jumlah Barang Reject</h6> -->
              <input type="text" name="rejected" hidden id="rejected" class="form-control">
            </div>
            <center><button type="reset" class="btn btn-secondary mb-3" data-dismiss="modal">Reset</button>
            <button type="submit" class="btn btn-info mb-3">Save</button></center>
          </form>
        </div>
      </div>
    </div>
  </div>
<?php endforeach; ?>