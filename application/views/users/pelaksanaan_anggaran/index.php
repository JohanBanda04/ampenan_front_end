
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
                $lokasi = $this->session->userdata('lokasi');
                $link3 = $this->uri->segment(3);
              ?>
                    <div class="panel panel-inverse">
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                            </div>
                            <h4 class="panel-title">PELAKSANAAN ANGGARAN <?php echo strtoupper($judul_tabel); ?></h4>
                        </div>
                        <div class="panel-body">
                          <?php if ($id_dipa == '00'): ?>
                            <div class="row">
                              <div class="col-md-12"><b>Filter</b></div>
                                <div class="col-md-3">
                                  <select class="form-control default-select2" id="stt" onchange="window.location.href='pelaksanaan_anggaran/v/'+this.value;">
                                    <option value="">- Pilih -</option>
                                    <?php foreach($dipa_list as $baris):?>
                                      <option value="<?php echo $baris['id'] ?>" <?php if($baris['id']==$link3){echo "selected";} ?>><?php echo ucwords($baris['nama']); ?></option>
                                    <?php endforeach; ?>
                                  </select>
                                </div>
                                <div class="col-md-6"></div>
                                <div class="col-md-2"></div>
                            </div>
                            <hr>
                          <?php elseif($level == 'pelaksana'): ?>
                            <a href="<?php echo strtolower($this->uri->segment(1)); ?>/<?php echo strtolower($this->uri->segment(2)); ?>/<?php echo $this->uri->segment(3); ?>/t.html" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Input Pelaksanaan Anggaran</a>
                            <hr>
                          <?php endif; ?>
													<div class="table-responsive">
                            <table id="data-table" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th width="1%">NO.</th>
                                        <th width="20%">KETERANGAN</th>
                                        <th width="10%">DOKUMEN PERTANGGUNG-JAWABAN</th>
                                        <th width="15%">REALISASI</th>
                                        <th>TANGGAL PELAKSANAAN</th>
                                        <th>TANGGAL PENGAJUAN</th>
                                        <th width="1%">STATUS</th>
                                        <th width="15%">Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  <?php
                                    $no=1;
                                   foreach ($pelaksanaan_anggaran as $value): ?>
                                    <tr>
                                        <td><?php echo $no++; ?>.</td>
																				<td><?php echo ucwords($value['uraian']); ?></td>
																				<td class="text-center"><a class="btn btn-info btn-xs" href="<?php echo $value['url_file']; ?>" target="_blank"><i class="fa fa-download"></i> Download</a></td>
																				<td><?php 
                                          if ($value['total_realisasi'] != null) {
                                            echo $value['total_realisasi'];
                                          } else {
                                            echo 'Rp 0';
                                          }
                                        ?></td>
																				<td><?php echo $this->Mcrud->tgl_id(date('d-m-Y', strtotime($value['tanggal_mulai'])),'full'); ?><?php if ($value['tanggal_mulai'] != $value['tanggal_selesai']): ?> s.d. <?php echo $this->Mcrud->tgl_id(date('d-m-Y', strtotime($value['tanggal_selesai'])),'full'); endif;?></td>
																				<td><?php echo $this->Mcrud->tgl_id(date('d-m-Y', strtotime($value['created_at'])),'full'); ?></td>
                                        <td class="text-center verifikasi-icon">
                                          <?php $this->Mcrud->status_verifikasi($value['status_verifikasi']); ?>
                                        </td>
																				<td align="center">
                                          <a href="<?php echo strtolower($this->uri->segment(1)); ?>/<?php echo strtolower($this->uri->segment(2)); ?>/<?php echo strtolower($this->uri->segment(3)); ?>/d/<?php echo hashids_encrypt($value['id']); ?>" class="m-b-5 btn btn-info btn-xs" title="Detail"><i class="fa fa-search"></i></a>
                                          <?php if($level == 'keuangan'){
                                              if ($id_dipa == '00') {
                                                if ($link3 != '00' AND $this->Mcrud->cek_lokasi($link3)) { ?>
                                                  <a href="<?php echo strtolower($this->uri->segment(1)); ?>/<?php echo strtolower($this->uri->segment(2)); ?>/<?php echo $this->uri->segment(3); ?>/c/<?php echo hashids_encrypt($value['id']); ?>" class="m-b-5 btn btn-success btn-xs" title="Verifikasi"><i class="fa fa-edit"></i> Verifikasi</a>
                                          <?php } } else { ?>
                                                  <a href="<?php echo strtolower($this->uri->segment(1)); ?>/<?php echo strtolower($this->uri->segment(2)); ?>/<?php echo $this->uri->segment(3); ?>/c/<?php echo hashids_encrypt($value['id']); ?>" class="m-b-5 btn btn-success btn-xs" title="Verifikasi"><i class="fa fa-edit"></i> Verifikasi</a>
                                          <?php }  } else { ?>
																					  <a href="<?php echo strtolower($this->uri->segment(1)); ?>/<?php echo strtolower($this->uri->segment(2)); ?>/<?php echo $this->uri->segment(3); ?>/e/<?php echo hashids_encrypt($value['id']); ?>" class="m-b-5 btn btn-success btn-xs <?php if ($value['status_verifikasi'] == 'sudah') { echo 'disabled'; }; ?>" title="Edit"><i class="fa fa-edit"></i></a>
                                          <?php } if($level == 'pelaksana'){ ?>
                                            <a href="<?php echo strtolower($this->uri->segment(1)); ?>/<?php echo strtolower($this->uri->segment(2)); ?>/<?php echo $this->uri->segment(3); ?>/h/<?php echo hashids_encrypt($value['id']); ?>" class="m-b-5 btn btn-danger btn-xs <?php if ($value['status_verifikasi'] == 'sudah') { echo 'disabled'; }; ?>" title="Hapus" onclick="return confirm('Anda yakin? Seluruh dokumen akan ikut terhapus.');"><i class="fa fa-trash-o"></i></a>
                                          <?php } ?>
                                        </td>
                                    </tr>
                                  <?php endforeach; ?>
                                </tbody>
                                
                            </table>
													</div>
                        </div>
                    </div>
                    <!-- end panel -->
                </div>
                <!-- end col-12 -->
            </div>
            <!-- end row -->
		</div>
		<!-- end #content -->
