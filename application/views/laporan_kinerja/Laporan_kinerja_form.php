<div class="row">
    <div class="col-xs-12 col-md-6">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title"><?= $button;?> Laporan Kinerja</h3>
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
            <input type="hidden" class="form-control" name="id" id="id" placeholder="Id" value="<?php echo $id; ?>" />
            <input type="hidden" class="form-control" name="old" id="old" placeholder="Id" value="<?php echo $laporan; ?>" />
	    <div class="form-group">
            <label for="varchar">Kegiatan <?php echo form_error('kegiatan') ?></label>
            <input type="text" class="form-control" name="kegiatan" id="kegiatan" placeholder="Kegiatan" value="<?php echo $kegiatan; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Laporan <?php echo form_error('laporan') ?></label>
            <input type="file" class="form-control" name="laporan" id="laporan" accept="application/pdf"/>
        </div>
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('laporan_kinerja') ?>" class="btn btn-default">Cancel</a>
	</form>
         </div>
        </div>
    </div>
</div>