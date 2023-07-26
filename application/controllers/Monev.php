<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Monev extends CI_Controller {
	public function index()
	{
		$id_dipa_user = $this->session->userdata('id_dipa');
		$ceks 		 = $this->session->userdata('username');

		if(!isset($ceks)) {
			redirect('web/login');
		}

		if ($id_dipa_user == '00') {
			redirect("monev/v/i");
		} else {
			redirect("monev/v/i/".$id_dipa_user);
		}
	}

	public function v($jenis='', $id_dipa='',$id='',$aksi='')
	{
		$id = hashids_decrypt($id);
		$ceks 	 = $this->session->userdata('username');
		$id_user = $this->session->userdata('id_user');
		$level 	 = $this->session->userdata('level');
		$id_dipa_user = $this->session->userdata('id_dipa');
		$lokasi = $this->session->userdata('lokasi');

		if(!isset($ceks)) {
			redirect('web/login');
		}
		
		$data['dipa_list'] = $this->Guzzle_model->getDipaList();
		$arraydipa_id_nama = [];
		foreach($data['dipa_list'] as $key => $val){
			$arraydipa_id_nama[$val['id']] = $val['nama'];
		}

		if ($level == 'kpa' AND $lokasi == 'kanwil') {
			$data['dipa_list'] = array_filter($data['dipa_list'], function($key) {
					return ($key['lokasi'] == 'kanwil');
				});
		}
		
		if ($id_dipa_user=='00') {
			$id_dipa = $id_dipa;
		} else {
			$id_dipa = $id_dipa_user;
		}
		
		if ($jenis == 'i') {
			$jenis_monev = 'insidental';
			$data['judul_tabel_jenis'] = 'Insidental';
		} elseif ($jenis == 't1') {
			$jenis_monev = 'triwulan1';
			$data['judul_tabel_jenis'] = 'Triwulan I';
		} elseif ($jenis == 't2') {
			$jenis_monev = 'triwulan2';
			$data['judul_tabel_jenis'] = 'Triwulan II';
		} elseif ($jenis == 't3') {
			$jenis_monev = 'triwulan3';
			$data['judul_tabel_jenis'] = 'Triwulan III';
		} elseif ($jenis == 't4') {
			$jenis_monev = 'triwulan4';
			$data['judul_tabel_jenis'] = 'Triwulan IV';
		}
		
		$data['monev'] = null;
		$data['judul_tabel_dipa'] = '';
		if ($id_dipa != '') {
			$data['judul_tabel_dipa'] = $arraydipa_id_nama[$id_dipa];
			$data['monev_list'] = $this->Guzzle_model->getMonevByDipaIdJenisMonev($id_dipa, $jenis_monev);
				if ($id != '') {
					$data['monev'] = $this->Guzzle_model->getMonevById($id);
				}
		}
		
		if ($aksi == 't') {
			if ($ceks!='kakanwil') {redirect('404');}
			$p = "tambah";
			$data['judul_web'] 	  = "Input Rekomendasi";
		} elseif ($aksi == 'tl') {
			if ($level!='kpa') {redirect('404');}
			$p = "tindaklanjut";
			$data['judul_web'] 	  = "Input Tindak Lanjut Rekomendasi";
		} elseif ($aksi == 'er') {
			if ($ceks!='kakanwil') {redirect('404');}
			$p = "edit";
			$data['judul_web'] 	  = "Edit Rekomendasi";
		} elseif ($aksi == 'etl') {
			if ($level!='kpa') {redirect('404');}
			$p = "edit_tindaklanjut";
			$data['judul_web'] 	  = "Edit Tindak Lanjut Rekomendasi";
		} elseif ($aksi == 'h') {
			$cek_data = $this->Guzzle_model->getMonevById($id);
			if (count($cek_data) != 0) {
				$this->Guzzle_model->deleteMonev($id);
				$notif = $this->Guzzle_model->getAllNotifikasi();

				$notif_filter = array_filter($notif, function($key) use ($id) {
					return ($key['id_for_link'] == $id);
				});

				foreach ($notif_filter as $key => $value) {
					$this->Guzzle_model->deleteNotifikasi($value['id']);
				}

				$this->session->set_flashdata('msg',
					'
					<div class="alert alert-success alert-dismissible" role="alert">
						 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
							 <span aria-hidden="true">&times;</span>
						 </button>
						 <strong>Sukses!</strong> Berhasil dihapus.
					</div>
					<br>'
				);
				redirect("monev/v/$jenis/$id_dipa");
				
			}else {
				redirect('404_content');
			}
		} else {
			$data['judul_web'] 	  = "Monitoring dan Evaluasi";
			$p = "index";

			$cek_notif = $this->Guzzle_model->getNotifikasiByIdPenerima($id_user);

			$notif_filter = array_filter($cek_notif, function($key) use ($data) {
				return ($key['id_for_link'] == $data['monev']['id']);
			});

			foreach ($notif_filter as $key => $value) {
				$this->Mcrud->update_notif($value);
			}
		}

		$this->load->view('users/header', $data);
		$this->load->view("users/monev/$p", $data);
		$this->load->view('users/footer');

		date_default_timezone_set('Asia/Singapore');
		$tgl = date('Y-m-d H:i:s');

		if (isset($_POST['btnsimpan'])) {
			$judul = htmlentities(strip_tags($this->input->post('judul')));
			$rekomendasi = htmlentities(strip_tags($this->input->post('rekomendasi')));

			$simpan = 'y';

			if ($simpan=='y') {
				$data = array(
					'judul'					=> $judul,
					'rekomendasi'			=> $rekomendasi,
					'kode_satker_tujuan'	=> $id_dipa,
					'jenis_rekomendasi'		=> $jenis_monev
				);
				$result = $this->Guzzle_model->createMonev($data);

				if ($result['status'] == 201) {
					$user_dipa = $this->Guzzle_model->getUserByDipaId($id_dipa);
					
					$kpa = array_filter($user_dipa, function($key) {
						return ($key['role'] == 'kpa');
					});

					if ($kpa == null) {
						$id_kpa = 6;
					} else {
						foreach ($kpa as $key => $value) {
							$id_kpa = $value['id'];
						}
					}
	
					$this->Mcrud->kirim_notif('monev', $id_dipa, $result['id'], $id_user, $id_kpa, $jenis);
				}

				$this->session->set_flashdata('msg',
					'
					<div class="alert alert-success alert-dismissible" role="alert">
						 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
							 <span aria-hidden="true">&times;</span>
						 </button>
						 <strong>Sukses!</strong> Berhasil disimpan.
					</div>
				 <br>'
				);
			}else {
				$this->session->set_flashdata('msg',
					'
					<div class="alert alert-warning alert-dismissible" role="alert">
						 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
							 <span aria-hidden="true">&times;</span>
						 </button>
						 <strong>Gagal!</strong>.
					</div>
				 <br>'
				);
			}
			redirect("monev/v/$jenis/$id_dipa");
		}

		if (isset($_POST['btnsimpantl'])) {
			$tindak_lanjut_rekomendasi = htmlentities(strip_tags($this->input->post('tindak_lanjut_rekomendasi')));
			$id_monev = htmlentities(strip_tags($this->input->post('id_monev')));

			$data_lama = $this->Guzzle_model->getMonevById($id_monev);

			$simpan = 'y';

			if ($simpan=='y') {
				$data = array(
					'judul'						=> $data_lama['judul'],
					'rekomendasi'				=> $data_lama['rekomendasi'],
					'kode_satker_tujuan'		=> $id_dipa,
					'tindak_lanjut_rekomendasi'	=> $tindak_lanjut_rekomendasi
				);
				$result = $this->Guzzle_model->updateMonev($id_monev, $data);

				if ($result['status'] == 200) {
					$this->Mcrud->kirim_notif('tindak_lanjut_monev', $id_dipa, $id, $id_user, 2, $jenis);
				}

				$this->session->set_flashdata('msg',
					'
					<div class="alert alert-success alert-dismissible" role="alert">
						 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
							 <span aria-hidden="true">&times;</span>
						 </button>
						 <strong>Sukses!</strong> Berhasil disimpan.
					</div>
				 <br>'
				);
			}else {
				$this->session->set_flashdata('msg',
					'
					<div class="alert alert-warning alert-dismissible" role="alert">
						 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
							 <span aria-hidden="true">&times;</span>
						 </button>
						 <strong>Gagal!</strong>.
					</div>
				 <br>'
				);
			}
			redirect("monev/v/$jenis/$id_dipa/".hashids_encrypt($id));
		}

		if (isset($_POST['btnupdate'])) {
			$judul = htmlentities(strip_tags($this->input->post('judul')));
			$rekomendasi = htmlentities(strip_tags($this->input->post('rekomendasi')));

			$data_lama = $this->Guzzle_model->getMonevById($id);

			$simpan = 'y';

			if ($simpan=='y') {
				$data = array(
					'judul'					=> $judul,
					'rekomendasi'			=> $rekomendasi,
					'kode_satker_tujuan'	=> $data_lama['kode_satker_tujuan']
				);
				$result = $this->Guzzle_model->updateMonev($id, $data);

				if ($result['status'] == 200) {
					$user_dipa = $this->Guzzle_model->getUserByDipaId($data_lama['kode_satker_tujuan']);
					
					$kpa = array_filter($user_dipa, function($key) {
						return ($key['role'] == 'kpa');
					});

					if ($kpa == null) {
						$id_kpa = 6;
					} else {
						foreach ($kpa as $key => $value) {
							$id_kpa = $value['id'];
						}
					}
					
	
					$this->Mcrud->kirim_notif('monev', $data_lama['kode_satker_tujuan'], $id, $id_user, $id_kpa, $jenis);
				}

				$this->session->set_flashdata('msg',
					'
					<div class="alert alert-success alert-dismissible" role="alert">
						 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
							 <span aria-hidden="true">&times;</span>
						 </button>
						 <strong>Sukses!</strong> Berhasil disimpan.
					</div>
				 <br>'
				);
			}else {
				$this->session->set_flashdata('msg',
					'
					<div class="alert alert-warning alert-dismissible" role="alert">
						 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
							 <span aria-hidden="true">&times;</span>
						 </button>
						 <strong>Gagal!</strong>.
					</div>
				 <br>'
				);
			}
			redirect("monev/v/$jenis/$id_dipa/".hashids_encrypt($id));
		}

		
	}
}