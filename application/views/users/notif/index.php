
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
            ?>

            <div class="panel panel-inverse">
				<div class="panel-heading">
					<div class="panel-heading-btn">
						<a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
					</div>
					
					<h4 class="panel-title"><?php echo $judul_web; ?> </h4>
						<!-- <a href="web/notif/h_all" class="btn btn-danger btn-xs" onclick="return confirm('Anda Yakin??');"> <i class="fa fa-trash"></i> Hapus Semua Notifikasi Saya</a> -->
					</div>
				
				<div class="panel-body">
					<div class="table-responsive">
						<table id="data-table" class="table table-striped table-bordered">
                            <thead>
                                <tr>
									<th width="1%">NO.</th>
									<th width="10%">FOTO</th>
									<th width="25%">PENGIRIM</th>
									<th width="40%">Pesan</th>
									<th width="14%">WAKTU</th>
									<th width="10%">Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php
                                	$no=1;
									$foto  = "img/user/user-default.jpg";
									$id_user = $this->session->userdata('id_user');
									foreach ($notif as $value):
										$cek_penerima = $this->Guzzle_model->getUserById($value['id_user_penerima']);

									  	if (count($cek_penerima)!=0) {
											$cek_pengirim = $this->Guzzle_model->getUserById($value['id_user_pengirim']);
											$dipa = $this->Guzzle_model->getDetailDipa($cek_pengirim['id_dipa']);
											$nama  = $cek_pengirim['nama'];
											$nama_dipa = $dipa['nama'];
											$pesan = $value['pesan'];
											$waktu = $this->Mcrud->waktu($value['created_at'],'full');
											
											$link = "javascript:;";

									  		if ($value['link']!='') {
												$link = $value['link'];
									  		}

								?>
								<tr>
                                    <td><b><?php echo $no++; ?>.</b></td>
									<td>
										<a href="<?php echo $foto; ?>" data-fancybox="all" data-caption="<?php echo $nama . ' ' . $nama_dipa; ?>">
											<img src="<?php echo $foto; ?>" alt="<?php echo $nama; ?>" width="100">
										</a>
									</td>
									<td><?php echo $nama . ' ' . $nama_dipa; ?></td>
									<td><?php echo ucfirst($pesan); ?></td>
									<td><?php echo $waktu; ?></td>
									<td align="center">
										<a href="<?php echo $link; ?>" class="btn btn-info btn-xs" title="Detail"><i class="fa fa-search"></i></a>
										<a href="web/notif/h/<?php echo hashids_encrypt($value['id']); ?>" class="btn btn-danger btn-xs" title="Hapus" onclick="return confirm('Anda yakin?');"><i class="fa fa-trash-o"></i></a>
									</td>
                                </tr>
                                <?php
											
										}
									endforeach; ?>
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
