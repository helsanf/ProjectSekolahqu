<div class="content-wrapper">
    
    <section class="content">
        <div class="box box-warning box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">INPUT DATA TBL_PRESTASI</h3>
            </div>
            <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
            
<table class='table table-bordered>'        

	    <tr><td width='200'>Nama Prestasi <?php echo form_error('nama_prestasi') ?></td><td><input type="text" class="form-control" name="nama_prestasi" id="nama_prestasi" placeholder="Nama Prestasi" value="<?php echo $nama_prestasi; ?>" /></td></tr>
	    <tr><td width='200'>Tanggal Didapat <?php echo form_error('tanggal_didapat') ?></td><td><input type="date" class="form-control" name="tanggal_didapat" id="tanggal_didapat" placeholder="Tanggal Didapat" value="<?php echo $tanggal_didapat; ?>" /></td></tr>
	    
        <tr><td width='200'>Deskripsi <?php echo form_error('deskripsi') ?></td><td> <textarea class="form-control" rows="3" name="deskripsi" id="deskripsi" placeholder="Deskripsi"><?php echo $deskripsi; ?></textarea></td></tr>
	    <tr><td width='200'>Image <?php echo form_error('image') ?></td><td><input type="file" class="form-control" name="image" id="image" placeholder="Image" value="<?php echo $image; ?>" /></td></tr>
	    <!-- <tr><td width='200'>Id Sekolah <?php echo form_error('id_sekolah') ?></td><td><input type="text" class="form-control" name="id_sekolah" id="id_sekolah" placeholder="Id Sekolah" value="<?php echo $id_sekolah; ?>" /></td></tr> -->
	    <tr><td></td><td><input type="hidden" name="id_prestasi" value="<?php echo $id_prestasi; ?>" /> 
	    <button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button> 
	    <a href="<?php echo site_url('prestasi') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Kembali</a></td></tr>
	</table></form>        </div>
</div>
</div>