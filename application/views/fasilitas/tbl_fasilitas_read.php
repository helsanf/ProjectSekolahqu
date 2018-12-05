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
        <h2 style="margin-top:0px">Tbl_fasilitas Read</h2>
        <table class="table">
	    <tr><td>Nama Fasilitas</td><td><?php echo $nama_fasilitas; ?></td></tr>
	    <tr><td>Image</td><td><?php echo $image; ?></td></tr>
	    <tr><td>Id Sekolah</td><td><?php echo $id_sekolah; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('fasilitas') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>