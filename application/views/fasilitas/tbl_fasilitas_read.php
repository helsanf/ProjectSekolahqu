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
        <h2 style="margin-top:0px">Tbl_fasilitas Read</h2>
        <table class="table">
	    <tr><td>Nama Fasilitas</td><td><?php echo $nama_fasilitas; ?></td></tr>
	    <tr><td>Id Sekolah</td><td><?php echo $id_sekolah; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('fasilitas') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
</div>
</div>
</div>
</div>
</html>