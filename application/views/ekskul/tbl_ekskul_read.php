<!doctype html>
<html>
    <head>
        <title>harviacode.com - codeigniter crud generator</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        <style>
            body{
                padding: 15px;
            }
        </style>
    </head>
    <body>
        <h2 style="margin-top:0px">Tbl_ekskul Read</h2>
        <table class="table">
	    <tr><td>Nama Ekskul</td><td><?php echo $nama_ekskul; ?></td></tr>
	    <tr><td>Deskripsi</td><td><?php echo $deskripsi; ?></td></tr>
	    <tr><td>Pembina</td><td><?php echo $pembina; ?></td></tr>
	    <tr><td>Image</td><td><?php echo $image; ?></td></tr>
	    <tr><td>Ketua</td><td><?php echo $ketua; ?></td></tr>
	    <tr><td>Id Sekolah</td><td><?php echo $id_sekolah; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('ekskul') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>