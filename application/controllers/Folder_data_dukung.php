<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Folder_data_dukung extends CI_Controller {
	public function index()
	{
		$ceks 		 = $this->session->userdata('username');

		if(!isset($ceks)) {
			redirect('web/login');
		}
		
		$id_dipa_user = $this->session->userdata('id_dipa');
		redirect("folder_data_dukung/v/".$id_dipa_user);
	}

	public function v($id_dipa='',$aksi='',$id='')
	{
		$id = hashids_decrypt($id);
		$ceks 	 = $this->session->userdata('username');
		$id_user = $this->session->userdata('id_user');
		$level 	 = $this->session->userdata('level');
		$id_dipa_user = $this->session->userdata('id_dipa');
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

		$data['folder_data_dukung'] = $this->Guzzle_model->getAllFolderDataDukung();
		
		if ($id_dipa!='00') {
			$data['folder_data_dukung'] = $this->Guzzle_model->getFolderDataDukungByDipaId($id_dipa);
			$data['judul_tabel'] = $arraydipa_id_nama[$id_dipa];
		}

		
		if ($aksi == 't') {
			$p = "tambah";
			$data['judul_web'] 	  = "Buat Folder";
		} elseif ($aksi == 'e') {
			$p = "edit";
			$data['judul_web'] 	  = "Edit Folder";
			$data['folder_data_dukung'] = $this->Guzzle_model->getFolderDataDukungById($id);
			if ($data['folder_data_dukung']['id']=='') {redirect('404');}
		} elseif ($aksi == 'h') {
			$cek_data = $this->Guzzle_model->getFolderDataDukungById($id);
			if (count($cek_data) != 0) {
				$cek_data_dukung = $this->Guzzle_model->getDataDukungByFolderId($id);
				foreach ($cek_data_dukung as $key => $value) {
					if ($value['url_file'] != '') {
						unlink($value['url_file']);
					}
				}
				$this->Guzzle_model->deleteFolderDataDukung($id);
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
				redirect("folder_data_dukung/v/$id_dipa");
			}else {
				redirect('404_content');
			}
		}else{
			$p = "index";
			$data['judul_web'] 	  = "Data Dukung";
		}

		$this->load->view('users/header', $data);
		$this->load->view("users/folder_data_dukung/$p", $data);
		$this->load->view('users/footer');

		date_default_timezone_set('Asia/Singapore');
		$tgl = date('Y-m-d H:i:s');

		if (isset($_POST['btnsimpan'])) {
			$name_folder = htmlentities(strip_tags($this->input->post('name_folder')));
			$simpan = 'y';

			if ($simpan=='y') {
				$data = array(
					'uraian'	=> $name_folder,
					'id_dipa'	=> $id_dipa
				);
				$this->Guzzle_model->createFolderDataDukung($data);

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
			redirect("folder_data_dukung/v/$id_dipa");
		}

		if (isset($_POST['btnupdate'])) {
			$name_folder = htmlentities(strip_tags($this->input->post('name_folder')));
			$simpan = 'y';

			if ($simpan=='y') {
				$data = array(
					'uraian' => $name_folder
				);
				$this->Guzzle_model->updateFolderDataDukung($id, $data);

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
				
				redirect("folder_data_dukung/v/$id_dipa");
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
				 redirect("folder_data_dukung/v/$id_dipa/e/".hashids_encrypt($id));
			}
		}
	}
}