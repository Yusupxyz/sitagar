<div class="row">
<div class="col-xs-12">
    <div class="box">
      <div class="box-header">
        <h3 class="box-title">Verifikasi Data Berkas</h3>
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
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 8px" id="message">
                    
                </div>
            </div>
            <div class="col-md-1 text-right">
            </div>
            <div class="col-md-3 text-right">
		<?php echo anchor(site_url('data_pegawai/excel'), '<i class="fa fa-file-excel"></i> Excel', 'class="btn btn-success"'); ?><form action="<?php echo site_url('data_pegawai/index'); ?>" class="form-inline" method="get" style="margin-top:10px">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('data_pegawai'); ?>" class="btn btn-default">Reset</a>
                                    <?php
                                }
                            ?>
                          <button class="btn btn-primary" type="submit">Search</button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
        <form method="post" action="<?= site_url('data_pegawai/deletebulk');?>" id="formbulk">
        <table class="table table-bordered" style="margin-bottom: 10px" style="width:100%">
            <tr>
                <!-- <th style="width: 10px;"><input type="checkbox" name="selectall" /></th> -->
                <th>No</th>
		<th>Nama</th>
		<th>NIK</th>
		<th>Ijazah</th>
		<th>Transkrip</th>
		<th>Sertifikasi</th>
		<th>Status Verifikasi</th>
		<th>Catatan Verifikasi</th>
		<th>Aksi</th>
            </tr><?php
            foreach ($data_pegawai_data as $data_pegawai)
            {
                ?>
                <tr>
                
		<!-- <td  style="width: 10px;padding-left: 8px;"><input type="checkbox" name="id" value="<?= $data_pegawai->id;?>" />&nbsp;</td> -->
                
			<td width="80px"><?php echo ++$start ?></td>
			<td><?php echo $data_pegawai->nama ?></td>
			<td><?php echo $data_pegawai->nik ?></td>
            <td>
                <?php if($data_pegawai->ijazah!=null){ ?>
                    <a target="_blank" href="<?php echo site_url('./assets/uploads/berkas/ijazah/'.$data_pegawai->ijazah) ?>" class="link-primary">Lihat Berkas Ijazah</a>
                <?php }else{ echo '-';} ?>
                </td>
            <td>
                <?php if($data_pegawai->transkrip!=null){ ?>
                    <a target="_blank" href="<?php echo site_url('./assets/uploads/berkas/transkrip/'.$data_pegawai->transkrip) ?>" class="link-primary">Lihat Berkas Transkrip</a>
                <?php }else{ echo '-';} ?>
            </td>
            <td>
                <?php if($data_pegawai->transkrip!=null){ ?>
                    <a target="_blank" href="<?php echo site_url('./assets/uploads/berkas/sertifikasi/'.$data_pegawai->sertifikasi) ?>" class="link-primary">Lihat Berkas Sertifikasi</a>
                <?php }else{ echo '-';} ?>
            </td>
				<td><?php echo $data_pegawai->status_verif=='0'?'<p class="text-danger">Belum</p>':($data_pegawai->status_verif=='1'?'<p class="text-warning">Perbaikan</p>':'<p class="text-success">Sudah</p>') ?></td>
			<td><?php echo $data_pegawai->catatan_verif ?></td>
			<td style="text-align:center" width="200px">
				<?php 
				echo anchor(site_url('verifikasi/update/'.$data_pegawai->dp_id),' <i class="fa fa-edit"></i>', 'class="btn btn-xs btn-warning" data-toggle="tooltip" title="Edit"'); 
				?>
			</td>
		</tr>
                <?php
            }
            ?>
        </table>
         <div class="row" style="margin-bottom: 10px;">
            <div class="col-md-12">
                <!-- <button class="btn btn-danger" type="submit"><i class="fa fa-trash"></i> Hapus Data Terpilih</button>  -->
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