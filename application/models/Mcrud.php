<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mcrud extends CI_Model {

 public static function tgl_id($date, $bln='')
 {
	 date_default_timezone_set('Asia/Singapore');
		 $str = explode('-', $date);
		 $bulan = array(
			 '01' => 'Jan',
			 '02' => 'Feb',
			 '03' => 'Mar',
			 '04' => 'Apr',
			 '05' => 'Mei',
			 '06' => 'Jun',
			 '07' => 'Jul',
			 '08' => 'Ags',
			 '09' => 'Sep',
			 '10' => 'Okt',
			 '11' => 'Nov',
			 '12' => 'Des',
		 );
		 if ($bln == '') {
			 $hasil = $str['0'] . "-" . substr($bulan[$str[1]],0,3) . "-" .$str[2];
		 }elseif ($bln == 'full') {
			 $hasil = $str['0'] . " " . $bulan[$str[1]] . " " .$str[2];
		 }else {
			 $hasil = $bulan[$str[1]];
		 }
		 return $hasil;
 }

	public function hari_id($tanggal)
	{
		$day = date('D', strtotime($tanggal));
		$dayList = array(
			'Sun' => 'Minggu',
			'Mon' => 'Senin',
			'Tue' => 'Selasa',
			'Wed' => 'Rabu',
			'Thu' => 'Kamis',
			'Fri' => "Jum'at",
			'Sat' => 'Sabtu'
		);
		return $dayList[$day];
	}

	public function get_user_name_by_id($id)
	{
		$user = $this->Guzzle_model->getUserById($id);
		return $user['nama'];
	}

	public function cek_lokasi($id_dipa) {
		$dipa = $this->Guzzle_model->getDetailDipa($id_dipa);
		if ($dipa['lokasi'] == 'kanwil') {
			return true;
		}
	}

	public function waktu($data, $aksi='')
	{
		if ($aksi=='full') {
			$tgl_n = date('d-m-Y H:i:s',strtotime($data));
		}else {
			$tgl_n = date('d-m-Y',strtotime($data));
		}
		$hari = $this->Mcrud->hari_id($tgl_n);
		$tgl  = $this->Mcrud->tgl_id($tgl_n,$aksi);
		return $hari.", ".$tgl;
	}

	function judul_web($id='')
	{
		$data = 'AMPENAN';
		return $data;
	}

	public function cek_filename($file='')
	{
		$data = "assets/favicon.png";
		if ($file != '') {
			if(file_exists("$file")){
				$data = $file;
			}
		}
		return $data;
	}

	function kirim_notif($notif_type, $id_dipa, $id_for_link, $pengirim, $penerima, $status_verifikasi='')
	{
		if ($notif_type == 'pelaksanaan_anggaran') {
			$pesan = "Mengirim laporan pelaksanaan anggaran";
			$link = "pelaksanaan_anggaran/v/$id_dipa/d/".hashids_encrypt($id_for_link);
		} elseif ($notif_type == 'revisi_pelaksanaan_anggaran') {
			$pesan = "Mengirim perbaikan laporan pelaksanaan anggaran";
			$link = "pelaksanaan_anggaran/v/$id_dipa/d/".hashids_encrypt($id_for_link);
		} elseif ($notif_type == 'verifikasi_pelaksanaan_anggaran') {
			$link = "pelaksanaan_anggaran/v/$id_dipa/d/".hashids_encrypt($id_for_link);
			if ($status_verifikasi == 'tolak') {
				$pesan = "Laporan pelaksanaan anggaran perlu perbaikan";
			} elseif ($status_verifikasi == 'sudah') {
				$pesan = "Laporan pelaksaanaan anggaran sudah diverifikasi";
			}
		} elseif ($notif_type == 'usulan_revisi_dipa') {
			$link = "revisi_dipa/v/$id_dipa/d/".hashids_encrypt($id_for_link);
			$pesan = "Mengirim usulan revisi dipa";
		} elseif ($notif_type == 'revisi_usulan_revisi_dipa') {
			$link = "revisi_dipa/v/$id_dipa/d/".hashids_encrypt($id_for_link);
			$pesan = "Mengirim perbaikan usulan revisi dipa";
		} elseif ($notif_type == 'verifikasi_usulan_revisi_dipa') {
			$link = "revisi_dipa/v/$id_dipa/d/".hashids_encrypt($id_for_link);
			if ($status_verifikasi == 'tolak') {
				$pesan = "Usulan revisi DIPA perlu perbaikan";
			} elseif ($status_verifikasi == 'sudah') {
				$pesan = "Usulan revisi DIPA sudah diverifikasi";
			}
		} elseif ($notif_type == 'monev') {
			$pesan = "Mengirim monitoring dan evaluasi";
			$link = "monev/v/$status_verifikasi/$id_dipa/".hashids_encrypt($id_for_link);
		} elseif ($notif_type == 'tindak_lanjut_monev') {
			$pesan = "Mengirim tindak lanjut monitoring dan evaluasi";
			$link = "monev/v/$status_verifikasi/$id_dipa/".hashids_encrypt($id_for_link);
		}

		$data_notif = array(
			'pesan'				=> $pesan,
			'link'				=> $link,
			'status'			=> "belum dibaca",
			'id_user_pengirim'	=> $pengirim,
			'id_user_penerima'	=> $penerima,
			'id_for_link'		=> $id_for_link

		);

		$this->Guzzle_model->createNotifikasi($data_notif);
	}

	function update_notif($notif) {
		$data_notif = array(
			'pesan'				=> $notif['pesan'],
			'link'				=> $notif['link'],
			'status'			=> "sudah dibaca",
			'id_user_pengirim'	=> $notif['id_user_pengirim'],
			'id_user_penerima'	=> $notif['id_user_penerima'],
			'id_for_link'		=> $notif['id_for_link']

		);
		$this->Guzzle_model->updateNotifikasi($notif['id'], $data_notif);
	}

	function cek_verifikasi_usulan_revisi_dipa($id_dipa, $id_user, $id_usulan_verifikasi_dipa) {
		$verifikasi_array = $this->Guzzle_model->getRevisiDipaByDipaIdUserId($id_dipa, $id_user);

		$verifikasi_filter = array_filter($verifikasi_array, function($key) use ($id_usulan_verifikasi_dipa) {
			return ($key['id'] == $id_usulan_verifikasi_dipa);
		});

		foreach ($verifikasi_filter as $key => $value) {
			$status = $value['status_verifikasi'];
		}

		if (count($verifikasi_filter) != 0 AND $status != 'sudah') {
			$result = true;
		} else {
			$result = false;
		}

		return $result;
	}

	public function rupiah($angka) {
		$hasil_rupiah = "Rp " . number_format($angka,0,"",".");
		return $hasil_rupiah;
	}

	public function persen($realisasi, $total) {
		 $persen = ($realisasi / $total) * 100;
		 if ($total == 0) {
			 $persen = 0;
		 }
		 return $persen;
	}

	public function status_verifikasi($status) {
		if($status == 'sudah') { 
            echo '<label class="label label-success">SUDAH DIVERIFIKASI</label>';
        } elseif($status == 'tolak') {
            echo '<label class="label label-danger">PERLU PERBAIKAN</label>';
        } else {
            echo '<label class="label label-default">BELUM DIVERIFIKASI</label>';
        }
	}

	public function status_verifikasi_revisi_dipa($status) {
		if($status == 'sudah') { 
            echo '<label class="label label-success">SELESAI</label>';
        } elseif($status == 'belum') {
            echo '<label class="label label-warning">DALAM PROSES</label>';
        }
	}

	
}
