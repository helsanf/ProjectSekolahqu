<!doctype html>
<html>
<div class="content-wrapper">
<section class="content">
<div class="row">
<div class="col-lg-12">
      <div class="box box-warning box-solid">

          <div class="box-header">
              <h3 class="box-title">DATA</h3>
          </div>
    <body>
        <h2 style="margin-top:0px">Tbl_profile_sekolah Read</h2>
        <table class="table">
	    <tr><td>Nama Sekolah</td><td><?php echo $nama_sekolah; ?></td></tr>
	    <tr><td>Alamat</td><td><?php echo $alamat; ?></td></tr>
	    <tr><td>Email</td><td><?php echo $email; ?></td></tr>
	    <tr><td>No Telp</td><td><?php echo $no_telp; ?></td></tr>
	    <tr><td>Logo Sekolah</td><td><?php echo $logo_sekolah; ?></td></tr>
	    <tr><td>Visi Misi</td><td><?php echo $visi_misi; ?></td></tr>
	    <tr><td>Kalender Akademik</td><td><?php echo $kalender_akademik; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('profile_sekolah') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
    </div>
        </div>
        </div>
        </div>
</html>