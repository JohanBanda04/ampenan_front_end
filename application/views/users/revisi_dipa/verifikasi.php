<?php
  $level 	= $this->session->userdata('level');
  $id_user 	= $this->session->userdata('id_user');
  $id_dipa 	= $this->session->userdata('id_dipa');
  $link3 = $this->uri->segment(3);
  $link4 = $this->uri->segment(4);
  $link5 = $this->uri->segment(5);
  $link6 = $this->uri->segment(6);
?>

<!-- Main content -->
<div class="content-wrapper">
  <!-- Content area -->
  <div class="content">

    <!-- Dashboard content -->
    <div class="row">
      <!-- <div class="col-md-2"></div> -->
      <div class="col-md-6">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                </div>
                <h4 class="panel-title">Detail <?php echo $judul_web; ?></h4>
            </div>
            <div class="panel-body">
              <?php
                echo $this->session->flashdata('msg');
              ?>
                <div class="table-responsive">
			            <table class="table table-bordered table-striped" width="100%">
                    <tbody>
                      <?php if ($id_dipa == '00'): ?>
                      <tr>
                        <th valign="top" width="160">Satuan Kerja</th>
                        <th valign="top" width="1">:</th>
                        <td><?php echo $this->Guzzle_model->getDetailDipa($link3)['nama']; ?></td>
                      </tr>
                      <?php endif; ?>
                      <tr>
                        <th valign="top" width="160">Jenis Revisi</th>
                        <th valign="top" width="1">:</th>
                        <td><?php echo $revisi_dipa['jenis_revisi']; ?></td>
                      </tr>
                      <tr>
                        <th valign="top" width="160">Keterangan</th>
                        <th valign="top" width="1">:</th>
                        <td><?php echo $revisi_dipa['keterangan']; ?></td>
                      </tr>
                      <tr>
                        <th valign="top">File Usulan Revisi DIPA</th>
                        <th valign="top">:</th>
                        <td><a class="btn btn-info btn-xs" href="<?php echo $revisi_dipa['url_file']; ?>" target="_blank"><i class="fa fa-download"></i> Download</a></td>
                      </tr>
                      <tr>
                        <th valign="top" width="160">Tanggal Input</th>
                        <th valign="top" width="1">:</th>
                        <td><?php echo $this->Mcrud->tgl_id(date('d-m-Y', strtotime($revisi_dipa['created_at'])),'full'); ?></td>
                      </tr>
                      <tr>
                        <th valign="top">Yang Mengesahkan</th>
                        <th valign="top">:</th>
                        <td><?php echo ucfirst($this->Mcrud->get_user_name_by_id($revisi_dipa['id_user_verifikator_terakhir'])); ?></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <?php foreach ($verifikasi_usulan as $key => $value):
                  if($id_user == $value['id_user_verifikator']) continue; ?>
                  <div class="table-responsive">
                    <table class="table table-bordered table-striped" width="100%">
                      <tbody>
                        <tr>
                          <th valign="top">Verifikator</th>
                          <th valign="top">:</th>
                          <td><?php echo ucfirst($this->Mcrud->get_user_name_by_id($value['id_user_verifikator'])); ?></td>
                        </tr>
                        <tr>
                          <th valign="top" width="160">Status</th>
                          <th valign="top" width="1">:</th>
                          <td><?php $this->Mcrud->status_verifikasi($value['status_verifikasi']); ?></td>
                        </tr>
                        <tr>
                          <th valign="top">Catatan Verifikator</th>
                          <th valign="top">:</th>
                          <td><?php echo ucfirst($value['komentar']); ?></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <?php endforeach; ?>
            </div>

        </div>
      </div>
      <div class="col-md-6">
            <?php foreach ($verifikasi_usulan as $key => $value):
              if($id_user == $value['id_user_verifikator']): ?>
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                </div>
                <h4 class="panel-title">Verifikasi <?php echo $judul_web; ?></h4>
            </div>
            <div class="panel-body">
              <?php
                echo $this->session->flashdata('msg');
              ?>
              <form class="form-horizontal" action="" data-parsley-validate="true" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id_usulan_revisi_dipa" value="<?php echo $value['id_usulan_revisi_dipa']; ?>">
                    <input type="hidden" name="id_verifikasi_usulan" value="<?php echo $value['id']; ?>">
                    <div class="form-group">
                      <label class="col-lg-3">Verifikasi</label>
                      <div class="col-lg-9">
                        <input class="radio-btn-verifikasi" type="radio" name="status_verifikasi" value="tolak" onchange="window.location.href='revisi_dipa/v/<?php echo $link3; ?>/<?php echo $link4; ?>/<?php echo $link5; ?>/'+this.value;"><span class="radio-text">Tolak</span>
                        <input class="radio-btn-verifikasi" type="radio" name="status_verifikasi" value="sudah" onchange="window.location.href='revisi_dipa/v/<?php echo $link3; ?>/<?php echo $link4; ?>/<?php echo $link5; ?>/'+this.value;"><span class="radio-text">Setuju</span>
                      </div>
                    </div>
                    <?php if ($link6 == 'sudah' AND $revisi_dipa['id_user_verifikator_terakhir']!=$id_user): ?>
                      <input type="hidden" value="">
                      <div class="form-group">
                        <label class="col-lg-3">Verifikator Selanjutnya</label>
                        <div class="col-lg-9">
                          <select class="form-control default-select2" name="id_user_verifikator" required>
                            <option value="">- Pilih -</option>
                            <?php foreach ($users as $value):
                                  if ($value['id'] == $id_user OR $value['role'] == 'pelaksana') continue;
                              ?>
                                <option value="<?php echo $value['id']; ?>"><?php echo ucwords($value['nama']); ?></option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                      </div>
                    <?php endif; ?>
                    <div class="form-group">
                      <label class="col-lg-3">Catatan</label>
                      <div class="col-lg-9">
                        <textarea name="catatan" class="form-control" placeholder="Catatan" rows="4" cols="100"><?php echo $value['komentar']; ?></textarea>
                      </div>
                    </div>
                    <hr class="grey-line">
                    <a href="<?php echo strtolower($this->uri->segment(1)); ?>/<?php echo strtolower($this->uri->segment(2)); ?>/<?php echo strtolower($this->uri->segment(3)); ?>.html" class="btn btn-default"><< Kembali</a>
                    <button type="submit" name="btnkonfirm" class="btn btn-primary" style="float:right;">Simpan</button>
                  </form>
                  
                </div>
              </div>
              <?php endif; endforeach; ?>
    </div>
    <!-- /dashboard content -->

    <script>
      // Radio Button 
      var val_status = <?php echo json_encode( $this->uri->segment(6)); ?>;
      $('input:radio[name=status_verifikasi]').val([val_status]);
    </script>