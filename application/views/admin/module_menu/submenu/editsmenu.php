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
					<a href="<?php echo site_url('smenu/show/'.$menu.'/'.$submenu)?>" class="btn btn-default menu-button">Sub Menu</a>
					<a href="<?php echo site_url('smenu/create/'.$menu.'/'.$submenu)?>" class="btn btn-default menu-button">Tambah Sub</a>
					<a href="<?php echo site_url('smenu/createspengguna/'.$menu.'/'.$submenu)?>" class="btn btn-default menu-button">Sub Menu Pengguna</a>
				</div>
			</div>
			<div class="panel panel-white">
				<div class="panel-body">
					<div class="row">
						<form action="<?php echo site_url('smenu/update/'.$id)?>" method="POST" id="createupdate">
							<div class="form-group col-md-6">
								<label>Nama Menu</label>
								<select class="form-control" name="menu">
									<?php
										foreach ($listmenu->result() as $data) {
											$selected = "";
											if($menu_id == $data->id_menu){
												$selected = "selected";
											}
											echo '<option value="'.$data->id_menu.'" '.$selected.'>'.$data->nama_menu.'</option>';
										}
									?>
								</select>
							</div>
							<div class="form-group col-md-6">
								<label>Nama Sub Menu</label>
								<input type="text" name="smenu" class="form-control" value="<?php echo $nama_smenu?>" required="" title="">
							</div>
							<div class="form-group col-md-6">
								<label>Icon</label>
								<input type="text" name="icon" class="form-control" value="<?php echo $icon?>" >
							</div>
							<div class="form-group col-md-6">
								<label>Link</label>
								<input type="text" name="link" class="form-control" value="<?php echo $link?>" required="" title="">
							</div>
							<div class="form-group col-md-6">
								<label>urutan</label>
								<input type="number" name="urut" class="form-control" value="<?php echo $urut?>" required=""  title="">
							</div>
							<div class="form-group col-md-6">
								<label>Tampil</label>
								<select class="form-control" name="tampil">
									<option value="Y" <?php if($tampil == "Y") echo "selected";?> >Ya</option>
									<option value="N" <?php if($tampil == "N") echo "selected";?> >Tidak</option>
								</select>
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