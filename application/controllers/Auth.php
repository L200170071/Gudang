<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller{

    function __construct(){
		parent::__construct();
        if(!$this->session->userdata('email')){
			redirect('Login');
		}
	}

    public function index(){
        $data['data_barang_masuk'] = $this->db->get('data_barang_masuk')->result_array();
        $this->load->view('Templates/Header', $data);
        $this->load->view('Auth/index', $data);
        $this->load->view('Templates/Footer', $data);
    }

    public function Tambah(){
		$production_order	= $this->input->post('production_order');
		$kode_produksi	= $this->input->post('kode_produksi');
        $diskripsi	= $this->input->post('diskripsi');
        $quatity	= $this->input->post('quatity');
        $part_number	= $this->input->post('part_number');
        $tanggal	= $this->input->post('tanggal');
        $lokasi	= $this->input->post('lokasi');

		$data = array(
			'production_order' 	=> $production_order,
			'kode_produksi'	=> $kode_produksi,
            'diskripsi'	=> $diskripsi,
            'quatity'	=> $quatity,
            'part_number'	=> $part_number,
            'tanggal'	=> $tanggal,
            'lokasi'	=> $lokasi
		);

        $query_barang = "SELECT * FROM `data_stock_barang` WHERE `kode_produksi` = '$kode_produksi'";
        $cek_barang_stok = $this->db->query($query_barang);
        $tot_barang_stok = $cek_barang_stok->num_rows();
        if($tot_barang_stok < 1){
            // echo 'belum ada barang';
            $query = "INSERT INTO data_barang_masuk (`production_order`, `kode_produksi`, `diskripsi`, `quatity`, `part_number`, `tanggal`, `lokasi`) 
            VALUES ('$production_order', '$kode_produksi', '$diskripsi', '$quatity', '$part_number', '$tanggal', '$lokasi')";
            $insert_data = $this->db->query($query);

            $querystok = "INSERT INTO data_stock_barang (`part_number`, `kode_produksi`, `diskripsi`, `quatity`, `tanggal`, `lokasi`, `production_order`) 
            VALUES ('$part_number', '$kode_produksi', '$diskripsi', '$quatity', '$tanggal', '$lokasi', '$production_order')";
            $insert_data_stok = $this->db->query($querystok);

            // $queryhasil = "INSERT INTO data_hasil_produksi (`part_number`, `kode_produksi`, `diskripsi`, `quatity_total`, `tanggal`, `lokasi`, `received`, `rejected`) 
            // VALUES ('$part_number', '$kode_produksi', '$diskripsi', '0', '$tanggal', '$lokasi', '0', '0')";
            // $insert_hasil = $this->db->query($queryhasil);

            echo '<script>
                alert("Berhasil");
                history.go(-1);
                </script>';
        }else{
            // echo 'sudah ada barang';
            $query = "INSERT INTO data_barang_masuk (`production_order`, `kode_produksi`, `diskripsi`, `quatity`, `part_number`, `tanggal`, `lokasi`) 
            VALUES ('$production_order', '$kode_produksi', '$diskripsi', '$quatity', '$part_number', '$tanggal', '$lokasi')";
            $insert_data = $this->db->query($query);

            $ambil_jumlah = '0';
            $query_ambil_masuk = "SELECT * FROM `data_stock_barang` WHERE `kode_produksi` = '$kode_produksi'";
            $jumlah_quantity = $this->db->query($query_ambil_masuk);
            foreach($jumlah_quantity->result() as $jq){
                $ambil_jumlah = $jq->quatity;
            }

            $ambil_cek = $ambil_jumlah + $quatity;

            $update_jumlah_stok = "UPDATE `data_stock_barang` SET `quatity` = '$ambil_cek' WHERE `kode_produksi` = '$kode_produksi'";
            $data_stok_jumlah = $this->db->query($update_jumlah_stok);

            echo '<script>
                alert("Berhasil");
                history.go(-1);
                </script>';
        }
	}

    public function Hapus(){
        $kode_produksi	= $this->input->post('kode_produksi');
        $id_part	= $this->input->post('id_part');
        $quatity	= $this->input->post('quatity');

        $query = "SELECT * FROM `data_hasil_produksi` WHERE `kode_produksi` = '$kode_produksi'";
        $ambil_ket = $this->db->query($query);
        $tot_ket = $ambil_ket->num_rows();

        if($tot_ket < 1){
            $query_stok_jum = "SELECT * FROM `data_stock_barang` WHERE `kode_produksi` = '$kode_produksi'";
            $ambil_stok_jum = $this->db->query($query_stok_jum);
            $juju = 0;
            foreach($ambil_stok_jum->result() as $asj){
                $juju = $asj->quatity;
            }

            if($juju > 1){
                // echo 'Update';
                $jumlah_jum = $juju - $quatity;
                $update_stok = "UPDATE `data_stock_barang` SET `quatity` = '$jumlah_jum' WHERE `kode_produksi` = '$kode_produksi'";
                $update_jumjum= $this->db->query($update_stok);

                $hapus_data = "DELETE FROM `data_barang_masuk` WHERE `id_part` = '$id_part'";
                $data_hapus_data= $this->db->query($hapus_data);

                echo '<script>
                alert("Berhasil");
                history.go(-1);
                </script>';
                
            }else{
                // echo 'hapus';
                $hapus_stok = "DELETE FROM `data_stock_barang` WHERE `kode_produksi` = '$kode_produksi'";
                $data_hapus_stok= $this->db->query($hapus_stok);
                echo '<script>
                alert("Berhasil");
                history.go(-1);
                </script>';
            }

        }else{
            echo '<script>
            alert("Sudah ada barang keluar");
            history.go(-1);
            </script>';
        }
	}

    public function Update(){
		$id_part = $this->input->post('id_part');
		$production_order = $this->input->post('production_order');
		$kode_produksi = $this->input->post('kode_produksi');
        $diskripsi = $this->input->post('diskripsi');
        $quatity = $this->input->post('quatity');
        $quatity2 = $this->input->post('quatity2');
        $part_number = $this->input->post('part_number');
        $tanggal = $this->input->post('tanggal');
        $lokasi = $this->input->post('lokasi');

        if($quatity2 < $quatity){
            echo '<script>
            alert("Nominal Harus lebih besar dari kuantiti awal");
            history.go(-1);
            </script>';
        }else{
            $jumlah_awal = $quatity2 - $quatity;

            $query_update = "SELECT * FROM `data_stock_barang` WHERE `kode_produksi`='$kode_produksi'";
            $data_stok = $this->db->query($query_update);

            $ambil_stok = 0;
            foreach($data_stok->result() as $ds){
                $ambil_stok = $ds->quatity;
            }
            $jumlah_akhir = $ambil_stok + $jumlah_awal;

            $update_jumlah_masuk = "UPDATE `data_stock_barang` SET `quatity` = '$jumlah_akhir' WHERE `kode_produksi` = '$kode_produksi'";
            $data_masuk_update = $this->db->query($update_jumlah_masuk);

            $this->db->where('id_part', $id_part);
            $this->db->set('production_order', $production_order);
            $this->db->set('kode_produksi', $kode_produksi);
            $this->db->set('diskripsi', $diskripsi);
            $this->db->set('quatity', $quatity2);
            $this->db->set('part_number', $part_number);
            $this->db->set('tanggal', $tanggal);
            $this->db->set('lokasi', $lokasi);
            $this->db->update('data_barang_masuk');

            echo '<script>
            alert("Berhasil");
            history.go(-1);
            </script>';
        
            // redirect('Auth/index/');
        }
	}

    public function Duplikat(){
        $production_order	= $this->input->post('production_order');
		$kode_produksi	= $this->input->post('kode_produksi');
        $diskripsi	= $this->input->post('diskripsi');
        $quatity	= $this->input->post('quatity');
        $part_number	= $this->input->post('part_number');
        $tanggal	= $this->input->post('tanggal');
        $lokasi	= $this->input->post('lokasi');

		$data = array(
			'production_order' 	=> $production_order,
			'kode_produksi'	=> $kode_produksi,
            'diskripsi'	=> $diskripsi,
            'quatity'	=> $quatity,
            'part_number'	=> $part_number,
            'tanggal'	=> $tanggal,
            'lokasi'	=> $lokasi
		);

        $query_barang = "SELECT * FROM `data_stock_barang` WHERE `kode_produksi` = '$kode_produksi'";
        $cek_barang_stok = $this->db->query($query_barang);
        $tot_barang_stok = $cek_barang_stok->num_rows();
        if($tot_barang_stok < 1){
            // echo 'belum ada barang';
            $query = "INSERT INTO data_barang_masuk (`production_order`, `kode_produksi`, `diskripsi`, `quatity`, `part_number`, `tanggal`, `lokasi`) 
            VALUES ('$production_order', '$kode_produksi', '$diskripsi', '$quatity', '$part_number', '$tanggal', '$lokasi')";
            $insert_data = $this->db->query($query);

            $querystok = "INSERT INTO data_stock_barang (`part_number`, `kode_produksi`, `diskripsi`, `quatity`, `tanggal`, `lokasi`, `production_order`) 
            VALUES ('$part_number', '$kode_produksi', '$diskripsi', '$quatity', '$tanggal', '$lokasi', '$production_order')";
            $insert_data_stok = $this->db->query($querystok);

            echo '<script>
                alert("Berhasil");
                history.go(-1);
                </script>';
        }else{
            // echo 'sudah ada barang';
            $query = "INSERT INTO data_barang_masuk (`production_order`, `kode_produksi`, `diskripsi`, `quatity`, `part_number`, `tanggal`, `lokasi`) 
            VALUES ('$production_order', '$kode_produksi', '$diskripsi', '$quatity', '$part_number', '$tanggal', '$lokasi')";
            $insert_data = $this->db->query($query);

            $ambil_jumlah = '0';
            $query_ambil_masuk = "SELECT * FROM `data_stock_barang` WHERE `kode_produksi` = '$kode_produksi'";
            $jumlah_quantity = $this->db->query($query_ambil_masuk);
            foreach($jumlah_quantity->result() as $jq){
                $ambil_jumlah = $jq->quatity;
            }

            $ambil_cek = $ambil_jumlah + $quatity;

            $update_jumlah_stok = "UPDATE `data_stock_barang` SET `quatity` = '$ambil_cek' WHERE `kode_produksi` = '$kode_produksi'";
            $data_stok_jumlah = $this->db->query($update_jumlah_stok);

            echo '<script>
                alert("Berhasil");
                history.go(-1);
                </script>';
        }
    }

}