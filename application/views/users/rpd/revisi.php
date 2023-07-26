<!-- Main content -->
<div class="content-wrapper">
  <!-- Content area -->
  <div class="content">

    <!-- Dashboard content -->
    <div class="row">
      <div class="col-md-2"></div>
      <div class="col-md-8">
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
                  <div class="form-group">
                    <label class="control-label col-lg-3 text-left">File Detail RPD</label>
                    <div class="col-lg-9">
                      <input type="file" name="url_file" class="form-control" value="" placeholder="File" required>
                    </div>
                  </div>
                  <hr>
                  <h4>Januari</h4>
                  <hr class="grey-line">
                  <div class="form-group">
                    <label class="control-label col-lg-3 text-left">Belanja Pegawai</label>
                    <div class="col-lg-9">
                      <input type="text" name="januari_pegawai" class="form-control" value="" placeholder="Belanja Pegawai" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-lg-3 text-left">Belanja Barang</label>
                    <div class="col-lg-9">
                      <input type="text" name="januari_barang" class="form-control" value="" placeholder="Belanja Barang" required autofocus onfocus="this.value = this.value;">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-lg-3 text-left">Belanja Modal</label>
                    <div class="col-lg-9">
                      <input type="text" name="januari_modal" class="form-control" value="" placeholder="Belanja Modal" required autofocus onfocus="this.value = this.value;">
                    </div>
                  </div>
                  <hr>
                  <h4>Februari</h4>
                  <hr class="grey-line">
                  <div class="form-group">
                    <label class="control-label col-lg-3 text-left">Belanja Pegawai</label>
                    <div class="col-lg-9">
                      <input type="text" name="februari_pegawai" class="form-control" value="" placeholder="Belanja Pegawai" required autofocus onfocus="this.value = this.value;">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-lg-3 text-left">Belanja Barang</label>
                    <div class="col-lg-9">
                      <input type="text" name="februari_barang" class="form-control" value="" placeholder="Belanja Barang" required autofocus onfocus="this.value = this.value;">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-lg-3 text-left">Belanja Modal</label>
                    <div class="col-lg-9">
                      <input type="text" name="februari_modal" class="form-control" value="" placeholder="Belanja Modal" required autofocus onfocus="this.value = this.value;">
                    </div>
                  </div>
                  <hr>
                  <h4>Maret</h4>
                  <hr class="grey-line">
                  <div class="form-group">
                    <label class="control-label col-lg-3 text-left">Belanja Pegawai</label>
                    <div class="col-lg-9">
                      <input type="text" name="maret_pegawai" class="form-control" value="" placeholder="Belanja Pegawai" required autofocus onfocus="this.value = this.value;">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-lg-3 text-left">Belanja Barang</label>
                    <div class="col-lg-9">
                      <input type="text" name="maret_barang" class="form-control" value="" placeholder="Belanja Barang" required autofocus onfocus="this.value = this.value;">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-lg-3 text-left">Belanja Modal</label>
                    <div class="col-lg-9">
                      <input type="text" name="maret_modal" class="form-control" value="" placeholder="Belanja Modal" required autofocus onfocus="this.value = this.value;">
                    </div>
                  </div>
                  <hr>
                  <h4>April</h4>
                  <hr class="grey-line">
                  <div class="form-group">
                    <label class="control-label col-lg-3 text-left">Belanja Pegawai</label>
                    <div class="col-lg-9">
                      <input type="text" name="april_pegawai" class="form-control" value="" placeholder="Belanja Pegawai" required autofocus onfocus="this.value = this.value;">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-lg-3 text-left">Belanja Barang</label>
                    <div class="col-lg-9">
                      <input type="text" name="april_barang" class="form-control" value="" placeholder="Belanja Barang" required autofocus onfocus="this.value = this.value;">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-lg-3 text-left">Belanja Modal</label>
                    <div class="col-lg-9">
                      <input type="text" name="april_modal" class="form-control" value="" placeholder="Belanja Modal" required autofocus onfocus="this.value = this.value;">
                    </div>
                  </div>
                  <hr>
                  <h4>Mei</h4>
                  <hr class="grey-line">
                  <div class="form-group">
                    <label class="control-label col-lg-3 text-left">Belanja Pegawai</label>
                    <div class="col-lg-9">
                      <input type="text" name="mei_pegawai" class="form-control" value="" placeholder="Belanja Pegawai" required autofocus onfocus="this.value = this.value;">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-lg-3 text-left">Belanja Barang</label>
                    <div class="col-lg-9">
                      <input type="text" name="mei_barang" class="form-control" value="" placeholder="Belanja Barang" required autofocus onfocus="this.value = this.value;">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-lg-3 text-left">Belanja Modal</label>
                    <div class="col-lg-9">
                      <input type="text" name="mei_modal" class="form-control" value="" placeholder="Belanja Modal" required autofocus onfocus="this.value = this.value;">
                    </div>
                  </div>
                  <hr>
                  <h4>Juni</h4>
                  <hr class="grey-line">
                  <div class="form-group">
                    <label class="control-label col-lg-3 text-left">Belanja Pegawai</label>
                    <div class="col-lg-9">
                      <input type="text" name="juni_pegawai" class="form-control" value="" placeholder="Belanja Pegawai" required autofocus onfocus="this.value = this.value;">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-lg-3 text-left">Belanja Barang</label>
                    <div class="col-lg-9">
                      <input type="text" name="juni_barang" class="form-control" value="" placeholder="Belanja Barang" required autofocus onfocus="this.value = this.value;">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-lg-3 text-left">Belanja Modal</label>
                    <div class="col-lg-9">
                      <input type="text" name="juni_modal" class="form-control" value="" placeholder="Belanja Modal" required autofocus onfocus="this.value = this.value;">
                    </div>
                  </div>
                  <hr>
                  <h4>Juli</h4>
                  <hr class="grey-line">
                  <div class="form-group">
                    <label class="control-label col-lg-3 text-left">Belanja Pegawai</label>
                    <div class="col-lg-9">
                      <input type="text" name="juli_pegawai" class="form-control" value="" placeholder="Belanja Pegawai" required autofocus onfocus="this.value = this.value;">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-lg-3 text-left">Belanja Barang</label>
                    <div class="col-lg-9">
                      <input type="text" name="juli_barang" class="form-control" value="" placeholder="Belanja Barang" required autofocus onfocus="this.value = this.value;">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-lg-3 text-left">Belanja Modal</label>
                    <div class="col-lg-9">
                      <input type="text" name="juli_modal" class="form-control" value="" placeholder="Belanja Modal" required autofocus onfocus="this.value = this.value;">
                    </div>
                  </div>
                  <hr>
                  <h4>Agustus</h4>
                  <hr class="grey-line">
                  <div class="form-group">
                    <label class="control-label col-lg-3 text-left">Belanja Pegawai</label>
                    <div class="col-lg-9">
                      <input type="text" name="agustus_pegawai" class="form-control" value="" placeholder="Belanja Pegawai" required autofocus onfocus="this.value = this.value;">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-lg-3 text-left">Belanja Barang</label>
                    <div class="col-lg-9">
                      <input type="text" name="agustus_barang" class="form-control" value="" placeholder="Belanja Barang" required autofocus onfocus="this.value = this.value;">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-lg-3 text-left">Belanja Modal</label>
                    <div class="col-lg-9">
                      <input type="text" name="agustus_modal" class="form-control" value="" placeholder="Belanja Modal" required autofocus onfocus="this.value = this.value;">
                    </div>
                  </div>
                  <hr>
                  <h4>September</h4>
                  <hr class="grey-line">
                  <div class="form-group">
                    <label class="control-label col-lg-3 text-left">Belanja Pegawai</label>
                    <div class="col-lg-9">
                      <input type="text" name="september_pegawai" class="form-control" value="" placeholder="Belanja Pegawai" required autofocus onfocus="this.value = this.value;">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-lg-3 text-left">Belanja Barang</label>
                    <div class="col-lg-9">
                      <input type="text" name="september_barang" class="form-control" value="" placeholder="Belanja Barang" required autofocus onfocus="this.value = this.value;">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-lg-3 text-left">Belanja Modal</label>
                    <div class="col-lg-9">
                      <input type="text" name="september_modal" class="form-control" value="" placeholder="Belanja Modal" required autofocus onfocus="this.value = this.value;">
                    </div>
                  </div>
                  <hr>
                  <h4>Oktober</h4>
                  <hr class="grey-line">
                  <div class="form-group">
                    <label class="control-label col-lg-3 text-left">Belanja Pegawai</label>
                    <div class="col-lg-9">
                      <input type="text" name="oktober_pegawai" class="form-control" value="" placeholder="Belanja Pegawai" required autofocus onfocus="this.value = this.value;">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-lg-3 text-left">Belanja Barang</label>
                    <div class="col-lg-9">
                      <input type="text" name="oktober_barang" class="form-control" value="" placeholder="Belanja Barang" required autofocus onfocus="this.value = this.value;">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-lg-3 text-left">Belanja Modal</label>
                    <div class="col-lg-9">
                      <input type="text" name="oktober_modal" class="form-control" value="" placeholder="Belanja Modal" required autofocus onfocus="this.value = this.value;">
                    </div>
                  </div>
                  <hr>
                  <h4>November</h4>
                  <hr class="grey-line">
                  <div class="form-group">
                    <label class="control-label col-lg-3 text-left">Belanja Pegawai</label>
                    <div class="col-lg-9">
                      <input type="text" name="november_pegawai" class="form-control" value="" placeholder="Belanja Pegawai" required autofocus onfocus="this.value = this.value;">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-lg-3 text-left">Belanja Barang</label>
                    <div class="col-lg-9">
                      <input type="text" name="november_barang" class="form-control" value="" placeholder="Belanja Barang" required autofocus onfocus="this.value = this.value;">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-lg-3 text-left">Belanja Modal</label>
                    <div class="col-lg-9">
                      <input type="text" name="november_modal" class="form-control" value="" placeholder="Belanja Modal" required autofocus onfocus="this.value = this.value;">
                    </div>
                  </div>
                  <hr>
                  <h4>Desember</h4>
                  <hr class="grey-line">
                  <div class="form-group">
                    <label class="control-label col-lg-3 text-left">Belanja Pegawai</label>
                    <div class="col-lg-9">
                      <input type="text" name="desember_pegawai" class="form-control" value="" placeholder="Belanja Pegawai" required autofocus onfocus="this.value = this.value;">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-lg-3 text-left">Belanja Barang</label>
                    <div class="col-lg-9">
                      <input type="text" name="desember_barang" class="form-control" value="" placeholder="Belanja Barang" required autofocus onfocus="this.value = this.value;">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-lg-3 text-left">Belanja Modal</label>
                    <div class="col-lg-9">
                      <input type="text" name="desember_modal" class="form-control" value="" placeholder="Belanja Modal" required autofocus onfocus="this.value = this.value;">
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
