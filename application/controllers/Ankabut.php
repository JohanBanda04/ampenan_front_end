<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ankabut extends CI_Controller {
	public function index()
	{
		$ceks 		 = $this->session->userdata('username');

		if(!isset($ceks)) {
			redirect('web/login');
		}
		
		$id_dipa_user = $this->session->userdata('id_dipa');
		redirect("ankabut/v/".$id_dipa_user);
	}

	public function v($id_dipa='',$aksi='',$id='')
	{
		$id = hashids_decrypt($id);
		$ceks 	 = $this->session->userdata('username');
		$id_user = $this->session->userdata('id_user');
		$level 	 = $this->session->userdata('level');
		$id_dipa_user = $this->session->userdata('id_dipa');
		$lokasi_user = $this->session->userdata('lokasi');

		
		if(!isset($ceks)) {
			redirect('web/login');
		}

		if ($id_dipa_user!='00') {
			if ($id_dipa!=$id_dipa_user) {
				redirect('404');
			}
		}

		$data['dipa_list'] = $this->Guzzle_model->getDipaList();
		$arraydipa_id_nama = [];
		foreach($data['dipa_list'] as $key => $val){
			$arraydipa_id_nama[$val['id']] = $val['nama'];
		}
		
		if ($id_dipa!='00') {
			$data['ankabut'] = $this->Guzzle_model->getAnkabutByDipaId($id_dipa);
			$data['judul_tabel'] = $arraydipa_id_nama[$id_dipa];
		}
		
		if ($aksi == 't') {
			if ($level!='pelaksana') {redirect('404');}
			$p = "tambah";
			$data['judul_web'] 	  = "Input Analisa Kebutuhan Anggaran";
		} elseif ($aksi == 'd') {
			$p = "detail";
			$data['judul_web'] 	  = "Detil Analisa Kebutuhan Anggaran";

			$data['ankabut'] = $this->Guzzle_model->getAnkabutById($id);
		} elseif ($aksi == 'e') {
			$p = "edit";
			$data['judul_web'] 	  = "Edit Analisa Kebutuhan Anggaran";
			$data['ankabut'] = $this->Guzzle_model->getAnkabutById($id);

			if ($data['ankabut']['id']==''){redirect('404');}
		} elseif ($aksi == 'h') {
			$cek_data = $this->Guzzle_model->getAnkabutById($id);
			if (count($cek_data) != 0) {
				if ($cek_data['url_file'] != '') {
					unlink($cek_data['url_file']);
				}
				$this->Guzzle_model->deleteAnkabut($id);
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
				redirect("ankabut/v/$id_dipa");
				
			}else {
				redirect('404_content');
			}
		}else{
			$p = "index";
			$data['judul_web'] 	  = "Analisa Kebutuhan Anggaran";
		}

		$this->load->view('users/header', $data);
		$this->load->view("users/ankabut/$p", $data);
		$this->load->view('users/footer');

		date_default_timezone_set('Asia/Singapore');
		$tgl = date('Y-m-d H:i:s');

		$lokasi = 'file/ankabut';
		$file_size = 1024 * 100; // 10 MB
		$this->upload->initialize(array(
			"upload_path"   => "./$lokasi",
			"allowed_types" => "*",
			"max_size" => "$file_size"
		));

		if (isset($_POST['btnsimpan'])) {
			$uraian = htmlentities(strip_tags($this->input->post('uraian')));

			if ( ! $this->upload->do_upload('url_file'))
			{
				$simpan = 'n';
				$pesan  = htmlentities(strip_tags($this->upload->display_errors('<p>', '</p>')));
			}
			else
			{
				$gbr = $this->upload->data();
				$filename = "$lokasi/".$gbr['file_name'];
				$url_file = preg_replace('/ /', '_', $filename);
				$simpan = 'y';
			}

			if ($simpan=='y') {
				$data = array(
					'uraian'				=> $uraian,
					'id_dipa'				=> $id_dipa,
					'url_file'				=> $url_file

				);
 
				$this->Guzzle_model->createAnkabut($data);

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
						 <strong>Gagal!</strong>
					</div>
				 <br>'
				);
			}
			redirect("ankabut/v/$id_dipa");
		}

		if (isset($_POST['btnupdate'])) {
			$uraian = htmlentities(strip_tags($this->input->post('uraian')));
			$cek_file = $data['ankabut']['url_file'];
			if ($_FILES['url_file']['error'] <> 4) {
				if ( ! $this->upload->do_upload('url_file'))
				{
					$simpan = 'n';
					$pesan  = htmlentities(strip_tags($this->upload->display_errors('<p>', '</p>')));
				} else {
					if ($cek_file!='') {
						unlink($cek_file);
					}
					$gbr = $this->upload->data();
					$filename = "$lokasi/".$gbr['file_name'];
					$url_file = preg_replace('/ /', '_', $filename);
					$simpan = 'y';
				}
			} else {
				$url_file = $cek_file;
				$simpan = 'y';
			}
				
			if ($simpan=='y') {
				$data = array(
					'uraian' => $uraian,
					'url_file' => $url_file,
					'id_dipa' => $id_dipa
				);
				$this->Guzzle_model->updateAnkabut($id, $data);

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
				redirect("ankabut/v/$id_dipa");
			} else {
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
			redirect("ankabut/v/$id_dipa/e".hashids_encrypt($id));
			}

		}

	}
}