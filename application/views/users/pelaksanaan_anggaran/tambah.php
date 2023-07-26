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
                      <input type="text" name="nama_pelaksanaan_anggaran" class="form-control" value="" placeholder="Nama Pelaksanaan Anggaran" required autofocus onfocus="this.value = this.value;">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-lg-3">Upload File Pertanggungjawaban<b id='wajib_isi'>*</b></label>
                    <div class="col-lg-9">
                      <input type="file" name="file_pertanggungjawaban" class="form-control" value="" placeholder="File" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-lg-3">Tanggal Mulai Pelaksanaan<b id='wajib_isi'>*</b></label>
                    <div class="col-lg-9">
                      <div class="input-group">
                        <input type="date" name="tanggal_mulai" class="form-control daterange-single" value="" maxlength="10" required>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-lg-3">Tanggal Selesai Pelaksanaan<b id='wajib_isi'>*</b></label>
                    <div class="col-lg-9">
                      <div class="input-group">
                        <input type="date" name="tanggal_selesai" class="form-control daterange-single" value="" maxlength="10" required>
                      </div>
                    </div>
                  </div>
                  <hr>
                  <!-- <div class="control-group after-add-more"> -->
                  <div class="field_wrapper">
                    <div class="form-group input-dinamis">
                      <div class="col-input-dinamis col-lg-3">
                        <input type="text" name="kode_akun[]" class="form-control" value="" placeholder="Kode Akun" required>
                      </div>
                      <div class="col-input-dinamis col-lg-5">
                        <input type="text" name="uraian_detil[]" class="form-control" value="" placeholder="Uraian" required>
                      </div>
                      <div class="col-input-dinamis col-lg-3">
                        <input type="text" name="jumlah_realisasi[]" class="form-control" value="" placeholder="Jumlah Realisasi" onkeypress="return hanyaAngka(event)" required>
                      </div>
                      <div class="col-input-dinamis col-lg-1">
                        <button class="btn btn-success add-more" type="button">
                          <i class="fa fa-plus-circle" aria-hidden="true"></i>
                        </button>
                      </div>
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

<script type="text/javascript">
  var addButton = $('.add-more'); //Add button selector
  var wrapper = $('.field_wrapper'); //Input field wrapper

  var fieldHTML = '<div class="form-group input-dinamis"><div class="col-input-dinamis col-lg-3"><input type="text" name="kode_akun[]" class="form-control" value="" placeholder="Kode Akun" required></div><div class="col-input-dinamis col-lg-5"><input type="text" name="uraian_detil[]" class="form-control" value="" placeholder="Uraian" required></div><div class="col-input-dinamis col-lg-3"><input type="text" name="jumlah_realisasi[]" class="form-control" value="" placeholder="Jumlah Realisasi" onkeypress="return hanyaAngka(event)" required></div><div class="col-input-dinamis col-lg-1"><button class="btn btn-danger remove" type="button"><i class="fa fa-minus-circle"></i></button></div></div>'; //New input field html 

  //Once add button is clicked
  $(addButton).click(function(){
      //Check maximum number of input fields
      // x++; //Increment field counter
      $(wrapper).append(fieldHTML); //Add field html
  });
  
  //Once remove button is clicked
  $(wrapper).on('click', '.remove', function(e){
      e.preventDefault();
      $(this).parents('.input-dinamis').remove(); //Remove field html
      // x--; //Decrement field counter
  });
  

</script>
