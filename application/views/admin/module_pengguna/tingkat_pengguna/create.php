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
					<a href="<?php echo site_url('tpengguna/show/'.$menu.'/'.$submenu)?>" class="btn btn-default menu-button">Daftar Tingkat Pengguna</a>
					<a href="<?php echo site_url('tpengguna/create/'.$menu.'/'.$submenu)?>" class="btn btn-primary menu-button">Tambah Tingkat Pengguna</a>
				</div>
			</div>
			<div class="panel panel-white">
				<div class="panel-body">
					<div class="row">
						<form action="<?php echo site_url('tpengguna/add')?>" method="POST" id="createupdate">
							
							<div class="form-group col-md-6">
								<label for="">Nama Tingkat Pengguna</label>
								<input type="text" name="ntp" class="form-control" required="required">
							</div>
							<div class="form-group col-md-6">
								<label for="">Status Toko</label>
								<select name="sttoko" id="inputSttoko" class="form-control" required="required">
									<option value="Y">Ya</option>
									<option value="N">Tidak</option>
								</select>
							</div>
							<div class="form-group col-md-12">
								<label for="">Keterangan</label>
								<textarea name="keterangan" class="form-control" rows="3" required=""></textarea>
							</div>

							<div class="form-group col-md-12">
								<button type="submit" class="btn btn-warning">Tambah</button>
								<button type="reset" class="btn btn-danger">Reset</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>