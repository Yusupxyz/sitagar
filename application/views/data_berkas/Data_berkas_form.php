<div class="row">
    <div class="col-xs-12 col-md-6">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title"><?= $button;?> Data Berkas</h3>
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
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
            <input type="hidden" class="form-control" name="id" id="id" placeholder="Id" value="<?php echo $id_pegawai; ?>" />
            <input type="hidden" class="form-control" name="old" id="old" placeholder="Id" value="<?php echo $ijazah; ?>" />
            <input type="hidden" class="form-control" name="old2" id="old2" placeholder="Id" value="<?php echo $transkrip; ?>" />
            <input type="hidden" class="form-control" name="old3" id="old3" placeholder="Id" value="<?php echo $sertifikasi; ?>" />

	    <div class="form-group">
            <label for="varchar">Ijazah <?php echo form_error('ijazah') ?></label>
            <input type="file" class="form-control" accept="application/pdf" name="ijazah" id="ijazah" />
        </div>
	    <div class="form-group">
            <label for="varchar">Transkrip <?php echo form_error('transkrip') ?></label>
            <input type="file" class="form-control" name="transkrip" id="transkrip" accept="application/pdf"/>
        </div>
        <div class="form-group">
            <label for="varchar">Sertifikasi <?php echo form_error('sertifikasi') ?></label>
            <input type="file" class="form-control" name="sertifikasi" id="sertifikasi" accept="application/pdf"/>
        </div>
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('data_berkas') ?>" class="btn btn-default">Batal</a>
	</form>
         </div>
        </div>
    </div>
</div>