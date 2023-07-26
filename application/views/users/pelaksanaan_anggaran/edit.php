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
                $link3 = $this->uri->segment(3);
                $link5 = $this->uri->segment(5);
                
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
                      <input type="text" name="nama_pelaksanaan_anggaran" class="form-control" value="<?php echo $pelaksanaan_anggaran['uraian']; ?>" placeholder="Nama Pelaksanaan Anggaran" required autofocus onfocus="this.value = this.value;">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-lg-3">Upload File Pertanggungjawaban<b id='wajib_isi'>*</b></label>
                    <div class="col-lg-9">
                      <input type="file" name="file_pertanggungjawaban" class="form-control" value="" placeholder="File">
                      <a href="<?php echo $pelaksanaan_anggaran['url_file']; ?>" target="_blank"><?php echo $pelaksanaan_anggaran['url_file']; ?></a>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-lg-3">Tanggal Mulai Pelaksanaan<b id='wajib_isi'>*</b></label>
                    <div class="col-lg-9">
                      <div class="input-group">
                        <input type="date" name="tanggal_mulai" class="form-control daterange-single" value="<?php echo $pelaksanaan_anggaran['tanggal_mulai']; ?>" maxlength="10" required>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-lg-3">Tanggal Selesai Pelaksanaan<b id='wajib_isi'>*</b></label>
                    <div class="col-lg-9">
                      <div class="input-group">
                        <input type="date" name="tanggal_selesai" class="form-control daterange-single" value="<?php echo $pelaksanaan_anggaran['tanggal_selesai']; ?>" maxlength="10" required>
                      </div>
                    </div>
                  </div>
                  <hr>
                  <?php if($pelaksanaan_anggaran_akun_detil != null): ?>
                  <!-- <div class="control-group after-add-more"> -->
                    <div class="field_wrapper_new">
                        <button class="btn btn-success add-new" type="button">
                          <i class="fa fa-plus-circle" aria-hidden="true"></i> Tambah Akun Detil
                        </button>
                    </div>
                    <div class="field_wrapper">
                    <?php foreach ($pelaksanaan_anggaran_akun_detil as $key => $value):?>
                    <div class="form-group input-dinamis">
                      <input type="hidden" name="id_pelaksanaan_anggaran_akun_detil[]" value="<?php echo $value['id']; ?>">
                      <div class="col-input-dinamis col-lg-3">
                        <input type="text" name="kode_akun[]" class="form-control" value="<?php echo $value['kode_akun']; ?>" placeholder="Kode Akun" required>
                      </div>
                      <div class="col-input-dinamis col-lg-5">
                        <input type="text" name="uraian_detil[]" class="form-control" value="<?php echo $value['uraian_detil']; ?>" placeholder="Uraian Detil" required>
                      </div>
                      <div class="col-input-dinamis col-lg-3">
                        <input type="text" name="jumlah_realisasi[]" class="form-control" value="<?php echo $value['jumlah_realisasi']; ?>" placeholder="Jumlah Realisasi" onkeypress="return hanyaAngka(event)" required>
                      </div>
                      <div class="col-input-dinamis col-lg-1">
                        <a class="btn btn-danger remove" type="button" name="btnremove[]" id="<?php echo $value['id']; ?>" href="pelaksanaan_anggaran/hapus_akun_detil/<?php echo $link3; ?>/<?php echo $link5; ?>/<?php echo hashids_encrypt($value['id']) ?>"  onclick="return confirm('Apakah Anda yakin? Akun detil ini akan dihapus dalam database.');">
                          <i class="fa fa-minus-circle" aria-hidden="true"></i>
                        </a>
                      </div>
                    </div>
                    <?php endforeach; ?>
                  </div>
                  <?php else: ?>
                    <div class="field_wrapper_new">
                      <div class="form-group input-dinamis">
                        <div class="col-input-dinamis col-lg-3">
                          <input type="text" name="kode_akun_new[]" class="form-control" value="" placeholder="Kode Akun" required>
                        </div>
                        <div class="col-input-dinamis col-lg-5">
                          <input type="text" name="uraian_detil_new[]" class="form-control" value="" placeholder="Uraian Detil" required>
                        </div>
                        <div class="col-input-dinamis col-lg-3">
                          <input type="text" name="jumlah_realisasi_new[]" class="form-control" value="" placeholder="Jumlah Realisasi" onkeypress="return hanyaAngka(event)" required>
                        </div>
                        <div class="col-input-dinamis col-lg-1">
                          <button class="btn btn-success add-new" type="button">
                            <i class="fa fa-plus-circle" aria-hidden="true"></i>
                          </button>
                        </div>
                      </div>
                    </div>
                  <?php endif; ?>
                  <hr>
                  <a href="<?php echo strtolower($this->uri->segment(1)); ?>/<?php echo strtolower($this->uri->segment(2)); ?>/<?php echo strtolower($this->uri->segment(3)); ?>.html" class="btn btn-default"><< Kembali</a>
                  <button type="submit" name="btnupdate" class="btn btn-primary" style="float:right;">Simpan</button>
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

  var val_skor = <?php echo json_encode($pelaksanaan_anggaran['skor_warna']); ?>;
  $('input:radio[name=skor_warna]').val([val_skor]);

  $(':radio:not(:checked)').attr('disabled', true);
  

  // Dynamic Form Tambah
  var addButton = $('.add-more'); //Add button selector
  var wrapper = $('.field_wrapper'); //Input field wrapper

  var fieldHTML = '<div class="form-group input-dinamis"><div class="col-input-dinamis col-lg-3"><input type="text" name="kode_akun[]" class="form-control" value="" placeholder="Kode Akun" required></div><div class="col-input-dinamis col-lg-5"><input type="text" name="uraian_detil[]" class="form-control" value="" placeholder="Uraian" required></div><div class="col-input-dinamis col-lg-3"><input type="text" name="jumlah_realisasi[]" class="form-control" value="" placeholder="Jumlah Realisasi" onkeypress="return hanyaAngka(event)" required></div><div class="col-input-dinamis col-lg-1"><button class="btn btn-danger remove" type="button" onclick="return confirm("Anda yakin akan menghapus detil ini?");"><i class="fa fa-minus-circle"></i></button></div></div>'; //New input field html 

  //Once add button is clicked
  $(addButton).click(function(){
      //Check maximum number of input fields
      $(wrapper).append(fieldHTML); //Add field html
  });
  
  // Dynamic Form Edit
  var addNew = $('.add-new'); //Add button selector
  var wrapperNew = $('.field_wrapper_new'); //Input field wrapper

  var fieldHTMLnew = '<div class="form-group input-dinamis"><div class="col-input-dinamis col-lg-3"><input type="text" name="kode_akun_new[]" class="form-control" value="" placeholder="Kode Akun" required></div><div class="col-input-dinamis col-lg-5"><input type="text" name="uraian_detil_new[]" class="form-control" value="" placeholder="Uraian" required></div><div class="col-input-dinamis col-lg-3"><input type="text" name="jumlah_realisasi_new[]" class="form-control" value="" placeholder="Jumlah Realisasi" onkeypress="return hanyaAngka(event)" required></div><div class="col-input-dinamis col-lg-1"><button class="btn btn-danger remove" type="button" onclick="return confirm("Anda yakin akan menghapus detil ini?");"><i class="fa fa-minus-circle"></i></button></div></div>'; //New input field html 

  //Once add button is clicked
  $(addNew).click(function(){
      //Check maximum number of input fields
      $(wrapperNew).append(fieldHTMLnew); //Add field html
  });
  
  //Once remove button is clicked
  $(wrapperNew).on('click', '.remove', function(e){
      e.preventDefault();
      $(this).parents('.input-dinamis').remove(); //Remove field html
  });
  

</script>
