<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Stok extends CI_Controller{
    function __construct(){
		parent::__construct();
        if(!$this->session->userdata('email')){
			redirect('Login');
		}
	}

    public function index(){
        $data['data_stock_barang'] = $this->db->get('data_stock_barang')->result_array();
        $this->load->view('Templates/Header', $data);
        $this->load->view('Auth/Stok', $data);
        $this->load->view('Templates/Footer', $data);
    }

    public function Update(){
		$id_part = $this->input->post('id_part');
		$production_order = $this->input->post('production_order');
		$kode_produksi = $this->input->post('kode_produksi');
        $diskripsi = $this->input->post('diskripsi');
        $quatity = $this->input->post('quatity');
        $part_number = $this->input->post('part_number');
        $tanggal = $this->input->post('tanggal');
        $lokasi = $this->input->post('lokasi');
        $received = $this->input->post('received');

        if($received > $quatity){
            echo '<script>
            alert("Jumlah stok melebihi kapasitas");
            history.go(-1);
            </script>';
        }else{
            $query_update = "SELECT * FROM `data_stock_barang` WHERE `id_part`='$id_part'";
            $data_stok = $this->db->query($query_update)->result_array();

            $jumlah = $quatity - $received;

            $update_jumlah_stok = "UPDATE `data_stock_barang` SET `quatity` = '$jumlah' WHERE `id_part` = '$id_part'";
            $data_stok_update = $this->db->query($update_jumlah_stok);

            $query = "INSERT INTO `data_hasil_produksi` (`part_number`, `kode_produksi`, `diskripsi`, `quatity_total`, `received`, `rejected`, `lokasi`) 
            VALUES ('$part_number', '$kode_produksi', '$diskripsi', '$jumlah', '$received', '0', '$lokasi')";
            $insert_data = $this->db->query($query);

            $query_keluar = "INSERT INTO `data_barang_keluar` (`part_number`, `kode_produksi`, `diskripsi`, `quatity_total`, `lokasi`) 
            VALUES ('$part_number', '$kode_produksi', '$diskripsi', '$received', '$lokasi')";
            $insert_data_keluar = $this->db->query($query_keluar);

            // redirect('Stok');
            echo '<script>
            alert("Berhasil");
            history.go(-1);
            </script>';
        }
	}

    public function Update_reject(){
		$id_part = $this->input->post('id_part');
		$production_order = $this->input->post('production_order');
		$kode_produksi = $this->input->post('kode_produksi');
        $diskripsi = $this->input->post('diskripsi');
        $quatity = $this->input->post('quatity');
        $part_number = $this->input->post('part_number');
        $tanggal = $this->input->post('tanggal');
        $lokasi = $this->input->post('lokasi');
        $rejected = $this->input->post('rejected');

        if($rejected > $quatity){
            echo '<script>
            alert("Jumlah stok melebihi kapasitas");
            history.go(-1);
            </script>';
        }else{
            $query_update = "SELECT * FROM `data_stock_barang` WHERE `id_part`='$id_part'";
            $data_stok = $this->db->query($query_update)->result_array();

            $jumlah = $quatity - $rejected;

            $update_jumlah_stok = "UPDATE `data_stock_barang` SET `quatity` = '$jumlah' WHERE `id_part` = '$id_part'";
            $data_stok_update = $this->db->query($update_jumlah_stok);

            $query = "INSERT INTO data_hasil_produksi (`part_number`, `kode_produksi`, `diskripsi`, `quatity_total`, `received`, `rejected`, `tanggal`, `lokasi`) 
            VALUES ('$part_number', '$kode_produksi', '$diskripsi', '$jumlah', '0', '$rejected', '$tanggal', '$lokasi')";
            $insert_data = $this->db->query($query);
        
            // redirect('Stok');
            echo '<script>
            alert("Berhasil");
            history.go(-1);
            </script>';
        }
	}

    public function Input_cek(){
        $id_part = $this->input->post('id_part');
		$production_order = $this->input->post('production_order');
		$kode_produksi = $this->input->post('kode_produksi');
        $diskripsi = $this->input->post('diskripsi');
        $quatity_total = $this->input->post('quatity_total');
        $part_number = $this->input->post('part_number');
        $tanggal = $this->input->post('tanggal');
        $lokasi = $this->input->post('lokasi');

        $ambil_data = "SELECT * FROM `data_stock_barang` WHERE `kode_produksi` = '$kode_produksi'";
        $insert_result = $this->db->query($ambil_data);
        foreach($insert_result->result() as $ir){
            $kuantiti = $ir->quatity;
        }

        if($quatity_total > $kuantiti){
            echo '<script>
            alert("Jumlah melebihi stok");
            history.go(-1);
            </script>';
        }else{
            $selek_ambil = "SELECT * FROM `data_hasil_produksi` WHERE `kode_produksi` = '$kode_produksi' GROUP BY `id_part` DESC LIMIT 1";
            $selek_result = $this->db->query($selek_ambil);
            $tot_tot_tot = $selek_result->num_rows();
            if($tot_tot_tot < 1){
                $input_hasil = "INSERT INTO `data_hasil_produksi` (`part_number`, `kode_produksi`, `diskripsi`, `quatity_total`, `received`, `rejected`, `tanggal`, `lokasi`, `ket`, `sementara`) VALUES ('$part_number', '$kode_produksi', '$diskripsi', '$quatity_total', '0', '0', '$tanggal', '$lokasi', '1', '$quatity_total')";
                $insert_cek = $this->db->query($input_hasil);

                $jumlah = $kuantiti - $quatity_total;

                $update_cek = "UPDATE `data_stock_barang` SET `quatity` = '$jumlah' WHERE `kode_produksi` = '$kode_produksi'";
                $update_cek = $this->db->query($update_cek);
            }else{

                foreach($selek_result->result() as $asu){
                    $azz = $asu->received;
                    $azx = $asu->quatity_total;
                }

                $jum_pol = $azx + $quatity_total;

                $input_hasil_satu = "INSERT INTO `data_hasil_produksi` (`part_number`, `kode_produksi`, `diskripsi`, `quatity_total`, `received`, `rejected`, `tanggal`, `lokasi`, `ket`, `sementara`) VALUES ('$part_number', '$kode_produksi', '$diskripsi', '$quatity_total', '0', '0', '$tanggal', '$lokasi', '1', '$quatity_total')";
                $insert_cek_satu = $this->db->query($input_hasil_satu);

                $jumlah = $kuantiti - $quatity_total;

                $update_cek_satu = "UPDATE `data_stock_barang` SET `quatity` = '$jumlah' WHERE `kode_produksi` = '$kode_produksi'";
                $update_cek_satu = $this->db->query($update_cek_satu);
            }
            
            echo '<script>
            alert("Berhasil");
            history.go(-1);
            </script>';
        }

    }

}