
<!-- begin #content -->
		<div id="content" class="content">
			<!-- begin breadcrumb -->
			<ol class="breadcrumb pull-right">
				<li><a href="dashboard.html">Dashboard</a></li>
				<li class="active"><?php echo $judul_web; ?></li>
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header">Folder <small><?php echo $judul_web; ?></small></h1>
			<!-- end page-header -->

			<!-- begin row -->
			<div class="row">
			    <!-- begin col-12 -->
			    <div class="col-md-12">
			        <!-- begin panel -->
              <?php
                echo $this->session->flashdata('msg');
                $id_dipa = $this->session->userdata('id_dipa');
              ?>
                    <div class="panel panel-inverse">
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                            </div>
                            <h4 class="panel-title">FOLDER DATA DUKUNG DIPA <?php echo strtoupper($judul_tabel); ?></h4>
                        </div>
                        <div class="panel-body">
                          <?php if ($id_dipa == '00'): ?>
                            <div class="row">
                              <div class="col-md-12"><b>Filter</b></div>
                                <div class="col-md-3">
                                  <select class="form-control default-select2" id="stt" onchange="window.location.href='folder_data_dukung/v/'+this.value;">
                                    <option value="">- Pilih -</option>
                                    <?php foreach($dipa_list as $baris): ?>

                                    <option value="<?php echo $baris['id'] ?>" <?php if($baris['id']==$link3){echo "selected";} ?>><?php echo ucwords($baris['nama']); ?></option>
                                    <?php endforeach; ?>
                                  </select>
                                </div>
                                <div class="col-md-1">
                                </div>
                                <div class="col-md-6"></div>
                                <div class="col-md-2"></div>
                            </div>
                          <?php else: ?>
                            <a href="<?php echo strtolower($this->uri->segment(1)); ?>/<?php echo strtolower($this->uri->segment(2)); ?>/<?php echo $this->uri->segment(3); ?>/t.html" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Buat Folder</a>
                            <?php endif; ?>
                            <hr>
													<div class="table-responsive">
                            <table id="data-table" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th width="1%">NO.</th>
                                        <th>NAMA FOLDER</th>
                                        <th width="15%">JUMLAH DOKUMEN</th>
                                        <th width="15%">Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  <?php
                                    $no=1;
                                   foreach ($folder_data_dukung as $value): ?>
                                    <tr>
                                        <td><?php echo $no++; ?>.</td>
																				<td><?php echo ucwords($value['uraian']); ?></td>
                                        <td><?php echo $this->Guzzle_model->countDataDukung($value['id']); ?></td>
																				<td align="center">
                                          <a href="data_dukung/<?php echo strtolower($this->uri->segment(2)); ?>/<?php echo hashids_encrypt($value['id']); ?>" class="btn btn-info btn-xs" title="Detail"><i class="fa fa-search"></i></a>
																					<a href="<?php echo strtolower($this->uri->segment(1)); ?>/<?php echo strtolower($this->uri->segment(2)); ?>/<?php echo $this->uri->segment(3); ?>/e/<?php echo hashids_encrypt($value['id']); ?>" class="btn btn-success btn-xs" title="Edit"><i class="fa fa-edit"></i></a>
                                          <a href="<?php echo strtolower($this->uri->segment(1)); ?>/<?php echo strtolower($this->uri->segment(2)); ?>/<?php echo $this->uri->segment(3); ?>/h/<?php echo hashids_encrypt($value['id']); ?>" class="btn btn-danger btn-xs" title="Hapus" onclick="return confirm('Anda yakin? Seluruh dokumen akan ikut terhapus.');"><i class="fa fa-trash-o"></i></a>
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
