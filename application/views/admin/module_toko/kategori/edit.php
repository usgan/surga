<script src="//cdn.ckeditor.com/4.5.8/full/ckeditor.js"></script>
<style type="text/css">
	.menu-button{
		margin-bottom: 10px;
		margin-left: 5px;
	}
	.table-pad {
		padding-bottom: 120px;
	}
	.required_{
		color:red; font-weight:bolder;font-size:10px
	}
</style>
<div id="main-wrapper" class="container">
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<div class="panel panel-white">
				<div class="panel-body">
					<a href="<?php echo site_url('kategori/show/'.$menu.'/'.$submenu)?>" class="btn btn-default menu-button">Daftar Kategori</a>
					<a href="<?php echo site_url('kategori/create/'.$menu.'/'.$submenu)?>" class="btn btn-default menu-button">Tambah Kategori</a>
				</div>
			</div>
			<div class="panel panel-white">
				<div class="panel-body">
					<div class="row">
						<form action="<?php echo site_url('kategori/update/'.$id)?>" method="POST" id="createupdate">
							
							<div class="form-group col-md-6">
								<label for="">Nama Kategori</label>
								<input type="text" name="nkategori" class="form-control" required="required" value="<?php echo $nama?>">
							</div>
							<div class="form-group col-md-6">
								<label for="">Gambar</label> <span class="required_">File Gambar maxsimal 40 Kb</span>
								<div class="row"><div class="col-md-8"><input type="file" name="image" class="form-control" /></div><div class="col-md-4 required_">jika ingin mengganti gambar silahkan memilih gambar baru</div></div>
							</div>							
							<div class="form-group col-md-12">
								<label for="">Keterangan</label>
								<textarea name="informasi" class="form-control" rows="9"><?php echo $keterangan?></textarea>
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