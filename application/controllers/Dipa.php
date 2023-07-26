<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dipa extends CI_Controller {
	public function index()
	{
		redirect('dipa/v');
	}

	public function v($aksi='',$id='')
	{
		$id_dipa = $this->session->userdata('id_dipa');
		$id = hashids_decrypt($id);
		$ceks 	 = $this->session->userdata('username');
		$id_user = $this->session->userdata('id_user');
		$level 	 = $this->session->userdata('level');

		if(!isset($ceks)) {
			redirect('web/login');
		}

		// $data['user']  			  = $this->Mcrud->get_users_by_un($ceks);

		if ($id_dipa=='00') {
			$data['dipa_list'] = $this->Guzzle_model->getDipaList();
		} else {
			$data['dipa'] = $this->Guzzle_model->getDokumenDipaByDipaId($id_dipa);
		}

		if ($aksi == 't') {
			if ($level!='pelaksana') {redirect('404');}
			$p = "tambah";
			$data['judul_web'] 	  = "Tambah Dokumen DIPA";
		} elseif ($aksi == 'e') {
			if ($level!='pelaksana') {redirect('404');}
			$p = "edit";
			$data['judul_web'] 	  = "Edit Dokumen DIPA";
			$data['dipa'] = $this->Guzzle_model->getDokumenDipaById($id);
			if ($data['dipa']['id']=='') {redirect('404');}
		} elseif ($aksi == 'h') {
			if ($level!='pelaksana') {redirect('404');}
			$cek_data = $this->Guzzle_model->getDokumenDipaById($id);
			if ($cek_data['url_file_dipa'] != '') {
				unlink($cek_data['url_file_dipa']);
			}

			if ($cek_data['url_file_lkk'] != '') {
				unlink($cek_data['url_file_lkk']);
			}
			$this->Guzzle_model->deleteDokumenDipa($id);
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
			redirect("dipa/v");

		}else{
			$p = "index";
			$data['judul_web'] 	  = "DIPA";
		}

		$this->load->view('users/header', $data);
		$this->load->view("users/dipa/$p", $data);
		$this->load->view('users/footer');

		date_default_timezone_set('Asia/Singapore');
		$tgl = date('Y-m-d H:i:s');

		$lokasi = 'file/dipa';
		$file_size = 1024 * 100; // 3 MB
		$this->upload->initialize(array(
			"upload_path"   => "./$lokasi",
			"allowed_types" => "*",
			"max_size" => "$file_size"
		));

		if (isset($_POST['btnsimpan'])) {
			$nama 		 = htmlentities(strip_tags($this->input->post('nama')));
			$keterangan 		 = htmlentities(strip_tags($this->input->post('keterangan')));
			$id_dipa  = htmlentities(strip_tags($this->input->post('id_dipa')));

			if ( ! $this->upload->do_upload('url_file_dipa'))
			{
				$pesan1  = htmlentities(strip_tags($this->upload->display_errors('<p>', '</p>')));
			}
			else
			{
				$gbr = $this->upload->data();
				$filename = "$lokasi/".$gbr['file_name'];
				$url_file_dipa = preg_replace('/ /', '_', $filename);
			}

			if ( ! $this->upload->do_upload('url_file_lkk'))
			{
				$pesan2  = htmlentities(strip_tags($this->upload->display_errors('<p>', '</p>')));
			}
			else
			{
				$gbr = $this->upload->data();
				$filename = "$lokasi/".$gbr['file_name'];
				$url_file_lkk = preg_replace('/ /', '_', $filename);
				
			}
			
			if ($url_file_dipa!=null && $url_file_lkk!=null) {
				$data = array(
					'id_dipa'			=> $id_dipa,
					'nama' 				=> $nama,
					'keterangan'		=> $keterangan,
					'url_file_dipa'		=> $url_file_dipa,
					'url_file_lkk'		=> $url_file_lkk
				);
				
				$this->Guzzle_model->createDokumenDipa($data);

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
				if($pesan1 != null) {
					$this->session->set_flashdata('msg',
						'
						<div class="alert alert-warning alert-dismissible" role="alert">
							 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
								 <span aria-hidden="true">&times;</span>
							 </button>
							 <strong>Gagal unggah file DIPA!</strong> '.$pesan1.'.
						</div>
					 <br>'
					);
				}
				if($pesan2 != null) {
					$this->session->set_flashdata('msg',
						'
						<div class="alert alert-warning alert-dismissible" role="alert">
							 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
								 <span aria-hidden="true">&times;</span>
							 </button>
							 <strong>Gagal unggah file Lembar Kertas Kerja!</strong> '.$pesan2.'.
						</div>
					 <br>'
					);
				}
			  redirect("dipa/v/$aksi");
			}
			redirect("dipa/v");
		}

		if (isset($_POST['btnupdate'])) {
			$nama 		 = htmlentities(strip_tags($this->input->post('nama')));
			$keterangan  = htmlentities(strip_tags($this->input->post('keterangan')));
			$id_dipa  = htmlentities(strip_tags($this->input->post('id_dipa')));
			
			$data['dipa'] = $this->Guzzle_model->getDokumenDipaById($id);
			$cek_file_dipa = $data['dipa']['url_file_dipa'];
			if ($_FILES['url_file_dipa']['error'] <> 4) {
				if ( ! $this->upload->do_upload('url_file_dipa'))
				{
					$simpan = 'n';
					$pesan  = htmlentities(strip_tags($this->upload->display_errors('<p>', '</p>')));
				}
				else
				{
					if ($cek_file_dipa!='') {
						unlink($cek_file_dipa);
					}

					$gbr = $this->upload->data();
					$filename = "$lokasi/".$gbr['file_name'];
					$url_file_dipa = preg_replace('/ /', '_', $filename);
					$simpan = 'y';
					
				}
			}else {
				$url_file_dipa = $cek_file_dipa;
				$simpan = 'y';
			}

			$cek_file_lkk = $data['dipa']['url_file_lkk'];
			if ($_FILES['url_file_lkk']['error'] <> 4) {
				if ( ! $this->upload->do_upload('url_file_lkk'))
				{
					$simpan = 'n';
					$pesan  = htmlentities(strip_tags($this->upload->display_errors('<p>', '</p>')));
				}
				else
				{
					if ($cek_file_lkk!='') {
						unlink($cek_file_lkk);
					}

					$gbr = $this->upload->data();
					$filename = "$lokasi/".$gbr['file_name'];
					$url_file_lkk = preg_replace('/ /', '_', $filename);
					$simpan = 'y';
					
				}
			}else {
				$url_file_lkk = $cek_file_lkk;
				$simpan = 'y';
			}


			if ($simpan=='y') {
				$data = array(
					'id_dipa'			=> $id_dipa,
					'nama' 				=> $nama,
					'keterangan'		=> $keterangan,
					'url_file_dipa'		=> $url_file_dipa,
					'url_file_lkk'		=> $url_file_lkk
				);
				$this->Guzzle_model->updateDokumenDipa($id, $data);
				
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
				redirect("dipa/v");
				
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
					redirect("dipa/v/e/".hashids_encrypt($id));
			 }

		}
			
	}

}