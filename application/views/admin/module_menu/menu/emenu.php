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
					<a href="<?php echo site_url('menu/menu/'.$menu.'/'.$submenu)?>" class="btn btn-default menu-button">Daftar Menu</a>
					<a href="<?php echo site_url('menu/cmenu/'.$menu.'/'.$submenu)?>" class="btn btn-default menu-button">Tambah Menu</a>
					<a href="<?php echo site_url('menu/cmpengguna/'.$menu.'/'.$submenu)?>" class="btn btn-default menu-button">Menu Pengguna</a>
				</div>
			</div>
			<div class="panel panel-white">
				<div class="panel-body">
					<div class="row">
						<form action="<?php echo site_url('menu/uemenu/'.$id)?>" method="POST" class="" id="createupdate" role="form">
							<div class="form-group col-md-6">
								<label>Menu</label>
								<input type="text" name="nama" id="inputNama" class="form-control" value="<?php echo $menu?>" required="required" placeholder="Nama Menu"/>
							</div>
							<div class="form-group col-md-6">
								<label>Urutan</label>
								<input type="number" name="urutan" id="inputNama" class="form-control" value="<?php echo $urutan?>" required="required" placeholder="Nama Menu"/>
							</div>
							<div class="form-group col-md-6">
								<label>link</label>
								<input type="text" name="link" id="inputNama" class="form-control" value="<?php echo $link?>" required="required" placeholder="Link"/>
							</div>
							<div class="form-group col-md-6">
								<label>Icon</label>
								<input type="text" name="icon" id="inputNama" class="form-control" value="<?php echo $icon?>" required="required" placeholder="icon"/>
							</div>

							<div class="form-group col-md-6">
								<label>Punya Sub</label>
								<select class="form-control" name="psub">
									<option value="Y" <?php if($punyasub == "Y") echo "selected";?> >Ya</option>
									<option value="N" <?php if($punyasub == "N") echo "selected";?> >Tidak</option>
								</select>
							</div>
							<div class="form-group col-md-6">
								<label>Tampil</label>
								<select class="form-control" name="tampil">
									<option value="Y" <?php if($tampil == "Y") echo "selected";?> >Ya</option>
									<option value="N" <?php if($tampil == "N") echo "selected";?> >Tidak</option>
								</select>
							</div>

							<div class="form-group">
								<div class="col-md-2">
									<button type="submit" class="btn btn-warning menu-button">Update</button>
									<button type="reset" class="btn btn-danger menu-button">Reset</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>