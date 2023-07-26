<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use GuzzleHttp\Client;

class Web extends CI_Controller {

	public function index()
	{
		$data['judul_web'] = $this->Mcrud->judul_web();

		$this->load->view('web/header', $data);
		$this->load->view('web/beranda', $data);
		$this->load->view('web/footer', $data);
	}

	public function login()
	{
		$ceks = $this->session->userdata('username');
		if(isset($ceks)) {
			// $this->load->view('404_content');
			redirect('dashboard');
		}else{
			$data['judul_web'] = "Halaman Login - ".$this->Mcrud->judul_web();
			$this->load->view('web/log/header', $data);
			$this->load->view('web/log/login', $data);
			$this->load->view('web/log/footer', $data);

			if (isset($_POST['btnlogin'])){
			    //echo "btnlogin cuy";die;
				$username = htmlentities(strip_tags($_POST['username']));
				$pass	   = htmlentities(strip_tags($_POST['password']));

				$data = array(
					'username' 	=> $username,
					'password'	=> $pass
				);

				try {
					$client = new Client([
						'base_uri' => 'http://localhost/api/index.php/',
						'headers' => [
							'Client-Service' => 'frontend-client',
							'Auth-Key' => 'simplerestapi',
							'Content-Type' => 'application/json'
						]
					]);
					
					$response = $client->request('POST', 'auth/login', [
						'json' => $data
					]);

					if (200 == $response->getStatusCode()) {
						$login_result = json_decode($response->getBody()->getContents(), true);
					}
				} catch (GuzzleHttp\Exception\ClientException $e) {
					$response = $e->getResponse();
    				$responseBody = json_decode($response->getBody()->getContents());
				}

				if($login_result["status"] != 200) {
					$this->session->set_flashdata('msg',
						'
						<div class="alert alert-danger alert-dismissible" role="alert">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								  <span aria-hidden="true">&times;</span>
							  </button>
							  <strong>"'.$responseBody->message.'"</strong>
						</div>'
					);
					redirect('web/login');
					} else {
						$userID = $login_result['id'];
						$user_role = $login_result['role'];
						$user_token = $login_result['token'];
						$user_dipa = $login_result['id_dipa'];
						$user_nama = $login_result['nama'];
						$user_lokasi = $login_result['lokasi'];

						$this->session->set_userdata('username', "$username");
						$this->session->set_userdata('nama', "$user_nama");
						$this->session->set_userdata('id_user', "$userID");
						$this->session->set_userdata('level', "$user_role");
						$this->session->set_userdata('token', "$user_token");
						$this->session->set_userdata('id_dipa', "$user_dipa");
						$this->session->set_userdata('lokasi', "$user_lokasi");

						$this->session->set_userdata('jml_notif_bell', "0");

						redirect('dashboard');
					}
				}
			}
		}
	


	public function logout() {
     if ($this->session->has_userdata('username') and $this->session->has_userdata('id_user')) {
         $this->session->sess_destroy();
		}

		redirect('web/login');
	}

	function error_not_found(){
		$this->load->view('404_content');
	}


	public function notif_bell($aksi='')
	{
		date_default_timezone_set('Asia/Singapore');
		$id_user = $this->session->userdata('id_user');
		$level	 = $this->session->userdata('level');

		$data['notif'] = $this->Guzzle_model->getNotifikasiByIdPenerima($id_user);

		// $jml_notif_baru = 0;
 		// foreach ($data['notif'] as $key => $value) {
		// 	if($value['status'] == 'belum dibaca') {
		// 		$jml_notif_baru++;
		// 	} elseif($value['status'] == 'sudah dibaca') {
		// 		$jml_notif_baru--;
		// 	}
		// }

		$filtered_notif = array_filter($data['notif'], function($key) {
			return ($key['status'] == 'belum dibaca');
		});
		$jml_notif_baru = count($filtered_notif);
		
		$data['jml_notif'] = $jml_notif_baru;
		if ($aksi=='pesan_baru') {
			$jml_notif_bell = $this->session->userdata('jml_notif_bell');
			if ($jml_notif_bell >= $jml_notif_baru) {
				$stt='0';
			} else {
				$stt='1';
			}
			$this->session->set_userdata('jml_notif_bell', "$jml_notif_baru");
			if ($id_user=='') {
				echo '11';
			} else {
				echo $stt;
			}
		} elseif ($aksi=='jml') {
			echo number_format($jml_notif_baru,0,",",".");
		} else {
			$this->load->view('users/notif/bell', $data);
		}	
	}

	public function notif($aksi='',$id='')
	{
		$id = hashids_decrypt($id);
		$ceks = $this->session->userdata('username');
		$id_user = $this->session->userdata('id_user');
		if(!isset($ceks)) {
			redirect('web/login');
		} else {
			$data['judul_web'] = "Notifikasi";

			$data['notif'] = $this->Guzzle_model->getNotifikasiByIdPenerima($id_user);

			usort($data['notif'], function($a, $b) {
				return $a['id'] <=> $b['id'];
			});

			if ($aksi == 'h') {
				$cek_data = $this->Guzzle_model->getNotifikasiById($id);
				if (count($cek_data) != 0) {
					$this->Guzzle_model->deleteNotifikasi($id);
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
					redirect("web/notif");
				}else {
					redirect('404_content');
				}
			}
			
			$this->load->view('users/header', $data);
			$this->load->view('users/notif/index', $data);
			$this->load->view('users/footer');
		}
	}

}
