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
					<a href="<?php echo site_url('menu/cmpengguna/'.$menu.'/'.$submenu)?>" class="btn btn-primary menu-button">Menu Pengguna</a>
				</div>
			</div>
			<div class="panel panel-white">
				<div class="panel-body">
					<div class="row">
						<form action="<?php echo site_url('menu/acmpengguna')?>" method="POST" class="" id="createupdate" role="form">
							<div class="form-group col-md-6">
								<label>Menu</label>
								<select class="form-control" name="menu">
									<?php

										foreach ($menu_list->result() as $data) {
											echo '<option value="'.$data->id_menu.'"> '.$data->nama_menu.'</option>';
										}
									?>
								</select>
							</div>
							<div class="form-group col-md-6">
								<label>Tingkatan Pengguna</label>
								<select class="form-control" name="tp">
									<?php 
										foreach ($levelp->result() as $data) {
											echo '<option value="'.$data->id_level.'"> '.$data->nama_level.'</option>';
										}
									?>
								</select>
							</div>

							<div class="form-group">
								<div class="col-md-2">
									<button type="submit" class="btn btn-warning menu-button">Tambah</button>
									<button type="reset" class="btn btn-danger menu-button">Reset</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>

		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<div class="panel panel-white">
				<div class="panel-body">
					<div class="row">
						<form action="<?php echo site_url('menu/cmpengguna/'.$menu.'/'.$submenu)?>" method="GET" class="col-md-offset-8 col-md-4" >
	                    	<div class="input-group input-group-sm">
			                    <input class="form-control" type="text" name="cari" value="<?php echo $cari; ?>">
			                    <span class="input-group-btn">
			                      <button class="btn btn-info btn-flat" type="submit">Cari</button>
			                    </span>
		                  	</div>
		                </form>
						<div class="table-responsive col-md-12 table-pad">
							<?php 
								echo $this->table->generate(); 
								echo $this->pagination->create_links();
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>