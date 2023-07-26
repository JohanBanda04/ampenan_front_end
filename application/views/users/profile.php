<?php
$username   = $this->session->userdata('username');
$level   = $this->session->userdata('level');
$nama	= $this->session->userdata('nama');
$id_dipa	= $this->session->userdata('id_dipa');

$foto_profile = "img/user/user-default.jpg";
if ($level=='obh') {
	$d_k = $this->db->get_where('tbl_data_obh', array('id_user'=>$user->id_user))->row();
	$foto_k = $d_k->foto_obh;
	if ($foto_k!='') {
		if(file_exists("$foto_k")){
			$foto_profile = $foto_k;
		}
	}
}
?>
<!-- Main content -->
<div class="content-wrapper">

  <!-- Content area -->
  <div class="content">

    <!-- Dashboard content -->
    <div class="row">
      <div class="col-md-3"></div>
      <div class="col-md-6">
      <div class="panel panel-flat">
          <div class="panel-body">
              <center>
                <img src="<?php echo $foto_profile; ?>" alt="<?php echo $nama; ?>" class="img-circle" width="176">
              </center>
          </div>
      </div>

      <div class="panel panel-flat">
          <div class="panel-body">
            <fieldset class="content-group">
              <legend class="text-bold"><i class="icon-user"></i>
                PROFILE
              </legend>
              <?php
              echo $this->session->flashdata('msg');
              ?>
              <form class="form-horizontal" action="" method="post" data-parsley-validate="true" enctype="multipart/form-data">
                  <div class="form-group">
                    <label class="control-label col-lg-3">Username</label>
                    <div class="col-lg-9">
                      <input type="text" name="username" class="form-control" value="<?php echo strtolower($username); ?>" placeholder="Nama Pengguna" readonly>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-lg-3">Nama</label>
                    <div class="col-lg-9">
                      <input type="text" name="nama_lengkap" class="form-control" value="<?php echo ucwords($nama); ?>" placeholder="Nama Lengkap" maxlength="100" readonly>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-lg-3">Level</label>
                    <div class="col-lg-9">
                      <input type="text" name="" class="form-control" value="<?php echo strtoupper($level); ?>" placeholder="Level User" readonly>
                    </div>
                  </div>
                
                <hr>
                
            </fieldset>

          </form>
          </div>
      </div>
      </div>


    </div>
    <!-- /dashboard content -->


        <script src="assets/js/jquery.min.js"></script>
        <link rel="stylesheet" type="text/css" href="assets/panel/plugin/datetimepicker/jquery.datetimepicker.css"/>
        <script src="assets/panel/plugin/datetimepicker/jquery.datetimepicker.js"></script>
        <script>
        $('#tgl_1').datetimepicker({
          lang:'en',
          timepicker:false,
          format:'d-m-Y'
        });
        </script>
