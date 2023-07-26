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
                ?>
                <form class="form-horizontal" action="" data-parsley-validate="true" method="post" enctype="multipart/form-data">
                  <input type="hidden" name="id_dipa" id="id_dipa" value="<?php echo $dipa['id_dipa']; ?>">
                  <div class="form-group">
                    <label class="control-label col-lg-3">Nama DIPA</label>
                    <div class="col-lg-9">
                      <input type="text" name="nama" class="form-control" value="<?php echo $dipa['nama']; ?>" placeholder="Nama DIPA" required autofocus onfocus="this.value = this.value;">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-lg-3">Keterangan</label>
                    <div class="col-lg-9">
                      <input type="text" name="keterangan" class="form-control" value="<?php echo $dipa['keterangan']; ?>" placeholder="Keterangan" required autofocus onfocus="this.value = this.value;">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-lg-3">File DIPA</label>
                    <div class="col-lg-9">
                      <input type="file" name="url_file_dipa" class="form-control" value="<?php echo $dipa['url_file_dipa']; ?>" placeholder="File DIPA">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-lg-3">File Lembar Kertas Kerja</label>
                    <div class="col-lg-9">
                      <input type="file" name="url_file_lkk" class="form-control" value="<?php echo $dipa['url_file_lkk']; ?>" placeholder="File Lembar Kertas Kerja">
                    </div>
                  </div>
                  <hr>
                  <a href="<?php echo strtolower($this->uri->segment(1)); ?>/<?php echo strtolower($this->uri->segment(2)); ?>.html" class="btn btn-default"><< Kembali</a>
                  <button type="submit" name="btnupdate" class="btn btn-primary" style="float:right;">Simpan</button>
                </form>
            </div>

        </div>
      </div>
    </div>
    <!-- /dashboard content -->
