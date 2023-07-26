
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
                            <h4 class="panel-title">ANALISA KEBUTUHAN ANGGARAN <?php echo strtoupper($judul_tabel); ?></h4>
                        </div>
                        <div class="panel-body">
                          <?php if ($id_dipa == '00'): ?>
                            <div class="row">
                              <div class="col-md-12"><b>DIPA</b></div>
                                <div class="col-md-3">
                                  <select class="form-control default-select2" id="stt" onchange="window.location.href='ankabut/v/'+this.value;">
                                    <option value="00">- Pilih DIPA -</option>
                                    <?php foreach($dipa_list as $baris):
                                      if ($baris['id'] == '00') continue;?>
                                      <option value="<?php echo $baris['id'] ?>" <?php if($baris['id']==$link3){echo "selected";} ?>><?php echo ucwords($baris['nama']); ?></option>
                                    <?php endforeach; ?>
                                  </select>
                                </div>
                                <div class="col-md-6"></div>
                                <div class="col-md-2"></div>
                            </div>
                          <?php elseif($level == 'pelaksana'): ?>
                              <a href="<?php echo strtolower($this->uri->segment(1)); ?>/<?php echo strtolower($this->uri->segment(2)); ?>/<?php echo $this->uri->segment(3); ?>/t.html" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Unggah Dokumen</a>
                          <?php endif; ?>
                           <hr>
                          <?php if ($id_dipa == '00' AND $ankabut == ''): ?>
                            <div class="text-center">
                              -- Silahkan pilih DIPA terlebih dahulu --
                            </div>
                          <?php else: ?>
													<div class="table-responsive">
                            <table id="data-table" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th width="1%">NO.</th>
                                        <th>NAMA FILE</th>
                                        <th width="20%">FILE</th>
                                        <?php if ($level == 'pelaksana'):?>
                                          <th width="15%">Opsi</th>
                                        <?php endif; ?>
                                    </tr>
                                </thead>
                                <tbody>
                                  <?php
                                    $no=1;
                                   foreach ($ankabut as $value): ?>
                                    <tr>
                                        <td><?php echo $no++; ?>.</td>
																				<td><?php echo ucwords($value['uraian']); ?></td>
																				<td class="text-center"><a class="btn btn-info" href="<?php echo $value['url_file']; ?>" target="_blank"><i class="fa fa-download"></i> Download</a></td>
                                        <?php if ($level == 'pelaksana'):?>
																				  <td align="center">
																					  <a href="<?php echo strtolower($this->uri->segment(1)); ?>/<?php echo strtolower($this->uri->segment(2)); ?>/<?php echo $this->uri->segment(3); ?>/e/<?php echo hashids_encrypt($value['id']); ?>" class="m-b-5 btn btn-success btn-xs" title="Edit"><i class="fa fa-edit"></i></a>
                                            <a href="<?php echo strtolower($this->uri->segment(1)); ?>/<?php echo strtolower($this->uri->segment(2)); ?>/<?php echo $this->uri->segment(3); ?>/h/<?php echo hashids_encrypt($value['id']); ?>" class="m-b-5 btn btn-danger btn-xs" title="Hapus" onclick="return confirm('Anda yakin? Seluruh dokumen akan ikut terhapus.');"><i class="fa fa-trash-o"></i></a>
                                          </td>
                                        <?php endif; ?>
                                    </tr>
                                  <?php endforeach; ?>
                                </tbody>
                                
                            </table>
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
