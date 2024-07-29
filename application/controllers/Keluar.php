<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Keluar extends CI_Controller{
    function __construct(){
		parent::__construct();
        if(!$this->session->userdata('email')){
			redirect('Login');
		}
	}

    public function index(){
        // $data['data_barang_keluar'] = $this->db->get('data_barang_keluar')->result_array();
        $this->load->view('Templates/Header');
        $this->load->view('Auth/Keluar');
        $this->load->view('Templates/Footer');
    }

    public function Tambah(){
		$part_number	= $this->input->post('part_number');
		$kode_produksi	= $this->input->post('kode_produksi');
        $diskripsi	= $this->input->post('diskripsi');
        $quatity_total	= $this->input->post('quatity_total');
        $tanggal	= $this->input->post('tanggal');
        $lokasi	= $this->input->post('lokasi');

		$data = array(
			'part_number' 	=> $part_number,
			'kode_produksi'	=> $kode_produksi,
            'diskripsi'	=> $diskripsi, 
            'quatity_total'	=> $quatity_total,
            'tanggal'	=> $tanggal,
            'lokasi'	=> $lokasi,
		);
        
        $query = "INSERT INTO data_barang_keluar (`part_number`, `kode_produksi`, `diskripsi`, `quatity_total`, `tanggal`, `lokasi`) 
        VALUES ('$part_number', '$kode_produksi', '$diskripsi', '$quatity_total', '$tanggal', '$lokasi')";
        $insert_data = $this->db->query($query);

        // $this->db->insert('data_barang_keluar', $data);
        echo '<script>
            alert("Berhasil");
            history.go(-1);
            </script>';

        // redirect('Keluar');
	}

    public function Hapus(){
        $id_part	= $this->input->post('id_part');
        $kode_produksi	= $this->input->post('kode_produksi');
        $tanggal	= $this->input->post('tanggal');
        $quatity_total	= $this->input->post('quatity_total');

        $query_update = "SELECT * FROM `data_stock_barang` WHERE `kode_produksi`='$kode_produksi'";
        $data_stok = $this->db->query($query_update)->result_array();
        foreach($data_stok as $ds){
            $ambil = $ds['quatity'];

            $jumlah = $ambil + $quatity_total;

            $update_jumlah_stok = "UPDATE `data_stock_barang` SET `quatity` = '$jumlah' WHERE `kode_produksi` = '$kode_produksi'";
            $data_stok_update = $this->db->query($update_jumlah_stok);

            $update_jumlah_masuk = "UPDATE `data_barang_masuk` SET `quatity` = '$jumlah' WHERE `kode_produksi` = '$kode_produksi'";
            $data_masuk_update = $this->db->query($update_jumlah_masuk);

            $hapus_satu = "DELETE FROM `data_barang_keluar` WHERE `id_part` = '$id_part'";
            $data_hapus_satu= $this->db->query($hapus_satu);

            $hapus_dua = "DELETE FROM `data_hasil_produksi` WHERE `tanggal` = '$tanggal'";
            $data_hapus_dua= $this->db->query($hapus_dua);
            // redirect('Keluar');
            echo '<script>
            alert("Berhasil dihapus");
            history.go(-1);
            </script>';
        }
        
	}

}