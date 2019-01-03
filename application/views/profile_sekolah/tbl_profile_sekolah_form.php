<div class="content-wrapper">
    
    <section class="content">
        <div class="box box-warning box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">INPUT DATA TBL_PROFILE_SEKOLAH</h3>
            </div>
            <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
            
<table class='table table-bordered>'        

	    <tr><td width='200'>Nama Sekolah <?php echo form_error('nama_sekolah') ?></td><td><input type="text" class="form-control" name="nama_sekolah" id="nama_sekolah" placeholder="Nama Sekolah" value="<?php echo $nama_sekolah; ?>" /></td></tr>
	    
        <tr>
		<td width='200'>Alamat <?php echo form_error('alamat') ?></td>
		<td> <textarea class="form-control" rows="3" name="alamat" id="alamat" placeholder="Alamat"><?php echo $alamat; ?></textarea>
		</td>
		</tr>
	    <tr><td width='200'>Email <?php echo form_error('email') ?></td><td><input type="text" class="form-control" name="email" id="email" placeholder="Email" value="<?php echo $email; ?>" /></td></tr>
	    <tr><td width='200'>No Telp <?php echo form_error('no_telp') ?></td><td><input type="text" class="form-control" name="no_telp" id="no_telp" placeholder="No Telp" value="<?php echo $no_telp; ?>" /></td></tr>
	    <tr><td width='200'>Logo Sekolah <?php echo form_error('logo_sekolah') ?></td><td><input type="file" class="form-control" name="logo_sekolah" id="logo_sekolah" placeholder="Logo Sekolah" value="<?php echo $logo_sekolah; ?>" /></td></tr>
        <tr><td width='200'>Visi Misi <?php echo form_error('visi_misi') ?></td><td> <textarea class="form-control" rows="3" name="visi_misi" id="visi_misi" placeholder="Visi Misi"><?php echo $visi_misi; ?></textarea></td></tr>
	    <tr><td width='200'>Kalender Akademik <?php echo form_error('kalender_akademik') ?></td><td><input type="file" class="form-control" name="kalender_akademik" id="kalender_akademik" placeholder="Kalender Akademik" value="<?php echo $kalender_akademik; ?>" /></td></tr>
	    <tr><td></td><td><input type="hidden" name="id_sekolah" value="<?php echo $id_sekolah; ?>" /> 
	    <button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button> 
	    <a href="<?php echo site_url('profile_sekolah') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Kembali</a></td></tr>
	</table></form>        </div>
</div>
</div>