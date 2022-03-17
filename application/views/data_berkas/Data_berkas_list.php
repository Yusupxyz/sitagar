<div class="row">
<div class="col-xs-12">
    <div class="box">
      <div class="box-header">
        <h3 class="box-title">Data Berkas</h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
              <button type="button" class="btn btn-box-tool" onclick="location.reload()" title="Refresh">
              <i class="fa fa-refresh"></i></button>
          </div>
      </div>

      <div class="box-body">
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <!-- <?php echo anchor(site_url('data_berkas/create'),'<i class="fa fa-plus"></i> Create', 'class="btn bg-purple"'); ?> -->
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 8px" id="message">
                    
                </div>
            </div>
            <div class="col-md-1 text-right">
            </div>
            <div class="col-md-3 text-right"><form action="<?php echo site_url('data_berkas/index'); ?>" class="form-inline" method="get" style="margin-top:10px">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('data_berkas'); ?>" class="btn btn-default">Reset</a>
                                    <?php
                                }
                            ?>
                          <button class="btn btn-primary" type="submit">Search</button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
        <form method="post" action="<?= site_url('data_berkas/deletebulk');?>" id="formbulk">
        <table class="table table-bordered" style="margin-bottom: 10px" style="width:100%">
            <tr>
		<th>Ijazah</th>
		<th>Transkrip</th>		
        <th>Sertifikasi</th>
        <th>Status Verifikasi</th>
        <th>Catatan Verifikasi</th>
		<th>Aksi</th>
            </tr><?php
            foreach ($data_berkas_data as $data_berkas)
            {
                ?>
                <tr>
                
                
            <td><a target="_blank" href="<?php echo site_url('./assets/uploads/berkas/ijazah/'.$data_berkas->ijazah) ?>" class="link-primary">Lihat Berkas Ijazah</a></td>
            <td><a target="_blank" href="<?php echo site_url('./assets/uploads/berkas/transkrip/'.$data_berkas->transkrip) ?>" class="link-primary">Lihat Berkas Transkrip</a></td>
            <td><a target="_blank" href="<?php echo site_url('./assets/uploads/berkas/sertifikasi/'.$data_berkas->sertifikasi) ?>" class="link-primary">Lihat Berkas Sertifikasi</a></td>
			<td><?php echo $data_berkas->status_verif=='0'?'<p class="text-danger">Belum</p>':($data_berkas->status_verif=='1'?'<p class="text-warning">Perbaikan</p>':'<p class="text-success">Sudah</p>') ?></td>
			<td><?php echo $data_berkas->catatan_verif ?></td>
            <td style="text-align:center" width="200px">
				<?php 

				echo anchor(site_url('data_berkas/update/'.$data_berkas->id),' <i class="fa fa-edit"></i>', 'class="btn btn-xs btn-warning" data-toggle="tooltip" title="Edit"'); 
?>
			</td>
		</tr>
                <?php
            }
            ?>
        </table>
         <div class="row" style="margin-bottom: 10px;">
            <div class="col-md-12">
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