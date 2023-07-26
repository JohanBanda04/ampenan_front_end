<?php 
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;

class Guzzle_model extends CI_model {
    private $_client;

    public function __construct()
    {
        $userID = $this->session->userdata('id_user');
        $token = $this->session->userdata('token');

        $this->_client = new Client([
            'base_uri' => 'http://localhost/api/index.php/',
            'headers' => [
                'Client-Service' => 'frontend-client',
                'Auth-Key' => 'simplerestapi',
                'Content-Type' => 'application/json',
                'User-ID' => $userID,
                'Authorization' => $token
               ]
        ]);
    }

    // Model User
    public function getAllUser()
    {
        $response = $this->_client->request('GET', 'User');
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function getUserById($id)
    {
        $response = $this->_client->request('GET', 'User/detail/' . $id);
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function getUserByDipaId($id)
    {
        $response = $this->_client->request('GET', 'User/getDetailByDipa/' . $id);
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    // Model Folder Data Dukung
    public function getAllFolderDataDukung()
    {
        $response = $this->_client->request('GET', 'FolderDataDukung');
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function getFolderDataDukungById($id)
    {
        $response = $this->_client->request('GET', 'FolderDataDukung/detail/' . $id);
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function getFolderDataDukungByDipaId($id)
    {
        $response = $this->_client->request('GET', 'FolderDataDukung/detailByDipa/' . $id);
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function createFolderDataDukung($data)
    {
        $response = $this->_client->request('POST', 'FolderDataDukung/create', [
            'json' => $data
        ]);
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function updateFolderDataDukung($id, $data)
    {
        $response = $this->_client->request('PUT', 'FolderDataDukung/update/' . $id, [
            'json' => $data
        ]);
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function deleteFolderDataDukung($id)
    {
        $response = $this->_client->request('DELETE', 'FolderDataDukung/delete/' . $id);
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function countDataDukung($id)
    {
        $response = $this->_client->request('GET', 'DataDukung/getdetailbyfolder/' . $id);
        $result = json_decode($response->getBody()->getContents(), true);
        $count = count($result);
        return $count;
    }

    // Model Data Dukung
    public function getDataDukungByFolderId($id)
    {
        $response = $this->_client->request('GET', 'DataDukung/getdetailbyfolder/' . $id);
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function getDataDukungById($id)
    {
        $response = $this->_client->request('GET', 'DataDukung/detail/' . $id);
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function createDataDukung($data)
    {
        $response = $this->_client->request('POST', 'DataDukung/create', [
            'json' => $data
        ]);
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function deleteDataDukung($id)
    {
        $response = $this->_client->request('DELETE', 'DataDukung/delete/' . $id);
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function updateDataDukung($id, $data)
    {
        $response = $this->_client->request('PUT', 'DataDukung/update/' . $id, [
            'json' => $data
        ]);
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    // Model list DIPA 
    public function getDipaList()
    {
        $response = $this->_client->request('GET', 'Dipa');
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }
    public function getDetailDipa($id)
    {
        $response = $this->_client->request('GET', 'Dipa/detail/' . $id);
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    // Model Dokumen DIPA 
    public function getAllDokumenDipa()
    {
        $response = $this->_client->request('GET', 'DokumenDipa');
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function getDokumenDipaByDipaId($id)
    {
        $response = $this->_client->request('GET', 'DokumenDipa/GetDetailByDipa/' . $id);
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function getDokumenDipaById($id)
    {
        $response = $this->_client->request('GET', 'DokumenDipa/detail/' . $id);
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function createDokumenDipa($data)
    {
        $response = $this->_client->request('POST', 'DokumenDipa/create', [
            'json' => $data
        ]);
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function deleteDokumenDipa($id)
    {
        $response = $this->_client->request('DELETE', 'DokumenDipa/delete/' . $id);
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function updateDokumenDipa($id, $data)
    {
        $response = $this->_client->request('PUT', 'DokumenDipa/update/' . $id, [
            'json' => $data
        ]);
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    // Model Ankabut
    public function getAllAnkabut()
    {
        $response = $this->_client->request('GET', 'Ankabut');
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function getAnkabutByDipaId($id)
    {
        $response = $this->_client->request('GET', 'Ankabut/GetDetailByDipa/' . $id);
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function getAnkabutById($id)
    {
        $response = $this->_client->request('GET', 'Ankabut/detail/' . $id);
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function createAnkabut($data)
    {
        $response = $this->_client->request('POST', 'Ankabut/create', [
            'json' => $data
        ]);
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function deleteAnkabut($id)
    {
        $response = $this->_client->request('DELETE', 'Ankabut/delete/' . $id);
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function updateAnkabut($id, $data)
    {
        $response = $this->_client->request('PUT', 'Ankabut/update/' . $id, [
            'json' => $data
        ]);
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    // Model Pagu dan Realisasi 
    public function getTotalPagu()
    {
        $response = $this->_client->request('GET', 'ApiDipaPusdatin/TotalPagu');
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }
    public function getTotalPagubyKodeSatker($id)
    {
        $response = $this->_client->request('GET', 'ApiDipaPusdatin/TotalPaguByKodeSatker/' . $id);
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }
    public function getTotalPaguJenisBelanja()
    {
        $response = $this->_client->request('GET', 'ApiDipaPusdatin/TotalPaguJenisBelanja');
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }
    public function getTotalPaguJenisBelanjabyKodeSatker($id)
    {
        $response = $this->_client->request('GET', 'ApiDipaPusdatin/TotalPaguJenisBelanjaByKodeSatker/' . $id);
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }
    public function getTotalRealisasi()
    {
        $response = $this->_client->request('GET', 'ApiRealisasiMonsakti/TotalRealisasi');
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }
    public function getTotalRealisasibyKodeSatker($id)
    {
        $response = $this->_client->request('GET', 'ApiRealisasiMonsakti/TotalRealisasiByKodeSatker/' . $id);
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }
    public function getTotalRealisasiJenisBelanja()
    {
        $response = $this->_client->request('GET', 'ApiRealisasiMonsakti/TotalRealisasiJenisBelanja');
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }
    public function getTotalRealisasiJenisBelanjaPerbulan()
    {
        $response = $this->_client->request('GET', 'ApiRealisasiMonsakti/TotalRealisasiJenisBelanjaPerbulan');
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }
    public function getTotalRealisasiJenisBelanjabyKodeSatker($id)
    {
        $response = $this->_client->request('GET', 'ApiRealisasiMonsakti/TotalRealisasiJenisBelanjaByKodeSatker/' . $id);
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }
    public function getTotalRealisasiJenisBelanjaPerbulanbyKodeSatker($id)
    {
        $response = $this->_client->request('GET', 'ApiRealisasiMonsakti/TotalRealisasiJenisBelanjaPerbulanByKodeSatker/' . $id);
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }
    public function getDataGrafikDeviasiRpdRealisasi($id)
    {
        $response = $this->_client->request('GET', 'ApiRealisasiMonsakti/dataGrafikDeviasiRpdRealisasi/' . $id);
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }
    public function getDataGrafikDeviasiRpdRealisasiSemuaSatker()
    {
        $response = $this->_client->request('GET', 'ApiRealisasiMonsakti/dataGrafikDeviasiRpdRealisasiSemuaSatker');
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    // Model Pelaksanaan Anggaran
    public function getAllPelaksanaanAnggaran()
    {
        $response = $this->_client->request('GET', 'PelaksanaanAnggaran');
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function getPelaksanaanAnggaranById($id)
    {
        $response = $this->_client->request('GET', 'PelaksanaanAnggaran/detail/' . $id);
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function getPelaksanaanAnggaranByDipaId($id)
    {
        $response = $this->_client->request('GET', 'PelaksanaanAnggaran/getDetailByDipa/' . $id);
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function createPelaksanaanAnggaran($data)
    {
        $response = $this->_client->request('POST', 'PelaksanaanAnggaran/create', [
            'json' => $data
        ]);
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function updatePelaksanaanAnggaran($id, $data)
    {
        // var_dump($data); exit;
        $response = $this->_client->request('PUT', 'PelaksanaanAnggaran/update/' . $id, [
            'json' => $data
        ]);
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function deletePelaksanaanAnggaran($id)
    {
        $response = $this->_client->request('DELETE', 'PelaksanaanAnggaran/delete/' . $id);
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    // Model Pelaksanaan Anggaran Akun Detil
    public function getAllPelaksanaanAnggaranAkunDetil()
    {
        $response = $this->_client->request('GET', 'PelaksanaanAnggaranAkunDetil');
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function getTotalPelaksanaanAnggaran()
    {
        $response = $this->_client->request('GET', 'PelaksanaanAnggaranAkunDetil/totalPelaksanaanAnggaranAkunDetil');
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function getTotalPelaksanaanAnggaranByDipa($id)
    {
        $response = $this->_client->request('GET', 'PelaksanaanAnggaranAkunDetil/totalPelaksanaanAnggaranAkunDetilByDipa/' . $id);
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function getPelaksanaanAnggaranAkunDetilById($id)
    {
        $response = $this->_client->request('GET', 'PelaksanaanAnggaranAkunDetil/detail/' . $id);
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function getPelaksanaanAnggaranAkunDetilByPelaksanaanAnggaran($id)
    {
        $response = $this->_client->request('GET', 'PelaksanaanAnggaranAkunDetil/getDetailByPelaksanaanAnggaran/' . $id);
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function createPelaksanaanAnggaranAkunDetil($data)
    {
        $response = $this->_client->request('POST', 'PelaksanaanAnggaranAkunDetil/create', [
            'json' => $data
        ]);
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function updatePelaksanaanAnggaranAkunDetil($id, $data)
    {
        $response = $this->_client->request('PUT', 'PelaksanaanAnggaranAkunDetil/update/' . $id, [
            'json' => $data
        ]);
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function deletePelaksanaanAnggaranAkunDetil($id)
    {
        $response = $this->_client->request('DELETE', 'PelaksanaanAnggaranAkunDetil/delete/' . $id);
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    // Model RPD
    public function getAllRPD()
    {
        $response = $this->_client->request('GET', 'RPD');
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function getRPDById($id)
    {
        $response = $this->_client->request('GET', 'RPD/detail/' . $id);
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function getRPDByDipaId($id)
    {
        $response = $this->_client->request('GET', 'RPD/getDetailByDipa/' . $id);
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function getDataGrafikDeviasi($id)
    {
        $response = $this->_client->request('GET', 'RPD/dataGrafikDeviasi/' . $id);
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function getdataGrafikDeviasiSemuaSatker()
    {
        $response = $this->_client->request('GET', 'RPD/dataGrafikDeviasiSemuaSatker');
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function getRPDByDipaIdRevisi($id, $revisi)
    {
        $response = $this->_client->request('GET', 'RPD/getDetailByDipaByRevisi/' . $id . '/' . $revisi);
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function createRPD($data)
    {
        $response = $this->_client->request('POST', 'RPD/create', [
            'json' => $data
        ]);
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function updateRPD($id, $data)
    {
        $response = $this->_client->request('PUT', 'RPD/update/' . $id, [
            'json' => $data
        ]);
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function deleteRPD($id)
    {
        $response = $this->_client->request('DELETE', 'RPD/delete/' . $id);
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    // Model Usulan Revisi DIPA
    public function getAllRevisiDipa()
    {
        $response = $this->_client->request('GET', 'UsulanRevisiDipa');
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function getRevisiDipaByDipaId($id)
    {
        $response = $this->_client->request('GET', 'UsulanRevisiDipa/getDetailByDipa/' . $id);
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function getRevisiDipaByDipaIdUserId($id_dipa, $id_user)
    {
        $response = $this->_client->request('GET', 'UsulanRevisiDipa/getDetailByDipaJoinVerifikasi/' . $id_dipa . '/' . $id_user);
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function getRevisiDipaById($id)
    {
        $response = $this->_client->request('GET', 'UsulanRevisiDipa/detail/' . $id);
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function createRevisiDipa($data)
    {
        $response = $this->_client->request('POST', 'UsulanRevisiDipa/create', [
            'json' => $data
        ]);
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function deleteRevisiDipa($id)
    {
        $response = $this->_client->request('DELETE', 'UsulanRevisiDipa/delete/' . $id);
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function updateRevisiDipa($id, $data)
    {
        $response = $this->_client->request('PUT', 'UsulanRevisiDipa/update/' . $id, [
            'json' => $data
        ]);
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    // Model Verifikasi Usulan Revisi DIPA
    public function getAllVerifikasiRevisiDipa()
    {
        $response = $this->_client->request('GET', 'VerifikasiUsulanRevisiDipa');
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function getVerifikasiByUsulanRevisiId($id)
    {
        $response = $this->_client->request('GET', 'VerifikasiUsulanRevisiDipa/getDetailByUsulanRevisiDipa/' . $id);
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function getVerifikasiById($id)
    {
        $response = $this->_client->request('GET', 'VerifikasiUsulanRevisiDipa/detail/' . $id);
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function createVerifikasiRevisiDipa($data)
    {
        $response = $this->_client->request('POST', 'VerifikasiUsulanRevisiDipa/create', [
            'json' => $data
        ]);
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function deleteVerifikasiRevisiDipa($id)
    {
        $response = $this->_client->request('DELETE', 'VerifikasiUsulanRevisiDipa/delete/' . $id);
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function updateVerifikasiRevisiDipa($id, $data)
    {
        $response = $this->_client->request('PUT', 'VerifikasiUsulanRevisiDipa/update/' . $id, [
            'json' => $data
        ]);
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    // Model Notifikasi
    public function getAllNotifikasi()
    {
        $response = $this->_client->request('GET', 'Notifikasi');
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function getNotifikasiById($id)
    {
        $response = $this->_client->request('GET', 'Notifikasi/detail/' . $id);
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function getNotifikasiByIdPengirim($id)
    {
        $response = $this->_client->request('GET', 'Notifikasi/getDetailByPengirim/' . $id);
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function getNotifikasiByIdPenerima($id)
    {
        $response = $this->_client->request('GET', 'Notifikasi/getDetailByPenerima/' . $id);
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function createNotifikasi($data)
    {
        $response = $this->_client->request('POST', 'Notifikasi/create', [
            'json' => $data
        ]);
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function deleteNotifikasi($id)
    {
        $response = $this->_client->request('DELETE', 'Notifikasi/delete/' . $id);
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function updateNotifikasi($id, $data)
    {
        $response = $this->_client->request('PUT', 'Notifikasi/update/' . $id, [
            'json' => $data
        ]);
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }
    
    // Model Monev
    public function getAllMonev()
    {
        $response = $this->_client->request('GET', 'Monev');
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function getMonevById($id)
    {
        $response = $this->_client->request('GET', 'Monev/detail/' . $id);
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function getMonevByDipaId($id)
    {
        $response = $this->_client->request('GET', 'Monev/getDetailByKodeSatker/' . $id);
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function getMonevByDipaIdJenisMonev($id, $jenis)
    {
        $response = $this->_client->request('GET', 'Monev/getDetailByKodeSatkerByJenisRekomendasi/' . $id . '/' . $jenis);
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function createMonev($data)
    {
        $response = $this->_client->request('POST', 'Monev/create', [
            'json' => $data
        ]);
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function updateMonev($id, $data)
    {
        $response = $this->_client->request('PUT', 'Monev/update/' . $id, [
            'json' => $data
        ]);
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function deleteMonev($id)
    {
        $response = $this->_client->request('DELETE', 'Monev/delete/' . $id);
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }
}