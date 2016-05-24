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
					<a href="<?php echo site_url('link/show/'.$menu.'/'.$submenu)?>" class="btn btn-default menu-button">Daftar Link</a>
					<a href="<?php echo site_url('link/create/'.$menu.'/'.$submenu)?>" class="btn btn-default menu-button">Tambah Link</a>
				</div>
			</div>
			<div class="panel panel-white">
				<div class="panel-body">
					<div class="row">
						<form action="<?php echo site_url('link/update/'.$id)?>" method="POST" id="createupdate">
							
							<div class="form-group col-md-6">
								<label for="">Pengguna</label>
								<select name="pengguna" class="form-control">
									<?php 
										foreach ($levelp->result() as $data) {
											$selected = "";
											if($data->id_level == $id_level){
												$selected = "selected";
											}
											echo '<option value="'.$data->id_level.'" '.$selected.'>'.$data->nama_level.'</option>';
										}
									?>
								</select>
							</div>
							<div class="form-group col-md-6">
								<label for="">Url</label>
								<input type="text" name="url" class="form-control"  placeholder="Nama Class/fungsi" value="<?php echo $url?>" required="">
							</div>
							<div class="form-group col-md-6">
								<label for="">Fungsi</label>
								<input type="text" name="fungsi" class="form-control" id="" placeholder="Fungsi" value="<?php echo $fungsi?>" required="">
							</div>
							<div class="form-group col-md-6">
								<label for="">Keterangan</label>
								<textarea name="keterangan" class="form-control" rows="9" required=""><?php echo $keterangan?></textarea>
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