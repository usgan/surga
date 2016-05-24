<div class="page-inner">
    <div class="page-breadcrumb">
        <ol class="breadcrumb container">
            <?php 
                if(isset($breadcrumb)){
                    echo $breadcrumb;
                }else{
                    echo '
                        <li><a href="index-2.html">Home</a></li>
                        <li class="active">Dashboard</li>';
                }
            ?>
        </ol>
    </div>
    <div class="page-title">
        <div class="container">
            <?php 
                if(isset($active)){
                    echo $active;
                }else{
                    echo '<h3>Dashboard</h3>';
                }
            ?>
        </div>
    </div>