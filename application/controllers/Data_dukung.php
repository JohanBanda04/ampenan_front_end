<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_dukung extends CI_Controller {
	public function index()
	{
		redirect('data_dukung/v');
	}

	public function v($id_folder='',$aksi='',$id='')
	{
		$id_folder_data_dukung = hashids_decrypt($id_folder);
		$id = hashids_decrypt($id);
		$ceks 	 = $this->session->userdata('username');
		$id_user = $this->session->userdata('id_user');
		$level 	 = $this->session->userdata('level');
		if(!isset($ceks)) {
			redirect('web/login');
		}

		$data['folder_data_dukung'] = $this->Guzzle_model->getFolderDataDukungById($id_folder_data_dukung);
		$data['judul_web'] 	  = $data['folder_data_dukung']['uraian'];

		$data['data_dukung'] = $this->Guzzle_model->getDataDukungByFolderId($id_folder_data_dukung);

		if ($aksi == 't') {
			$p = "tambah";
			$data['judul_web'] 	  = "Tambah Data Dukung";
		} elseif ($aksi == 'e') {
			$p = "edit";
			$data['judul_web'] 	  = "Edit Data Dukung";
			$data['data_dukung'] = $this->Guzzle_model->getDataDukungById($id);
			if ($data['data_dukung']['id']=='') {redirect('404');}
		} elseif ($aksi == 'h') {
			$cek_data = $this->Guzzle_model-> getDataDukungById($id);
			if ($cek_data['url_file'] != '') {
				unlink($cek_data['url_file']);
			}
			$this->Guzzle_model->deleteDataDukung($id);
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
			redirect("data_dukung/v/".hashids_encrypt($id_folder_data_dukung));
		}else{
			$p = "index";
		}

		$this->load->view('users/header', $data);
		$this->load->view("users/folder_data_dukung/data_dukung/$p", $data);
		$this->load->view('users/footer');

		date_default_timezone_set('Asia/Singapore');
		$tgl = date('Y-m-d H:i:s');

		$lokasi = 'file/data_dukung';
		$file_size = 1024 * 100; // 3 MB
		$this->upload->initialize(array(
			"upload_path"   => "./$lokasi",
			"allowed_types" => "*",
			"max_size" => "$file_size"
		));

		if (isset($_POST['btnsimpan'])) {
			$name_file 		 = htmlentities(strip_tags($this->input->post('name_file')));

			if ( ! $this->upload->do_upload('file'))
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
				$data = array(
					'id_folder'		=> $id_folder_data_dukung,
					'uraian' 		=> $name_file,
					'url_file'		=> $file
				);
				$this->Guzzle_model->createDataDukung($data);
				
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
				$enkrip = hashids_encrypt($id_folder_data_dukung);
			  redirect("data_dukung/v/$enkrip/$aksi");
			}
			redirect("data_dukung/v/".hashids_encrypt($id_folder_data_dukung));
		}

		if (isset($_POST['btnupdate'])) {
			$name_file = htmlentities(strip_tags($this->input->post('name_file')));
			$id_file = htmlentities(strip_tags($this->input->post('id')));
			$id_folder = htmlentities(strip_tags($this->input->post('id_folder_data_dukung')));
			$data['data_dukung'] = $this->Guzzle_model->getDataDukungById($id_file);
			$cek_file = $data['data_dukung']['url_file'];
			if ($_FILES['file']['error'] <> 4) {
				if ( ! $this->upload->do_upload('file'))
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
					'url_file'		=> $file,
					'id_folder'		=> $id_folder,
					'uraian' 		=> $name_file,
				);
				$this->Guzzle_model->updateDataDukung($id, $data);
				
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
				redirect("data_dukung/v/".hashids_encrypt($id_folder_data_dukung));
				
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
					redirect("data_dukung/v/$aksi/".hashids_encrypt($id_folder_data_dukung));
			 }

		}
			
	}

}