<div class="row">
    <div class="col-xs-12 col-md-6">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Data Pegawai Detail</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
                    <i class="fa fa-minus"></i></button>
                     <button type="button" class="btn btn-box-tool" onclick="location.reload()" title="Collapse">
              <i class="fa fa-refresh"></i></button>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
        <table class="table">
	    <tr><td>Nama</td><td><?php echo $nama; ?></td></tr>
	    <tr><td>NIK</td><td><?php echo $nik; ?></td></tr>
	    <tr><td>Ijazah</td><td><a target="_blank" href="<?php echo site_url('./assets/uploads/berkas/ijazah/'.$ijazah) ?>" class="link-primary">Lihat Berkas Ijazah</a></td></tr>
	    <tr><td>Transkrip</td><td><a target="_blank" href="<?php echo site_url('./assets/uploads/berkas/ijazah/'.$transkrip) ?>" class="link-primary">Lihat Berkas Transkrip</a></td></tr>
	    <tr><td>Sertifikasi</td><td><a target="_blank" href="<?php echo site_url('./assets/uploads/berkas/ijazah/'.$sertifikasi) ?>" class="link-primary">Lihat Berkas Sertifikasi</a></td></tr>
	    <tr><td><a href="<?php echo site_url('data_pegawai') ?>" class="btn bg-purple">Batal</a></td></tr>
	</table>
            </div>
        </div>
    </div>
</div>