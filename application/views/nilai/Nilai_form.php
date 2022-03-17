<div class="row">
    <div class="col-xs-12 col-md-6">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title"><?= $button;?> Nilai</h3>
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
	    <div class="form-group">
            <input type="hidden" class="form-control" name="id" id="id" placeholder="Id" value="<?php echo $id; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Tanggung Jawab <?php echo form_error('tanggung_jawab') ?></label>
            <input type="text" class="form-control" name="tanggung_jawab" id="tanggung_jawab" placeholder="Tanggung Jawab" value="<?php echo $tanggung_jawab; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Ketaatan <?php echo form_error('ketaatan') ?></label>
            <input type="text" class="form-control" name="ketaatan" id="ketaatan" placeholder="Ketaatan" value="<?php echo $ketaatan; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Produktivitas <?php echo form_error('produktivitas') ?></label>
            <input type="text" class="form-control" name="produktivitas" id="produktivitas" placeholder="Produktivitas" value="<?php echo $produktivitas; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Efesiensi <?php echo form_error('efesiensi') ?></label>
            <input type="text" class="form-control" name="efesiensi" id="efesiensi" placeholder="Efesiensi" value="<?php echo $efesiensi; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Inovasi <?php echo form_error('inovasi') ?></label>
            <input type="text" class="form-control" name="inovasi" id="inovasi" placeholder="Inovasi" value="<?php echo $inovasi; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Kerja Sama <?php echo form_error('kerja_sama') ?></label>
            <input type="text" class="form-control" name="kerja_sama" id="kerja_sama" placeholder="Kerja Sama" value="<?php echo $kerja_sama; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Efektivitas <?php echo form_error('efektivitas') ?></label>
            <input type="text" class="form-control" name="efektivitas" id="efektivitas" placeholder="Efektivitas" value="<?php echo $efektivitas; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Kecepatan <?php echo form_error('kecepatan') ?></label>
            <input type="text" class="form-control" name="kecepatan" id="kecepatan" placeholder="Kecepatan" value="<?php echo $kecepatan; ?>" />
        </div>
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('nilai') ?>" class="btn btn-default">Cancel</a>
	</form>
         </div>
        </div>
    </div>
</div>