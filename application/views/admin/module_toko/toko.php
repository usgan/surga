
            <div class="page-inner">
                <div class="page-title">
                    <div class="container">
                        <h3>User Settings</h3>
                    </div>
                </div>
                <div id="main-wrapper" class="container">
                    <div class="row">
                        <div class="col-md-12">
                                            
                            <div class="panel panel-primary">
                                <div class="panel-heading clearfix">
                                    <h4 class="panel-title">Informasi Toko<h4>
                                </div>
                                <div class="panel-body">
                                   <div class="table-responsive">
                                    <table id="example" class="display table" style="width: 100%; cellspacing: 0;">
                                        <thead>
                                            <tr>
                                                <th style="width:3%">No</th>
                                                <th style="width:15%">Pemilik</th>
                                                <th style="width:15%">Nama Toko</th>
                                                <th style="width:25%">Informasi</th>
                                                <th style="width:20%">E-mail</th>
                                                <th style="width:25%">Tanggal Daftar</th>
                                                <th style="width:10%">Action</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th style="width:3%">No</th>
                                                <th style="width:15%">Pemilik</th>
                                                <th style="width:15%">Nama Toko</th>
                                                <th style="width:25%">Informasi</th>
                                                <th style="width:20%">E-mail</th>
                                                <th style="width:25%">Tanggal Daftar</th>
                                                <th style="width:10%">Action</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            <?php 
                                            $no = 1;
                                            foreach ($toko as $t){?>
                                            <tr>
                                                <td><?php echo $no;?></td>
                                                <td><?php echo $t->pemilik;?></td>
                                                <td><?php echo $t->nama_toko;?></td>
                                                <td><?php echo $t->informasi;?></td>
                                                <td><?php echo $t->email;?></td>
                                                <td><?php echo $t->tgl;?></td>
                                                <td class="hidden-xs">
                                                    <button data-toggle="modal" data-target=".modal-update-<?php echo $t->id_toko;?>"><div class="icon-pencil"></div></button>
                                                    <button data-toggle="modal" data-target=".modal-delete-<?php echo $t->id_toko;?>"><div class="icon-close"></div></button>
                                                </td>
                                            </tr>
                                            <?php $no++; }?>
                                        </tbody>
                                       </table>  
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- modal-->
                        <div class="col-md-4">
                            <!-- Large modal -->
                            <button type="button" class="btn btn-success" data-toggle="modal" data-target=".bs-example-modal-lg">Large modal</button>
                        </div>
                        <!-- modal-->
                    </div><!-- Row -->
                </div><!-- Main Wrapper -->
                <div class="page-footer">
                    <div class="container">
                        <p class="no-s">2015 &copy; Modern by Steelcoders.</p>
                    </div>
                </div>
            </div><!-- Page Inner -->
        </main><!-- Page Content -->
       
<!--modal-delete-->
<?php foreach ($toko as $d){?>
<div class="modal fade modal-delete-<?php echo $d->id_toko;?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myLargeModalLabel">Delete Data Toko <?php echo $d->nama_toko?></h4>
            </div>
            <div class="modal-body">
                tes
                <input type="text" name="coba" class="form-control" placeholder="coba">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success">Save changes</button>
            </div>
        </div>
    </div>
</div>
<?php }?>
<!--modal-delete-->        
        
<!--modal-update-->
<?php foreach ($toko as $d){?>
<div class="modal fade modal-update-<?php echo $d->id_toko;?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myLargeModalLabel">Edit Data Toko <?php echo $d->nama_toko?></h4>
            </div>
            <div class="modal-body">
                    <?php echo form_open("toko/update")?>
                            <label class="col-sm-2 control-label">Default</label>
                                <input type="text" class="form-control">
                    <?php form_close()?>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success">Save changes</button>
            </div>
        </div>
    </div>
</div>
<!--modal-update-->
<?php }?>



       