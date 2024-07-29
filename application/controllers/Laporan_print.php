<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');
 
class Laporan_print extends CI_Controller {
    public function __construct()
        {   
            parent::__construct();
            $this->load->library('Pdf');
        }
    public function index()
        {
            $query = "SELECT * FROM `data_hasil_produksi` INNER JOIN `data_barang_masuk` ON `data_barang_masuk`.`kode_produksi` = `data_hasil_produksi`.`kode_produksi` WHERE (`data_hasil_produksi`.`tanggal`) BETWEEN '$tanggal_awal' AND '$tanggal_akhir'";
            $ambil['ambil_lap'] = $this->db->query($query)->result_array();
            $this->load->view('Auth/Laporan_cetak');
        }
}