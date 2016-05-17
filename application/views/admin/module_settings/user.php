
            <div class="page-inner">
                <div class="page-title">
                    <div class="container">
                        <h3>User Settings</h3>
                    </div>
                </div>
                <div id="main-wrapper" class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-white">
                                <div class="panel-heading clearfix">
                                    <h4 class="panel-title">User Table<h4>
                                </div>
                                <div class="panel-body">
                                   <div class="table-responsive">
                                    <table id="example" class="display table" style="width: 100%; cellspacing: 0;">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>UserID</th>
                                                <th>Email</th>
                                                <th>Username</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>No</th>
                                                <th>UserID</th>
                                                <th>Email</th>
                                                <th>Username</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            <?php 
                                            $no = 1;
                                            foreach ($user as $u){?>
                                            <tr>
                                                <td><?php echo $no;?></td>
                                                <td><?php echo $u->user_id;?></td>
                                                <td><?php echo $u->username;?></td>
                                                <td><?php echo $u->email;?></td>
                                            </tr>
                                            <?php $no++; }?>
                                        </tbody>
                                       </table>  
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- Row -->
                </div><!-- Main Wrapper -->
                <div class="page-footer">
                    <div class="container">
                        <p class="no-s">2015 &copy; Modern by Steelcoders.</p>
                    </div>
                </div>
            </div><!-- Page Inner -->
        </main><!-- Page Content -->
        
	

       