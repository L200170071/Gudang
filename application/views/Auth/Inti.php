 <!-- Begin Page Content -->
 <br>
 <div class="container-fluid">

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Laporan Barang Terkirim </h6> 
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <?php if($jenis == 0){?>
        <thead>
          <tr>
            <th>No</th>
            <th>Production Order</th>
            <th>Kode Produksi</th>
            <th>Part Number</th>
            <th>Description</th>
            <th>Date</th>
            <th>Quatity</th>
            <th>Location</th>
          </tr>
        </thead>
        <tbody>
          <?php $i = 1; ?>
          <?php
            $query = "SELECT * FROM `data_barang_masuk` WHERE (`data_barang_masuk`.`tanggal`) BETWEEN '$tanggal_awal' AND '$tanggal_akhir'";
            $data_masuk = $this->db->query($query)->result_array();
            foreach($data_masuk as $dm) :?>

            <tr>
              <td><?= $i; ?></td>
              <td><?= $dm['production_order']; ?></td>
              <td><?= $dm['kode_produksi']; ?></td>
              <td><?= $dm['part_number']; ?></td>
              <td><?= $dm['diskripsi']; ?></td>
              <td><?= $dm['tanggal']; ?></td>
              <td><?= $dm['quatity']; ?></td>
              <td><?= $dm['lokasi']; ?></td>
            </tr>
            
        </tbody>
        <?php $i++; ?>
        <?php endforeach ?>
        <?php }elseif($jenis == 1){ ?>
          <thead>
          <tr>
            <th>No</th>
            <th>Production Order</th>
            <th>Kode Produksi</th>
            <th>Part Number</th>
            <th>Description</th>
            <th>Date</th>
            <th>Quatity</th>
            <th>Received</th>
            <th>Rejected</th>
            <th>Location</th>
          </tr>
        </thead>
        <tbody>
          <?php $i = 1; ?>
          <?php
            $query_satu = "SELECT * FROM `data_hasil_produksi` INNER JOIN `data_stock_barang` ON `data_stock_barang`.`kode_produksi` = `data_hasil_produksi`.`kode_produksi` WHERE (`data_hasil_produksi`.`tanggal`) BETWEEN '$tanggal_awal' AND '$tanggal_akhir'";
            $data_hasil = $this->db->query($query_satu)->result_array();
            foreach($data_hasil as $dh) :?>

            <tr>
              <td><?= $i; ?></td>
              <td><?= $dh['production_order']; ?></td>
              <td><?= $dh['kode_produksi']; ?></td>
              <td><?= $dh['part_number']; ?></td>
              <td><?= $dh['diskripsi']; ?></td>
              <td><?= $dh['tanggal']; ?></td>
              <td><?= $dh['quatity_total']; ?></td>
              <td><?= $dh['received']; ?></td>
              <td><?= $dh['rejected']; ?></td>
              <td><?= $dh['lokasi']; ?></td>
            </tr>
              
        </tbody>
        <?php $i++; ?>
        <?php endforeach ?>
        <?php }else{ ?>
          <thead>
          <tr>
            <th>No</th>
            <th>Production Order</th>
            <th>Kode Produksi</th>
            <th>Part Number</th>
            <th>Description</th>
            <th>Date</th>
            <th>Quatity</th>
            <th>Location</th>
          </tr>
        </thead>
        <tbody>
          <?php $i = 1; ?>
          <?php
            $query_dua = "SELECT * FROM `data_barang_keluar` INNER JOIN `data_stock_barang` ON `data_stock_barang`.`kode_produksi` = `data_barang_keluar`.`kode_produksi` WHERE (`data_barang_keluar`.`tanggal`) BETWEEN '$tanggal_awal' AND '$tanggal_akhir'";
            $data_keluar = $this->db->query($query_dua)->result_array();
            foreach($data_keluar as $dk) :?>

            <tr>
              <td><?= $i; ?></td>
              <td><?= $dk['production_order']; ?></td>
              <td><?= $dk['kode_produksi']; ?></td>
              <td><?= $dk['part_number']; ?></td>
              <td><?= $dk['diskripsi']; ?></td>
              <td><?= $dk['tanggal']; ?></td>
              <td><?= $dk['quatity_total']; ?></td>
              <td><?= $dk['lokasi']; ?></td>
            </tr>
            

        </tbody>
        <?php $i++; ?>
        <?php endforeach ?>
        <?php } ?>
      </table>
    </div>
  </div>
</div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

