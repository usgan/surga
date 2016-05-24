<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Fungsi_umum {
    
/* 
 * library fungsi umum (2016-05-18) versi usgan
    bagian getmenu
 */
    var $CI = NULL;
    function __construct()
    {
        // get CI's object
        $this->CI =& get_instance();
    }
    //perintah untuk membuat id baru
    function newgetid(){
        $ip = $this->CI->input->ip_address();
        $ip = str_replace(':','',$ip);
        $ip = str_replace('.','',$ip);
        date_default_timezone_set('Asia/Singapore');
        return date('YmdHis')."".$ip;
    }
    public function setpagination($totalrows,$alamat,$perpage,$segmen){
        $config['base_url'] = $alamat;
        $config['total_rows'] = $totalrows;
        //$config['per_page'] = $perpage;
        $config['uri_segment'] = $segmen;
        
        $config['full_tag_open'] = '<p><ul class="pagination pagination-sm" id="pagination">';
        $config['full_tag_close'] = '</ul></p>';
        
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';

        $config['last_tag_open'] = '<li>'; 
        $config['last_tag_close'] = '</li>';
        
        $config['cur_tag_open'] = '<li ><a style="color:#fff;background-color: #e03e25;border-color: #e03e25;" href="#">';
        $config['cur_tag_close'] = '</a></li>';
        
        $config['next_link'] = '<i class="fa fa-angle-right"></i>';
        $config['prev_link'] = '<i class="fa fa-angle-left"></i>';
        
        $config['next_tag_open'] = '<li class="pagination-next">';
        $config['next_tag_close'] = '</li>';
        
        $config['prev_tag_open'] = '<li class="pagination-prev">';
        $config['prev_tag_close'] = '</li>';
        
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['first_link'] = '<i class="fa fa-angle-double-left"></i>';
        $config['last_link'] = '<i class="fa fa-angle-double-right"></i>';
        $config['page_query_string'] = TRUE;
        $config['num_links'] = 5;
        
        $this->CI->pagination->initialize($config);
    }
    
    public function actionbutton($ac){
            $action = '<div class="input-group-btn" style="width:auto">
                                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Pilihan <span class="caret" style="margin-left:3px"></span></button>
                                    <ul class="dropdown-menu dropdown-menu-right" role="menu">';
                                            if(array_key_exists('detail',$ac)){
                                                    $action = $action.'<li><a href="#">Something else here</a></li>';
                                            }
                                            if(array_key_exists('info',$ac)){
                                                    $action = $action.'<li><a href="'.$ac['info'].'" class="info">Info</a></li>';
                                            }
                                            if(array_key_exists('edit',$ac)){
                                                    $action = $action.'<li><a class="edit" href="'.$ac['edit'].'" target="_blank">Edit</a></li>';
                                            }
                                            if(array_key_exists('hapus',$ac)){
                                                    $action = $action.'<li class="divider"></li>';
                                                    $action = $action.'<li ><a class="hapus" href="'.$ac['hapus'].'" target="_blank">Hapus</a></li>';
                                            }

                                    $action = $action.'</ul>
                            </div>';
            return $action;
    }
    public function getsetting(){
        $arraytable = array (
            'table_open'          => '<table border="0" cellpadding="0" cellspacing="0" class="table table-striped table-bordered table-hover dataTable no-footer" id="example">',

            'heading_row_start'   => '<tr>',
            'heading_row_end'     => '</tr>',
            'heading_cell_start'  => '<th>',
            'heading_cell_end'    => '</th>',

            'row_start'           => '<tr>',
            'row_end'             => '</tr>',
            'cell_start'          => '<td>',
            'cell_end'            => '</td>',

            'row_alt_start'       => '<div class="form-group"><tr>',
            'row_alt_end'         => '</tr></div>',
            'cell_alt_start'      => '<td>',
            'cell_alt_end'        => '</td>',

            'table_close'         => '</table>'
        );
        return $arraytable;
    }

    public function getmenu($menu,$smenu){
        $m = "";
        $level = $this->CI->typeencryption->thirdDecryption($this->CI->session->userdata('levelp'));
        $menu_ = $this->return_menu($level);
        if($menu_->num_rows() > 0){
            $active = "";
            foreach($menu_->result() as $data){
                $active = "";
                if(md5($data->id_menu) == $menu){
                    $active = "active";
                }
                if($data->punyasub == "N"){
                    $m = $m."<li class='".$active."' ><a href='".site_url($data->link.'/'.md5($data->id_menu))."'><span class='".$data->icon."'></span><p>".$data->nama_menu."</p></a></li>";      
                }else{
                    $m = $m."<li class='".$active."' >
                    <a href='#'><span class='".$data->icon."'></span><p>".$data->nama_menu."</p></a><ul class='sub-menu'>";
                    $smenuu = $this->return_smenu($data->id_menu,$level);
                    if($smenuu->num_rows() > 0){
                        foreach($smenuu->result() as $sm){
                            $sactive = "";
                            if(md5($sm->id_smenu) == $smenu){
                                $sactive = "active";
                            }
                            $m = $m."<li class='".$sactive."'><a href='".site_url($sm->link.'/'.md5($data->id_menu).'/'.md5($sm->id_smenu))."'><span class='".$sm->icon."'></span><p>".$sm->nama_smenu."</p></a></li>";
                        }
                    }
                    $m = $m."</ul></li>";
                }
            }
        }
        return $m;
    }

    private function return_menu($lv){
        $this->CI->db->select('tb_menu.id_menu,tb_menu.nama_menu,tb_menu.icon,tb_menu.link,tb_menu.punyasub');
        $this->CI->db->from('tb_menu,tb_lmenu');
        $this->CI->db->where('tb_menu.id_menu = tb_lmenu.id_menu','',false);
        $this->CI->db->where('tb_lmenu.id_level',$lv);
        $this->CI->db->where('tb_menu.tampil','Y');
        $this->CI->db->order_by('tb_menu.urut ASC');
        return $this->CI->db->get();
    }
    private function return_smenu($idmenu,$lv){
        $this->CI->db->select('tb_smenu.id_smenu,tb_smenu.nama_smenu,tb_smenu.icon,tb_smenu.link,tb_smenu.urut');
        $this->CI->db->from('tb_smenu,tb_lsmenu');
        $this->CI->db->where('tb_smenu.id_smenu = tb_lsmenu.id_smenu','',false);
        $this->CI->db->where('tb_lsmenu.id_level',$lv);
        $this->CI->db->where('tb_smenu.id_menu',$idmenu);
        $this->CI->db->where('tb_smenu.tampil','Y');
        $this->CI->db->order_by('urut ASC');
        return $this->CI->db->get();
    }
}