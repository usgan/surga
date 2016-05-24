<script src="//cdn.ckeditor.com/4.5.8/full/ckeditor.js"></script>
<style type="text/css">
	.menu-button{
		margin-bottom: 10px;
		margin-left: 5px;
	}
	.table-pad {
		padding-bottom: 120px;
	}
</style>
<div id="main-wrapper" class="container">
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<div class="panel panel-white">
				<div class="panel-body">
					<a href="<?php echo site_url('daftartoko/show/'.$menu.'/'.$submenu)?>" class="btn btn-default menu-button">Daftar Toko</a>
					<a href="<?php echo site_url('daftartoko/create/'.$menu.'/'.$submenu)?>" class="btn btn-default menu-button">Tambah Toko</a>
				</div>
			</div>
			<div class="panel panel-white">
				<div class="panel-body">
					<div class="row">
						<form action="<?php echo site_url('daftartoko/update/'.$id)?>" method="POST" id="createupdate">
							
							<div class="form-group col-md-6">
								<label for="">Nama Toko</label>
								<input type="text" name="ntoko" class="form-control" value="<?php echo $namatoko; ?>" required="required">
							</div>
							<div class="form-group col-md-6">
								<label for="">Pemilik</label>
								<input type="text" name="pemilik" class="form-control" value="<?php echo $pemilik; ?>" required="required">
							</div>
							<div class="form-group col-md-6">
								<label for="">Email</label>
								<input type="email" name="email" class="form-control" value="<?php echo $email; ?>">
							</div>
							<div class="form-group col-md-6">
								<label for="">No Hp</label>
								<input type="text" name="hp" class="form-control"  value="<?php echo $nohp; ?>" required="required">
							</div>
							<div class="form-group col-md-12">
								<label for="">Informasi</label>
								<textarea name="informasi" rows="9" class="form-control"><?php echo $informasi; ?></textarea>
							</div>
							<div class="form-group col-md-12">
								<button type="submit" class="btn btn-warning">Update</button>
								<button type="reset" class="btn btn-danger">Reset</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	info  = CKEDITOR.replace( 'informasi' );
	var formdata;
	$("#createupdate").submit(function(){
		editor = true;
		formdata =  new FormData($(this)[0]);
		formdata.append('info',info.getData());
	});
</script>