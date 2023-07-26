<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Datapengguna extends CI_Controller {

	public function index()
	{
		redirect('datapengguna/v');
	}

	public function v($aksi='', $id='')
	{
		$id = hashids_decrypt($id);
		$ceks 	 = $this->session->userdata('username');
		$id_user = $this->session->userdata('id_user');
		$level 	 = $this->session->userdata('level');
		$id_dipa_user = $this->session->userdata('id_dipa');
		$lokasi_user = $this->session->userdata('lokasi');

		
		
		
		if(!isset($ceks)) {
			redirect('web/login');
		}else{
			
			if ($level != 'superadmin') {
				redirect('404_content');
			}
			
			$user_list = $this->Guzzle_model->getAllUser();
			foreach ($user_list as $key => $value) {
				if ($value['role'] == 'superadmin') continue;
				$data['user_list'][$key] = $value;
			}

			$data['dipa_list'] = $this->Guzzle_model->getDipaList();

			if ($aksi == 't') {
				$p = "tambah";
				$data['judul_web'] 	  = "Tambah Pengguna";
			}elseif ($aksi == 'e') {
				$p = "edit";
				$data['judul_web'] 	  = "Edit Data Pengguna";
				$data['pengguna'] = $this->Guzzle_model->getUserById($id);
				if ($data['pengguna']['id']=='') {redirect('404');}
			}
			elseif ($aksi == 'h') {
				$cek_data = $this->Guzzle_model->getUserById($id);
				if (count($cek_data) != 0 AND $cek_data['role'] != 'superadmin') {
					$this->db->delete('tbl_user', array('id_user' => $id));
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
					redirect("datapengguna/v");
				}else {
					redirect('404');
				}
			} else {
				$p = "index";
				$data['judul_web'] 	  = "Pengguna";
			}


			
			$this->load->view('users/header', $data);
			$this->load->view("users/datapengguna/$p", $data);
			$this->load->view('users/footer');

			date_default_timezone_set('Asia/Jakarta');
			$tgl = date('Y-m-d H:i:s');

			if (isset($_POST['btnsimpan'])) {
				$nama 	 = htmlentities(strip_tags($this->input->post('nama')));
				$id_dipa  = htmlentities(strip_tags($this->input->post('id_dipa')));
				$role  = htmlentities(strip_tags($this->input->post('role')));
				$lokasi  = htmlentities(strip_tags($this->input->post('lokasi')));
				$username = htmlentities(strip_tags($this->input->post('username')));
				$password  = htmlentities(strip_tags($this->input->post('password')));
				$password2 = htmlentities(strip_tags($this->input->post('password2')));

				$cek_username = array_search($username, array_column($user_list, 'username', 'id'));

				$pesan  = '';
				$simpan = 'y';
				
				if ($cek_username != null) {
					$simpan = 'n';
					$pesan  = "Username '<b>$username</b>' sudah ada";
				} else {
					if ($password!=$password2) {
						$simpan = 'n';
						$pesan  = "Password tidak cocok!";
					}
				}

				if ($simpan=='y') {
					$data = array(
						'nama'			 => $nama,
						'username' 		 => $username,
						'password' 		 => $password,
						'role' 			 => $role,
						'id_dipa' 		 => $id_dipa,
						'lokasi' 		 => $lokasi
					);
					$this->Guzzle_model->createUser($data);
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
					 redirect("datapengguna/v/t");
				}
				 redirect("datapengguna/v");
			}

			if (isset($_POST['btnupdate'])) {
				$nama 	 = htmlentities(strip_tags($this->input->post('nama')));
				$level  = htmlentities(strip_tags($this->input->post('level')));
				$divisi  = htmlentities(strip_tags($this->input->post('divisi')));
				$username = htmlentities(strip_tags($this->input->post('username')));
				$password  = htmlentities(strip_tags($this->input->post('password')));
				$password2 = htmlentities(strip_tags($this->input->post('password2')));
				$data_lama = $this->db->get_where('tbl_user', array('id_user'=>$id))->row();
				$cek_data  = $this->db->get_where('tbl_user', array('username'=>$username,'username!='=>$data_lama->username));
				
				$pesan  = '';
				$simpan = 'y';

				if ($cek_data->num_rows()!=0) {
					$simpan = 'n';
					$pesan  = "Username '<b>$username</b>' sudah ada";
				} else {
					$pass_lama = $data_lama->password;
					if ($password=='') {
						$password = $pass_lama;
					} else {
						if ($password!=$password2) {
							$simpan = 'n';
							$pesan  = "Password tidak cocok!";
						}
					}
				}

				if ($simpan=='y') {
					$data = array(
						'nama_lengkap' => $nama,
						'username' 		 => $username,
						'password' 		 => $password,
						'level'			=> $level,
						'divisi'			=> $divisi
					);
					$this->db->update('tbl_user',$data, array('id_user'=>$id));

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
					redirect("datapengguna/v/e/".hashids_encrypt($id));
				}
				redirect("datapengguna/v");
			}
		}
	}

}
				

