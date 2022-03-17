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
            <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama" value="<?php echo $nama; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">NIK <?php echo form_error('nik') ?></label>
            <input type="text" class="form-control" name="nik" id="nik" placeholder="NIK" value="<?php echo $nik; ?>" />
        </div>
        <div class="form-group">
            <label for="enum">Jenis Kelamin <?php echo form_error('jk') ?></label>
            <select class="form-control" aria-label="Default select example" name="jk" id="jk">
                <option value="">-Pilih Jenis Kelamin-</option>
                <option value="0" <?= $jk=='0'?'selected':'' ?>>Laki-laki</option>
                <option value="1" <?= $jk=='1'?'selected':'' ?>>Perempuan</option>
            </select>
        </div>
	    <div class="form-group">
            <label for="varchar">Tempat Lahir <?php echo form_error('tempat_lahir') ?></label>
            <input type="text" class="form-control" name="tempat_lahir" id="tempat_lahir" placeholder="Tempat Lahir" value="<?php echo $tempat_lahir; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Tanggal Lahir <?php echo form_error('tanggal_lahir') ?></label>
            <input type="text" class="form-control" name="tanggal_lahir" id="tanggal_lahir" placeholder="Tanggal Lahir" value="<?php echo $tanggal_lahir; ?>" />
        </div>

	    <div class="form-group">
            <label for="varchar">Pendidikan Terakhir <?php echo form_error('pendidikan_terakhir') ?></label>
            <select class="form-control" aria-label="Default select example" name="pendidikan_terakhir" id="pendidikan_terakhir">
                <option value="">-Pilih Pendidikan Terakhir-</option>
                <option <?= $jk=='Tamat SD/Sederajat'?'selected':'' ?>>Tamat SD/Sederajat</option>
                <option <?= $jk=='SLTP/Sederajat'?'selected':'' ?>>SLTP/Sederajat</option>
                <option <?= $jk=='SLTA/Sederajat'?'selected':'' ?>>SLTA/Sederajat</option>
                <option <?= $jk=='Diploma I/II'?'selected':'' ?>>Diploma I/II</option>
                <option <?= $jk=='Akademi/Diploma III/Sarjana Muda'?'selected':'' ?>>Akademi/Diploma III/Sarjana Muda</option>
                <option <?= $jk=='Diploma IV/Strata I'?'selected':'' ?>>Diploma IV/Strata I</option>
            </select>
        </div>
	    <div class="form-group">
            <label for="varchar">Alamat <?php echo form_error('alamat') ?></label>
            <textarea class="form-control" name="alamat" id="alamat" placeholder="Alamat"><?php echo $alamat; ?></textarea>
        </div>
	    <div class="form-group">
            <label for="varchar">Jabatan <?php echo form_error('jabatan') ?></label>
            <input type="text" class="form-control" name="jabatan" id="jabatan" placeholder="Jabatan" value="<?php echo $jabatan; ?>" />
        </div>
	    <div class="form-group">
            <label for="year">Tahun Lulus <?php echo form_error('tahun_lulus') ?></label>
            <input type="number" class="form-control" name="tahun_lulus" id="tahun_lulus" placeholder="Tahun Lulus" value="<?php echo $tahun_lulus; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Tanggal Sk Awal <?php echo form_error('tanggal_sk_awal') ?></label>
            <input type="date" class="form-control" name="tanggal_sk_awal" id="tanggal_sk_awal" placeholder="Tanggal Sk Awal" value="<?php echo $tanggal_sk_awal; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Tempat Tugas <?php echo form_error('tempat_tugas') ?></label>
            <input type="text" class="form-control" name="tempat_tugas" id="tempat_tugas" placeholder="Tempat Tugas" value="<?php echo $tempat_tugas; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">No Hp <?php echo form_error('no_hp') ?></label>
            <input type="text" class="form-control" name="no_hp" id="no_hp" placeholder="No Hp" value="<?php echo $no_hp; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Email <?php echo form_error('email') ?></label>
            <input type="email" class="form-control" name="email" id="email" placeholder="Email" value="<?php echo $email; ?>" />
        </div>
	    <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('data_pegawai') ?>" class="btn btn-default">Cancel</a>
	</form>
         </div>
        </div>
    </div>
</div>