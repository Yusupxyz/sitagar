<div class="row">
    <div class="col-xs-12 col-md-6">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Nilai Detail</h3>
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
	    <tr><td>Tanggung Jawab</td><td><?php echo $tanggung_jawab; ?></td></tr>
	    <tr><td>Ketaatan</td><td><?php echo $ketaatan; ?></td></tr>
	    <tr><td>Produktivitas</td><td><?php echo $produktivitas; ?></td></tr>
	    <tr><td>Efesiensi</td><td><?php echo $efesiensi; ?></td></tr>
	    <tr><td>Inovasi</td><td><?php echo $inovasi; ?></td></tr>
	    <tr><td>Kerja Sama</td><td><?php echo $kerja_sama; ?></td></tr>
	    <tr><td>Efektivitas</td><td><?php echo $efektivitas; ?></td></tr>
	    <tr><td>Kecepatan</td><td><?php echo $kecepatan; ?></td></tr>
	    <tr><td><a href="<?php echo site_url('nilai_laporan_kinerja') ?>" class="btn bg-purple">Batal</a></td></tr>
	</table>
            </div>
        </div>
    </div>
</div>