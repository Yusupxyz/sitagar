<div class="row">
    <div class="col-xs-12 col-md-6">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title"><?= $button;?> Kategori</h3>
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
        <form action="<?php echo $action; ?>" method="post">
            <input type="hidden" class="form-control" name="id" id="id" placeholder="Id" value="<?php echo $id; ?>" />
	    <div class="form-group">
            <label for="char">Kategori <?php echo form_error('kategori') ?></label>
            <input type="text" class="form-control" name="kategori" id="kategori" placeholder="Kategori" value="<?php echo $kategori; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Keterangan <?php echo form_error('keterangan') ?></label>
            <input type="text" class="form-control" name="keterangan" id="keterangan" placeholder="Keterangan" value="<?php echo $keterangan; ?>" />
        </div>
        <div class="form-group">
            <label for="varchar">Minimal Nilai <?php echo form_error('min') ?></label>
            <input type="text" class="form-control" name="min" id="min" placeholder="Minimal Nilai" value="<?php echo $min; ?>" />
        </div>
        <div class="form-group">
            <label for="varchar">Maksimal Nilai <?php echo form_error('max') ?></label>
            <input type="text" class="form-control" name="max" id="max" placeholder="Maksimal" value="<?php echo $max; ?>" />
        </div>
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('kategori') ?>" class="btn btn-default">Cancel</a>
	</form>
         </div>
        </div>
    </div>
</div>