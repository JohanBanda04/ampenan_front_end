<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Revisi_dipa extends CI_Controller {
	public function index()
	{
		$id_dipa_user = $this->session->userdata('id_dipa');
		if ($id_dipa_user=='00') {
			redirect('revisi_dipa/v');
		} else {
			redirect('revisi_dipa/v/'.$id_dipa_user);
		}
	}

	public function v($id_dipa='',$aksi='',$id='')
	{
		$id_dipa_user = $this->session->userdata('id_dipa');
		$id = hashids_decrypt($id);
		$ceks 	 = $this->session->userdata('username');
		$id_user = $this->session->userdata('id_user');
		$level 	 = $this->session->userdata('level');

		if(!isset($ceks)) {
			redirect('web/login');
		}

		if ($id_dipa_user=='00') {
			$data['dipa_list'] = $this->Guzzle_model->getDipaList();

			if ($id_dipa == '') {
				$data['revisi_dipa'] = '';
			} else {
				$data['revisi_dipa'] = $this->Guzzle_model->getRevisiDipaByDipaIdUserId($id_dipa, $id_user);
			}
		} else {
			$data['revisi_dipa'] = $this->Guzzle_model->getRevisiDipaByDipaIdUserId($id_dipa, $id_user);
		}

		if ($id_dipa!='') {
			$users_00 = $this->Guzzle_model->getUserByDipaId('00');
			$data['users'] = $this->Guzzle_model->getUserByDipaId($id_dipa);
			$jml_user_dipa = count($data['users']);
			$jml_user_00 = count($users_00);
			for ($i=$jml_user_dipa; $i < $jml_user_dipa+$jml_user_00; $i++) {
				if ($users_00[$i - $jml_user_dipa]['role'] != 'superadmin' AND $users_00[$i - $jml_user_dipa]['role'] != 'koordinator_wilayah') {
					$data['users'][$i] = $users_00[$i - $jml_user_dipa];
				}
			}
		}

		if ($aksi == 't') {
			if ($level!='perencana' AND $level!='pelaksana') {redirect('404');}
			$p = "tambah";
			$data['judul_web'] 	  = "Input Usulan Revisi DIPA";
		} elseif ($aksi == 'd') {
			$p = "detail";
			$data['judul_web'] 	  = "Detail Usulan Revisi DIPA";
			$data['revisi_dipa'] = $this->Guzzle_model->getRevisiDipaById($id);

			if ($data['revisi_dipa'] == null) {
				redirect(404);
			}

			$data['verifikasi_usulan'] = $this->Guzzle_model->getVerifikasiByUsulanRevisiId($id);
			usort($data['verifikasi_usulan'], function($a, $b) {
				return $a['id'] <=> $b['id'];
			});

			$cek_notif = $this->Guzzle_model->getNotifikasiByIdPenerima($id_user);

			$notif_filter = array_filter($cek_notif, function($key) use ($id) {
				return ($key['id_for_link'] == $id);
			});

			foreach ($notif_filter as $key => $value) {
				$this->Mcrud->update_notif($value);
			}
		} elseif ($aksi == 'e') {
			$p = "edit";
			$data['judul_web'] 	  = "Edit Usulan Revisi DIPA";
			$data['revisi_dipa'] = $this->Guzzle_model->getRevisiDipaById($id);
			if ($data['revisi_dipa']['id']=='') {redirect('404');}
		} elseif ($aksi == 'v') {
			$p = "verifikasi";
			$data['judul_web'] 	  = "Usulan Revisi DIPA";
			$data['revisi_dipa'] = $this->Guzzle_model->getRevisiDipaById($id);
			$data['verifikasi_usulan'] = $this->Guzzle_model->getVerifikasiByUsulanRevisiId($id);
			usort($data['verifikasi_usulan'], function($a, $b) {
				return $a['id'] <=> $b['id'];
			});
		} elseif ($aksi == 'h') {
			if ($level!='pelaksana') {redirect('404');}
			$filter = array_filter($data['revisi_dipa'], function($key) {
				return ($key['status_verifikasi_terakhir'] == 'sudah');
			});
			foreach ($filter as $key => $value) {
				if ($value['id'] == $id) {
					redirect('404');
				}
			}
			$cek_data = $this->Guzzle_model->getRevisiDipaById($id);
			if ($cek_data['url_file'] != '') {
				unlink($cek_data['url_file']);
			}
			$this->Guzzle_model->deleteRevisiDipa($id);
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
			redirect('revisi_dipa/v/'.$id_dipa_user);
		}else{
			$p = "index";
			$data['judul_web'] 	  = "USULAN REVISI DIPA";
		}

		$this->load->view('users/header', $data);
		$this->load->view("users/revisi_dipa/$p", $data);
		$this->load->view('users/footer');

		date_default_timezone_set('Asia/Singapore');
		$tgl = date('Y-m-d H:i:s');

		$lokasi = 'file/revisi_dipa';
		$file_size = 1024 * 100; // 3 MB
		$this->upload->initialize(array(
			"upload_path"   => "./$lokasi",
			"allowed_types" => "*",
			"max_size" => "$file_size"
		));

		if (isset($_POST['btnsimpan'])) {
			$jenis_revisi 		 = htmlentities(strip_tags($this->input->post('jenis_revisi')));
			$keterangan 		 = htmlentities(strip_tags($this->input->post('keterangan')));
			$id_dipa  = htmlentities(strip_tags($this->input->post('id_dipa')));
			$id_verifikator_terakhir  = htmlentities(strip_tags($this->input->post('id_user_verifikator_terakhir')));
			$id_verifikator  = htmlentities(strip_tags($this->input->post('id_user_verifikator')));

			if ( ! $this->upload->do_upload('url_file'))
			{
				$simpan = 'n';
				$pesan  = htmlentities(strip_tags($this->upload->display_errors('<p>', '</p>')));
			}
			 else
			{
				$gbr = $this->upload->data();
				$filename = "$lokasi/".$gbr['file_name'];
				$file = preg_replace('/ /', '_', $filename);
				$simpan = 'y';
			}

			if ($simpan=='y') {
				$data1 = array(
					'id_dipa'						=> $id_dipa,
					'keterangan' 					=> $keterangan,
					'jenis_revisi'					=> $jenis_revisi,
					'id_user_verifikator_terakhir'	=> $id_verifikator_terakhir,
					'url_file'						=> $file
				);
				$revisi_dipa_result = $this->Guzzle_model->createRevisiDipa($data1);

				$id_usulan_revisi_dipa = $revisi_dipa_result['id'];

				$data2 = array(
					'id_usulan_revisi_dipa'	=> $id_usulan_revisi_dipa,
					'status_verifikasi' 	=> "belum",
					'komentar'				=> "",
					'id_user_verifikator'	=> $id_verifikator
				);
				$verifikasi_revisi = $this->Guzzle_model->createVerifikasiRevisiDipa($data2);

				if ($revisi_dipa_result['status'] == 201 AND $verifikasi_revisi['status'] == 201) {
					$this->Mcrud->kirim_notif('usulan_revisi_dipa', $id_dipa, $id_usulan_revisi_dipa, $id_user, $id_verifikator);
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
						 <strong>Gagal!</strong> '.$pesan.'.
					</div>
				 <br>'
				);
			  redirect('revisi_dipa/v/'.$id_dipa.'/'.$aksi);
			}
			redirect('revisi_dipa/v/'.$id_dipa);
		}

		if (isset($_POST['btnupdate'])) {
			$jenis_revisi = htmlentities(strip_tags($this->input->post('jenis_revisi')));
			$keterangan = htmlentities(strip_tags($this->input->post('keterangan')));
			$id_verifikator = htmlentities(strip_tags($this->input->post('id_verifikator')));
			$id_dipa = htmlentities(strip_tags($this->input->post('id_dipa')));
			$cek_file = $data['revisi_dipa']['url_file'];
			if ($_FILES['url_file']['error'] <> 4) {
				if ( ! $this->upload->do_upload('url_file'))
				{
						$simpan = 'n';
						$pesan  = htmlentities(strip_tags($this->upload->display_errors('<p>', '</p>')));
				}
				 else
				{
					if ($cek_file!='') {
						unlink($cek_file);
					}
							$gbr = $this->upload->data();
							$filename = "$lokasi/".$gbr['file_name'];
							$file = preg_replace('/ /', '_', $filename);
							$simpan = 'y';
				}
			}else {
				$file = $cek_file;
				$simpan = 'y';
			}

			if ($simpan=='y') {
				$data = array(
					'url_file'						=> $file,
					'id_dipa'						=> $id_dipa,
					'keterangan' 					=> $keterangan,
					'jenis_revisi'					=> $jenis_revisi,
					'id_user_verifikator_terakhir'	=> $id_verifikator
				);
				$revisi_dipa_result = $this->Guzzle_model->updateRevisiDipa($id, $data);

				if ($revisi_dipa_result['status'] == 200) {
					$verifikator = $this->Guzzle_model->getVerifikasiByUsulanRevisiId($id);

					$verifikator_filter = array_filter($verifikator, function($key) {
						return ($key['status_verifikasi'] != 'sudah');
					});
					
					foreach ($verifikator_filter as $key => $value) {
						$id_verifikator = $value['id_user_verifikator'];
						$this->Mcrud->kirim_notif('revisi_usulan_revisi_dipa', $id_dipa, $id, $id_user, $id_verifikator);
					}
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
				redirect('revisi_dipa/v/'.$id_dipa);
				
			 }else {
					 $this->session->set_flashdata('msg',
						 '
						 <div class="alert alert-warning alert-dismissible" role="alert">
							  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
								  <span aria-hidden="true">&times;</span>
							  </button>
							  <strong>Gagal!</strong> '.$pesan.'.
						 </div>
					  <br>'
					 );
					redirect("revisi_dipa/v/$id_dipa/$aksi/".hashids_encrypt($id));
			 }

		}

		if (isset($_POST['btnkonfirm'])) {
			$status_verifikasi 		= htmlentities(strip_tags($this->input->post('status_verifikasi')));
			$id_user_verifikator 	= htmlentities(strip_tags($this->input->post('id_user_verifikator')));
			$id_usulan_revisi_dipa  = htmlentities(strip_tags($this->input->post('id_usulan_revisi_dipa')));
			$komentar  = htmlentities(strip_tags($this->input->post('catatan')));
			$id_verifikasi_usulan = htmlentities(strip_tags($this->input->post('id_verifikasi_usulan')));
			
			$simpan = 'y';
			$id_user_verifikator_terakhir = $data['revisi_dipa']['id_user_verifikator_terakhir'];

			if ($simpan=='y') {
				if ($status_verifikasi == 'tolak') {
					$data = array(
						'status_verifikasi'			=> $status_verifikasi,
						'id_user_verifikator' 		=> $id_user,
						'id_usulan_revisi_dipa'		=> $id_usulan_revisi_dipa,
						'komentar'					=> $komentar
					);
					$verifikasi_result = $this->Guzzle_model->updateVerifikasiRevisiDipa($id_verifikasi_usulan, $data);
				} elseif ($status_verifikasi == 'sudah') {
					$data1 = array(
						'status_verifikasi'			=> $status_verifikasi,
						'id_user_verifikator' 		=> $id_user,
						'id_usulan_revisi_dipa'		=> $id_usulan_revisi_dipa,
						'komentar'					=> $komentar
					);
					$verifikasi_result = $this->Guzzle_model->updateVerifikasiRevisiDipa($id_verifikasi_usulan, $data1);

					if ($id_user != $id_user_verifikator_terakhir) {
						$data2 = array(
							'status_verifikasi'			=> 'belum',
							'id_user_verifikator' 		=> $id_user_verifikator,
							'id_usulan_revisi_dipa'		=> $id_usulan_revisi_dipa,
							'komentar'					=> ""
						);
						$new_verifikator = $this->Guzzle_model->createVerifikasiRevisiDipa($data2);
					}
				}
				
				if ($verifikasi_result['status'] == 200) {
					$user_dipa = $this->Guzzle_model->getUserByDipaId($id_dipa);
					
					$pelaksana = array_filter($user_dipa, function($key) {
						return ($key['role'] == 'pelaksana');
					});
					
					foreach ($pelaksana as $key => $value) {
						$id_pelaksana = $value['id'];
					}
					
					$this->Mcrud->kirim_notif('verifikasi_usulan_revisi_dipa', $id_dipa, $id_usulan_revisi_dipa, $id_user, $id_pelaksana, $status_verifikasi);
				}

				if ($new_verifikator['status'] == 201) {
					$this->Mcrud->kirim_notif('usulan_revisi_dipa', $id_dipa, $id_usulan_revisi_dipa, $id_user, $id_user_verifikator);
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
						 <strong>Gagal!</strong> '.$pesan.'.
					</div>
				 <br>'
				);
			  redirect("revisi_dipa/v/$id_dipa/$aksi");
			}
			redirect('revisi_dipa/v/'.$id_dipa);
		}
			
	}

}