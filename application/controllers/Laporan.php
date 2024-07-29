<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan extends CI_Controller{

    public function __construct()
    {   
        parent::__construct();
        $this->load->library('Pdf');
    }

    public function index(){
        $this->load->view('Templates/Header');
        $this->load->view('Auth/Laporan');
        $this->load->view('Templates/Footer_lap');
    }

    public function Tampilkan(){
        $jenis	= $this->input->post('jenis');
        $tanggal1	= $this->input->post('tanggal1');
        $tanggal2	= $this->input->post('tanggal2');

        $tanggal_awal = $tanggal1. " 00:00:00";
        $tanggal_akhir = $tanggal2. " 23:59:59";

        if(isset($_POST['cetak'])){
            $this->Cetak_pdf($jenis,$tanggal1,$tanggal2);
        }else{
            $data = array(
                'jenis' 	=> $jenis,
                'tanggal_awal'	    => $tanggal_awal,
                'tanggal_akhir'	    => $tanggal_akhir
            );
            
            $this->load->view('Templates/Header');
            $this->load->view('Auth/Laporan');
            $this->load->view('Auth/Inti', $data);
            $this->load->view('Templates/Footer_lap');
        }
        
    }

    public function Cetak_pdf($jenis, $tanggal1,$tanggal2)
        {
            // var_dump($jenis);
            $tanggal_awal = $tanggal1. " 00:00:00";
            $tanggal_akhir = $tanggal2. " 23:59:59";            

            $data = array(
                'jenis' 	=> $jenis,
                'tanggal_awal'	    => $tanggal_awal,
                'tanggal_akhir'	    => $tanggal_akhir
            );

            $this->load->view('Auth/Laporan_cetak', $data);
        }
}