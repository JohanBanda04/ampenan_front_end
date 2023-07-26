
<!-- begin #content -->
		<div id="content" class="content">
			<!-- begin breadcrumb -->
			<ol class="breadcrumb pull-right">
				<li><a href="dashboard.html">Dashboard</a></li>
				<li class="active"><?php echo ucwords($judul_web); ?></li>
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header">Folder <small><?php echo ucwords($judul_web); ?></small></h1>
			<!-- end page-header -->

			<!-- begin row -->
			<div class="row">
			    <!-- begin col-12 -->
			    <div class="col-md-12">
			        <!-- begin panel -->
              <?php
                echo $this->session->flashdata('msg');
              ?>
                    <div class="panel panel-inverse">
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                            </div>
                            <h4 class="panel-title">DATA DUKUNG</h4>
                        </div>
                        <div class="panel-body">
                          <a href="<?php echo strtolower($this->uri->segment(1)); ?>/<?php echo strtolower($this->uri->segment(2)); ?>/<?php echo $this->uri->segment(3); ?>/t.html" class="btn btn-primary"><i class="fa fa-upload"></i> Unggah Dokumen</a>
                          <hr>
													<div class="table-responsive">
                            <table id="data-table" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th width="1%">NO.</th>
                                        <th>NAMA FILE</th>
                                        <th width="15%">DOWNLOAD</th>
                                        <th width="15%">Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  <?php
                                    $no=1;
                                   foreach ($data_dukung as $value): ?>
                                    <tr>
                                        <td><?php echo $no++; ?>.</td>
																				<td><?php echo ucwords($value['uraian']); ?></td>
                                        <td><a class="btn btn-info" href="<?php echo $value['url_file']; ?>" target="_blank"><i class="fa fa-download"></i> Download</a></td>
																				<td align="center">
																					<a href="<?php echo strtolower($this->uri->segment(1)); ?>/<?php echo strtolower($this->uri->segment(2)); ?>/<?php echo $this->uri->segment(3); ?>/e/<?php echo hashids_encrypt($value['id']); ?>" class="btn btn-success btn-xs" title="Edit"><i class="fa fa-edit"></i></a>
                                          <a href="<?php echo strtolower($this->uri->segment(1)); ?>/<?php echo strtolower($this->uri->segment(2)); ?>/<?php echo $this->uri->segment(3); ?>/h/<?php echo hashids_encrypt($value['id']); ?>" class="btn btn-danger btn-xs" title="Hapus" onclick="return confirm('Anda yakin?');"><i class="fa fa-trash-o"></i></a>
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
