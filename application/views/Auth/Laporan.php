
        
                <form method="post" action="<?php echo base_url().'Laporan/Tampilkan' ?>">

                    <div class="form-group" style="margin-left: 3%;">
                        <span>Kategori</span>
                        <select name="jenis" id="jenis" class="form-control" style="width: 20%;">
                            <option value="0">Barang Masuk</option>
                            <option value="1">Hasil Produksi</option>
                            <option value="2">Barang Keluar</option>
                        </select>
                    </div>
                    <div class="form-group" style="margin-left: 3%;">
                        <span>Tanggal Awal</span>
                        <input type="date" name="tanggal1" id="tanggal1" class="form-control" style="width: 20%;">
                    </div>
                    <div class="form-group" style="margin-left: 3%;">
                        <span>Tanggal Akhir</span>
                        <input type="date" name="tanggal2" id="tanggal2" class="form-control" style="width: 20%;">
                    </div>

                    <button type="submit" class="btn btn-primary" style="margin-left: 3%;">Tampilkan</button> <button type="submit" name="cetak" value="cetak" class="btn btn-danger" style="margin-left: 3%;">Cetak PDF</button>
                </form>
            