<div class="content-wrapper">
    
    <section class="content">
        <div class="box box-warning box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">INPUT DATA TBL_EKSKUL</h3>
            </div>
            <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
            
<table class='table table-bordered>'        

	    <tr><td width='200'>Nama Ekskul <?php echo form_error('nama_ekskul') ?></td><td><input type="text" class="form-control" name="nama_ekskul" id="nama_ekskul" placeholder="Nama Ekskul" value="<?php echo $nama_ekskul; ?>" /></td></tr>
	    
        <tr><td width='200'>Deskripsi <?php echo form_error('deskripsi') ?></td><td> <textarea class="form-control" rows="3" name="deskripsi" id="deskripsi" placeholder="Deskripsi"><?php echo $deskripsi; ?></textarea></td></tr>
	    <tr><td width='200'>Pembina <?php echo form_error('pembina') ?></td><td><input type="text" class="form-control" name="pembina" id="pembina" placeholder="Pembina" value="<?php echo $pembina; ?>" /></td></tr>
	    <tr><td width='200'>Image <?php echo form_error('image') ?></td><td><input type="file" class="form-control" name="image" id="image" placeholder="Image" value="<?php echo $image; ?>" /></td></tr>
	    <tr><td width='200'>Ketua <?php echo form_error('ketua') ?></td><td><input type="text" class="form-control" name="ketua" id="ketua" placeholder="Ketua" value="<?php echo $ketua; ?>" /></td></tr>
	    <tr><td></td><td><input type="hidden" name="id_ekskul" value="<?php echo $id_ekskul; ?>" /> 
	    <button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button> 
	    <a href="<?php echo site_url('ekskul') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Kembali</a></td></tr>
	</table></form>        </div>
</div>
</div>