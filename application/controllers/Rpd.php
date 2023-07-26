<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rpd extends CI_Controller {
	public function index()
	{
		$id_dipa_user = $this->session->userdata('id_dipa');
		$ceks 		 = $this->session->userdata('username');

		if(!isset($ceks)) {
			redirect('web/login');
		}

		if ($id_dipa_user == '00') {
			redirect("rpd/v");
		} else {

			$data['rpd'] = $this->Guzzle_model->getRPDByDipaId($id_dipa_user);
			$revisi = count($data['rpd']) - 1;
			redirect("rpd/v/".$id_dipa_user."/".$revisi);
		}
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
		
		$data['dipa_list'] = $this->Guzzle_model->getDipaList();
		$arraydipa_id_nama = [];
		foreach($data['dipa_list'] as $key => $val){
			$arraydipa_id_nama[$val['id']] = $val['nama'];
		}
				
		if ($id_dipa_user!='00') {
			if ($id_dipa!=$id_dipa_user) {
				redirect('404');
			}
			$data['rpd_dipa'] = $this->Guzzle_model->getRPDByDipaId($id_dipa_user);
			$revisi_redirect = count($data['rpd_dipa']);
		}

		if ($aksi == 't') {
			if ($level!='pelaksana') {redirect('404');}
			$p = "revisi";
			$data['judul_web'] 	  = "Input Disbursement Plan";
			if (count($data['rpd_dipa']) != 0) {
				redirect('404_content');
			}
		} elseif ($aksi == 'r') {
			if ($level!='pelaksana') {redirect('404');}
			$p = "revisi";
			$data['judul_web'] 	  = "Revisi Rencana Penarikan Dana";
			
		} else {
			if ($id_dipa_user=='00') {
				$p = "index_all";
				$data['judul_tabel'] = $arraydipa_id_nama[$id_dipa];

				if ($id_dipa != '') {
					$data['rpd_dipa'] = $this->Guzzle_model->getRPDByDipaId($id_dipa);
				}
				if ($id_dipa != '' AND $aksi != '') {
					$data['rpd'] = $this->Guzzle_model->getRPDByDipaIdRevisi($id_dipa, $aksi);
				}
			} else {
				$p = "index_satker";
				$data['rpd'] = $this->Guzzle_model->getRPDByDipaIdRevisi($id_dipa_user, $aksi);
				$data['judul_tabel'] = $arraydipa_id_nama[$id_dipa_user];
			}
			$data['judul_web'] 	  = "Rencana Penarikan Dana (RPD)";
		}

		$this->load->view('users/header', $data);
		$this->load->view("users/rpd/$p", $data);
		$this->load->view('users/footer');

		date_default_timezone_set('Asia/Singapore');
		$tgl = date('Y-m-d H:i:s');

		$lokasi = 'file/rpd';
		$file_size = 1024 * 100; // 3 MB
		$this->upload->initialize(array(
			"upload_path"   => "./$lokasi",
			"allowed_types" => "*",
			"max_size" => "$file_size"
		));

		if (isset($_POST['btnsimpan'])) {
			$januari_pegawai = htmlentities(strip_tags($this->input->post('januari_pegawai')));
			$januari_barang = htmlentities(strip_tags($this->input->post('januari_barang')));
			$januari_modal = htmlentities(strip_tags($this->input->post('januari_modal')));
			$februari_pegawai = htmlentities(strip_tags($this->input->post('februari_pegawai')));
			$februari_barang = htmlentities(strip_tags($this->input->post('februari_barang')));
			$februari_modal = htmlentities(strip_tags($this->input->post('februari_modal')));
			$maret_pegawai = htmlentities(strip_tags($this->input->post('maret_pegawai')));
			$maret_barang = htmlentities(strip_tags($this->input->post('maret_barang')));
			$maret_modal = htmlentities(strip_tags($this->input->post('maret_modal')));
			$april_pegawai = htmlentities(strip_tags($this->input->post('april_pegawai')));
			$april_barang = htmlentities(strip_tags($this->input->post('april_barang')));
			$april_modal = htmlentities(strip_tags($this->input->post('april_modal')));
			$mei_pegawai = htmlentities(strip_tags($this->input->post('mei_pegawai')));
			$mei_barang = htmlentities(strip_tags($this->input->post('mei_barang')));
			$mei_modal = htmlentities(strip_tags($this->input->post('mei_modal')));
			$juni_pegawai = htmlentities(strip_tags($this->input->post('juni_pegawai')));
			$juni_barang = htmlentities(strip_tags($this->input->post('juni_barang')));
			$juni_modal = htmlentities(strip_tags($this->input->post('juni_modal')));
			$juli_pegawai = htmlentities(strip_tags($this->input->post('juli_pegawai')));
			$juli_barang = htmlentities(strip_tags($this->input->post('juli_barang')));
			$juli_modal = htmlentities(strip_tags($this->input->post('juli_modal')));
			$agustus_pegawai = htmlentities(strip_tags($this->input->post('agustus_pegawai')));
			$agustus_barang = htmlentities(strip_tags($this->input->post('agustus_barang')));
			$agustus_modal = htmlentities(strip_tags($this->input->post('agustus_modal')));
			$september_pegawai = htmlentities(strip_tags($this->input->post('september_pegawai')));
			$september_barang = htmlentities(strip_tags($this->input->post('september_barang')));
			$september_modal = htmlentities(strip_tags($this->input->post('september_modal')));
			$oktober_pegawai = htmlentities(strip_tags($this->input->post('oktober_pegawai')));
			$oktober_barang = htmlentities(strip_tags($this->input->post('oktober_barang')));
			$oktober_modal = htmlentities(strip_tags($this->input->post('oktober_modal')));
			$november_pegawai = htmlentities(strip_tags($this->input->post('november_pegawai')));
			$november_barang = htmlentities(strip_tags($this->input->post('november_barang')));
			$november_modal = htmlentities(strip_tags($this->input->post('november_modal')));
			$desember_pegawai = htmlentities(strip_tags($this->input->post('desember_pegawai')));
			$desember_barang = htmlentities(strip_tags($this->input->post('desember_barang')));
			$desember_modal = htmlentities(strip_tags($this->input->post('desember_modal')));

			$revisi_ke = count($data['rpd_dipa']);
			
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

			$simpan = 'y';

			if ($simpan=='y') {
				$data = array(
					'revisi_ke'			=> $revisi_ke,
					'id_dipa'			=> $id_dipa,
					'url_file'			=> $file,
					'januari_pegawai'	=> $januari_pegawai,
					'januari_barang'	=> $januari_barang,
					'januari_modal'		=> $januari_modal,
					'februari_pegawai'	=> $februari_pegawai,
					'februari_barang'	=> $februari_barang,
					'februari_modal'	=> $februari_modal,
					'maret_pegawai'		=> $maret_pegawai,
					'maret_barang'		=> $maret_barang,
					'maret_modal'		=> $maret_modal,
					'april_pegawai'		=> $april_pegawai,
					'april_barang'		=> $april_barang,
					'april_modal'		=> $april_modal,
					'mei_pegawai'		=> $mei_pegawai,
					'mei_barang'		=> $mei_barang,
					'mei_modal'			=> $mei_modal,
					'juni_pegawai'		=> $juni_pegawai,
					'juni_barang'		=> $juni_barang,
					'juni_modal'		=> $juni_modal,
					'juli_pegawai'		=> $juli_pegawai,
					'juli_barang'		=> $juli_barang,
					'juli_modal'		=> $juli_modal,
					'agustus_pegawai'	=> $agustus_pegawai,
					'agustus_barang'	=> $agustus_barang,
					'agustus_modal' 	=> $agustus_modal,
					'september_pegawai'	=> $september_pegawai,
					'september_barang'	=> $september_barang,
					'september_modal'	=> $september_modal,
					'oktober_pegawai'	=> $oktober_pegawai,
					'oktober_barang'	=> $oktober_barang,
					'oktober_modal'		=> $oktober_modal,
					'november_pegawai'	=> $november_pegawai,
					'november_barang'	=> $november_barang,
					'november_modal'	=> $november_modal,
					'desember_pegawai'	=> $desember_pegawai,
					'desember_barang'	=> $desember_barang,
					'desember_modal'	=> $desember_modal
				);
				$this->Guzzle_model->createRPD($data);

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
						 <strong>Gagal!</strong>'.$pesan.'.
					</div>
				 <br>'
				);
			}
			redirect("rpd/v/$id_dipa/$revisi_redirect");
		}
	}
}