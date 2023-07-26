<?php
$level  = $this->session->userdata('level');
$id_dipa = $this->session->userdata('id_dipa');
?>
<!-- begin #content -->
<div id="content" class="content dashboard">
	<!-- begin breadcrumb -->
	<ol class="breadcrumb pull-right">
	  <li class="active">Dashboard</li>
	</ol>
	<!-- end breadcrumb -->
	<!-- begin page-header -->
	<!-- Dashboard Satker -->
	
		<h1 class="page-header">Dashboard <?php echo ucwords($nama_dipa);?></h1>
		<div class="row">
			<div class="col-md-12">
				<div class="realisasi-card card">
					<div class= card-body">
						<h6 class="text-white mt-0">PENYERAPAN ANGGARAN</h6>
						<div class="penyerapan-chart row">
							<div class="col-md-6">
								<canvas id="chart_penyerapan"></canvas>
							</div>
							<div class="col-md-4">
								<div class="dashboard-progress">
									<div class="progress-title">TOTAL PAGU</div>
									<div class="text-white progress-angka"><?php echo $this->Mcrud->rupiah($total_pagu); ?></div>
									<div class="progress">
										<div class="progress-bar progress-bar-striped" role="progressbar" style="width: 100%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
									</div>
								</div>
								<div class="dashboard-progress">
									<div class="progress-title">REALISASI ANGGARAN</div>
									<div class="text-white progress-angka"><?php echo $this->Mcrud->rupiah($total_realisasi); ?> (<?php echo number_format($this->Mcrud->persen($total_realisasi, $total_pagu),2,",",""); ?>%)</div>
									<div class="progress">
										<div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="<?php echo $persen_realisasi ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $persen_realisasi ?>%">
											<span class="sr-only"></span>
										</div>
										</div>
								</div>
								<div class="dashboard-progress">
									<div class="progress-title">SISA ANGGARAN</div>
									<div class="text-white progress-angka"><?php echo $this->Mcrud->rupiah($sisa_anggaran); ?> (<?php echo number_format($this->Mcrud->persen($sisa_anggaran, $total_pagu),2,",",""); ?>%)</div>
									<div class="progress">
										<div class="progress-bar progress-bar-danger progress-bar-striped" role="progressbar" style="width: <?php echo $persen_sisa ?>%;" aria-valuenow="<?php echo $persen_sisa ?>" aria-valuemin="0" aria-valuemax="100"></div>
									</div>

								</div>
								</div>
							<div class="col-md-2">
							</div>
						</div>
						<hr>
						<div class="row">
							<div class="col-md-4">
								<div class="dashboard-progress">
									<div class="progress-title">TOTAL BELANJA PEGAWAI</div>
									<div class="text-white progress-angka"><?php echo $this->Mcrud->rupiah($realisasi_bp); ?> (<?php echo number_format($this->Mcrud->persen($realisasi_bp, $pagu_jenis_belanja['pegawai']),2,",",""); ?>%)</div>
									<div class="progress">
										<div class="progress-bar progress-bar-bp progress-bar-striped" role="progressbar" style="width: 100%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
									</div>
								</div>
							</div>
							<div class="col-md-4">
								<div class="dashboard-progress">
									<div class="progress-title">TOTAL BELANJA BARANG</div>
									<div class="text-white progress-angka"><?php echo $this->Mcrud->rupiah($realisasi_bb); ?> (<?php echo number_format($this->Mcrud->persen($realisasi_bb, $pagu_jenis_belanja['barang']),2,",",""); ?>%)</div>
									<div class="progress">
										<div class="progress-bar progress-bar-bb progress-bar-striped" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
											<span class="sr-only"></span>
										</div>
										</div>
								</div>
							</div>
							<div class="col-md-4">
								<div class="dashboard-progress">
									<div class="progress-title">TOTAL BELANJA MODAL</div>
									<div class="text-white progress-angka"><?php echo $this->Mcrud->rupiah($realisasi_bm); ?> (<?php echo number_format($this->Mcrud->persen($realisasi_bm, $pagu_jenis_belanja['modal']),2,",",""); ?>%)</div>
									<div class="progress">
										<div class="progress-bar progress-bar-bm progress-bar-striped" role="progressbar" style="width: 100%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
									</div>

								</div>
							</div>						
						</div>
					</div>
				</div>
			</div>		
		</div>
		<!-- Chart deviasi RPD dan realisasi anggaran  -->
		<div class="row">
			<div class="col-md-12">
				<div class="realisasi-card card">
					<div class="card-body">
						<ul class="nav nav-pills text-center chart-deviasi-btn">
							<li class="active"><a data-toggle="pill" href="#pegawai" class="btn btn-info">Belanja Pegawai</a></li>
							<li><a data-toggle="pill" href="#barang" class="btn btn-info">Belanja Barang</a></li>
							<li><a data-toggle="pill" href="#modal" class="btn btn-info">Belanja Modal</a></li>
						</ul>

						<hr>
						
						<div class="tab-content">
							<div id="pegawai" class="tab-pane fade in active">
								<h4 class="m-t-0 text-center text-white">Deviasi Belanja Pegawai</h4>
								<canvas id="line_chart_rpd_pegawai" ></canvas>
							</div>
							<div id="barang" class="tab-pane fade">
								<h4 class="m-t-0 text-center text-white">Deviasi Belanja Barang</h4>
								<canvas id="line_chart_rpd_barang" ></canvas>
							</div>
							<div id="modal" class="tab-pane fade">
								<h4 class="m-t-0 text-center text-white">Deviasi Belanja Modal</h4>
								<canvas id="line_chart_rpd_modal" ></canvas>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
<!-- end #content -->

<!-- <script src="assets/panel/plugins/chart-js/Chart.min.js"></script> -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.7.3/dist/Chart.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@0.7.0"></script>
<script>
const total_realisasi = <?php echo $total_realisasi; ?>;
const sisa_anggaran = <?php echo $sisa_anggaran; ?>;

const ctx = document.getElementById('chart_penyerapan').getContext('2d');

var options = {
           tooltips: {
         enabled: true
    },
             plugins: {
            datalabels: {
                formatter: (value, ctx) => {
                
                //   let sum = 0;
                //   let dataArr = ctx.chart.data.datasets[0].data;
                // //   dataArr.map(data => {
                // //       sum += data;
                // //   });
				  let sum = total_realisasi + sisa_anggaran;
                  let percentage = (value*100 / sum).toFixed(2)+"%";
				  if(value/sum * 100 <= 0){ percentage = "";}
                  return percentage;

              
                },
                color: '#fff',
                     }
        }
    };

const chart_penyerapan = new Chart(ctx, {
    type: 'pie',
    data: {
        labels: ['Penyerapan Anggaran', 'Sisa Anggaran'],
        datasets: [{
            // label: '# of Votes',
            data: [total_realisasi, sisa_anggaran < 0 ? 0 : sisa_anggaran],
            backgroundColor: [
                'rgba(0, 172, 172, 1)',
                'rgba(234, 66, 114, 1)'
            ],
            borderColor: [
                'rgba(45, 53, 60, 1)',
				'rgba(45, 53, 60, 1)'
            ],
            borderWidth: 5
        }]
    },
	options: options
});



</script>

<script>
let data_realisasi_pegawai = <?php echo json_encode($realisasi_rpd['pegawai']);  ?>;
let data_rpd_pegawai = <?php echo json_encode($grafik_rpd['pegawai']);  ?>;
let data_deviasi_pegawai = [];
let persen_deviasi_pegawai = [];
data_realisasi_pegawai.forEach((val, key)=>{
	data_deviasi_pegawai[key] = data_realisasi_pegawai[key] - data_rpd_pegawai[key];
	// data_deviasi_pegawai[key]["persen"] = data_deviasi_pegawai[key] / data_rpd_pegawai[key] * 100;
	persen_deviasi_pegawai[key] = (data_realisasi_pegawai[key] - data_rpd_pegawai[key]) / data_rpd_pegawai[key] * 100;
});

const data_chart_pegawai = {
  labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
  datasets: [
    {
      label: 'Data Realisasi Belanja Pegawai',
      fill: false,
      backgroundColor: 'cyan',
      borderColor: 'cyan',
      data: data_realisasi_pegawai
    }, {
      label: 'Data RPD Belanja Pegawai',
      fill: false,
      backgroundColor: 'cyan',
      borderColor: 'cyan',
      borderDash: [5, 7],
      data: data_rpd_pegawai
    }
    , {
      label: 'Deviasi Belanja Pegawai',
      fill: false,
      backgroundColor: 'lime',
      borderColor: 'lime',
      data: data_deviasi_pegawai,
	  datalabels:{
		  display: true
	  }
    }
  ]
};

var ctxrpd = document.getElementById('line_chart_rpd_pegawai').getContext('2d');
var line_chart_penyerapan_pegawai = new Chart(ctxrpd, {
	type: 'line',
	data: data_chart_pegawai,
	options: {
		legend: {
            display: true,
            labels: {
                fontColor: 'white'
            }
        },
		layout: {
            padding: {
                left: 0,
                right: 50,
                top: 10,
                bottom: 10
            }
        },
			
		responsive: true,
		plugins: {
			title: {
				display: false,
				text: 'Chart.js Line Chart'
			},
		},
		scales: {
			yAxes: [{
				display: true,
				ticks: {
					fontColor: 'white',
					padding: 40
				}
			}],
			xAxes: [{
                  ticks: {
                      autoSkip: false,
					  fontColor: 'white'
                  }
              }
			  ]
		}
		,plugins: {
			datalabels: {
				anchor: 'end',
				align: 'bottom',
				formatter: (value, ctx) => {
					// return 'Rp ' +  (value).toLocaleString().replace(/,/g,".");//toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
					// return '' +  value;
					return persen_deviasi_pegawai[ctx.dataIndex].toFixed(2) + " %";
				},
				color: 'white',
				display: false
			}
		}
	}
  });

let data_realisasi_barang = <?php echo json_encode($realisasi_rpd['barang']);  ?>;
let data_rpd_barang = <?php echo json_encode($grafik_rpd['barang']);  ?>;
let data_deviasi_barang = [];
let persen_deviasi_barang = [];
data_realisasi_barang.forEach((val, key)=>{
	data_deviasi_barang[key] = data_realisasi_barang[key] - data_rpd_barang[key];
	// data_deviasi_barang[key]["persen"] = (data_realisasi_barang[key] - data_rpd_barang[key]) / data_rpd_barang[key] * 100;
	// data_deviasi_barang[key]['haha'] = 88;
	// data_deviasi_barang[key].hehe = 77;
	persen_deviasi_barang[key] = (data_realisasi_barang[key] - data_rpd_barang[key]) / data_rpd_barang[key] * 100;
});

const data_chart_barang = {
  labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
  datasets: [
    {
      label: 'Data Realisasi Belanja Barang',
      fill: false,
      backgroundColor: 'cyan',
      borderColor: 'cyan',
      data: data_realisasi_barang
    }, {
      label: 'Data RPD Belanja Barang',
      fill: false,
      backgroundColor: 'cyan',
      borderColor: 'cyan',
      borderDash: [5, 7],
      data: data_rpd_barang
    }
    , {
      label: 'Deviasi Belanja Barang',
      fill: false,
      backgroundColor: 'lime',
      borderColor: 'lime',
      data: data_deviasi_barang,
	  datalabels:{
		  display: true
	  }
    }
  ]
};

var ctxrpd = document.getElementById('line_chart_rpd_barang').getContext('2d');
var line_chart_penyerapan_barang = new Chart(ctxrpd, {
	type: 'line',
	data: data_chart_barang,
	options: {
		legend: {
            display: true,
            labels: {
                fontColor: 'white'
            }
        },
		layout: {
            padding: {
                left: 0,
                right: 50,
                top: 10,
                bottom: 10
            }
        },
			
		responsive: true,
		plugins: {
			title: {
				display: false,
				text: 'Chart.js Line Chart'
			},
		},
		scales: {
			yAxes: [{
				display: true,
				ticks: {
					fontColor: 'white',
					padding: 40
				}
			}],
			xAxes: [{
                  ticks: {
                      autoSkip: false,
					  fontColor: 'white'
                  }
              }
			  ]
		}
		,plugins: {
			datalabels: {
				anchor: 'end',
				align: 'bottom',
				formatter: (value, ctx) => {
					return persen_deviasi_barang[ctx.dataIndex].toFixed(2) + " %";
				},
				color: 'white',
				display: false
			}
		}
	}
  });

let data_realisasi_modal = <?php echo json_encode($realisasi_rpd['modal']);  ?>;
let data_rpd_modal = <?php echo json_encode($grafik_rpd['modal']);  ?>;
let data_deviasi_modal = [];
let persen_deviasi_modal = [];
data_realisasi_modal.forEach((val, key)=>{
	data_deviasi_modal[key] = data_realisasi_modal[key] - data_rpd_modal[key];
	persen_deviasi_modal[key] = (data_realisasi_modal[key] - data_rpd_modal[key]) / data_rpd_modal[key] * 100;
});

const data_chart_modal = {
  labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
  datasets: [
    {
      label: 'Data Realisasi Belanja Modal',
      fill: false,
      backgroundColor: 'cyan',
      borderColor: 'cyan',
      data: data_realisasi_modal
    }, {
      label: 'Data RPD Belanja Modal',
      fill: false,
      backgroundColor: 'cyan',
      borderColor: 'cyan',
      borderDash: [5, 7],
      data: data_rpd_modal
    }
    , {
      label: 'Deviasi Belanja Modal',
      fill: false,
      backgroundColor: 'lime',
      borderColor: 'lime',
      data: data_deviasi_modal,
	  datalabels:{
		  display: true
	  }
    }
  ]
};

var ctxrpd = document.getElementById('line_chart_rpd_modal').getContext('2d');
var line_chart_penyerapan_modal = new Chart(ctxrpd, {
	type: 'line',
	data: data_chart_modal,
	options: {
		legend: {
            display: true,
            labels: {
                fontColor: 'white'
            }
        },
		layout: {
            padding: {
                left: 0,
                right: 50,
                top: 10,
                bottom: 10
            }
        },
			
		responsive: true,
		plugins: {
			title: {
				display: false,
				text: 'Chart.js Line Chart'
			},
		},
		scales: {
			yAxes: [{
				display: true,
				ticks: {
					fontColor: 'white',
					padding: 40
				}
			}],
			xAxes: [{
                  ticks: {
                      autoSkip: false,
					  fontColor: 'white'
                  }
              }
			  ]
		}
		,plugins: {
			datalabels: {
				anchor: 'end',
				align: 'bottom',
				formatter: (value, ctx) => {
					// return 'Rp ' +  (value).toLocaleString().replace(/,/g,".");//toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
					return persen_deviasi_modal[ctx.dataIndex].toFixed(2) + " %";
				},
				color: 'white',
				display: false
			}
		}
	}
  });

</script>