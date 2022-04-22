<div class="row">
<div class="col-xs-12">
    <div class="box">
      <div class="box-header">
        <h3 class="box-title">Data Pegawai Honorer</h3>
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
		<?php echo anchor(site_url('daftar_pegawai/excel'), '<i class="fa fa-file-excel"></i> Excel', 'class="btn btn-success"'); ?><form action="<?php echo site_url('data_pegawai/index'); ?>" class="form-inline" method="get" style="margin-top:10px">
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
        <table class="table table-bordered" style="margin-bottom: 10px" style="width:100%" id="table1">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>NIK</th>
                <th>Tempat Lahir</th>
                <th>Tanggal Lahir</th>
                <th>Jenis Kelamin</th>
                <th>Pendidikan Terakhir</th>
                <th>Alamat</th>
                <th>Jabatan</th>
                <th>Tahun Lulus</th>
                <th>Tanggal Sk Awal</th>
                <th>Tempat Tugas</th>
                <th>No Hp</th>
                <th>Email</th>
                <th>Status Verif</th>
                <th>Catatan Verif</th>
                <th>Berkas</th>
            </tr>
                            </thead>
                            <?php
            foreach ($data_pegawai_data as $data_pegawai)
            {
                ?>
                <tbody>
                <tr>
                
                
                    <td width="80px"><?php echo ++$start ?></td>
                    <td><?php echo $data_pegawai->nama ?></td>
                    <td><?php echo $data_pegawai->nik ?></td>
                    <td><?php echo $data_pegawai->tempat_lahir ?></td>
                    <td><?php echo $data_pegawai->tanggal_lahir ?></td>
                    <td><?php echo $data_pegawai->jk=='0'?'Laki-laki':'Perempuan' ?></td>
                    <td><?php echo $data_pegawai->pendidikan_terakhir ?></td>
                    <td><?php echo $data_pegawai->alamat ?></td>
                    <td><?php echo $data_pegawai->jabatan ?></td>
                    <td><?php echo $data_pegawai->tahun_lulus ?></td>
                    <td><?php echo $data_pegawai->tanggal_sk_awal ?></td>
                    <td><?php echo $data_pegawai->tempat_tugas ?></td>
                    <td><?php echo $data_pegawai->no_hp ?></td>
                    <td><?php echo $data_pegawai->email ?></td>
                    <td><?php echo $data_pegawai->status_verif=='0'?'Belum':'Sudah' ?></td>
                    <td><?php echo $data_pegawai->catatan_verif ?></td>
                    <td style="text-align:center" width="200px">
				<?php 
				echo anchor(site_url('daftar_pegawai/read/'.$data_pegawai->id),' <i class="fa fa-search"></i>', 'class="btn btn-xs btn-warning" data-toggle="tooltip" title="Edit"'); 
				?>
			</td>
		</tr></tbody>
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