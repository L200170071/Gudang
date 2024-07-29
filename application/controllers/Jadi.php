<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jadi extends CI_Controller{
    function __construct(){
		parent::__construct();
        if(!$this->session->userdata('email')){
			redirect('Login');
		}
	}

    public function index(){
        $this->load->view('Templates/Header');
        $this->load->view('Auth/Jadi');
        $this->load->view('Templates/Footer');
    }

    public function Update_acc($id_part, $rejected, $part_number, $kode_produksi, $diskripsi, $lokasi){
        $update_jumlah_stok = "UPDATE `data_hasil_produksi` SET `received` = '$rejected', `rejected` = '0', ket = '' WHERE `id_part` = '$id_part'";
        $data_stok_update = $this->db->query($update_jumlah_stok);

        $new = urldecode($diskripsi);

        $query_keluar = "INSERT INTO data_barang_keluar (`part_number`, `kode_produksi`, `diskripsi`, `quatity_total`, `lokasi`) 
        VALUES ('$part_number', '$kode_produksi', '$new', '$rejected', '$lokasi')";
        $insert_data_keluar = $this->db->query($query_keluar);
        echo '
            <script>
            alert("Berhasil");
            history.go(-1);
            </script>
        ';
    }

    public function Acc(){
        $id_part_satu = $this->input->post('id_part_satu');
        $sementara_satu = $this->input->post('sementara_satu');
        $part_number = $this->input->post('part_number');
        $kode_produksi = $this->input->post('kode_produksi');
        $diskripsi = $this->input->post('diskripsi');
        $tanggal = $this->input->post('tanggal');
        $lokasi = $this->input->post('lokasi');
        $quatity_total = $this->input->post('quatity_total');
        $quatity_masuk = $this->input->post('quatity_masuk');

        $new = urldecode($diskripsi);

        if($quatity_masuk > $quatity_total){
            echo '
            <script>
            alert("Jumlah melebihi quatity");
            history.go(-1);
            </script>
            ';
        }else{
            $rejek = $quatity_total - $quatity_masuk;
            $acc = $quatity_total - $rejek;

            $update_stok_satu = "UPDATE `data_hasil_produksi` SET `sementara` = '', ket='', `received` = '$acc', `rejected` = '$rejek' WHERE `id_part` = '$id_part_satu'";
            $data_hasil_acc = $this->db->query($update_stok_satu);

            $input_keluar = "INSERT INTO data_barang_keluar (`part_number`, `kode_produksi`, `diskripsi`, `quatity_total`, `lokasi`) 
            VALUES ('$part_number', '$kode_produksi', '$new', '$acc', '$lokasi')";
            $insert_data_keluar = $this->db->query($input_keluar);

            echo '
                <script>
                alert("Berhasil menambahkan barang keluar");
                history.go(-1);
                </script>
            ';
        }
    }

    public function Reject(){
        $id_part_dua = $this->input->post('id_part_dua');
        $sementara_dua = $this->input->post('sementara_dua');

        $update_stok_dua = "UPDATE `data_hasil_produksi` SET `sementara` = '', ket='', `rejected` = '$sementara_dua' WHERE `id_part` = '$id_part_dua'";
        $data_hasil_reject = $this->db->query($update_stok_dua);
        echo '
            <script>
            alert("Berhasil menambahkan barang reject");
            history.go(-1);
            </script>
        ';
    }

}