<!-- Page Header-->
  <header class="page-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-6"><h2 class="no-margin-bottom">Laporan Penjualan</h2></div>
          <div class="col-md-6">
          </div>
        </div>
    </div>
  </header>
<!-- Dashboard Counts Section-->

<div class="container-fluid top-bottom">
    <div class="row">
        <div class="col-md-12">

              <div class="d-flex">
                <div class="statistics col-lg-3 col-12">
                  <div class="statistic d-flex align-items-center bg-white has-shadow">
                    <div class="text"><h2>Penjualan Rekap</h2>
                    <small>
                    <a href="<?php echo admin_url()."report/sales_rekap" ?>">
                      <button class="btn btn-info btn-sm"><span class="fa fa-external-link-square"></span> Lihat Selengkapnya</button>
                    </a>
                    </small></div>
                  </div>
                </div>
                <div class="statistics col-lg-3 col-12">
                  <div class="statistic d-flex align-items-center bg-white has-shadow">
                    <div class="text"><h2>Penjualan Detail</h2>
                    <small>
                      <a href="<?php echo admin_url()."report/sales_detail" ?>">
                        <button class="btn btn-info btn-sm"><span class="fa fa-external-link-square"></span> Lihat Selengkapnya</button>
                      </a>
                    </small></div>
                  </div>
                </div>
                <div class="statistics col-lg-3 col-12">
                  <div class="statistic d-flex align-items-center bg-white has-shadow">
                    <div class="text"><h2>Penjualan Harian</h2>
                    <small>
                    <a href="<?php echo admin_url()."report/sales_harian" ?>">
                      <button class="btn btn-info btn-sm"><span class="fa fa-external-link-square"></span> Lihat Selengkapnya</button>
                    </a>
                    </small></div>
                  </div>
                </div>
                <div class="statistics col-lg-3 col-12">
                  <div class="statistic d-flex align-items-center bg-white has-shadow">
                    <div class="text"><h2>Grafik Penjualan</h2>
                    <small>
                    <a href="<?php echo admin_url()."report/sales_stats" ?>">
                      <button class="btn btn-info btn-sm"><span class="fa fa-external-link-square"></span> Lihat Selengkapnya</button>
                    </a>
                    </small></div>
                  </div>
                </div>
                
              </div>
        </div>
    </div>
</div>