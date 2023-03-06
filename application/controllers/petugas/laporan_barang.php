<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan_Barang extends CI_Controller
{

		
	public function index()
	{
		$args = [
			'judul' => 'Laporan Barang'
		];
		
		$this->load->view('templates_admin/header', $args);
		$this->load->view('templates_admin/sidebar_petugas', $args);
		$this->load->view('petugas/laporan_barang/v_laporan_barang', $args);
		$this->load->view('templates_admin/footer');
	}
	
	 public function cetak_laporan() {
		//load library
		$this->load->model('Lelang_model');
		$this->load->library('pdf');

		$tgl_lelang_awal = $this->input->post('tgl_lelang_awal');
		$tgl_lelang_akhir = $this->input->post('tgl_lelang_akhir');
	
		// load model dashboard
		$data['laporan'] = $this->Lelang_model->laporan_barang();

		$this->session->set_userdata('tgl_lelang_awal', $tgl_lelang_awal);
		$this->session->set_userdata('tgl_lelang_akhir', $tgl_lelang_akhir);

		$this->pdf->setPaper('A4', 'potrait');
		$this->pdf->filename = "laporan_barang-.pdf";

			// run dompdf
            $this->pdf->load_view('petugas/laporan_barang/cetak_laporan_barang', $data);
        
	}
}
	
	