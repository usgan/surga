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
					<a href="<?php echo site_url('daftartoko/show/'.$menu.'/'.$submenu)?>" class="btn btn-primary menu-button">Daftar Toko</a>
					<a href="<?php echo site_url('daftartoko/create/'.$menu.'/'.$submenu)?>" class="btn btn-default menu-button">Tambah Toko</a>
				</div>
			</div>
			<div class="panel panel-white">
				<div class="panel-heading">
					Daftar Toko
				</div>
				<div class="panel-body">
					<div class="row">
						<form action="<?php echo site_url('daftartoko/show/'.$menu.'/'.$submenu)?>" method="GET" class="col-md-offset-8 col-md-4" >
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