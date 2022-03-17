<!-- Default box -->
<div class="row">
  <div class="col-md-3 col-xs-12">
    <!-- Profile Image -->
    <div class="box box-primary">
      <div class="box-body box-profile">
        <img class="profile-user-img img-responsive img-circle" src="<?= base_url();?>assets/uploads/foto/<?= $user->foto ?>" alt="User profile picture">
        <h3 class="profile-username text-center"><?= $user->first_name." ".$user->last_name ?></h3>
        <p class="text-muted text-center"><?= $user->company ?></p>
        <ul class="list-group list-group-unbordered">
          <li class="list-group-item">
            <b>Email</b> <a class="pull-right"><?= $user->email ?></a>
          </li>
          <li class="list-group-item">
            <b>Username</b> <a class="pull-right"><?= $user->username ?></a>
          </li>
        </ul>
        <!-- <a href="<?= base_url();?>auth/logout" class="btn bg-purple btn-block"><b>Sign Out</b></a> -->
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
  </div>
  <!--  box edit-->
  <div class="col-md-5 col-xs-12">
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Ubah Profil</h3>
      </div>
        <!-- /.box-header -->
        <!-- form start -->
      <form role="form" action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
      <input type="hidden" class="form-control" name="old" id="old" placeholder="Id" value="<?php echo $user->foto; ?>" />
      <input type="hidden" class="form-control" name="id" id="id" placeholder="Id" value="<?php echo $user->id; ?>" />

        <div class="box-body">
          <div class="form-group">
            <label for="exampleInputEmail1">Email</label>
            <input type="email" class="form-control" id="exampleInputEmail1" name="email" placeholder="Enter email">
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Password Baru</label>
            <input type="password" class="form-control" id="exampleInputPassword1" name="new_p" placeholder="Konfirmasi Password">
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Konfirmasi Password</label>
            <input type="password" class="form-control" id="exampleInputPassword1" name="konfirmasi_p" placeholder="Konfirmasi Password">
          </div>
          <div class="form-group">
            <label for="exampleInputFile">Ganti Foto</label>
            <input type="file" name="foto" id="exampleInputFile" accept="image/jpg,image/png;">
            <p class="help-block">Format JPG/PNG.</p>
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Password Lama (Untuk Konfirmasi Perubahan Data Login)</label>
            <input type="password" class="form-control" id="exampleInputPassword1" name="old_p" placeholder="Password" required>
          </div>
        </div>
        <!-- /.box-body -->
        
        <div class="box-footer">
          <button type="submit" class="btn btn-primary">Ubah</button>
        </div>
      </form>
    </div>
  </div>
  <!--  / box edit-->

  
</div>
    