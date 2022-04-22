<div class="row">
<div class="col-xs-12">
    <div class="box">
      <div class="box-header">
        <h3 class="box-title">Nilai Laporan Kinerja</h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
              <button type="button" class="btn btn-box-tool" onclick="location.reload()" title="Refresh">
              <i class="fa fa-refresh"></i></button>
          </div>
    
      <div class="box-body">
      </div>
        <div class="alert alert-info" role="alert">
        <h4>Range Nilai</h4>
        <?php foreach ($kategori as $key => $value) {
            echo $value->kategori.' - '.$value->keterangan.' ('.$value->min.'-'.$value->max.')<br>';
        }
        ?>
        </div>
       
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 8px" id="message">
                    
                </div>
            </div>
            <div class="col-md-1 text-right">
            </div>
            <div class="col-md-3 text-right"><form action="<?php echo site_url('laporan_kinerja/index'); ?>" class="form-inline" method="get" style="margin-top:10px">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('laporan_kinerja'); ?>" class="btn btn-default">Reset</a>
                                    <?php
                                }
                            ?>
                          <button class="btn btn-primary" type="submit">Search</button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
        <form method="post" action="<?= site_url('laporan_kinerja/deletebulk');?>" id="formbulk">
        <table class="table table-bordered" style="margin-bottom: 10px" style="width:100%">
            <tr>
                <th>No</th>
                <th>Nama Pegawai</th>
                <th>Kegiatan</th>
                <th>Tanggal Pelaporan</th>
                <th>Laporan</th>
                <th>Nilai Kinerja</th>
                <th>Aksi</th>
            </tr><?php
            foreach ($laporan_kinerja_data as $laporan_kinerja)
            {
                ?>
                <tr>
                
			<td width="80px">
                <?php echo ++$start ?></td>
                <td><?php echo $laporan_kinerja->nama ?></td>
                <td><?php echo $laporan_kinerja->kegiatan ?></td>
                <td><?php echo $laporan_kinerja->tgl ?></td>
                <td><a target="_blank" href="<?php echo site_url('./assets/uploads/laporan/'.$laporan_kinerja->laporan) ?>" class="link-primary">Lihat Berkas Laporan</a></td>
                <td><?php echo $laporan_kinerja->skor." (".$laporan_kinerja->kategori." - ".$laporan_kinerja->keterangan.")" ?><br>
                <a target="_blank" href="<?php echo site_url('nilai/read/'.$laporan_kinerja->id_laporan_kinerja) ?>" class="link-primary">Lihat Detail Nilai</a>

            </td>
                <td style="text-align:center" width="200px">
				<?php 
		            echo anchor(site_url('nilai/update/'.$laporan_kinerja->id_laporan_kinerja),' <i class="fa fa-edit"></i>', 'class="btn btn-xs btn-warning" data-toggle="tooltip" title="Edit"'); 
				?>
			</td>
		</tr>
                <?php
            }
            ?>
        </table>
         <div class="row" style="margin-bottom: 10px;">
            <div class="col-md-12">
                <a href="#" class="btn bg-yellow">Total Record : <?php echo $total_rows ?></a>
            </div>
        </div>
        </form>
        <div class="row">
            <div class="col-md-6">
	    </div>
            <div class="col-md-6 text-right">
                <?php echo $pagination ?>
            </div>
        </div>
    </div>
    </div>
  </div>
</div>