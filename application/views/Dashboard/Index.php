<!-- Default box -->
<div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box bg-aqua">
            <span class="info-box-icon"><i class="fas fa-users"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Pegawai Honorer</span>
              <span class="info-box-number"><?= $total_data ?></span>

              <div class="progress">
                <div class="progress-bar" style="width: 100%"></div>
              </div>
                  <span class="progress-description">
                    Total Data
                  </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box bg-green">
            <span class="info-box-icon"><i class="fa fa-cubes"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Data Terverifikasi</span>
              <span class="info-box-number"><?= $total_verif ?></span>

              <div class="progress">
                <div class="progress-bar" style="width: 100%"></div>
              </div>
                  <span class="progress-description">
                    Total Data
                  </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
       <!-- /.col -->
       <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box bg-red">
            <span class="info-box-icon"><i class="fa fa-cubes"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Data Belum Terverifikasi</span>
              <span class="info-box-number"><?= $total_nonverif ?></span>

              <div class="progress">
                <div class="progress-bar" style="width: 100%"></div>
              </div>
                  <span class="progress-description">
                    Total Data
                  </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

      </div>
      
