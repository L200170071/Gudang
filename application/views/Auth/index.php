
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- DataTales Example -->
          <?= $this->session->flashdata('pesan'); ?>
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Data Barang Masuk <button class="btn-sm btn-primary" data-toggle="modal" data-target="#newAnnouncement">Tambah</button></h6> 
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Production Order</th>
                      <th>Kode Production</th>
                      <th>Description </th>
                      <th>Quantity</th>
                      <th>Part Number</th>
                      <th>Date</th>
                      <th>Location</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $i = 1; ?>
                    <?php

                    foreach($data_barang_masuk as $dm) :?>
                    <tr>
                      <td><?= $i; ?></td>
                      <td><?= $dm['production_order']; ?></td>
                      <td><?= $dm['kode_produksi']; ?></td>
                      <td><?= $dm['diskripsi']; ?></td>
                      <td><?= $dm['quatity']; ?></td>
                      <td><?= $dm['part_number']; ?></td>
                      <td><?= $dm['tanggal']; ?></td>
                      <td><?= $dm['lokasi']; ?></td>
                      <td style="width: 13%;"><center><button class="btn-sm btn-success" data-toggle="modal" data-target="#newAnnouncementEdit<?= $dm['id_part'] ?>"><center><i class="fa fa-edit"></i></center></button>
                      <button class="btn-sm btn-danger" data-toggle="modal" data-target="#newAnnouncementHapus<?= $dm['id_part'] ?>"><center><i class="fa fa-trash"></i></center></button>
                      <button class="btn-sm btn-warning" data-toggle="modal" data-target="#newAnnouncementPlus<?= $dm['id_part'] ?>"><center><i class="fa fa-plus"></i></center></button></center></td>
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


  <!-- Modal -->
  <div class="modal fade" id="newAnnouncement" tabindex="-1" aria-labelledby="newAnnouncementLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="newAnnouncementLabel">Tambah Barang Masuk</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="post" action="<?php echo base_url().'Auth/Tambah' ?>">
            <div class="form-group">
              <span>Production Order</span>
              <input type="text" name="production_order" id="production_order" class="form-control">
            </div>
            <div class="form-group">
            <span>Kode</span>
              <input type="text" name="kode_produksi" id="kode_produksi" class="form-control">
            </div>
            <div class="form-group">
              <span>Description</span>
              <input type="text" name="diskripsi" id="diskripsi" class="form-control">
            </div>
            <div class="form-group">
              <span>Quantity</span>
              <input type="text" name="quatity" id="quatity" class="form-control" value="0">
            </div>
            <div class="form-group">
              <span>Part Number</span>
              <input type="text" name="part_number" id="part_number" class="form-control">
            </div>
            <div class="form-group">
              <span>Date</span>
              <input type="date" name="tanggal" id="tanggal" class="form-control">
            </div>
            <div class="form-group">
              <span>Location</span>
              <input type="text" name="lokasi" id="lokasi" class="form-control">
            </div>
            <button type="reset" class="btn btn-secondary" data-dismiss="modal">Reset</button>
            <button type="submit" class="btn btn-primary">Save</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal edit -->
  <?php $no = 0;
  foreach($data_barang_masuk as $dm) : $no++; ?>
  <div class="modal fade" id="newAnnouncementEdit<?= $dm['id_part'] ?>" tabindex="-1" aria-labelledby="newAnnouncementEditLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="newAnnouncementEditLabel">Edit</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="post" action="<?php echo base_url().'Auth/Update'; ?>">
            <div class="form-group">
              <input type="hidden" name="id_part" id="id_part" class="form-control" value="<?= $dm['id_part'] ?>">
              <span>Nama Barang</span>
              <input type="text" name="production_order" id="production_order" class="form-control" value="<?= $dm['production_order'] ?>">
            </div>
            <div class="form-group">
              <span>Kode</span>
              <input type="text" name="kode_produksi" id="kode_produksi" class="form-control" value="<?= $dm['kode_produksi'] ?>" readonly>
            </div>
            <div class="form-group">
              <span>Diskripsi</span>
              <input type="text" name="diskripsi" id="diskripsi" class="form-control" value="<?= $dm['diskripsi'] ?>">
            </div>
            <div class="form-group">
              <span>Kuantiti Awal</span>
              <input type="text" name="quatity" id="quatity" class="form-control" value="<?= $dm['quatity'] ?>" readonly>
            </div>
            <div class="form-group">
              <span>Kuantiti Baru</span>
              <input type="text" name="quatity2" id="quatity2" class="form-control">
            </div>
            <div class="form-group">
              <span>Part Number</span>
              <input type="text" name="part_number" id="part_number" class="form-control" value="<?= $dm['part_number'] ?>">
            </div>
            <div class="form-group">
              <span>Tanggal</span>
              <input type="text" name="tanggal" id="tanggal" class="form-control" value="<?= $dm['tanggal'] ?>">
            </div>
            <div class="form-group">
              <span>Lokasi</span>
              <input type="text" name="lokasi" id="lokasi" class="form-control" value="<?= $dm['lokasi'] ?>">
            </div>
            <button type="reset" class="btn btn-secondary mb-3" data-dismiss="modal">Reset</button>
            <button type="submit" class="btn btn-primary mb-3">Edit</button>
          </form>
        </div>
      </div>
    </div>
  </div>
<?php endforeach; ?>

<!-- Modal Hapus -->
<?php $no = 0;
  foreach($data_barang_masuk as $di) : $no++; ?>
  <div class="modal fade" id="newAnnouncementHapus<?= $di['id_part'] ?>" tabindex="-1" aria-labelledby="newAnnouncementHapusLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="newAnnouncementHapusLabel">Apakah anda yakin hapus?</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="post" action="<?php echo base_url().'Auth/Hapus'; ?>">
            <div class="form-group">
              <input type="hidden" name="id_part" id="id_part" class="form-control" value="<?= $di['id_part'] ?>">
              <input type="text" name="production_order" id="production_order" hidden class="form-control" value="<?= $di['production_order'] ?>">
            </div>
            <div class="form-group">
              <input type="text" name="kode_produksi" id="kode_produksi" hidden class="form-control" value="<?= $di['kode_produksi'] ?>">
            </div>
            <div class="form-group">
              <input type="text" name="diskripsi" id="diskripsi" hidden class="form-control" value="<?= $di['diskripsi'] ?>">
            </div>
            <div class="form-group">
              <input type="text" name="quatity" id="quatity" hidden class="form-control" value="<?= $di['quatity'] ?>" readonly>
            </div>
            <div class="form-group">
              <input type="text" name="part_number" id="part_number" hidden class="form-control" value="<?= $di['part_number'] ?>">
            </div>
            <div class="form-group">
              <input type="text" name="tanggal" id="tanggal" hidden class="form-control" value="<?= $di['tanggal'] ?>">
            </div>
            <div class="form-group">
              <input type="text" name="lokasi" id="lokasi" hidden class="form-control" value="<?= $di['lokasi'] ?>">
            </div>
            <center><button type="reset" class="btn btn-secondary mb-3" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-danger mb-3">Hapus</button></center>
          </form>
        </div>
      </div>
    </div>
  </div>
<?php endforeach; ?>

<!-- Modal duplikat -->
<?php $no = 0;
  foreach($data_barang_masuk as $dy) : $no++; ?>
  <div class="modal fade" id="newAnnouncementPlus<?= $dy['id_part'] ?>" tabindex="-1" aria-labelledby="newAnnouncementPlusLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="newAnnouncementPlusLabel">Duplikat</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="post" action="<?php echo base_url().'Auth/Duplikat'; ?>">
            <div class="form-group">
              <input type="hidden" name="id_part" id="id_part" class="form-control" value="<?= $dy['id_part'] ?>">
              <input type="text" name="production_order" hidden id="production_order" class="form-control" value="<?= $dy['production_order'] ?>">
            </div>
            <div class="form-group">
              <input type="text" name="kode_produksi" hidden id="kode_produksi" class="form-control" value="<?= $dy['kode_produksi'] ?>" readonly>
            </div>
            <div class="form-group">
              <input type="text" name="diskripsi" hidden id="diskripsi" class="form-control" value="<?= $dy['diskripsi'] ?>">
            </div>
            <div class="form-group">
              <span>Kuantiti</span>
              <input type="text" name="quatity" id="quatity" class="form-control" value="<?= $dy['quatity'] ?>">
            </div>
            <div class="form-group">
              <input type="text" name="part_number" hidden id="part_number" class="form-control" value="<?= $dy['part_number'] ?>">
            </div>
            <div class="form-group">
              <input type="text" name="tanggal" hidden id="tanggal" class="form-control" value="<?= $dy['tanggal'] ?>">
            </div>
            <div class="form-group">
              <input type="text" name="lokasi" hidden id="lokasi" class="form-control" value="<?= $dy['lokasi'] ?>">
            </div>
            <button type="reset" class="btn btn-secondary mb-3" data-dismiss="modal">Reset</button>
            <button type="submit" class="btn btn-warning mb-3">Duplikat</button>
          </form>
        </div>
      </div>
    </div>
  </div>
<?php endforeach; ?>