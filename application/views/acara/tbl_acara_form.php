<div class="content-wrapper">
    
    <section class="content">
        <div class="box box-warning box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">INPUT DATA TBL_ACARA</h3>
            </div>
            <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
            
<table class='table table-bordered>'        

	    <tr><td width='200'>Nama Acara <?php echo form_error('nama_acara') ?></td><td><input type="text" class="form-control" name="nama_acara" id="nama_acara" placeholder="Nama Acara" value="<?php echo $nama_acara; ?>" /></td></tr>
	    <tr><td width='200'>Tanggal Acara <?php echo form_error('tanggal_acara') ?></td><td><input type="date" class="form-control" name="tanggal_acara" id="tanggal_acara" placeholder="Tanggal Acara" value="<?php echo $tanggal_acara; ?>" /></td></tr>
	    
        <tr><td width='200'>Deskripsi <?php echo form_error('deskripsi') ?></td><td> <textarea class="form-control" rows="3" name="deskripsi" id="deskripsi" placeholder="Deskripsi"><?php echo $deskripsi; ?></textarea></td></tr>
	    <tr><td width='200'>Image <?php echo form_error('image') ?></td><td><input type="file" class="form-control" name="image" id="image" placeholder="Image" value="<?php echo $image; ?>" /></td></tr>
	    
	    <tr><td></td><td><input type="hidden" name="id_acara" value="<?php echo $id_acara; ?>" /> 
	    <button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button> 
	    <a href="<?php echo site_url('acara') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Kembali</a></td></tr>
	</table></form>        </div>
</div>
</div>