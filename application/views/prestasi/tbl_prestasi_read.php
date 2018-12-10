
<div class="content-wrapper">
<section class="content">
<div class="row">
<div class="col-lg-12">
      <div class="box box-warning box-solid">

          <div class="box-header">
              <h3 class="box-title">DATA</h3>
          </div>

<div class="box-body">
        <h2 style="margin-top:0px">Tbl_prestasi Read</h2>
        <table class="table">
	    <tr><td>Nama Prestasi</td><td><?php echo $nama_prestasi; ?></td></tr>
	    <tr><td>Tanggal Didapat</td><td><?php echo $tanggal_didapat; ?></td></tr>
	    <tr><td>Deskripsi</td><td><?php echo $deskripsi; ?></td></tr>
	    <tr><td>Image</td><td><?php echo $image; ?></td></tr>
	    <tr><td>Id Sekolah</td><td><?php echo $id_sekolah; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('prestasi') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        <!-- </body> -->
        </div>
        </div>
        </div>
        </div>
</html>