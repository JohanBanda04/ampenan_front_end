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
	<!-- Dashboard Superadmin dan Koordinator Wilayah -->
	<h1 class="page-header">Dashboard</h1>
	<div class="row">
		<div class="col-md-12">
			<div class="realisasi-card card">
				<div class="card-body">
					<canvas id="bar_chart_realisasi_satker" height="220"></canvas>
				</div>
			</div>
		</div>
	</div>
	

	<div class="c-content-accordion-1 c-theme dashboard-all">
		<div class="panel-group" id="accordion" role="tablist">
		 <?php
			$isFirst = true;
			foreach ($dipa_list as $key): 
			if($key['id'] == '00') continue;
		?>
		<div class="panel">
			<div class="panel-heading dipa-accordion-btn" role="tab" id="heading<?php echo $key['id']; ?>">
				<h4 class="panel-title">
					<a class="c-font-bold c-font-19"  data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $key['id']; ?>" aria-expanded="true" aria-controls="collapse<?php echo $key['id']; ?>"><?php echo strtoupper($key['nama']); ?></a>
				</h4>
			</div>
		<div id="collapse<?php echo $key['id']; ?>" class="panel-collapse collapse <?php if ($isFirst) {echo "in";} ?>" role="tabpanel" aria-labelledby="heading<?php echo $key['id']; ?>">
			<div class="panel-body c-font-18">
				<div class="row">
					<div class="col-md-12">
						<div class="realisasi-card card">
							<div class= card-body">
							<!-- <h6 class="text-white mt-0">PENYERAPAN ANGGARAN <?php echo strtoupper($key['nama']); ?></h6> -->
							<div class="penyerapan-chart row">
								<div class="col-md-5">
									<canvas id="chart_penyerapan<?php echo $key['id']; ?>"></canvas>
								</div>
								<div class="col-md-3">
									<div class="dashboard-progress">
										<div class="progress-title">TOTAL PAGU</div>
										<div class="text-white progress-angka"><?php 
											echo $this->Mcrud->rupiah($pagu_satker[$key['id']]); 
										?></div>
										<div class="progress">
											<div class="progress-bar progress-bar-striped" role="progressbar" style="width: 100%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
										</div>
									</div>
									<div class="dashboard-progress">
										<div class="progress-title">REALISASI ANGGARAN</div>
										<div class="text-white progress-angka"><?php 
											echo $this->Mcrud->rupiah($realisasi_satker_total[$key['id']]);
										?> (<?php echo number_format($this->Mcrud->persen($realisasi_satker_total[$key['id']], $pagu_satker[$key['id']]),2,",",""); ?>%)</div>
										<div class="progress">
											<div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="<?php echo $realisasi_satker_persen[$key['id']] ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $realisasi_satker_persen[$key['id']] ?>%">
												<span class="sr-only"></span>
											</div>
										</div>
									</div>
									<div class="dashboard-progress">
										<div class="progress-title">SISA ANGGARAN</div>
										<div class="text-white progress-angka"><?php echo $this->Mcrud->rupiah($sisa_satker[$key['id']]); ?> (<?php echo number_format($this->Mcrud->persen($sisa_satker[$key['id']], $pagu_satker[$key['id']]),2,",",""); ?>%)</div>
										<div class="progress">
											<div class="progress-bar progress-bar-danger progress-bar-striped" role="progressbar" style="width: <?php echo $sisa_satker_persen[$key['id']]; ?>%;" aria-valuenow="<?php echo $sisa_satker_persen[$key['id']]; ?>" aria-valuemin="0" aria-valuemax="100"></div>
										</div>
									</div>
								</div>
								<div class="col-md-3">
									<!-- <div class="col-md-4"> -->
										<div class="dashboard-progress">
											<div class="progress-title">TOTAL BELANJA PEGAWAI</div>
											<div class="text-white progress-angka"><?php 
											if ($realisasi_satker_bp[$key['id']] != null) {
												echo $this->Mcrud->rupiah($realisasi_satker_bp[$key['id']]) . " (" . number_format($this->Mcrud->persen($realisasi_satker_bp[$key['id']], $pagu_jenis_belanja[$key['id']]['pegawai']),2,",","") . "%)";
											} else {
												echo 'Rp 0';
											}
										 ?></div>
											<div class="progress">
												<div class="progress-bar progress-bar-bp progress-bar-striped" role="progressbar" style="width: 100%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
											</div>
										</div>
									<!-- </div>
									<div class="col-md-4"> -->
										<div class="dashboard-progress">
											<div class="progress-title">TOTAL BELANJA BARANG</div>
											<div class="text-white progress-angka"><?php 
											if ($realisasi_satker_bb[$key['id']] != null) {
												echo $this->Mcrud->rupiah($realisasi_satker_bb[$key['id']]) . " (" . number_format($this->Mcrud->persen($realisasi_satker_bb[$key['id']], $pagu_jenis_belanja[$key['id']]['barang']),2,",","") . "%)";
											} else {
												echo 'Rp 0';
											}
										 ?></div>
										<div class="progress">
											<div class="progress-bar progress-bar-bb progress-bar-striped" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
												<span class="sr-only"></span>
											</div>
											</div>
										</div>
									<!-- </div> -->
									<!-- <div class="col-md-4"> -->
										<div class="dashboard-progress">
											<div class="progress-title">TOTAL BELANJA MODAL</div>
											<div class="text-white progress-angka"><?php 
												if ($realisasi_satker_bm[$key['id']] != null) {
													echo $this->Mcrud->rupiah($realisasi_satker_bm[$key['id']]) . " (" . number_format($this->Mcrud->persen($realisasi_satker_bm[$key['id']], $pagu_jenis_belanja[$key['id']]['modal']),2,",","") . "%)"; 
												} else {
													echo 'Rp 0';
												}
											?></div>
											<div class="progress">
												<div class="progress-bar progress-bar-bm progress-bar-striped" role="progressbar" style="width: 100%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
											</div>
										</div>
									<!-- </div> -->
								</div>
								<div class="col-md-1"></div>
							</div>
							<!-- <hr>
							<div class="row">
							</div> -->
							<hr>
							<div class="row">
								<div class="col-md-12">
									<ul class="nav nav-pills text-center chart-deviasi-btn">
										<li class="active"><a data-toggle="pill" href="#pegawai<?php echo $key['id']; ?>" class="btn btn-info">Belanja Pegawai</a></li>
										<li><a data-toggle="pill" href="#barang<?php echo $key['id']; ?>" class="btn btn-info">Belanja Barang</a></li>
										<li><a data-toggle="pill" href="#modal<?php echo $key['id']; ?>" class="btn btn-info">Belanja Modal</a></li>
									</ul>
			
									<!-- <hr> -->
									
									<div class="tab-content">
										<div id="pegawai<?php echo $key['id']; ?>" class="tab-pane fade in active">
											<h4 class="m-t-0 text-center text-white">Deviasi Belanja Pegawai</h4>
											<canvas id="line_chart_rpd_pegawai<?php echo $key['id']; ?>" ></canvas>
										</div>
										<div id="barang<?php echo $key['id']; ?>" class="tab-pane fade">
											<h4 class="m-t-0 text-center text-white">Deviasi Belanja Barang</h4>
											<canvas id="line_chart_rpd_barang<?php echo $key['id']; ?>" ></canvas>
										</div>
										<div id="modal<?php echo $key['id']; ?>" class="tab-pane fade">
											<h4 class="m-t-0 text-center text-white">Deviasi Belanja Modal</h4>
											<canvas id="line_chart_rpd_modal<?php echo $key['id']; ?>" ></canvas>
										</div>
									</div>
								</div>
							</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php $isFirst = false;
		endforeach; ?>
	</div>
	</div>
</div>
<!-- end #content -->

<!-- <script src="assets/panel/plugins/chart-js/Chart.min.js"></script> -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.7.3/dist/Chart.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@0.7.0"></script>
<!-- <script src="https://github.com/chartjs/Chart.js/blob/master/docs/scripts/utils.js"></script> -->
<script>
var dipa_id = <?php echo json_encode($dipa_id);  ?>;
const realisasi_satker_total = <?php echo json_encode($realisasi_satker_total); ?>;
const sisa_satker = <?php echo json_encode($sisa_satker_pie_chart); ?>;
const sisa_satker_aktual = <?php echo json_encode($sisa_satker); ?>;

dipa_id.forEach(myFunction);

function myFunction(value, key) {
var kode_satker = value;
var options = {
           tooltips: {
         enabled: true
    },
             plugins: {
            datalabels: {
                formatter: (value, ctx) => {
                
                  let sum = 0;
                  let dataArr = ctx.chart.data.datasets[0].data;
                  dataArr.map(data => {
                      sum += data;
                  });
				  sum = realisasi_satker_total[kode_satker] + sisa_satker_aktual[kode_satker];
				  
                  let percentage = (value*100 / sum).toFixed(2)+"%";
				  if( (value*100 / sum) <= 0){ percentage = "";}
                  return percentage;
				// return "haha"+key;
				//   return value;
              
                },
                color: '#fff',
                     }
        }
    };
	
  var ctx = document.getElementById('chart_penyerapan' + value).getContext('2d');
  var chart_penyerapan = new Chart(ctx, {
	  type: 'pie',
	  data: {
		  labels: ['Penyerapan Anggaran', 'Sisa Anggaran'],
		  datasets: [{
			  data: [realisasi_satker_total[value], sisa_satker[value]],
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
}
</script>

<script>
var dipa_list = <?php echo json_encode($dipa_list);  ?>;
var nama_dipa = [];
var persen_realisasi = [];

dipa_list.forEach(fungsi);
function fungsi(val, key){
	if(key > 0){
		nama_dipa[key-1] = val.nama;
		let realisasi = realisasi_satker_total[val.id];
		let sisa = sisa_satker_aktual[val.id];

		persen_realisasi[key-1] = (Math.round(((realisasi / (realisasi + sisa)) * 100) * 100) / 100).toFixed(2)
	}
	
}
const labels = nama_dipa;
const ctx = document.getElementById('bar_chart_realisasi_satker');
const myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: nama_dipa,
        datasets: [{
            label: 'Penyerapan Anggaran (%)',
            data: persen_realisasi,//[100,2,4,5,6,7,8,9,10,11,12,13,14,5.5,16,17,18,19,20,21,22,23,24,25], //[100.0,75.6,87.8,100.0,91.6,84.9,74.4,86.2,71.7,86.8,83.0,78.5,75.9,85.5,91.6,89.5,94.9,84.0,64.7,90.3,67.9,90.2,80.8,88.4,92.3]
            backgroundColor: 'rgba(54, 162, 235, 0.2)',
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 1
        }]
    },
    options: {
		legend: {
             labels: {
                  fontColor: 'white'
                 }
              },
        scales: {
			yAxes: [{
				display: true,
				ticks: {
					// max: 100,
					fontColor: 'white'
				}
			}],
			xAxes: [{
                  ticks: {
                      autoSkip: false,
                      maxRotation: 90,
                      minRotation: 90,
					  padding: 20,
					  fontColor: 'white'
                  }
              }]
        }
		,plugins: {
            datalabels: {
				anchor: 'end',
        		align: 'top',
                formatter: (value, ctx) => {
                return value;              
                },
                color: 'cyan',
                     }
        }
    }
});

</script>

<script>
let data_realisasi_pegawai = <?php echo json_encode($realisasi_rpd['pegawai']);  ?>;
let data_rpd_pegawai = <?php echo json_encode($grafik_rpd['pegawai']);  ?>;
let data_deviasi_pegawai = <?php echo json_encode($data_deviasi['pegawai']);  ?>;
let data_realisasi_barang = <?php echo json_encode($realisasi_rpd['barang']);  ?>;
let data_rpd_barang = <?php echo json_encode($grafik_rpd['barang']);  ?>;
let data_deviasi_barang = <?php echo json_encode($data_deviasi['barang']);  ?>;
let data_realisasi_modal = <?php echo json_encode($realisasi_rpd['modal']);  ?>;
let data_rpd_modal = <?php echo json_encode($grafik_rpd['modal']);  ?>;
let data_deviasi_modal = <?php echo json_encode($data_deviasi['modal']);  ?>;

dipa_id.forEach(myFunction);

function myFunction(value, key) {
var kode_satker = value;
const data_chart_pegawai = {
  labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
  datasets: [
    {
      label: 'Data Realisasi Belanja Pegawai',
      fill: false,
      backgroundColor: 'cyan',
      borderColor: 'cyan',
      data: data_realisasi_pegawai[value]
    }, {
      label: 'Data RPD Belanja Pegawai',
      fill: false,
      backgroundColor: 'cyan',
      borderColor: 'cyan',
      borderDash: [5, 7],
      data: data_rpd_pegawai[value]
    }
    , {
      label: 'Deviasi Belanja Pegawai',
      fill: false,
      backgroundColor: 'lime',
      borderColor: 'lime',
      data: data_deviasi_pegawai[value],
	  datalabels:{
		  display: true
	  }
    }
  ]
};

var ctxrpd = document.getElementById('line_chart_rpd_pegawai'+ value).getContext('2d');

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
				formatter: (val, ctx) => {
					// return 'Rp ' +  (val).toLocaleString().replace(/,/g,".");//toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
					return ((data_realisasi_pegawai[kode_satker][ctx.dataIndex] - data_rpd_pegawai[kode_satker][ctx.dataIndex]) / data_rpd_pegawai[kode_satker][ctx.dataIndex] * 100).toFixed(2) + " %";
				},
				color: 'white',
				display: false
			}
		}
	}
  });

const data_chart_barang = {
  labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
  datasets: [
    {
      label: 'Data Realisasi Belanja Barang',
      fill: false,
      backgroundColor: 'cyan',
      borderColor: 'cyan',
      data: data_realisasi_barang[value]
    }, {
      label: 'Data RPD Belanja Barang',
      fill: false,
      backgroundColor: 'cyan',
      borderColor: 'cyan',
      borderDash: [5, 7],
      data: data_rpd_barang[value]
    }
    , {
      label: 'Deviasi Belanja Barang',
      fill: false,
      backgroundColor: 'lime',
      borderColor: 'lime',
      data: data_deviasi_barang[value],
	  datalabels:{
		  display: true
	  }
    }
  ]
};

var ctxrpd = document.getElementById('line_chart_rpd_barang'+ value).getContext('2d');
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
				formatter: (val, ctx) => {
					// return 'Rp ' +  (val).toLocaleString().replace(/,/g,".");//toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
					return ((data_realisasi_barang[kode_satker][ctx.dataIndex] - data_rpd_barang[kode_satker][ctx.dataIndex]) / data_rpd_barang[kode_satker][ctx.dataIndex] * 100).toFixed(2) + " %";
					// return kode_satker ;
				},
				color: 'white',
				display: false
			}
		}
	}
  });

const data_chart_modal = {
  labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
  datasets: [
    {
      label: 'Data Realisasi Belanja Modal',
      fill: false,
      backgroundColor: 'cyan',
      borderColor: 'cyan',
      data: data_realisasi_modal[value]
    }, {
      label: 'Data RPD Belanja modal',
      fill: false,
      backgroundColor: 'cyan',
      borderColor: 'cyan',
      borderDash: [5, 7],
      data: data_rpd_modal[value]
    }
    , {
      label: 'Deviasi Belanja Modal',
      fill: false,
      backgroundColor: 'lime',
      borderColor: 'lime',
      data: data_deviasi_modal[value],
	  datalabels:{
		  display: true
	  }
    }
  ]
};

var ctxrpd = document.getElementById('line_chart_rpd_modal'+ value).getContext('2d');
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
				formatter: (val, ctx) => {
					// return 'Rp ' +  (val).toLocaleString().replace(/,/g,".");//toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
					return ((data_realisasi_modal[kode_satker][ctx.dataIndex] - data_rpd_modal[kode_satker][ctx.dataIndex]) / data_rpd_modal[kode_satker][ctx.dataIndex] * 100).toFixed(2) + " %";

				},
				color: 'white',
				display: false
			}
		}
	}
  });
}

</script>