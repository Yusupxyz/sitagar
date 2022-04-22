<div class="row">
    <div class="col-xs-12 col-md-6">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title"><?= $button;?> Data Pegawai Honorer</h3>
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
            <label for="varchar">Nama <?php echo form_error('nama') ?></label>
            <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama" value="<?php echo $nama; ?>" readonly/>
        </div>
	    <div class="form-group">
            <label for="varchar">NIK <?php echo form_error('nik') ?></label>
            <input type="text" class="form-control" name="nik" id="nik" placeholder="NIK" value="<?php echo $nik; ?>" readonly/>
        </div>
        <div class="form-group">
            <label for="enum">Status Verifikasi <?php echo form_error('status_verif') ?></label>
            <select class="form-control" aria-label="Default select example" name="status_verif" id="status_verif">
                <option value="">-Pilih Status Verifikasi-</option>
                <option value="0" <?= $status_verif=='0'?'selected':'' ?>>Belum Terverifikasi</option>
                <option value="1" <?= $status_verif=='1'?'selected':'' ?>>Salah/Belum Lengkap</option>
                <option value="2" <?= $status_verif=='2'?'selected':'' ?>>Terverifikasi</option>
            </select>
        </div>
	    <div class="form-group">
            <label for="varchar">Catatan <?php echo form_error('catatan') ?></label>
            <textarea class="form-control" name="catatan_verif" id="catatan_verif" placeholder="Catatan"><?php echo $catatan_verif; ?></textarea>
        </div>
	    <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('verifikasi') ?>" class="btn btn-default">Batal</a>
	</form>
         </div>
        </div>
    </div>
</div>