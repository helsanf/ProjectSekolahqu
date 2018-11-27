<!doctype html>
<html>
    <head>
        <title>harviacode.com - codeigniter crud generator</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        <style>
            .word-table {
                border:1px solid black !important; 
                border-collapse: collapse !important;
                width: 100%;
            }
            .word-table tr th, .word-table tr td{
                border:1px solid black !important; 
                padding: 5px 10px;
            }
        </style>
    </head>
    <body>
        <h2>Tbl_profile_sekolah List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Nama Sekolah</th>
		<th>Alamat</th>
		<th>Email</th>
		<th>No Telp</th>
		<th>Logo Sekolah</th>
		<th>Visi Misi</th>
		<th>Kalender Akademik</th>
		
            </tr><?php
            foreach ($profile_sekolah_data as $profile_sekolah)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $profile_sekolah->nama_sekolah ?></td>
		      <td><?php echo $profile_sekolah->alamat ?></td>
		      <td><?php echo $profile_sekolah->email ?></td>
		      <td><?php echo $profile_sekolah->no_telp ?></td>
		      <td><?php echo $profile_sekolah->logo_sekolah ?></td>
		      <td><?php echo $profile_sekolah->visi_misi ?></td>
		      <td><?php echo $profile_sekolah->kalender_akademik ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>