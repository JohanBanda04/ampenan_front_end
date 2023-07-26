<!DOCTYPE html>
<?php
$username   = $this->session->userdata('username');
$level   = $this->session->userdata('level');
$nama	= $this->session->userdata('nama');
$id_dipa	= $this->session->userdata('id_dipa');

$dipa_name = '';
if ($id_dipa != '00') {
	$dipa_user = $this->Guzzle_model->getDetailDipa($id_dipa);
	$dipa_name = $dipa_user['nama'];
}

$foto = "img/user/user-default.jpg";

$menu 		= strtolower($this->uri->segment(1));
$sub_menu = strtolower($this->uri->segment(2));
$sub_menu3 = strtolower($this->uri->segment(3));
?>

<html lang="en">
<head>
	<meta charset="utf-8" />
	<title><?= $judul_web; ?></title>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
	<meta content="<?php echo $this->Mcrud->judul_web(); ?>" name="description" />
	<meta content="Kemenkumham NTB" name="author" />
	<meta name="keywords" content="Kemenkumham NTB, <?php echo $this->Mcrud->judul_web(); ?>">
	<base href="<?php echo base_url();?>"/>
	<link rel="shortcut icon" href="assets/favicon.png" type="image/x-icon" />
	<!-- ================== BEGIN BASE CSS STYLE ================== -->
	<link href="assets/panel/plugins/jquery-ui/themes/base/minified/jquery-ui.min.css" rel="stylesheet" />
	<link href="assets/panel/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
	<link href="assets/panel/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
	<link href="assets/panel/plugins/ionicons/css/ionicons.min.css" rel="stylesheet" />
	<link href="assets/panel/css/animate.min.css" rel="stylesheet" />
	<link href="assets/panel/css/style.min.css" rel="stylesheet" />
	<link href="assets/panel/css/style-responsive.min.css" rel="stylesheet" />
	<link href="assets/panel/css/theme/default.css" rel="stylesheet" id="theme" />
	<link href="assets/panel/css/style-gue.css" rel="stylesheet">
	<link href="assets/panel/css/custom.css" rel="stylesheet">
	<!-- ================== END BASE CSS STYLE ================== -->

	<!-- ================== BEGIN PAGE LEVEL CSS STYLE ================== -->
    <link href="assets/panel/plugins/jquery-jvectormap/jquery-jvectormap.css" rel="stylesheet" />
    <link href="assets/panel/plugins/bootstrap-calendar/css/bootstrap_calendar.css" rel="stylesheet" />
    <link href="assets/panel/plugins/gritter/css/jquery.gritter.css" rel="stylesheet" />
    <link href="assets/panel/plugins/morris/morris.css" rel="stylesheet" />
	<!-- ================== END PAGE LEVEL CSS STYLE ================== -->

	<!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
	<link href="assets/panel/plugins/DataTables/media/css/dataTables.bootstrap.min.css" rel="stylesheet" />
	<link href="assets/panel/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css" rel="stylesheet" />
	<link href="assets/panel/plugins/parsley/src/parsley.css" rel="stylesheet" />
	<!-- ================== END PAGE LEVEL STYLE ================== -->

	<!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
	<link href="assets/panel/plugins/bootstrap-datepicker/css/bootstrap-datepicker.css" rel="stylesheet" />
	<link href="assets/panel/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.css" rel="stylesheet" />
	<link href="assets/panel/plugins/ionRangeSlider/css/ion.rangeSlider.css" rel="stylesheet" />
	<link href="assets/panel/plugins/ionRangeSlider/css/ion.rangeSlider.skinNice.css" rel="stylesheet" />
	<link href="assets/panel/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css" rel="stylesheet" />
	<link href="assets/panel/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" />
	<link href="assets/panel/plugins/password-indicator/css/password-indicator.css" rel="stylesheet" />
	<link href="assets/panel/plugins/bootstrap-combobox/css/bootstrap-combobox.css" rel="stylesheet" />
	<link href="assets/panel/plugins/bootstrap-select/bootstrap-select.min.css" rel="stylesheet" />
	<link href="assets/panel/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css" rel="stylesheet" />
	<link href="assets/panel/plugins/jquery-tag-it/css/jquery.tagit.css" rel="stylesheet" />
    <link href="assets/panel/plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet" />
    <link href="assets/panel/plugins/select2/dist/css/select2.min.css" rel="stylesheet" />
    <link href="assets/panel/plugins/bootstrap-eonasdan-datetimepicker/build/css/bootstrap-datetimepicker.min.css" rel="stylesheet" />
    <link href="assets/panel/plugins/bootstrap-colorpalette/css/bootstrap-colorpalette.css" rel="stylesheet" />
    <link href="assets/panel/plugins/jquery-simplecolorpicker/jquery.simplecolorpicker.css" rel="stylesheet" />
    <link href="assets/panel/plugins/jquery-simplecolorpicker/jquery.simplecolorpicker-fontawesome.css" rel="stylesheet" />
    <link href="assets/panel/plugins/jquery-simplecolorpicker/jquery.simplecolorpicker-glyphicons.css" rel="stylesheet" />
	<!-- ================== END PAGE LEVEL STYLE ================== -->

	<!-- ================== BEGIN BASE JS ================== -->
	<script src="assets/panel/plugins/pace/pace.min.js"></script>
	<!-- ================== END BASE JS ================== -->
	<link rel="stylesheet" type="text/css" href="assets/fancybox/jquery.fancybox.css">
	<script type="text/javascript" src="assets/js/jquery.min.js"></script>
	<script type="text/javascript" src="assets/fancybox/jquery.fancybox.js"></script>
</head>
<body>

<style type="text/css"></style>
	<!-- begin #page-loader -->
	<div id="page-loader" class="fade in"><span class="spinner"></span></div>
	<!-- end #page-loader -->

	<!-- begin #page-container -->
	<div id="page-container" class="fade page-sidebar-fixed page-header-fixed in"> <!--page-sidebar-minified-->
		<!-- begin #header -->
		<div id="header" class="header navbar navbar-default navbar-fixed-top">
			<!-- begin container-fluid -->
			<div class="container-fluid">
				<!-- begin mobile sidebar expand / collapse button -->
				<div class="navbar-header">
					<!-- <a href="" class="navbar-brand"><span class="navbar-logo"><i class="fa fa-vcard"></i></span> &nbsp;<b>Panel</b> <?php //echo ucwords($level); ?></a> -->
					<button type="button" class="navbar-toggle" data-click="sidebar-toggled">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
				</div>
				<!-- end mobile sidebar expand / collapse button -->

				<!-- begin header navigation right -->
				<ul class="nav navbar-nav navbar-right">
					<li class="dropdown">
						<a href="javascript:;" data-toggle="dropdown" class="dropdown-toggle icon" aria-expanded="false">
							<i class="ion-ios-bell"></i>
							<span class="label" id="jml_notif_bell"><span class="badge badge-danger pull-right">0</span>
						</a>
						<ul class="dropdown-menu media-list pull-right animated fadeInDown" id="notif_bell"></ul>
					</li>
					<li class="dropdown navbar-user">
						<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
							<span class="user-image online">
								<img src="<?php echo $foto;?>" alt="" />
							</span>
							<b class="caret"></b>
						</a>
						<ul class="dropdown-menu animated fadeInLeft">
							<li class="arrow"></li>
							<li <?php if($menu=='profile'){echo " class='active'";}?>><a href="profile.html">Profile</a></li>
							<li class="divider"></li>
							<li><a href="web/logout.html">Logout</a></li>
						</ul>
					</li>
				</ul>
				<!-- end header navigation right -->
			</div>
			<!-- end container-fluid -->
		</div>
		<!-- end #header -->

		<!-- begin #sidebar -->
		
		<div id="sidebar" class="sidebar">
			<!-- begin sidebar scrollbar -->
			<div data-scrollbar="true" data-height="100%">
				<!-- begin sidebar user -->
				<ul class="nav">
					<li class="nav-profile">
						<div class="image col-md-4">
							<a href="profile"><img src="<?php echo $foto;?>" alt="" /></a>
						</div>
						<div class="info col-md-8">
							<?php echo ucwords($nama); ?>
							<small><?php echo ucwords($dipa_name); ?></small>
						</div>
					</li>
				</ul>
				<!-- end sidebar user -->

				<!-- begin sidebar nav -->
				<ul class="nav">
					<li class="nav-header"><big ">Menu Navigasi</big></li>
					<li class="has-sub<?php if($menu=='users' AND $sub_menu=='' or $menu=='dashboard'){echo " active";} ?>">
						<a href="dashboard.html">
						    <i class="fa fa-th-large"></i>
						    <span>Dashboard</span>
					   </a>
					</li>
					<li class="has-sub <?php if($menu=='perencanaan' OR ($menu=='dipa' AND $sub_menu=='v') OR ($menu=='folder_data_dukung' AND $sub_menu=='v') OR ($menu=='data_dukung' AND $sub_menu=='v') OR ($menu=='rpd' AND $sub_menu=='v') OR ($menu=='ankabut' AND $sub_menu=='v')){echo " active";} ?>">
						<a href="javascript:;">
							<b class="caret pull-right"></b>
							<i class="fa fa-calculator bg-gray"></i>
							<span>Perencanaan</span>
						</a>
						<ul class="sub-menu">
							<li <?php if($menu=='dipa'){echo " class='active'";} ?>>
								<a href="dipa/v.html">
									<i class="fa fa-file-text"></i> <span>DIPA</span>
								</a>
							</li>
							<li class="has-sub <?php if($menu=='data_dukung' or $menu=='folder_data_dukung' or $menu=='ankabut'){echo " active";} ?>">
								<a href="javascript:;">
									<b class="caret pull-right"></b>
									<i class="fa fa-calculator bg-gray"></i>
									<span>Penyusunan Anggaran</span>
								</a>
								<ul class="sub-menu">
									<li <?php if($menu=='ankabut'){echo " class='active'";} ?>>
										<a href="ankabut">
											<i class="fa fa-file"></i> <span>Analisa Kebutuhan Anggaran</span>
										</a>
									</li>
									<li <?php if($menu=='data_dukung' or $menu=='folder_data_dukung'){echo " class='active'";} ?>>
										<a href="folder_data_dukung">
											<i class="fa fa-folder-open"></i> <span>Data Dukung</span>
										</a>
									</li>
								</ul>
							</li>
							<li <?php if($menu=='rpd' AND $sub_menu=='v'){echo " class='active'";} ?>>
								<a href="rpd">
									<i class="fa fa-calendar-check-o"></i> <span>Rencana Penarikan Dana</span>
								</a>
							</li>
						</ul>
					</li>
					<li class="has-sub<?php if($menu=='revisi_dipa' AND $sub_menu=='' or $menu=='revisi_dipa'){echo " active";} ?>">
						<a href="revisi_dipa">
							<i class="fa fa-pencil-square"></i> <span>Usulan Revisi DIPA</span>
						</a>
					</li>
					<li class="has-sub<?php if($menu=='pelaksanaan_anggaran' AND $sub_menu=='' or $menu=='pelaksanaan_anggaran'){echo " active";} ?>">
						<a href="pelaksanaan_anggaran">
						    <i class="fa fa-line-chart"></i>
						    <span>Pelaksanaan Anggaran</span>
					   </a>
					</li>
					<li class="has-sub <?php if($menu=='monev'){echo " active";} ?>">
						<a href="javascript:;">
							<b class="caret pull-right"></b>
							<i class="fa fa-newspaper-o bg-gray"></i>
							<span>Monitoring dan Evaluasi</span>
						</a>
						<ul class="sub-menu">
							<li class="has-sub <?php if($sub_menu3=='t1' OR $sub_menu3=='t2' OR $sub_menu3=='t3'OR $sub_menu3=='t4'){echo " active";} ?>">
								<a href="javascript:;">
									<b class="caret pull-right"></b>
									<i class="fa fa-calendar-check-o bg-gray"></i>
									<span>Rutin</span>
								</a>
								<ul class="sub-menu">
									<li <?php if($sub_menu3=='t1'){echo " class='active'";} ?>>
										<a href="monev/v/t1">
											<i class="fa fa-commenting"></i> <span>Triwulan I</span>
										</a>
									</li>
									<li <?php if($sub_menu3=='t2'){echo " class='active'";} ?>>
										<a href="monev/v/t2">
											<i class="fa fa-commenting"></i> <span>Triwulan II</span>
										</a>
									</li>
									<li <?php if($sub_menu3=='t3'){echo " class='active'";} ?>>
										<a href="monev/v/t3">
											<i class="fa fa-commenting"></i> <span>Triwulan III</span>
										</a>
									</li>
									<li <?php if($sub_menu3=='t4'){echo " class='active'";} ?>>
										<a href="monev/v/t4">
											<i class="fa fa-commenting"></i> <span>Triwulan IV</span>
										</a>
									</li>
								</ul>
							</li>
							<li <?php if($sub_menu3=='i'){echo " class='active'";} ?>>
								<a href="monev/v/i">
									<i class="fa fa-calendar"></i> <span>Insidental</span>
								</a>
							</li>
						</ul>
					</li>
					<li class="has-sub">
						<a href="javascript:;">
							<b class="caret pull-right"></b>
							<i class="fa fa-folder-open bg-gray"></i>
							<span>Pelaporan</span>
						</a>
						<ul class="sub-menu">
							<li class="has-sub">
								<a href="https://sites.google.com/view/pelungguh/home/laporan-keuangan-kinerja" target="_blank">
									<i class="fa fa-folder"></i>
									<span>Laporan Keuangan dan BMN</span>
							   </a>
							</li>
							<li class="has-sub">
								<a href="https://sites.google.com/view/pelungguh/home/laporan-keuangan-kinerja" target="_blank">
									<i class="fa fa-folder"></i>
									<span>Laporan Kinerja</span>
							   </a>
							</li>
						</ul>
					</li>

					<li class="nav-header"></li>
					<li>
						<a href="web/logout.html">
							<div class="icon-img">
						    <i class="fa fa-sign-out bg-red"></i>
						    </div>
						    <span>Logout</span>
						</a>
					</li>
					    <!-- begin sidebar minify button -->
					<li><a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify"><i class="ion-ios-arrow-left"></i> <span></span></a></li>
			        <!-- end sidebar minify button -->
				</ul>
				<!-- end sidebar nav -->
			</div>
			<!-- end sidebar scrollbar -->
		</div>
		<div class="sidebar-bg"></div>
		<!-- end #sidebar -->
