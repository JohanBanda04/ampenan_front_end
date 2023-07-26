<li class="dropdown-header">Notifikasi (<?php echo number_format($jml_notif,0,",","."); ?>)</li>

<?php
$no = '1';
$foto  = "img/user/user-default.jpg";
$id_user = $this->session->userdata('id_user');

foreach ($notif as $key => $value):
  $pengirim = $this->Guzzle_model->getUserById($value['id_user_pengirim']);
  $dipa = $this->Guzzle_model->getDetailDipa($pengirim['id_dipa']);
  $nama  = $pengirim['nama'];
  $nama_dipa = $dipa['nama'];
  $pesan = $value['pesan'];
  $waktu = $this->Mcrud->waktu($value['created_at'],'full');

    if ($no <= '5') {
      $link = "javascript:;";
      if ($value['link']!='') {
        $link = $value['link'];
      }
  ?>
  <li class="media">
      <a href="<?php echo $link; ?>" id="notif_click" class="<?php if($value['status'] == 'belum dibaca') echo "unread" ?>">
          <div class="media-left"><img src="<?php echo $foto; ?>" class="media-object" alt=""></div>
          <div class="media-body">
              <?php if ($pengirim['id_dipa'] == '00'): ?>
                <h6 class="media-heading"><?php echo $nama; ?></h6>
              <?php else: ?>
                <h6 class="media-heading"><?php echo $nama . " " . $nama_dipa; ?></h6>
              <?php endif; ?>
              <p><?php echo $pesan; ?></p>
              <div class="text-muted f-s-11"><?php echo $waktu; ?></div>
          </div>
      </a>
  </li>
<?php
  }
  $no++;
endforeach; ?>


  <li class="text-center">
    <?php if (count($notif)==0){ ?>
      Tidak ada notifikasi
      <br><br>
    <?php }else{ ?>
      <a href="web/notif.html" style="padding:10px;">Tampilkan Semua</a>
    <?php } ?>
  </li>

<script>
</script>
