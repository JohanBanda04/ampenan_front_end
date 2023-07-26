
<!-- begin #content -->
		<div id="content" class="content">
			<!-- begin breadcrumb -->
			<ol class="breadcrumb pull-right">
				<li><a href="dashboard.html">Dashboard</a></li>
				<li class="active"><?php echo $judul_web; ?></li>
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header">Data <small><?php echo $judul_web; ?></small></h1>
			<!-- end page-header -->

			<!-- begin row -->
			<div class="row">
			    <!-- begin col-12 -->
			    <div class="col-md-12">
			        <!-- begin panel -->
              <?php
                echo $this->session->flashdata('msg');
                $id_dipa = $this->session->userdata('id_dipa');
                $level = $this->session->userdata('level');
                $username = $this->session->userdata('username');
                $link1 = $this->uri->segment(1);
                $link2 = $this->uri->segment(2);
                $link3 = $this->uri->segment(3);
                $link4 = $this->uri->segment(4);
                $link5 = $this->uri->segment(5);
                if ($id_dipa == '00') {
                  $id_dipa_select = $link4;
                } else {
                  $id_dipa_select = $id_dipa;
                }

              ?>
                    <div class="panel panel-inverse">
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                            </div>
                            <h4 class="panel-title">MONEV <?php echo strtoupper($judul_tabel_jenis) . ' ' . strtoupper($judul_tabel_dipa); ?></h4>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                              <?php if ($id_dipa == '00'): ?>
                              <div class="col-md-3">
                                  <select class="form-control default-select2" id="" onchange="window.location.href='<?php echo $link1; ?>/<?php echo $link2; ?>/<?php echo $link3; ?>/'+this.value;">
                                    <option value="">- Pilih DIPA -</option>
                                    <?php foreach($dipa_list as $baris):
                                          if ($baris['id']=='00') continue;
                                    ?>
                                    <option value="<?php echo $baris['id'] ?>" <?php if($baris['id']==$link4){echo "selected";} ?>><?php echo ucwords($baris['nama']); ?></option>
                                    <?php endforeach; ?>
                                  </select>
                                </div>
                                <?php endif; ?>
                              <div class="col-md-3">
                              <?php //if ($link3 == 'i'): ?>
                                <select class="form-control default-select2" id="" onchange="window.location.href='<?php echo $link1; ?>/<?php echo $link2; ?>/<?php echo $link3; ?>/<?php echo $id_dipa_select; ?>/'+this.value;">
                                    <option value="">- Pilih Monev -</option>
                                    <?php foreach($monev_list as $baris):?>
                                    <option value="<?php echo hashids_encrypt($baris['id']); ?>" <?php if(hashids_encrypt($baris['id'])==$link5){echo "selected";} ?>><?php echo ucwords($baris['judul']); ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <?php //endif; ?>
                              </div>
                              <?php if ($id_dipa != '00'): ?>
                                <div class="col-md-3"></div>
                              <?php endif; ?>
                              <div class="col-md-6 text-right">
                                <?php if ($username == 'kakanwil' AND $id_dipa_select != ''): ?>
                                  <?php //if ($monev == ''): ?>
                                    <a href="<?php echo strtolower($this->uri->segment(1)) . "/" . strtolower($this->uri->segment(2)) . "/" . $this->uri->segment(3) . "/" .  $id_dipa_select . "/" . hashids_encrypt(''); ?>/t.html" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Input</a>
                                  <?php if ($monev != ''): ?>
                                    <a href="<?php echo strtolower($this->uri->segment(1)) . "/" . strtolower($this->uri->segment(2)) . "/" . $this->uri->segment(3) . "/" .  $id_dipa_select . "/" . hashids_encrypt($monev['id']); ?>/er.html" class="btn btn-success"><i class="fa fa-pencil"></i> Edit</a>
                                    <a href="<?php echo strtolower($this->uri->segment(1)) . "/" . strtolower($this->uri->segment(2)) . "/" . $this->uri->segment(3) . "/" .  $id_dipa_select . "/" . hashids_encrypt($monev['id']); ?>/h.html" class="btn btn-danger"><i class="fa fa-trash"></i> Hapus</a>
                                  <?php endif;
                                elseif ($monev != null AND $level == 'kpa'):
                                  if ($monev['tindak_lanjut_rekomendasi'] == ''): ?>
                                    <a href="<?php echo strtolower($this->uri->segment(1)) . "/" . strtolower($this->uri->segment(2)) . "/" . $this->uri->segment(3) . "/" .  $id_dipa_select . "/" . hashids_encrypt($monev['id']); ?>/tl.html" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Input Tindak Lanjut</a>
                                  <?php else: ?>
                                    <a href="<?php echo strtolower($this->uri->segment(1)) . "/" . strtolower($this->uri->segment(2)) . "/" . $this->uri->segment(3) . "/" .  $id_dipa_select . "/" . hashids_encrypt($monev['id']); ?>/etl.html" class="btn btn-success"><i class="fa fa-plus-circle"></i> Edit Tindak Lanjut</a>
                                  <?php endif; endif; ?>
                                </div>
                              </div>
                              <hr <?php if (($id_dipa != '00' AND $link3 != 'i' AND $monev == null) OR ($id_dipa != '00' AND $level!='kpa' AND $link3 != 'i')) { echo "hidden"; } ?>>
                            <?php if ($monev == null):?>
                              <div class="text-center">-- Belum ada data Monitoring dan Evaluasi --</div>
                            <?php else: ?>
                            <div class="row">
                              <div class="col-md-6">
                                  <div class="table-responsive">
                                    <table class="table table-bordered table-striped" width="100%">
                                      <tbody>
                                        <tr>
                                          <th>Rekomendasi Kepala Kantor Wilayah</th>
                                        </tr>
                                        <tr>
                                          <td>
                                            <?php if ($monev['rekomendasi'] != '') {
                                                echo ucfirst($monev['rekomendasi']); 
                                              } else {
                                                echo "Belum ada rekomendasi.";
                                              }
                                            ?>
                                          </td>
                                        </tr>
                                      </tbody>
                                    </table>
                                  </div>
                              </div>
                              <div class="col-md-6">
                                  <div class="table-responsive">
                                    <table class="table table-bordered table-striped" width="100%">
                                      <tbody>
                                        <tr>
                                          <th>Tindak Lanjut Satuan Kerja</th>
                                        </tr>
                                        <tr>
                                          <td>
                                            <?php if ($monev['tindak_lanjut_rekomendasi'] != '') {
                                                echo ucfirst($monev['tindak_lanjut_rekomendasi']); 
                                              } else {
                                                echo "Belum ada tindak lanjut.";
                                              }
                                            ?>
                                          </td>
                                        </tr>
                                      </tbody>
                                    </table>
                                  </div>
                                </div>
                              </div>
                              <?php endif; ?>
                        </div>
                    </div>
                    <!-- end panel -->
                </div>
                <!-- end col-12 -->
            </div>
            <!-- end row -->
		</div>
		<!-- end #content -->

<script>
$(document).ready(function(){
  $('#right').tooltip();
});
</script>