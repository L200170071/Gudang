<?php
    $pdf = new \TCPDF();
    $pdf->AddPage('L', 'mm', 'A4');
    $pdf->SetFont('', 'B', 18);
    $pdf->Cell(150, 10, "PT Techpack Asia", 0, 1, 'R');
    $pdf->SetFont('', '', 10);
    $pdf->Cell(178, 10, "Jalan Raya, Waruk, Karangawen, Kec. Karangawen,", 0, 1, 'R');
    $pdf->Cell(160, 5, "Kabupaten Demak, Jawa Tengah 59566,", 0, 1, 'R');
    $pdf->Ln(10);
    if($jenis == 0){
        $pdf->SetFont('', 'B', 12);
        $pdf->Cell(277, 10, "DAFTAR BARANG MASUK", 0, 1, 'C');
        $pdf->SetAutoPageBreak(true, 0);
        $pdf->SetLineWidth(0.3);
        $pdf->Line(10, 40.5, 280, 40.5);
        $pdf->Image('asli.jpg', '', '', 30, 30, '', '', 'T', false, 300, '', false, false, 1, false, false, false);
        // Add Header
        $pdf->Ln(10);
        $pdf->Cell(20, 8, "Periode :", 0, 0, 'L');
        $pdf->Ln(7);
        $pdf->Cell(20, 8, "Awal :", 0, 0, 'L');
        $pdf->Ln(7);
        $pdf->Cell(20, 8, "Akhir :", 0, 0, 'L');
        $pdf->Ln(10);
        $pdf->SetFont('', 'B', 10);
        $pdf->Cell(10, 8, "No", 1, 0, 'C');
        $pdf->Cell(37, 8, "Production Order", 1, 0, 'C');
        $pdf->Cell(20, 8, "Kode", 1, 0, 'C');
        $pdf->Cell(20, 8, "Part Num", 1, 0, 'C');
        $pdf->Cell(100, 8, "Desc", 1, 0, 'C');
        $pdf->Cell(37, 8, "Date", 1, 0, 'C');
        $pdf->Cell(15, 8, "Quatity", 1, 0, 'C');
        $pdf->Cell(15, 8, "Location", 1, 0, 'C');
        $pdf->Ln(8);
        $pdf->SetFont('', '', 10);
        $no=0;
        $query = "SELECT * FROM `data_barang_masuk` WHERE (`data_barang_masuk`.`tanggal`) BETWEEN '$tanggal_awal' AND '$tanggal_akhir'";
        $data_masuk = $this->db->query($query)->result_array();
        foreach ($data_masuk as $data){
            $no++;
            $pdf->Cell(10,8,$no,1,0, 'C');
            $pdf->Cell(37,8,$data['production_order'],1,0);
            $pdf->Cell(20,8,$data['kode_produksi'],1,0);
            $pdf->Cell(20,8,$data['part_number'],1,0);
            $pdf->Cell(100,8,$data['diskripsi'],1,0);
            $pdf->Cell(37,8,$data['tanggal'],1,0);
            $pdf->Cell(15,8,$data['quatity'],1,0);
            $pdf->Cell(15,8,$data['lokasi'],1,0);
            $pdf->Ln(8);
            
        }
    }elseif($jenis == 1){
        $pdf->SetFont('', 'B', 12);
        $pdf->Cell(277, 10, "DAFTAR HASIL PRODUKSI", 0, 1, 'C');
        $pdf->SetAutoPageBreak(true, 0);
        $pdf->SetLineWidth(0.3);
        $pdf->Line(10, 40.5, 280, 40.5);
        $pdf->Image('asli.jpg', '', '', 30, 30, '', '', 'T', false, 300, '', false, false, 1, false, false, false);
        // Add Header
        $pdf->Ln(10);
        $pdf->Cell(20, 8, "Periode :", 0, 0, 'L');
        $pdf->Ln(7);
        $pdf->Cell(20, 8, "Awal :", 0, 0, 'L');
        $pdf->Ln(7);
        $pdf->Cell(20, 8, "Akhir :", 0, 0, 'L');
        $pdf->Ln(10);
        $pdf->SetFont('', 'B', 10);
        $pdf->Cell(10, 8, "No", 1, 0, 'C');
        $pdf->Cell(37, 8, "Production Order", 1, 0, 'C');
        $pdf->Cell(20, 8, "Kode", 1, 0, 'C');
        $pdf->Cell(20, 8, "Part Num", 1, 0, 'C');
        $pdf->Cell(85, 8, "Desc", 1, 0, 'C');
        $pdf->Cell(37, 8, "Date", 1, 0, 'C');
        $pdf->Cell(15, 8, "Quatity", 1, 0, 'C');
        $pdf->Cell(15, 8, "Received", 1, 0, 'C');
        $pdf->Cell(15, 8, "Rejected", 1, 0, 'C');
        $pdf->Cell(15, 8, "Location", 1, 0, 'C');
        $pdf->Ln(8);
        $pdf->SetFont('', '', 10);
        $no=0;
        $query_satu = "SELECT * FROM `data_hasil_produksi` INNER JOIN `data_stock_barang` ON `data_stock_barang`.`kode_produksi` = `data_hasil_produksi`.`kode_produksi` WHERE (`data_hasil_produksi`.`tanggal`) BETWEEN '$tanggal_awal' AND '$tanggal_akhir'";
        $data_hasil = $this->db->query($query_satu)->result_array();
        foreach ($data_hasil as $dh){
            $no++;
            $pdf->Cell(10,8,$no,1,0, 'C');
            $pdf->Cell(37,8,$dh['production_order'],1,0);
            $pdf->Cell(20,8,$dh['kode_produksi'],1,0);
            $pdf->Cell(20,8,$dh['part_number'],1,0);
            $pdf->Cell(85,8,$dh['diskripsi'],1,0);
            $pdf->Cell(37,8,$dh['tanggal'],1,0);
            $pdf->Cell(15,8,$dh['quatity_total'],1,0);
            $pdf->Cell(15,8,$dh['received'],1,0);
            $pdf->Cell(15,8,$dh['rejected'],1,0);
            $pdf->Cell(15,8,$dh['lokasi'],1,0);
            $pdf->Ln(8);
            
        }
    }else{
        $pdf->SetFont('', 'B', 12);
        $pdf->Cell(277, 10, "DAFTAR BARANG KELUAR", 0, 1, 'C');
        $pdf->SetAutoPageBreak(true, 0);
        $pdf->SetLineWidth(0.3);
        $pdf->Line(10, 40.5, 280, 40.5);
        $pdf->Image('asli.jpg', '', '', 30, 30, '', '', 'T', false, 300, '', false, false, 1, false, false, false);
        // Add Header
        $pdf->Ln(10);
        $pdf->Cell(20, 8, "Periode :", 0, 0, 'L');
        $pdf->Ln(7);
        $pdf->Cell(20, 8, "Awal :", 0, 0, 'L');
        $pdf->Ln(7);
        $pdf->Cell(20, 8, "Akhir :", 0, 0, 'L');
        $pdf->Ln(10);
        $pdf->SetFont('', 'B', 10);
        $pdf->Cell(10, 8, "No", 1, 0, 'C');
        $pdf->Cell(37, 8, "Production Order", 1, 0, 'C');
        $pdf->Cell(20, 8, "Kode", 1, 0, 'C');
        $pdf->Cell(20, 8, "Part Num", 1, 0, 'C');
        $pdf->Cell(100, 8, "Desc", 1, 0, 'C');
        $pdf->Cell(37, 8, "Date", 1, 0, 'C');
        $pdf->Cell(15, 8, "Quatity", 1, 0, 'C');
        $pdf->Cell(15, 8, "Location", 1, 0, 'C');
        $pdf->Ln(8);
        $pdf->SetFont('', '', 10);
        $no=0;
        $query_dua = "SELECT * FROM `data_barang_keluar` INNER JOIN `data_stock_barang` ON `data_stock_barang`.`kode_produksi` = `data_barang_keluar`.`kode_produksi` WHERE (`data_barang_keluar`.`tanggal`) BETWEEN '$tanggal_awal' AND '$tanggal_akhir'";
            $data_keluar = $this->db->query($query_dua)->result_array();
        foreach ($data_keluar as $dk){
            $no++;
            $pdf->Cell(10,8,$no,1,0, 'C');
            $pdf->Cell(37,8,$dk['production_order'],1,0);
            $pdf->Cell(20,8,$dk['kode_produksi'],1,0);
            $pdf->Cell(20,8,$dk['part_number'],1,0);
            $pdf->Cell(100,8,$dk['diskripsi'],1,0);
            $pdf->Cell(37,8,$dk['tanggal'],1,0);
            $pdf->Cell(15,8,$dk['quatity_total'],1,0);
            $pdf->Cell(15,8,$dk['lokasi'],1,0);
            $pdf->Ln(8);
            
        }
    }
    $pdf->SetFont('', 'B', 10);
    // $pdf->Cell(277, 10, "Terimakasih", 0, 1, 'L');
    $pdf->Output('Laporan-Tcpdf-CodeIgniter.pdf');
?>