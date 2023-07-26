<!-- Main content -->
<div class="content-wrapper">
  <!-- Content area -->
  <div class="content">

    <!-- Dashboard content -->
    <div class="row">
      <div class="col-md-3"></div>
      <div class="col-md-6">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                </div>
                <h4 class="panel-title"><?php echo $judul_web; ?></h4>
            </div>
            <div class="panel-body">
                <?php
                echo $this->session->flashdata('msg');
                $id_user = $this->session->userdata('id_user');
                ?>
                <form class="form-horizontal" action="" data-parsley-validate="true" method="post" enctype="multipart/form-data">
                  <input type="hidden" name="id_dipa" id="id_dipa" value="<?php echo $this->session->userdata('id_dipa'); ?>">
                  <div class="form-group">
                    <label class="control-label col-lg-3">Jenis Revisi</label>
                    <div class="col-lg-9">
                      <input type="text" name="jenis_revisi" class="form-control" value="" placeholder="Nama DIPA" required autofocus onfocus="this.value = this.value;">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-lg-3">Keterangan</label>
                    <div class="col-lg-9">
                      <input type="text" name="keterangan" class="form-control" value="" placeholder="Keterangan" required autofocus onfocus="this.value = this.value;">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-lg-3">File Usulan Revisi</label>
                    <div class="col-lg-9">
                      <input type="file" name="url_file" class="form-control" value="" placeholder="File Usulan Revisi" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-lg-3">Yang Mengesahkan</label>
                    <div class="col-lg-9">
                      <select class="form-control default-select2" name="id_user_verifikator_terakhir" required>
                        <option value="">- Pilih -</option>
                        <?php foreach ($users as $value):
                              if ($value['id'] == $id_user) continue;
                              if ($value['id'] == $id_user OR $value['role'] == 'pelaksana') continue;
                          ?>
                            <option value="<?php echo $value['id']; ?>"><?php echo ucwords($value['nama']); ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-lg-3">Verifikator</label>
                    <div class="col-lg-9">
                      <select class="form-control default-select2" name="id_user_verifikator" required>
                        <option value="">- Pilih -</option>
                        <?php foreach ($users as $value):
                              if ($value['id'] == $id_user) continue;
                              if ($value['id'] == $id_user OR $value['role'] == 'pelaksana') continue;
                          ?>
                            <option value="<?php echo $value['id']; ?>"><?php echo ucwords($value['nama']); ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                  <hr>
                  <a href="<?php echo strtolower($this->uri->segment(1)); ?>/<?php echo strtolower($this->uri->segment(2)); ?>/<?php echo strtolower($this->uri->segment(3)); ?>.html" class="btn btn-default"><< Kembali</a>
                  <button type="submit" name="btnsimpan" class="btn btn-primary" style="float:right;">Simpan</button>
                </form>
            </div>

        </div>
      </div>
    </div>
    <!-- /dashboard content -->
