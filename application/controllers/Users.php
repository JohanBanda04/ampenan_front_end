<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

	public function index()
	{
		$ceks = $this->session->userdata('username');
		$id_user = $this->session->userdata('id_user');
		if(!isset($ceks)) {
			redirect('web/login');
		}else{
			$data['judul_web'] = "Dashboard";
			
			$id_dipa = $this->session->userdata('id_dipa');

			if ($id_dipa == '00') {
				$data['dipa_list'] = $this->Guzzle_model->getDipaList();
				$counter = 0;
				foreach ($data['dipa_list'] as $key => $value) {
					if($value['id'] == '00') continue;
					$dipa_id[$counter] = $value['id'];
					$counter++;
				}
				$data['dipa_id'] = $dipa_id;

				// Data Pagu dan Realisasi seluruh satker
				$data['pagu_all'] = $this->Guzzle_model->getTotalPagu();
				$data['realisasi_jenis_belanja'] = $this->Guzzle_model->getTotalRealisasiJenisBelanja();
				
				foreach ($data['pagu_all'] as $key => $val) {
					$pagu_satker[$val['kode_satker']] = $val['jumlah'];
				}
				$data['pagu_satker'] = $pagu_satker;

				$data['pagu_jenis_belanja'] = $this->Guzzle_model->getTotalPaguJenisBelanja();

				foreach ($data['realisasi_jenis_belanja'] as $subkey => $subval) {
					if ($subval['jenis_belanja'] == '51') {
						$realisasi_bp[$subval['kode_satker']] = $subval['total_realisasi'];
					}
					if ($subval['jenis_belanja'] == '52') {
						$realisasi_bb[$subval['kode_satker']] = $subval['total_realisasi'];
					}
					if ($subval['jenis_belanja'] == '53') {
						$realisasi_bm[$subval['kode_satker']] = $subval['total_realisasi'];
					}
					$realisasi_total[$subval['kode_satker']] = $realisasi_bp[$subval['kode_satker']] + $realisasi_bb[$subval['kode_satker']] + $realisasi_bm[$subval['kode_satker']];

					$realisasi_total_persen[$subval['kode_satker']] = $this->Mcrud->persen($realisasi_total[$subval['kode_satker']], $data['pagu_satker'][$subval['kode_satker']]);

					$sisa_satker[$subval['kode_satker']] = $data['pagu_satker'][$subval['kode_satker']] - $realisasi_total[$subval['kode_satker']];

					$sisa_satker_pie_chart[$subval['kode_satker']] = $sisa_satker[$subval['kode_satker']];

					if ($sisa_satker[$subval['kode_satker']] < 0) {
						$sisa_satker_pie_chart[$subval['kode_satker']] = 0;
					}

					$sisa_satker_persen[$subval['kode_satker']] = $this->Mcrud->persen($sisa_satker[$subval['kode_satker']], $data['pagu_satker'][$subval['kode_satker']]);
				}
					
				$data['realisasi_satker_bp'] = $realisasi_bp;
				$data['realisasi_satker_bb'] = $realisasi_bb;
				$data['realisasi_satker_bm'] = $realisasi_bm;
				$data['realisasi_satker_total'] = $realisasi_total;
				$data['sisa_satker'] = $sisa_satker;
				$data['sisa_satker_pie_chart'] = $sisa_satker_pie_chart;

				$data['realisasi_satker_persen'] = $realisasi_total_persen;
				$data['sisa_satker_persen'] = $sisa_satker_persen;

				// Data Chart Deviasi RPD 
				$data['realisasi_rpd'] = $this->Guzzle_model->getDataGrafikDeviasiRpdRealisasiSemuaSatker();
				$data['grafik_rpd'] = $this->Guzzle_model->getDataGrafikDeviasiSemuaSatker();
				foreach ($data['dipa_id'] as $key => $value) {
					for ($i=0; $i < 12; $i++) { 
						$data['data_deviasi']['pegawai'][$value][$i] = $data['realisasi_rpd']['pegawai'][$value][$i] - $data['grafik_rpd']['pegawai'][$value][$i];
						$data['data_deviasi']['barang'][$value][$i] = $data['realisasi_rpd']['barang'][$value][$i] - $data['grafik_rpd']['barang'][$value][$i];
						$data['data_deviasi']['modal'][$value][$i] = $data['realisasi_rpd']['modal'][$value][$i] - $data['grafik_rpd']['modal'][$value][$i];
					}
				}
				// echo '<pre>'; print_r($data['data_deviasi']['pegawai']['407607']); exit;

			} else {
				$dipa = $this->Guzzle_model->getDetailDipa($id_dipa);
				$data['nama_dipa'] = $dipa['nama'];

				// Data Pagu dan Realisasi Anggaran 
				$data['total_pagu'] = $this->Guzzle_model->getTotalPagubyKodeSatker($id_dipa);

				$data['pagu_jenis_belanja'] = $this->Guzzle_model->getTotalPaguJenisBelanjabyKodeSatker($id_dipa);
				$total_realisasi_jenis_belanja = $this->Guzzle_model->getTotalRealisasiJenisBelanjabyKodeSatker($id_dipa);

				foreach ($total_realisasi_jenis_belanja as $key => $value) {
					if ($value['jenis_belanja'] == '51') {
						$data['realisasi_bp'] = $value['total_realisasi'];
					}
					if ($value['jenis_belanja'] == '52') {
						$data['realisasi_bb'] = $value['total_realisasi'];
					}
					if ($value['jenis_belanja'] == '53') {
						$data['realisasi_bm'] = $value['total_realisasi'];
					}
				}

				$data['total_realisasi'] = $data['realisasi_bp'] + $data['realisasi_bb'] + $data['realisasi_bm'];				

				$data['sisa_anggaran'] = $data['total_pagu'] - $data['total_realisasi'];

				// Data Pagu dan Realisasi Anggaran dalam Persen
				$data['persen_realisasi'] = $this->Mcrud->persen($data['total_realisasi'], $data['total_pagu']);
				$data['persen_sisa'] = $this->Mcrud->persen($data['sisa_anggaran'], $data['total_pagu']);

				// Data for Chart Deviasi RPD
				$data['realisasi_rpd'] = $this->Guzzle_model->getDataGrafikDeviasiRpdRealisasi($id_dipa);
				$data['grafik_rpd'] = $this->Guzzle_model->getDataGrafikDeviasi($id_dipa);
			}

			$this->load->view('users/header', $data);
			if ($id_dipa == '00') {
				$this->load->view('users/dashboard_all', $data);
			} else {
				$this->load->view('users/dashboard_kode_satker', $data);
			}
			$this->load->view('users/footer');
		}
	}

	public function profile()
	{
		$ceks = $this->session->userdata('username');
		$id_user = $this->session->userdata('id_user');
		$level = $this->session->userdata('level');
		if(!isset($ceks)) {
			redirect('web/login');
		}else{
			$data['user']  			  = $ceks;
			$data['level_users']  = $level;
			$data['judul_web'] 		= "Profile";

			$this->load->view('users/header', $data);
			$this->load->view('users/profile', $data);
			$this->load->view('users/footer');
		}
	}

}
