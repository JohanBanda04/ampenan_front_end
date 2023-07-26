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
            <div class="panel-body pelaksanaan-anggaran">
                <?php
                echo $this->session->flashdata('msg');
                $level = $this->session->userdata('level');
                ?>
                <form class="form-horizontal" action="" data-parsley-validate="true" method="post" enctype="multipart/form-data">
                  <style>
                    #wajib_isi{color:red;}
                  </style>
                  <div class="alert alert-success">
                    <strong><i>Catatan :</i></strong> Pastikan Laporan Pertanggungjawaban Anda telah lengkap dan sesuai dengan ketentuan. Ketentuan Pertanggungjawaban dapat dilihat pada link berikut ini    <a class="btn btn-info btn-xs" href="file/ketentuan_pertanggungjawaban/Kelengkapan data pertanggungjawaban belanja.pdf" target="_blank"><i class="fa fa-download"></i> Kelengkapan Pertanggungjawaban</a>
                  </div>
                  <br>
                  <div class="form-group" methode="post">
                    <label class="col-lg-3">Nama Pelaksanaan Anggaran<b id='wajib_isi'>*</b></label>
                    <div class="col-lg-9">
                      <input type="text" name="nama_pelaksanaan_anggaran" class="form-control" value="<?php echo $pelaksanaan_anggaran['uraian']; ?>" placeholder="Nama Pelaksanaan Anggaran" required autofocus onfocus="this.value = this.value;" readonly>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-lg-3">Upload File Pertanggungjawaban<b id='wajib_isi'>*</b></label>
                    <div class="col-lg-9">
                      <!-- <input type="file" name="file_pertanggungjawaban" class="form-control" value="" placeholder="File" required> -->
                      <a href="<?php echo $pelaksanaan_anggaran['uraian']; ?>" target="_blank"><?php echo $pelaksanaan_anggaran['url_file']; ?></a>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-lg-3">Tanggal Mulai Pelaksanaan<b id='wajib_isi'>*</b></label>
                    <div class="col-lg-9">
                      <div class="input-group">
                        <input type="date" name="tanggal_mulai" class="form-control daterange-single" value="<?php echo $pelaksanaan_anggaran['tanggal_mulai']; ?>" maxlength="10" required readonly>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-lg-3">Tanggal Selesai Pelaksanaan<b id='wajib_isi'>*</b></label>
                    <div class="col-lg-9">
                      <div class="input-group">
                        <input type="date" name="tanggal_selesai" class="form-control daterange-single" value="<?php echo $pelaksanaan_anggaran['tanggal_selesai']; ?>" maxlength="10" required readonly>
                      </div>
                    </div>
                  </div>
                  <hr>
                  <?php if($pelaksanaan_anggaran_akun_detil != null): ?>
                  <label class="col-lg-3">Kode Akun</label>
                  <label class="col-lg-5">Realisasi</label>
                  <label class="col-lg-4">Uraian</label>
                  <?php foreach($pelaksanaan_anggaran_akun_detil as $key => $value):?>
                    <div class="form-group input-dinamis">
                      <div class="col-input-dinamis col-lg-3">
                        <input type="text" name="kode_akun[]" class="form-control" value="<?php echo $value['kode_akun']; ?>" placeholder="Kode Akun" required readonly>
                      </div>
                      <div class="col-input-dinamis col-lg-5">
                        <input type="text" name="uraian_detil[]" class="form-control" value="<?php echo $value['uraian_detil']; ?>" placeholder="Uraian" required readonly>
                      </div>
                      <div class="col-input-dinamis col-lg-4">
                        <input type="text" name="jumlah_realisasi[]" class="form-control" value="<?php echo $value['jumlah_realisasi']; ?>" placeholder="Jumlah Realisasi" onkeypress="return hanyaAngka(event)" required readonly>
                      </div>
                    </div>
                  <?php endforeach; ?>
                  <div class="row">
                    <div class="col-lg-8 text-right"><strong>Total Realisasi</strong>  :</div>
                    <div class="col-lg-4"><?php echo $total_realisasi; ?></div>
                  </div>
                  <?php else: ?>
                    <div class="text-center">- Detil realisasi belum diinput -</div>
                  <?php endif; ?>
                  <?php if($level == 'keuangan'): ?>
                  <hr>
                  <div class="form-group">
                    <label class="col-lg-3">Verifikasi</label>
                    <div class="col-lg-9">
                      <input class="radio-btn-verifikasi" type="radio" name="status_verifikasi" value="tolak"><span class="radio-text">Tolak</span>
                      <input class="radio-btn-verifikasi" type="radio" name="status_verifikasi" value="sudah"><span class="radio-text">Setuju</span>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-lg-3">Catatan</label>
                    <div class="col-lg-9">
                      <textarea name="catatan" class="form-control" placeholder="Catatan" rows="4" cols="100"><?php echo $pelaksanaan_anggaran['catatan_verifikator']; ?></textarea>
                    </div>
                  </div>
                  <?php endif; ?>
                  <hr>
                  <a href="<?php echo strtolower($this->uri->segment(1)); ?>/<?php echo strtolower($this->uri->segment(2)); ?>/<?php echo strtolower($this->uri->segment(3)); ?>.html" class="btn btn-default"><< Kembali</a>
                  <button type="submit" name="btnkonfirm" class="btn btn-primary" style="float:right;">Simpan</button>
                </form>
            </div>

        </div>
      </div>
    </div>
    <!-- /dashboard content -->

<script type="text/javascript">
  // Radio Button 
  var val_status = <?php echo json_encode($pelaksanaan_anggaran['status_verifikasi']); ?>;
  $('input:radio[name=status_verifikasi]').val([val_status]);

  // Dynamic Form 
  var addButton = $('.add-more'); //Add button selector
  var wrapper = $('.field_wrapper'); //Input field wrapper

  var fieldHTML = '<div class="form-group input-dinamis"><div class="col-input-dinamis col-lg-3"><input type="text" name="kode_akun[]" class="form-control" value="" placeholder="Kode Akun" required></div><div class="col-input-dinamis col-lg-5"><input type="text" name="uraian_detil[]" class="form-control" value="" placeholder="Uraian" required></div><div class="col-input-dinamis col-lg-3"><input type="text" name="jumlah_realisasi[]" class="form-control" value="" placeholder="Jumlah Realisasi" onkeypress="return hanyaAngka(event)" required></div><div class="col-input-dinamis col-lg-1"><button class="btn btn-danger remove" type="button"><i class="fa fa-minus-circle"></i></button></div></div>'; //New input field html 


  //Once add button is clicked
  $(addButton).click(function(){
      //Check maximum number of input fields
      $(wrapper).append(fieldHTML); //Add field html
  });
  
  //Once remove button is clicked
  $(wrapper).on('click', '.remove', function(e){
      e.preventDefault();
      $(this).parents('.input-dinamis').remove(); //Remove field html
  });
  

</script>
