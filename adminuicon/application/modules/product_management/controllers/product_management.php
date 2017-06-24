<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product_management extends MX_Controller{
    public function __construct() {
        parent::__construct();
       if($this->session->userdata('logged_in')==false){
           redirect('login');    
        }
        $this->load->model('mproduct_management');
        $this->load->model('main_model');
    }
    
    function get_filter(){
        $data="";
        $id=$this->input->post('id');
        $val=$this->db->query("select * from filter_category where category_id='$id'")->result();
        foreach($val as $value){
            $data .="<option value='$value->id'>$value->filter_name</option>\n";
        }
        echo $data;
    }
    
    function image_browse(){
        $this->load->view("image_browse");
    }
    
    function index(){
        $this->load->database('desalite',true);
        $this->session->unset_userdata('page_sr');
        $this->session->unset_userdata('product_code_sr');
        $this->session->unset_userdata('product_name_sr');
        $this->session->unset_userdata('category_sr');
        $this->session->unset_userdata('merk_sr');
        $config['base_url'] = base_url().'product_management/index/';
        $config['total_rows'] = $this->db->query("select a.id_product,product_code,product_name,b.name,c.product_category
                                                  from product a
                                                  left join merk b on a.merk = b.id_merk
                                                  left join product_category c on a.product_category = c.id_product_category
                                                  order by a.id_product desc
                                                 ")->num_rows();
        $config['per_page'] = 10;
        $config['num_links'] = 2;
        $config['uri_segment'] = 3;
        $config['first_page'] = 'Awal';
        $config['last_page'] = 'Akhir';
        $config['next_page'] = '&laquo;';
        $config['prev_page'] = '&raquo;';
        $pg = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0 ;
        //inisialisasi config
        $this->pagination->initialize($config);
        //buat pagination
        $data['halaman'] = $this->pagination->create_links();
        //tamplikan data
        $data['total_data']=$this->db->query("select a.id_product,product_code,product_name,b.name,c.product_category
                                                  from product a
                                                  left join merk b on a.merk = b.id_merk
                                                  left join product_category c on a.product_category = c.id_product_category
                                                  order by a.id_product desc
                                                 ")->num_rows();
        $data['data'] = $this->db->query("select a.id_product,product_code,product_name,b.name,c.product_category
                                                  from product a
                                                  left join merk b on a.merk = b.id_merk
                                                  left join product_category c on a.product_category = c.id_product_category
                                                  order by a.id_product desc limit ".$pg.",".$config['per_page']."")->result();
        $data['view']='main';
//        $this->load->view('template',$data);
//        $data['list']=$this->mproduct_management->select_index()->result();
//        $data['view']='main';
        $this->load->view('template',$data);
    }
    
    function search(){
        $this->load->database('desalite',true);
        if($_POST){
            $page_sr = ($this->input->get_post('page_sr')==""?$this->session->unset_userdata('page_sr'):$this->mproduct_management->handler0("page_sr",$this->input->get_post('page_sr', TRUE)));
            $product_code_sr = ($this->input->get_post('product_code_sr')==""?$this->session->unset_userdata('product_code_sr'):$this->mproduct_management->handler0("product_code_sr",$this->input->get_post('product_code_sr', TRUE)));
            $product_name_sr = ($this->input->get_post('product_name_sr')==""?$this->session->unset_userdata('product_name_sr'):$this->mproduct_management->handler0("product_name_sr",$this->input->get_post('product_name_sr', TRUE)));
            $category_sr = ($this->input->get_post('category_sr')==""?$this->session->unset_userdata('category_sr'):$this->mproduct_management->handler0("category_sr",$this->input->get_post('category_sr', TRUE)));
            $merk_sr = ($this->input->get_post('merk_sr')==""?$this->session->unset_userdata('merk_sr'):$this->mproduct_management->handler0("merk_sr",$this->input->get_post('merk_sr', TRUE)));
        }else{
            $page_sr = $this->mproduct_management->handler0("page_sr",$this->input->get_post('page_sr', TRUE));
            $product_code_sr = $this->mproduct_management->handler0("product_code_sr",$this->input->get_post('product_code_sr', TRUE));
            $product_name_sr = $this->mproduct_management->handler0("product_name_sr",$this->input->get_post('product_name_sr', TRUE));
            $category_sr = $this->mproduct_management->handler0("category_sr",$this->input->get_post('category_sr', TRUE));
            $merk_sr = $this->mproduct_management->handler0("merk_sr",$this->input->get_post('merk_sr', TRUE));
        }
        $limit = ($this->uri->segment(3) > 0)?$this->uri->segment(3):0;

        $config['base_url'] = base_url() .'product_management/search';
        $config['total_rows'] = $this->db->query("select a.id_product,product_code,product_name,b.name,c.product_category
                                                  from product a
                                                  left join merk b on a.merk = b.id_merk
                                                  left join product_category c on a.product_category = c.id_product_category
                                                  where a.product_code like '%$product_code_sr%' and a.product_name like '%$product_name_sr%'
                                                  and b.name like '%$merk_sr%' and c.product_category like '%$category_sr%'
                                                  order by a.id_product desc
                                                 ")->num_rows();
        $config['per_page'] = ($page_sr > 0)?$page_sr:10;
        $config['uri_segment'] = 3;
        $choice = $config['total_rows']/$config['per_page'];
        $config['num_links'] = 2;		
        $this->pagination->initialize($config);

        $data['data'] = $this->db->query("select a.id_product,product_code,product_name,b.name,c.product_category
                                                  from product a
                                                  left join merk b on a.merk = b.id_merk
                                                  left join product_category c on a.product_category = c.id_product_category
                                                  where a.product_code like '%$product_code_sr%' and a.product_name like '%$product_name_sr%'
                                                  and b.name like '%$merk_sr%' and c.product_category like '%$category_sr%'
                                                  order by a.id_product desc limit ".$limit.",".$config['per_page']."")->result();
        $data['halaman'] = $this->pagination->create_links();
        $data['total_data']= $this->db->query("select a.id_product,product_code,product_name,b.name,c.product_category
                                                  from product a
                                                  left join merk b on a.merk = b.id_merk
                                                  left join product_category c on a.product_category = c.id_product_category
                                                  where a.product_code like '%$product_code_sr%' and a.product_name like '%$product_name_sr%'
                                                  and b.name like '%$merk_sr%' and c.product_category like '%$category_sr%'
                                                  order by a.id_product desc")->num_rows();
        $data['product_code_sr'] = $product_code_sr;
        $data['product_name_sr'] = $product_name_sr;
        $data['category_sr'] = $category_sr;
        $data['merk_sr'] = $merk_sr;
        $data['page_sr'] = $page_sr;
        $data['view']='search';
        $this->load->view('template',$data);
    }
    
    function get_value(){
        $data="";
        $id=$this->input->post('id');
        $valx=$this->mproduct_management->select_where('t_value',$id)->result();
        $data .= "<option value=''>--pilih--</option>";
        foreach($valx as $valuex){
            $data .="<option value='$valuex->id'>$valuex->value_name</option>\n";
        }
        echo $data;
    }
    
    function add($posisi){
        $this->load->database('desalite',true);
        $data['category']=$this->db->query("select * from product_category order by id_product_category desc")->result();
        $data['merk']=$this->db->query("select * from merk order by id_merk desc")->result();
        $data['type']=$this->db->query("select * from type_material order by id_type_material desc")->result();
        $data['unit']=$this->db->query("select * from unit_measure order by id_unit_measure desc")->result();
        $data['posisi']=$posisi;
        $data['view']='add';
        $this->load->view('template',$data);
    }
    
    function update($id,$posisi){
        $this->load->database('desalite',true);
        $data['detail']=$this->db->query("select * from product where id_product='$id'")->row();
        $data['category']=$this->db->query("select * from product_category order by id_product_category desc")->result();
        $data['merk']=$this->db->query("select * from merk order by id_merk desc")->result();
        $data['type']=$this->db->query("select * from type_material order by id_type_material desc")->result();
        $data['unit']=$this->db->query("select * from unit_measure order by id_unit_measure desc")->result();
        $data['image']=$this->db->query("select * from product_images where product_general_id='$id'")->row();
        $data['posisi']=$posisi;
        $data['view']='edit';
        $this->load->view('template',$data);
    }
    
    function add_proses(){
        $this->load->database('desalite',true);
        error_reporting(0);
        $posisi=$this->input->post('posisi');
        $session=$this->session->userdata('logged_in');
        $datex=  gmdate("Y-m-d H:i:s", time()+60*60*7);
        $product_name=$this->input->post('product_name');
        $product_code=$this->input->post('product_code');
        $keyword=$this->input->post('keyword');
        $product_category=$this->input->post('product_category');
        $product_type=$this->input->post('product_type');
        $product_merk=$this->input->post('product_merk');
        $product_description=$this->input->post('description');
        $hot_product=$this->input->post('hot_product');
        $exclusive_product=$this->input->post('exclusive_product');
        $product_active=$this->input->post('product_active');
        $stock_status=$this->input->post('stock_status');

        $normal_price=$this->input->post('normal_price');
        $special_price=$this->input->post('special_price');
        $afiliasi_price=$this->input->post('afiliasi_price');
        $reseller_quota=$this->input->post('reseller_quota');
        $reseller_price=$this->input->post('reseller_price');
        $product_unit=$this->input->post('product_unit');
        $product_finish=$this->input->post('product_finish');
        $product_valuation=$this->input->post('product_valuation');
        $product_service=$this->input->post('product_service');
        $product_weight=str_replace(",",".",$this->input->post('product_weight'));
        $product_volume=$this->input->post('product_volume');
        $cod=$this->input->post('cod');
        $ppn=$this->input->post('ppn');
        $delivery_time=$this->input->post('estimasi');
        $guaranted=$this->input->post('guaranted');
        $contact_product=$this->input->post('contact_product');
        
        $image1=$this->input->post('image1');
        $image2=$this->input->post('image2');
        $image3=$this->input->post('image3');
        $image4=$this->input->post('image4');
        $image5=$this->input->post('image5');
        $image6=$this->input->post('image6');
        
        $overview=$this->input->post('overview');
        $spesifikasi=$this->input->post('spesifikasi');
        $other_information=$this->input->post('other_information');
        $rating_popular=$this->input->post('rating_popular');
        $rating_price=$this->input->post('rating_price');
                           
        $data_gen=array(
            'product_code'=>$product_code,
            'keyword'=>$keyword,
            'product_category'=>$product_category,
            'product_name'=>$product_name,
            'type'=>$product_type,
            'merk'=>$product_merk,
            'description'=>$product_description,
            'is_service'=>$product_service,
            'is_active'=>$product_service,
            'stock_status'=>$stock_status,
            'unit'=>$product_unit,
            'is_finish_product'=>$product_finish,
            'cost_price'=>$normal_price,
            'hot_product'=>$hot_product,
            'exclusive_product'=>$exclusive_product,
            'special_price'=>$special_price,
            'afiliasi_price'=>$afiliasi_price,
            'is_material_valuation'=>$product_valuation,
            'weight'=>$product_weight,
            'volume'=>$product_volume,
            'reseller_quota'=>$reseller_quota,
            'reseller_price'=>$reseller_price,
            'overview'=>$overview,
            'spesifikasi'=>$spesifikasi,
            'other_information'=>$other_information,
            'cod'=>$cod,
            'ppn'=>$ppn,
            'delivery_time'=>$delivery_time,
            'guaranted'=>$guaranted,
            'contact_product'=>$contact_product,
            'rating_popular'=>$rating_popular,
            'rating_price'=>$rating_price   
        );
        $this->mproduct_management->insert('product',$data_gen);
        
        $idxy = mysql_insert_id();
              
        $dataimage=array(
            'product_general_id'=>$idxy,
            'product_image1'=>$image1,
            'product_image2'=>$image2,
            'product_image3'=>$image3,
            'product_image4'=>$image4,
            'product_image5'=>$image5,
            'product_image6'=>$image6
        );
        $this->mproduct_management->insert('product_images',$dataimage);
        
        redirect('product_management/search/'.$posisi);
    }
    
    function delete($id,$posisi){
        $this->main_model->delete('product_images','product_general_id',$id);
        $this->main_model->delete('product','id_product',$id);
        redirect('product_management/search/'.$posisi);
    }
        
    function update_proses(){
        $this->load->database('desalite',true);
        error_reporting(0);
        $posisi=$this->input->post('posisi');
        $id=$this->input->post('id');
        $session=$this->session->userdata('logged_in');
        $datex=  gmdate("Y-m-d H:i:s", time()+60*60*7);
        $product_name=$this->input->post('product_name');
        $product_code=$this->input->post('product_code');
        $keyword=$this->input->post('keyword');
        $product_category=$this->input->post('product_category');
        $product_type=$this->input->post('product_type');
        $product_merk=$this->input->post('product_merk');
        $product_description=$this->input->post('description');
        $hot_product=$this->input->post('hot_product');
        $exclusive_product=$this->input->post('exclusive_product');
        $product_active=$this->input->post('product_active');
        $stock_status=$this->input->post('stock_status');
        
        $special_price=$this->input->post('special_price');
        $normal_price=$this->input->post('normal_price');
        $afiliasi_price=$this->input->post('afiliasi_price');
        $reseller_quota=$this->input->post('reseller_quota');
        $reseller_price=$this->input->post('reseller_price');
        $product_unit=$this->input->post('product_unit');
        $product_finish=$this->input->post('product_finish');
        $product_valuation=$this->input->post('product_valuation');
        $product_service=$this->input->post('product_service');
        $product_weight=str_replace(",",".",$this->input->post('product_weight'));
        $product_volume=$this->input->post('product_volume');
        $cod=$this->input->post('cod');
        $ppn=$this->input->post('ppn');
        $delivery_time=$this->input->post('estimasi');
        $guaranted=$this->input->post('guaranted');
        $contact_product=$this->input->post('contact_product');
        
        $image1=$this->input->post('image1');
        $image2=$this->input->post('image2');
        $image3=$this->input->post('image3');
        $image4=$this->input->post('image4');
        $image5=$this->input->post('image5');
        $image6=$this->input->post('image6');
        
        $overview=$this->input->post('overview');
        $spesifikasi=$this->input->post('spesifikasi');
        $other_information=$this->input->post('other_information');
        $rating_popular=$this->input->post('rating_popular');
        $rating_price=$this->input->post('rating_price');
                           
        $data_gen=array(
            'product_code'=>$product_code,
            'keyword'=>$keyword,
            'product_category'=>$product_category,
            'product_name'=>$product_name,
            'type'=>$product_type,
            'merk'=>$product_merk,
            'description'=>$product_description,
            'is_service'=>$product_service,
            'is_active'=>$product_service,
            'stock_status'=>$stock_status,
            'unit'=>$product_unit,
            'is_finish_product'=>$product_finish,
            'cost_price'=>$normal_price,
            'hot_product'=>$hot_product,
            'exclusive_product'=>$exclusive_product,
            'special_price'=>$special_price,
            'afiliasi_price'=>$afiliasi_price,
            'is_material_valuation'=>$product_valuation,
            'weight'=>$product_weight,
            'volume'=>$product_volume,
            'special_price'=>$special_price,
            'reseller_quota'=>$reseller_quota,
            'reseller_price'=>$reseller_price,
            'overview'=>$overview,
            'spesifikasi'=>$spesifikasi,
            'other_information'=>$other_information,
            'cod'=>$cod,
            'ppn'=>$ppn,
            'delivery_time'=>$delivery_time,
            'guaranted'=>$guaranted,
            'contact_product'=>$contact_product,
            'rating_popular'=>$rating_popular,
            'rating_price'=>$rating_price
        );
        $this->main_model->update('product','id_product',$id,$data_gen);
              
        $dataimage=array(
            'product_image1'=>$image1,
            'product_image2'=>$image2,
            'product_image3'=>$image3,
            'product_image4'=>$image4,
            'product_image5'=>$image5,
            'product_image6'=>$image6
        );
        $this->main_model->update('product_images','product_general_id',$id,$dataimage);
        
        redirect('product_management/search/'.$posisi);
    }
    
    function batchimport(){
        $data['view']="main_batch";
        $this->load->view('template',$data);
    }
    
    function d_product(){

    $this->load->library("phpexcel/PHPExcel");
    $this->load->library("phpexcel/PHPExcel/IOFactory");

    $data['default'] = $this->db->query("SELECT 
                                        a.id,
                                        a.product_name,
                                        a.product_description,
                                        a.product_category,
                                        a.product_brand,
                                        a.product_theme,
                                        a.product_bestseller,
                                        a.for_men,
                                        a.for_women,
                                        b.sku,
                                        b.stock,
                                        b.normal_price,
                                        b.special_price,
                                        b.date_start,
                                        b.date_end,
                                        b.enam_bulan,
                                        b.duabelas_bulan,
                                        b.case_size,
                                        b.band_width,
                                        b.band_material,
                                        b.dial_type,
                                        b.colour,
                                        b.exterior_material,
                                        b.handle_drop,
                                        b.length,
                                        b.width,
                                        b.height,
                                        b.closure,
                                        b.filter,
                                        b.compartment,
                                        b.crosssells,
                                        b.uppsells,
                                        c.product_image1,
                                        c.product_image2,
                                        c.product_image3,
                                        c.product_image4,
                                        c.product_image5,
                                        c.product_image6
                                        from product_general a
                                        INNER JOIN product_detail b on a.id=b.product_general_id
                                        INNER JOIN product_images c on a.id=c.product_general_id
                                        order by a.id asc")->result_array();

    $excel = new PHPExcel();

    $excel->setActiveSheetIndex(0);

    $page = $excel->getActiveSheet();

    $page->setTitle("Product Urbanicon");

    $header_style = array(
                            "borders" => array(
                                                "allborders" => array(
                                                                        "style" => PHPExcel_Style_Border::BORDER_THIN
                                                )
                            ),
                            "alignment" => array(

                                                "horizontal" => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                                                 "vertical" => PHPExcel_Style_Alignment::VERTICAL_CENTER
                            ),
                            "font" => array(
                                            "bold" => true
                            ),

                            'fill' => array(
                                            'type' => PHPExcel_Style_Fill::FILL_SOLID,
                                            'color' => array('rgb' => '#5bc0de')

                            )
    );

    $body_style_huruf = array(
                                "borders" => array(
                                                    "allborders" => array(
                                                                            "style" => PHPExcel_Style_Border::BORDER_THIN
                                                    )   
                                ),
                                "alignment" => array(
                                                    "horizontal" => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
                                                    "vertical" => PHPExcel_Style_Alignment::VERTICAL_CENTER
                                )
    );

    $italic_center = array(
                            "borders" => array(
                                                "allborders" => array(
                                                                        "style" => PHPExcel_Style_Border::BORDER_THIN
                                                )
                            ),
                            "alignment" => array(
                                                "horizontal" => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                                                "vertical" => PHPExcel_Style_Alignment::VERTICAL_CENTER
                            ),
                            "font" => array(
                                                "italic" => true,
                                                "bold" => false
                            )
    );

    $center = array(
                            "borders" => array(
                                                "allborders" => array(
                                                                        "style" => PHPExcel_Style_Border::BORDER_THIN
                                                )
                            ),
                            "alignment" => array(
                                                "horizontal" => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                                                "vertical" => PHPExcel_Style_Alignment::VERTICAL_CENTER
                            )
    );

    $bordered = array(
                        "borders" => array(
                                            "allborders" => array(
                                            "style" => PHPExcel_Style_Border::BORDER_THIN
                        )
                    )
    );

    $page->getColumnDimension("A")->setWidth(5);
    $a="A";
    for($i=0;$i<=36;$i++){
            $a++;
            $page->getColumnDimension("$a")->setWidth(20);;	
    }
    
    $page->setCellValue("A1","Product ID.");
    $page->mergeCells("A1:A1");
    
    $a="A";
    $abc=array(
	"Product Name",
	"Product Description",
	"Product Category",
	"Product Brand",
	"Product Theme",
	"Product Bestseller",
	"For Men",
	"For Women",
	"SKU",
	"Stock",
	"Normal Price",
	"Special Price",
	"Start Date",
	"End Date",
	"6 Month",
	"12 Month",
	"Case Size",
	"Band Width",
	"Band Material",
	"Dial Type",
	"Colour",
	"Exterior Material",
	"Handle Drop",
	"Lenght",
	"Width",
	"Height",
	"Closure",
	"Compartmen",
	"Crosssels",
	"Uppsells",
	"Image 1(Thumnail)",
	"Image 2",
	"Image 3",
	"Image 4",
	"Image 5",
	"Image 6",
        "Category Filter"
		  );

    for($i=0;$i<=36;$i++){
        $a++;
        $page->setCellValue($a."1",$abc[$i]);
        $page->mergeCells($a."1:".$a."1");
        //echo $a.$abc[$i]."<br/>";	
    }

    $page->getStyle("A1:AL1")->applyFromArray($header_style);

		
    $pos = 2;
    $no=0;

    for($i=0;$i<count($data['default']);$i++){
    $no++;

        $page->setCellValue("A".($i+2), $data['default'][$i]['id']);

        $page->setCellValue("B".($i+2), $data['default'][$i]['product_name']);

        $page->setCellValue("C".($i+2), $data['default'][$i]['product_description']);

        $page->setCellValue("D".($i+2), $data['default'][$i]['product_category']);

        $page->setCellValue("E".($i+2), $data['default'][$i]['product_brand']);

        $page->setCellValue("F".($i+2), $data['default'][$i]['product_theme']);

        $page->setCellValue("G".($i+2), $data['default'][$i]['product_bestseller']);
        
        $page->setCellValue("H".($i+2), $data['default'][$i]['for_men']);
        
        $page->setCellValue("I".($i+2), $data['default'][$i]['for_women']);
        
        $page->setCellValue("J".($i+2), $data['default'][$i]['sku']);
        
        $page->setCellValue("K".($i+2), $data['default'][$i]['stock']);
        
        $page->setCellValue("L".($i+2), $data['default'][$i]['normal_price']);
        
        $page->setCellValue("M".($i+2), $data['default'][$i]['special_price']);
        
        $page->setCellValue("N".($i+2), $data['default'][$i]['date_start']);
        
        $page->setCellValue("O".($i+2), $data['default'][$i]['date_end']);
        
        $page->setCellValue("P".($i+2), $data['default'][$i]['enam_bulan']);
        
        $page->setCellValue("Q".($i+2), $data['default'][$i]['duabelas_bulan']);
        
        $page->setCellValue("R".($i+2), $data['default'][$i]['case_size']);
        
        $page->setCellValue("S".($i+2), $data['default'][$i]['band_width']);
        
        $page->setCellValue("T".($i+2), $data['default'][$i]['band_material']);
        
        $page->setCellValue("U".($i+2), $data['default'][$i]['dial_type']);
        
        $page->setCellValue("V".($i+2), $data['default'][$i]['colour']);
        
        $page->setCellValue("W".($i+2), $data['default'][$i]['exterior_material']);
        
        $page->setCellValue("X".($i+2), $data['default'][$i]['handle_drop']);
        
        $page->setCellValue("Y".($i+2), $data['default'][$i]['length']);
        
        $page->setCellValue("Z".($i+2), $data['default'][$i]['width']);
        
        $page->setCellValue("AA".($i+2), $data['default'][$i]['height']);
        
        $page->setCellValue("AB".($i+2), $data['default'][$i]['closure']);
        
        $page->setCellValue("AC".($i+2), $data['default'][$i]['compartment']);
        
        $page->setCellValue("AD".($i+2), $data['default'][$i]['crosssells']);
        
        $page->setCellValue("AE".($i+2), $data['default'][$i]['uppsells']);
        
        $page->setCellValue("AF".($i+2), $data['default'][$i]['product_image1']);
        
        $page->setCellValue("AG".($i+2), $data['default'][$i]['product_image2']);
        
        $page->setCellValue("AH".($i+2), $data['default'][$i]['product_image3']);
        
        $page->setCellValue("AI".($i+2), $data['default'][$i]['product_image4']);
        
        $page->setCellValue("AJ".($i+2), $data['default'][$i]['product_image5']);
        
        $page->setCellValue("AK".($i+2), $data['default'][$i]['product_image6']);
        
        $page->setCellValue("AL".($i+2), $data['default'][$i]['filter']);

        $pos++;

    }

    $page->getStyle("A1:AL".($pos-1))->applyFromArray($bordered);
 
    $date_export = date('Y-m-d H:i:s');
    $objWriter = IOFactory::createWriter($excel, 'Excel5');
    $objWriter->save("Urbanicon_product.xls");  
    
    redirect ("./Urbanicon_product.xls");
    }
    
    function d_category(){

    $this->load->library("phpexcel/PHPExcel");
    $this->load->library("phpexcel/PHPExcel/IOFactory");

    $data['default'] = $this->db->query("SELECT 
                                        id,
                                        product_category_name,
                                        product_category_description,
                                        product_category_child_id,
                                        product_category_images,
                                        product_category_status
                                        from product_category
                                        order by id asc")->result_array();

    $excel = new PHPExcel();

    $excel->setActiveSheetIndex(0);

    $page = $excel->getActiveSheet();

    $page->setTitle("Product Category Urbanicon");

    $header_style = array(
                            "borders" => array(
                                                "allborders" => array(
                                                                        "style" => PHPExcel_Style_Border::BORDER_THIN
                                                )
                            ),
                            "alignment" => array(

                                                "horizontal" => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                                                 "vertical" => PHPExcel_Style_Alignment::VERTICAL_CENTER
                            ),
                            "font" => array(
                                            "bold" => true
                            ),

                            'fill' => array(
                                            'type' => PHPExcel_Style_Fill::FILL_SOLID,
                                            'color' => array('rgb' => '#5bc0de')

                            )
    );

    $body_style_huruf = array(
                                "borders" => array(
                                                    "allborders" => array(
                                                                            "style" => PHPExcel_Style_Border::BORDER_THIN
                                                    )   
                                ),
                                "alignment" => array(
                                                    "horizontal" => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
                                                    "vertical" => PHPExcel_Style_Alignment::VERTICAL_CENTER
                                )
    );

    $italic_center = array(
                            "borders" => array(
                                                "allborders" => array(
                                                                        "style" => PHPExcel_Style_Border::BORDER_THIN
                                                )
                            ),
                            "alignment" => array(
                                                "horizontal" => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                                                "vertical" => PHPExcel_Style_Alignment::VERTICAL_CENTER
                            ),
                            "font" => array(
                                                "italic" => true,
                                                "bold" => false
                            )
    );

    $center = array(
                            "borders" => array(
                                                "allborders" => array(
                                                                        "style" => PHPExcel_Style_Border::BORDER_THIN
                                                )
                            ),
                            "alignment" => array(
                                                "horizontal" => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                                                "vertical" => PHPExcel_Style_Alignment::VERTICAL_CENTER
                            )
    );

    $bordered = array(
                        "borders" => array(
                                            "allborders" => array(
                                            "style" => PHPExcel_Style_Border::BORDER_THIN
                        )
                    )
    );

    $page->getColumnDimension("A")->setWidth(5);
    $a="A";
    for($i=0;$i<=4;$i++){
            $a++;
            $page->getColumnDimension("$a")->setWidth(20);;	
    }
    
    $page->setCellValue("A1","Category ID.");
    $page->mergeCells("A1:A1");
    
    $a="A";
    $abc=array(
	"Category Name",
	"Category Description",
	"Category Images",
        "Category Child ID",
	"Category Status"
    );

    for($i=0;$i<=4;$i++){
        $a++;
        $page->setCellValue($a."1",$abc[$i]);
        $page->mergeCells($a."1:".$a."1");
        //echo $a.$abc[$i]."<br/>";	
    }

    $page->getStyle("A1:F1")->applyFromArray($header_style);

		
    $pos = 2;
    $no=0;

    for($i=0;$i<count($data['default']);$i++){
    $no++;

        $page->setCellValue("A".($i+2), $data['default'][$i]['id']);

        $page->setCellValue("B".($i+2), $data['default'][$i]['product_category_name']);

        $page->setCellValue("C".($i+2), $data['default'][$i]['product_category_description']);

        $page->setCellValue("D".($i+2), $data['default'][$i]['product_category_images']);

        $page->setCellValue("E".($i+2), $data['default'][$i]['product_category_child_id']);

        $page->setCellValue("F".($i+2), $data['default'][$i]['product_category_status']);

        $pos++;

    }

    $page->getStyle("A1:F".($pos-1))->applyFromArray($bordered);
 
    $date_export = date('Y-m-d H:i:s');
    $objWriter = IOFactory::createWriter($excel, 'Excel5');
    $objWriter->save("Urbanicon_product_category.xls");  
    
    redirect ("./Urbanicon_product_category.xls");
    }
    
    function d_brand(){

    $this->load->library("phpexcel/PHPExcel");
    $this->load->library("phpexcel/PHPExcel/IOFactory");

    $data['default'] = $this->db->query("SELECT 
                                        id,
                                        brand_name,
                                        brand_description,
                                        brand_images,
                                        status,
                                        brand_child_id
                                        from brand
                                        order by id asc")->result_array();

    $excel = new PHPExcel();

    $excel->setActiveSheetIndex(0);

    $page = $excel->getActiveSheet();

    $page->setTitle("Product Category Urbanicon");

    $header_style = array(
                            "borders" => array(
                                                "allborders" => array(
                                                                        "style" => PHPExcel_Style_Border::BORDER_THIN
                                                )
                            ),
                            "alignment" => array(

                                                "horizontal" => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                                                 "vertical" => PHPExcel_Style_Alignment::VERTICAL_CENTER
                            ),
                            "font" => array(
                                            "bold" => true
                            ),

                            'fill' => array(
                                            'type' => PHPExcel_Style_Fill::FILL_SOLID,
                                            'color' => array('rgb' => '#5bc0de')

                            )
    );

    $body_style_huruf = array(
                                "borders" => array(
                                                    "allborders" => array(
                                                                            "style" => PHPExcel_Style_Border::BORDER_THIN
                                                    )   
                                ),
                                "alignment" => array(
                                                    "horizontal" => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
                                                    "vertical" => PHPExcel_Style_Alignment::VERTICAL_CENTER
                                )
    );

    $italic_center = array(
                            "borders" => array(
                                                "allborders" => array(
                                                                        "style" => PHPExcel_Style_Border::BORDER_THIN
                                                )
                            ),
                            "alignment" => array(
                                                "horizontal" => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                                                "vertical" => PHPExcel_Style_Alignment::VERTICAL_CENTER
                            ),
                            "font" => array(
                                                "italic" => true,
                                                "bold" => false
                            )
    );

    $center = array(
                            "borders" => array(
                                                "allborders" => array(
                                                                        "style" => PHPExcel_Style_Border::BORDER_THIN
                                                )
                            ),
                            "alignment" => array(
                                                "horizontal" => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                                                "vertical" => PHPExcel_Style_Alignment::VERTICAL_CENTER
                            )
    );

    $bordered = array(
                        "borders" => array(
                                            "allborders" => array(
                                            "style" => PHPExcel_Style_Border::BORDER_THIN
                        )
                    )
    );

    $page->getColumnDimension("A")->setWidth(5);
    $a="A";
    for($i=0;$i<=4;$i++){
            $a++;
            $page->getColumnDimension("$a")->setWidth(20);;	
    }
    
    $page->setCellValue("A1","Brand ID.");
    $page->mergeCells("A1:A1");
    
    $a="A";
    $abc=array(
	"Brand Name",
	"Brand Description",
	"Brand Images",
	"Brand Status",
        "Category Child ID"
    );

    for($i=0;$i<=4;$i++){
        $a++;
        $page->setCellValue($a."1",$abc[$i]);
        $page->mergeCells($a."1:".$a."1");
        //echo $a.$abc[$i]."<br/>";	
    }

    $page->getStyle("A1:F1")->applyFromArray($header_style);

		
    $pos = 2;
    $no=0;

    for($i=0;$i<count($data['default']);$i++){
    $no++;

        $page->setCellValue("A".($i+2), $data['default'][$i]['id']);

        $page->setCellValue("B".($i+2), $data['default'][$i]['brand_name']);

        $page->setCellValue("C".($i+2), $data['default'][$i]['brand_description']);

        $page->setCellValue("D".($i+2), $data['default'][$i]['brand_images']);

        $page->setCellValue("E".($i+2), $data['default'][$i]['status']);

        $page->setCellValue("F".($i+2), $data['default'][$i]['brand_child_id']);

        $pos++;

    }

    $page->getStyle("A1:F".($pos-1))->applyFromArray($bordered);
 
    $date_export = date('Y-m-d H:i:s');
    $objWriter = IOFactory::createWriter($excel, 'Excel5');
    $objWriter->save("Urbanicon_product_brand.xls");  
    
    redirect ("./Urbanicon_product_brand.xls");
    }
    
    function d_pick(){

    $this->load->library("phpexcel/PHPExcel");
    $this->load->library("phpexcel/PHPExcel/IOFactory");

    $data['default'] = $this->db->query("SELECT 
                                        id,
                                        theme_name,
                                        theme_description,
                                        theme_images,
                                        status
                                        from editorpick
                                        order by id asc")->result_array();

    $excel = new PHPExcel();

    $excel->setActiveSheetIndex(0);

    $page = $excel->getActiveSheet();

    $page->setTitle("Product Category Urbanicon");

    $header_style = array(
                            "borders" => array(
                                                "allborders" => array(
                                                                        "style" => PHPExcel_Style_Border::BORDER_THIN
                                                )
                            ),
                            "alignment" => array(

                                                "horizontal" => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                                                 "vertical" => PHPExcel_Style_Alignment::VERTICAL_CENTER
                            ),
                            "font" => array(
                                            "bold" => true
                            ),

                            'fill' => array(
                                            'type' => PHPExcel_Style_Fill::FILL_SOLID,
                                            'color' => array('rgb' => '#5bc0de')

                            )
    );

    $body_style_huruf = array(
                                "borders" => array(
                                                    "allborders" => array(
                                                                            "style" => PHPExcel_Style_Border::BORDER_THIN
                                                    )   
                                ),
                                "alignment" => array(
                                                    "horizontal" => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
                                                    "vertical" => PHPExcel_Style_Alignment::VERTICAL_CENTER
                                )
    );

    $italic_center = array(
                            "borders" => array(
                                                "allborders" => array(
                                                                        "style" => PHPExcel_Style_Border::BORDER_THIN
                                                )
                            ),
                            "alignment" => array(
                                                "horizontal" => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                                                "vertical" => PHPExcel_Style_Alignment::VERTICAL_CENTER
                            ),
                            "font" => array(
                                                "italic" => true,
                                                "bold" => false
                            )
    );

    $center = array(
                            "borders" => array(
                                                "allborders" => array(
                                                                        "style" => PHPExcel_Style_Border::BORDER_THIN
                                                )
                            ),
                            "alignment" => array(
                                                "horizontal" => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                                                "vertical" => PHPExcel_Style_Alignment::VERTICAL_CENTER
                            )
    );

    $bordered = array(
                        "borders" => array(
                                            "allborders" => array(
                                            "style" => PHPExcel_Style_Border::BORDER_THIN
                        )
                    )
    );

    $page->getColumnDimension("A")->setWidth(5);
    $a="A";
    for($i=0;$i<=4;$i++){
            $a++;
            $page->getColumnDimension("$a")->setWidth(20);;	
    }
    
    $page->setCellValue("A1","Theme ID.");
    $page->mergeCells("A1:A1");
    
    $a="A";
    $abc=array(
	"Theme Name",
	"Theme Description",
	"Theme Images",
	"Theme Status"
    );

    for($i=0;$i<=3;$i++){
        $a++;
        $page->setCellValue($a."1",$abc[$i]);
        $page->mergeCells($a."1:".$a."1");
        //echo $a.$abc[$i]."<br/>";	
    }

    $page->getStyle("A1:E1")->applyFromArray($header_style);

		
    $pos = 2;
    $no=0;

    for($i=0;$i<count($data['default']);$i++){
    $no++;

        $page->setCellValue("A".($i+2), $data['default'][$i]['id']);

        $page->setCellValue("B".($i+2), $data['default'][$i]['theme_name']);

        $page->setCellValue("C".($i+2), $data['default'][$i]['theme_description']);

        $page->setCellValue("D".($i+2), $data['default'][$i]['theme_images']);

        $page->setCellValue("E".($i+2), $data['default'][$i]['status']);

        $pos++;

    }

    $page->getStyle("A1:E".($pos-1))->applyFromArray($bordered);
 
    $date_export = date('Y-m-d H:i:s');
    $objWriter = IOFactory::createWriter($excel, 'Excel5');
    $objWriter->save("Urbanicon_editor_pick.xls");  
    
    redirect ("./Urbanicon_editor_pick.xls");
    }
    
    function d_material(){

    $this->load->library("phpexcel/PHPExcel");
    $this->load->library("phpexcel/PHPExcel/IOFactory");

    $data['default'] = $this->db->query("SELECT 
                                        id,
                                        bandmaterial_name,
                                        status
                                        from t_bandmaterial
                                        order by id asc")->result_array();

    $excel = new PHPExcel();

    $excel->setActiveSheetIndex(0);

    $page = $excel->getActiveSheet();

    $page->setTitle("Product Category Urbanicon");

    $header_style = array(
                            "borders" => array(
                                                "allborders" => array(
                                                                        "style" => PHPExcel_Style_Border::BORDER_THIN
                                                )
                            ),
                            "alignment" => array(

                                                "horizontal" => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                                                 "vertical" => PHPExcel_Style_Alignment::VERTICAL_CENTER
                            ),
                            "font" => array(
                                            "bold" => true
                            ),

                            'fill' => array(
                                            'type' => PHPExcel_Style_Fill::FILL_SOLID,
                                            'color' => array('rgb' => '#5bc0de')

                            )
    );

    $body_style_huruf = array(
                                "borders" => array(
                                                    "allborders" => array(
                                                                            "style" => PHPExcel_Style_Border::BORDER_THIN
                                                    )   
                                ),
                                "alignment" => array(
                                                    "horizontal" => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
                                                    "vertical" => PHPExcel_Style_Alignment::VERTICAL_CENTER
                                )
    );

    $italic_center = array(
                            "borders" => array(
                                                "allborders" => array(
                                                                        "style" => PHPExcel_Style_Border::BORDER_THIN
                                                )
                            ),
                            "alignment" => array(
                                                "horizontal" => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                                                "vertical" => PHPExcel_Style_Alignment::VERTICAL_CENTER
                            ),
                            "font" => array(
                                                "italic" => true,
                                                "bold" => false
                            )
    );

    $center = array(
                            "borders" => array(
                                                "allborders" => array(
                                                                        "style" => PHPExcel_Style_Border::BORDER_THIN
                                                )
                            ),
                            "alignment" => array(
                                                "horizontal" => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                                                "vertical" => PHPExcel_Style_Alignment::VERTICAL_CENTER
                            )
    );

    $bordered = array(
                        "borders" => array(
                                            "allborders" => array(
                                            "style" => PHPExcel_Style_Border::BORDER_THIN
                        )
                    )
    );

    $page->getColumnDimension("A")->setWidth(5);
    $a="A";
    for($i=0;$i<=2;$i++){
            $a++;
            $page->getColumnDimension("$a")->setWidth(20);;	
    }
    
    $page->setCellValue("A1","Bandmaterial ID.");
    $page->mergeCells("A1:A1");
    
    $a="A";
    $abc=array(
	"Bandmaterial Name",
	"Bandmaterial Status"
    );

    for($i=0;$i<=1;$i++){
        $a++;
        $page->setCellValue($a."1",$abc[$i]);
        $page->mergeCells($a."1:".$a."1");
        //echo $a.$abc[$i]."<br/>";	
    }

    $page->getStyle("A1:C1")->applyFromArray($header_style);

		
    $pos = 2;
    $no=0;

    for($i=0;$i<count($data['default']);$i++){
    $no++;

        $page->setCellValue("A".($i+2), $data['default'][$i]['id']);

        $page->setCellValue("B".($i+2), $data['default'][$i]['bandmaterial_name']);

        $page->setCellValue("C".($i+2), $data['default'][$i]['status']);

        $pos++;

    }

    $page->getStyle("A1:C".($pos-1))->applyFromArray($bordered);
 
    $date_export = date('Y-m-d H:i:s');
    $objWriter = IOFactory::createWriter($excel, 'Excel5');
    $objWriter->save("Urbanicon_bandmaterial.xls");  
    
    redirect ("./Urbanicon_bandmaterial.xls");
    }
    
    function d_type(){

    $this->load->library("phpexcel/PHPExcel");
    $this->load->library("phpexcel/PHPExcel/IOFactory");

    $data['default'] = $this->db->query("SELECT 
                                        id,
                                        dialtype_name,
                                        status
                                        from t_dialtype
                                        order by id asc")->result_array();

    $excel = new PHPExcel();

    $excel->setActiveSheetIndex(0);

    $page = $excel->getActiveSheet();

    $page->setTitle("Product Category Urbanicon");

    $header_style = array(
                            "borders" => array(
                                                "allborders" => array(
                                                                        "style" => PHPExcel_Style_Border::BORDER_THIN
                                                )
                            ),
                            "alignment" => array(

                                                "horizontal" => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                                                 "vertical" => PHPExcel_Style_Alignment::VERTICAL_CENTER
                            ),
                            "font" => array(
                                            "bold" => true
                            ),

                            'fill' => array(
                                            'type' => PHPExcel_Style_Fill::FILL_SOLID,
                                            'color' => array('rgb' => '#5bc0de')

                            )
    );

    $body_style_huruf = array(
                                "borders" => array(
                                                    "allborders" => array(
                                                                            "style" => PHPExcel_Style_Border::BORDER_THIN
                                                    )   
                                ),
                                "alignment" => array(
                                                    "horizontal" => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
                                                    "vertical" => PHPExcel_Style_Alignment::VERTICAL_CENTER
                                )
    );

    $italic_center = array(
                            "borders" => array(
                                                "allborders" => array(
                                                                        "style" => PHPExcel_Style_Border::BORDER_THIN
                                                )
                            ),
                            "alignment" => array(
                                                "horizontal" => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                                                "vertical" => PHPExcel_Style_Alignment::VERTICAL_CENTER
                            ),
                            "font" => array(
                                                "italic" => true,
                                                "bold" => false
                            )
    );

    $center = array(
                            "borders" => array(
                                                "allborders" => array(
                                                                        "style" => PHPExcel_Style_Border::BORDER_THIN
                                                )
                            ),
                            "alignment" => array(
                                                "horizontal" => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                                                "vertical" => PHPExcel_Style_Alignment::VERTICAL_CENTER
                            )
    );

    $bordered = array(
                        "borders" => array(
                                            "allborders" => array(
                                            "style" => PHPExcel_Style_Border::BORDER_THIN
                        )
                    )
    );

    $page->getColumnDimension("A")->setWidth(5);
    $a="A";
    for($i=0;$i<=2;$i++){
            $a++;
            $page->getColumnDimension("$a")->setWidth(20);;	
    }
    
    $page->setCellValue("A1","Dialtype ID.");
    $page->mergeCells("A1:A1");
    
    $a="A";
    $abc=array(
	"Dialtype Name",
	"Dialtype Status"
    );

    for($i=0;$i<=1;$i++){
        $a++;
        $page->setCellValue($a."1",$abc[$i]);
        $page->mergeCells($a."1:".$a."1");
        //echo $a.$abc[$i]."<br/>";	
    }

    $page->getStyle("A1:C1")->applyFromArray($header_style);

		
    $pos = 2;
    $no=0;

    for($i=0;$i<count($data['default']);$i++){
    $no++;

        $page->setCellValue("A".($i+2), $data['default'][$i]['id']);

        $page->setCellValue("B".($i+2), $data['default'][$i]['dialtype_name']);

        $page->setCellValue("C".($i+2), $data['default'][$i]['status']);

        $pos++;

    }

    $page->getStyle("A1:C".($pos-1))->applyFromArray($bordered);
 
    $date_export = date('Y-m-d H:i:s');
    $objWriter = IOFactory::createWriter($excel, 'Excel5');
    $objWriter->save("Urbanicon_dialtype.xls");  
    
    redirect ("./Urbanicon_dialtype.xls");
    }
    
    function d_colour(){

    $this->load->library("phpexcel/PHPExcel");
    $this->load->library("phpexcel/PHPExcel/IOFactory");

    $data['default'] = $this->db->query("SELECT 
                                        id,
                                        color_name,
                                        color_code,
                                        color_image,
                                        status
                                        from t_color
                                        order by id asc")->result_array();

    $excel = new PHPExcel();

    $excel->setActiveSheetIndex(0);

    $page = $excel->getActiveSheet();

    $page->setTitle("Product Category Urbanicon");

    $header_style = array(
                            "borders" => array(
                                                "allborders" => array(
                                                                        "style" => PHPExcel_Style_Border::BORDER_THIN
                                                )
                            ),
                            "alignment" => array(

                                                "horizontal" => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                                                 "vertical" => PHPExcel_Style_Alignment::VERTICAL_CENTER
                            ),
                            "font" => array(
                                            "bold" => true
                            ),

                            'fill' => array(
                                            'type' => PHPExcel_Style_Fill::FILL_SOLID,
                                            'color' => array('rgb' => '#5bc0de')

                            )
    );

    $body_style_huruf = array(
                                "borders" => array(
                                                    "allborders" => array(
                                                                            "style" => PHPExcel_Style_Border::BORDER_THIN
                                                    )   
                                ),
                                "alignment" => array(
                                                    "horizontal" => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
                                                    "vertical" => PHPExcel_Style_Alignment::VERTICAL_CENTER
                                )
    );

    $italic_center = array(
                            "borders" => array(
                                                "allborders" => array(
                                                                        "style" => PHPExcel_Style_Border::BORDER_THIN
                                                )
                            ),
                            "alignment" => array(
                                                "horizontal" => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                                                "vertical" => PHPExcel_Style_Alignment::VERTICAL_CENTER
                            ),
                            "font" => array(
                                                "italic" => true,
                                                "bold" => false
                            )
    );

    $center = array(
                            "borders" => array(
                                                "allborders" => array(
                                                                        "style" => PHPExcel_Style_Border::BORDER_THIN
                                                )
                            ),
                            "alignment" => array(
                                                "horizontal" => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                                                "vertical" => PHPExcel_Style_Alignment::VERTICAL_CENTER
                            )
    );

    $bordered = array(
                        "borders" => array(
                                            "allborders" => array(
                                            "style" => PHPExcel_Style_Border::BORDER_THIN
                        )
                    )
    );

    $page->getColumnDimension("A")->setWidth(5);
    $a="A";
    for($i=0;$i<=4;$i++){
            $a++;
            $page->getColumnDimension("$a")->setWidth(20);;	
    }
    
    $page->setCellValue("A1","Colour ID.");
    $page->mergeCells("A1:A1");
    
    $a="A";
    $abc=array(
	"Colour Name",
	"Colour Code",
        "Colour Image",
        "Status"
    );

    for($i=0;$i<=3;$i++){
        $a++;
        $page->setCellValue($a."1",$abc[$i]);
        $page->mergeCells($a."1:".$a."1");
        //echo $a.$abc[$i]."<br/>";	
    }

    $page->getStyle("A1:E1")->applyFromArray($header_style);

		
    $pos = 2;
    $no=0;

    for($i=0;$i<count($data['default']);$i++){
    $no++;

        $page->setCellValue("A".($i+2), $data['default'][$i]['id']);

        $page->setCellValue("B".($i+2), $data['default'][$i]['color_name']);

        $page->setCellValue("C".($i+2), $data['default'][$i]['color_code']);
        
        $page->setCellValue("D".($i+2), $data['default'][$i]['color_image']);
        
        $page->setCellValue("E".($i+2), $data['default'][$i]['status']);

        $pos++;

    }

    $page->getStyle("A1:E".($pos-1))->applyFromArray($bordered);
 
    $date_export = date('Y-m-d H:i:s');
    $objWriter = IOFactory::createWriter($excel, 'Excel5');
    $objWriter->save("Urbanicon_color.xls");  
    
    redirect ("./Urbanicon_color.xls");
    }
    
    function d_exterior(){

    $this->load->library("phpexcel/PHPExcel");
    $this->load->library("phpexcel/PHPExcel/IOFactory");

    $data['default'] = $this->db->query("SELECT 
                                        id,
                                        exteriormaterial_name,
                                        status
                                        from t_exteriormaterial
                                        order by id asc")->result_array();

    $excel = new PHPExcel();

    $excel->setActiveSheetIndex(0);

    $page = $excel->getActiveSheet();

    $page->setTitle("Exterior Material");

    $header_style = array(
                            "borders" => array(
                                                "allborders" => array(
                                                                        "style" => PHPExcel_Style_Border::BORDER_THIN
                                                )
                            ),
                            "alignment" => array(

                                                "horizontal" => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                                                 "vertical" => PHPExcel_Style_Alignment::VERTICAL_CENTER
                            ),
                            "font" => array(
                                            "bold" => true
                            ),

                            'fill' => array(
                                            'type' => PHPExcel_Style_Fill::FILL_SOLID,
                                            'color' => array('rgb' => '#5bc0de')

                            )
    );

    $body_style_huruf = array(
                                "borders" => array(
                                                    "allborders" => array(
                                                                            "style" => PHPExcel_Style_Border::BORDER_THIN
                                                    )   
                                ),
                                "alignment" => array(
                                                    "horizontal" => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
                                                    "vertical" => PHPExcel_Style_Alignment::VERTICAL_CENTER
                                )
    );

    $italic_center = array(
                            "borders" => array(
                                                "allborders" => array(
                                                                        "style" => PHPExcel_Style_Border::BORDER_THIN
                                                )
                            ),
                            "alignment" => array(
                                                "horizontal" => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                                                "vertical" => PHPExcel_Style_Alignment::VERTICAL_CENTER
                            ),
                            "font" => array(
                                                "italic" => true,
                                                "bold" => false
                            )
    );

    $center = array(
                            "borders" => array(
                                                "allborders" => array(
                                                                        "style" => PHPExcel_Style_Border::BORDER_THIN
                                                )
                            ),
                            "alignment" => array(
                                                "horizontal" => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                                                "vertical" => PHPExcel_Style_Alignment::VERTICAL_CENTER
                            )
    );

    $bordered = array(
                        "borders" => array(
                                            "allborders" => array(
                                            "style" => PHPExcel_Style_Border::BORDER_THIN
                        )
                    )
    );

    $page->getColumnDimension("A")->setWidth(5);
    $a="A";
    for($i=0;$i<=2;$i++){
            $a++;
            $page->getColumnDimension("$a")->setWidth(20);;	
    }
    
    $page->setCellValue("A1","Exteriormaterial ID.");
    $page->mergeCells("A1:A1");
    
    $a="A";
    $abc=array(
	"Exteriormaterial Name",
        "Status"
    );

    for($i=0;$i<=1;$i++){
        $a++;
        $page->setCellValue($a."1",$abc[$i]);
        $page->mergeCells($a."1:".$a."1");
        //echo $a.$abc[$i]."<br/>";	
    }

    $page->getStyle("A1:C1")->applyFromArray($header_style);

		
    $pos = 2;
    $no=0;

    for($i=0;$i<count($data['default']);$i++){
    $no++;

        $page->setCellValue("A".($i+2), $data['default'][$i]['id']);

        $page->setCellValue("B".($i+2), $data['default'][$i]['exteriormaterial_name']);

        $page->setCellValue("C".($i+2), $data['default'][$i]['status']);

        $pos++;

    }

    $page->getStyle("A1:C".($pos-1))->applyFromArray($bordered);
 
    $date_export = date('Y-m-d H:i:s');
    $objWriter = IOFactory::createWriter($excel, 'Excel5');
    $objWriter->save("Urbanicon_exteriormaterial.xls");  
    
    redirect ("./Urbanicon_exteriormaterial.xls");
    }
    
    function d_shop(){

    $this->load->library("phpexcel/PHPExcel");
    $this->load->library("phpexcel/PHPExcel/IOFactory");

    $data['default'] = $this->db->query("SELECT 
                                        a.*,b.product_category_name
                                        from filter_category a
                                        left join product_category b on a.category_id=b.id
                                        order by a.id asc")->result_array();

    $excel = new PHPExcel();

    $excel->setActiveSheetIndex(0);

    $page = $excel->getActiveSheet();

    $page->setTitle("Exterior Material");

    $header_style = array(
                            "borders" => array(
                                                "allborders" => array(
                                                                        "style" => PHPExcel_Style_Border::BORDER_THIN
                                                )
                            ),
                            "alignment" => array(

                                                "horizontal" => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                                                 "vertical" => PHPExcel_Style_Alignment::VERTICAL_CENTER
                            ),
                            "font" => array(
                                            "bold" => true
                            ),

                            'fill' => array(
                                            'type' => PHPExcel_Style_Fill::FILL_SOLID,
                                            'color' => array('rgb' => '#5bc0de')

                            )
    );

    $body_style_huruf = array(
                                "borders" => array(
                                                    "allborders" => array(
                                                                            "style" => PHPExcel_Style_Border::BORDER_THIN
                                                    )   
                                ),
                                "alignment" => array(
                                                    "horizontal" => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
                                                    "vertical" => PHPExcel_Style_Alignment::VERTICAL_CENTER
                                )
    );

    $italic_center = array(
                            "borders" => array(
                                                "allborders" => array(
                                                                        "style" => PHPExcel_Style_Border::BORDER_THIN
                                                )
                            ),
                            "alignment" => array(
                                                "horizontal" => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                                                "vertical" => PHPExcel_Style_Alignment::VERTICAL_CENTER
                            ),
                            "font" => array(
                                                "italic" => true,
                                                "bold" => false
                            )
    );

    $center = array(
                            "borders" => array(
                                                "allborders" => array(
                                                                        "style" => PHPExcel_Style_Border::BORDER_THIN
                                                )
                            ),
                            "alignment" => array(
                                                "horizontal" => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                                                "vertical" => PHPExcel_Style_Alignment::VERTICAL_CENTER
                            )
    );

    $bordered = array(
                        "borders" => array(
                                            "allborders" => array(
                                            "style" => PHPExcel_Style_Border::BORDER_THIN
                        )
                    )
    );

    $page->getColumnDimension("A")->setWidth(5);
    $a="A";
    for($i=0;$i<=4;$i++){
            $a++;
            $page->getColumnDimension("$a")->setWidth(20);;	
    }
    
    $page->setCellValue("A1","Shop By ID.");
    $page->mergeCells("A1:A1");
    
    $a="A";
    $abc=array(
	"Category ID",
        "Category Name",
        "Shop by Name",
        "Status"
    );

    for($i=0;$i<=3;$i++){
        $a++;
        $page->setCellValue($a."1",$abc[$i]);
        $page->mergeCells($a."1:".$a."1");
        //echo $a.$abc[$i]."<br/>";	
    }

    $page->getStyle("A1:E1")->applyFromArray($header_style);

		
    $pos = 2;
    $no=0;

    for($i=0;$i<count($data['default']);$i++){
    $no++;

        $page->setCellValue("A".($i+2), $data['default'][$i]['id']);

        $page->setCellValue("B".($i+2), $data['default'][$i]['category_id']);

        $page->setCellValue("C".($i+2), $data['default'][$i]['product_category_name']);
        
        $page->setCellValue("D".($i+2), $data['default'][$i]['filter_name']);
        
        $page->setCellValue("E".($i+2), $data['default'][$i]['status']);

        $pos++;

    }

    $page->getStyle("A1:E".($pos-1))->applyFromArray($bordered);
 
    $date_export = date('Y-m-d H:i:s');
    $objWriter = IOFactory::createWriter($excel, 'Excel5');
    $objWriter->save("Urbanicon_Shop_by.xls");  
    
    redirect ("./Urbanicon_Shop_by.xls");
    }
    
    function u_product(){
        if(!isset($_POST['save'])){	
        show_404();
        }else{
        $this->load->library("phpexcel/PHPExcel");
        $this->load->library("phpexcel/PHPExcel/IOFactory");
        
        $fileName = $_FILES['import']['name'];

        $config['upload_path']	= "./assets/excel_file/";
        $config['upload_url']	= base_url().'assets/excel_file/';
        $config['file_name'] = $fileName;
        $config['allowed_types'] = '*';
        $config['max_size']     = '20000';
        $this->load->library('upload');
        $this->upload->initialize($config);

        if($this->upload->do_upload('import'))
         {
         $this->upload->data();    
         }

        $media = $this->upload->data('import');
        $inputFileName = './assets/excel_file/'.$media['file_name'];

        //  Read your Excel workbook
        try {
            $inputFileType = IOFactory::identify($inputFileName);
            $objReader = IOFactory::createReader($inputFileType);
            $objPHPExcel = $objReader->load($inputFileName);
        } catch(Exception $e) {
            die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
        }

        //  Get worksheet dimensions
        $sheet = $objPHPExcel->getSheet(0);
        $highestRow = $sheet->getHighestRow();
        $highestColumn = $sheet->getHighestColumn();

        //  Loop through each row of the worksheet in turn
        for ($row = 2; $row <= $highestRow; $row++){                  //  Read a row of data into an array                 
                    $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
                                            NULL,
                                            TRUE,
                                            FALSE);
            //  Insert row data array into your database of choice here
            $date=date("Y-m-d h:i:s");
            $data = array(
                "product_name"=>$rowData[0][0],
                "product_description"=> $rowData[0][1],
                "product_category"=> $rowData[0][2],
                "product_brand"=> $rowData[0][3],
                "product_theme"=> $rowData[0][4],
                "product_bestseller"=> $rowData[0][5],
                "for_men"=> ($rowData[0][6] == "" ? "0" : $rowData[0][6]),
                "for_women"=> ($rowData[0][7] == "" ? "0" : $rowData[0][7]),
                "create_date"=>$date,
            );
            $this->db->insert("product_general",$data);
            $idx=  mysql_insert_id();
            if($rowData[0][11] > 1 ){
            $enam= floor($rowData[0][11]/6);
            $duabelas = floor($rowData[0][11]/12);
            }else{
                $enam = floor($rowData[0][10]/6);
                $duabelas = floor($rowData[0][10]/12);
            }
            $data_detail = array(
                "product_general_id"=>$idx,
                "sku"=> $rowData[0][8],
                "stock"=>$rowData[0][9],
                "normal_price"=> ($rowData[0][10] == "" ? "0" : $rowData[0][10]),
                "special_price"=> ($rowData[0][11] == "" ? "0" : $rowData[0][11]),
                "date_start"=> $rowData[0][12],
                "date_end"=> $rowData[0][13],
                "enam_bulan_enable"=> ($rowData[0][14] == "" ? "Y" : $rowData[0][14]),
                "duabelas_bulan_enable"=> ($rowData[0][15] == "" ? "Y" : $rowData[0][15]),
                "case_size"=> $rowData[0][16],
                "band_width"=> $rowData[0][17],
                "band_material"=> $rowData[0][18],
                "dial_type"=> $rowData[0][19],
                "colour"=> $rowData[0][20],
                "exterior_material"=>$rowData[0][21],
                "handle_drop"=> $rowData[0][22],
                "length"=> $rowData[0][23],
                "width"=> $rowData[0][24],
                "height"=> $rowData[0][25],
                "closure"=> $rowData[0][26],
                "compartment"=> $rowData[0][27],
                "crosssells"=> $rowData[0][28],
                "uppsells"=> $rowData[0][29],
                "filter"=> $rowData[0][36],
                "enam_bulan"=>$enam,
                "duabelas_bulan"=>$duabelas
            );
            $this->db->insert("product_detail",$data_detail);
            
            $data_image=array(
                "product_general_id"=>$idx,
                "product_image1"=> $rowData[0][30],
                "product_image2"=> $rowData[0][31],
                "product_image3"=> $rowData[0][32],
                "product_image4"=> $rowData[0][33],
                "product_image5"=> $rowData[0][34],
                "product_image6"=> $rowData[0][35],
            );
            $this->db->insert("product_images",$data_image);
//             "sku"=> $rowData[0][9],
//                "stock"=>$rowData[0][10],
//                "normal_price"=> $rowData[0][11],
//                "special_price"=> $rowData[0][12],
//                "product_category"=> $rowData[0][13],
//                "date_start"=> $rowData[0][14],
//                "date_end"=> $rowData[0][15],
//                "enam_bulan"=> $rowData[0][16],
//                "duabulas_bulan"=> $rowData[0][17],
//                "case_size"=> $rowData[0][18],
//                "band_width"=> $rowData[0][19],
//                "band_material"=> $rowData[0][20],
//                "dial_type"=> $rowData[0][21],
//                "colour"=> $rowData[0][22],
//                "exterior_material"=>$rowData[0][23],
//                "handle_drop"=> $rowData[0][24],
//                "length"=> $rowData[0][25],
//                "width"=> $rowData[0][26],
//                "height"=> $rowData[0][27],
//                "closure"=> $rowData[0][28],
//                "compartment"=> $rowData[0][29],
//                "crosssells"=> $rowData[0][30],
//                "uppsells"=> $rowData[0][31],
//                "product_image1"=> $rowData[0][32],
//                "product_image2"=> $rowData[0][33],
//                "product_image3"=> $rowData[0][34],
//                "product_image4"=> $rowData[0][35],
//                "product_image5"=> $rowData[0][36],
//                "product_image6"=> $rowData[0][37],
        }
        redirect("product_management/batchimport");
        }
    }
    
    function u_category(){
        if(!isset($_POST['save'])){	
        show_404();
        }else{
        $this->load->library("phpexcel/PHPExcel");
        $this->load->library("phpexcel/PHPExcel/IOFactory");
        
        $fileName = $_FILES['import']['name'];

        $config['upload_path']	= "./assets/excel_file/";
        $config['upload_url']	= base_url().'assets/excel_file/';
        $config['file_name'] = $fileName;
        $config['allowed_types'] = '*';
        $config['max_size']     = '20000';
        $this->load->library('upload');
        $this->upload->initialize($config);

        if($this->upload->do_upload('import'))
         {
         $this->upload->data();    
         }

        $media = $this->upload->data('import');
        $inputFileName = './assets/excel_file/'.$media['file_name'];

        //  Read your Excel workbook
        try {
            $inputFileType = IOFactory::identify($inputFileName);
            $objReader = IOFactory::createReader($inputFileType);
            $objPHPExcel = $objReader->load($inputFileName);
        } catch(Exception $e) {
            die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
        }

        //  Get worksheet dimensions
        $sheet = $objPHPExcel->getSheet(0);
        $highestRow = $sheet->getHighestRow();
        $highestColumn = $sheet->getHighestColumn();

        //  Loop through each row of the worksheet in turn
        for ($row = 2; $row <= $highestRow; $row++){                  //  Read a row of data into an array                 
                    $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
                                            NULL,
                                            TRUE,
                                            FALSE);
            //  Insert row data array into your database of choice here
            $data = array(
                "product_category_name"=> $rowData[0][0],
                "product_category_description"=> $rowData[0][1],
                "product_category_images"=> $rowData[0][2],
                "product_category_child_id"=>$rowData[0][3],
                "product_category_status"=>$rowData[0][4],
            );
            $this->db->insert("product_category",$data);
        }
        redirect("product_management/batchimport");
        }
    }
    
    function u_brand(){
        if(!isset($_POST['save'])){	
        show_404();
        }else{
        $this->load->library("phpexcel/PHPExcel");
        $this->load->library("phpexcel/PHPExcel/IOFactory");
        
        $fileName = $_FILES['import']['name'];

        $config['upload_path']	= "./assets/excel_file/";
        $config['upload_url']	= base_url().'assets/excel_file/';
        $config['file_name'] = $fileName;
        $config['allowed_types'] = '*';
        $config['max_size']     = '20000';
        $this->load->library('upload');
        $this->upload->initialize($config);

        if($this->upload->do_upload('import'))
         {
         $this->upload->data();    
         }

        $media = $this->upload->data('import');
        $inputFileName = './assets/excel_file/'.$media['file_name'];

        //  Read your Excel workbook
        try {
            $inputFileType = IOFactory::identify($inputFileName);
            $objReader = IOFactory::createReader($inputFileType);
            $objPHPExcel = $objReader->load($inputFileName);
        } catch(Exception $e) {
            die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
        }

        //  Get worksheet dimensions
        $sheet = $objPHPExcel->getSheet(0);
        $highestRow = $sheet->getHighestRow();
        $highestColumn = $sheet->getHighestColumn();

        //  Loop through each row of the worksheet in turn
        for ($row = 2; $row <= $highestRow; $row++){                  //  Read a row of data into an array                 
                    $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
                                            NULL,
                                            TRUE,
                                            FALSE);
            //  Insert row data array into your database of choice here
            $data = array(
                "brand_name"=> $rowData[0][0],
                "brand_description"=> $rowData[0][1],
                "brand_images"=> $rowData[0][2],
                "status"=>$rowData[0][3],
                "brand_child_id"=>$rowData[0][4],
            );
            $this->db->insert("brand",$data);
        }
        redirect("product_management/batchimport");
        }
    }
    
    function validation_stock(){
        $data['view']='main_validation';
        $this->load->view("template",$data);
    }
    
    function validation_stock_proses(){
        $this->db->query("TRUNCATE table update_stock");
        if(!isset($_POST['submit'])){	
        show_404();
        }else{
        $this->load->library("phpexcel/PHPExcel");
        $this->load->library("phpexcel/PHPExcel/IOFactory");
        
        $fileName = $_FILES['import']['name'];

        $config['upload_path']	= "./assets/excel_file/";
        $config['upload_url']	= base_url().'assets/excel_file/';
        $config['file_name'] = $fileName;
        $config['allowed_types'] = '*';
        $config['max_size']     = '20000';
        $this->load->library('upload');
        $this->upload->initialize($config);

        if($this->upload->do_upload('import'))
         {
         $this->upload->data();    
         }

        $media = $this->upload->data('import');
        $inputFileName = './assets/excel_file/'.$media['file_name'];

        //  Read your Excel workbook
        try {
            $inputFileType = IOFactory::identify($inputFileName);
            $objReader = IOFactory::createReader($inputFileType);
            $objPHPExcel = $objReader->load($inputFileName);
        } catch(Exception $e) {
            die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
        }

        //  Get worksheet dimensions
        $sheet = $objPHPExcel->getSheet(0);
        $highestRow = $sheet->getHighestRow();
        $highestColumn = $sheet->getHighestColumn();

        //  Loop through each row of the worksheet in turn
        for ($row = 2; $row <= $highestRow; $row++){                  //  Read a row of data into an array                 
                    $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
                                            NULL,
                                            TRUE,
                                            FALSE);
            //  Insert row data array into your database of choice here
            $data = array(
                "sku"=> $rowData[0][0],
                "stock"=> $rowData[0][1]
            );
            $this->db->insert("update_stock",$data);
        }
        $dval=$this->db->query("select sku, stock from product_detail where sku in (select sku from update_stock)")->result();
        foreach($dval as $dvalx){
            $this->db->query("update product_detail set stock=(select stock from update_stock where sku='".$dvalx->sku."') where sku='".$dvalx->sku."'");
        }
        redirect("product_management/validation_stock");
        }
    }
    
    function comment($id){
        $this->load->database('desalite',true);
        $this->session->unset_userdata('page_sr');
        $this->session->unset_userdata('customer_sr');
        $this->session->unset_userdata('comment_sr');
        $this->session->unset_userdata('status_sr');
        $config['base_url'] = base_url().'product_management/index/';
        $config['total_rows'] = $this->db->query("select a.*,b.name
                                                 from product_comment a
                                                 left join customer b on a.id_customer=b.id_customer
                                                 where a.id_product='$id'
                                                 order by a.id desc
                                                 ")->num_rows();
        $config['per_page'] = 10;
        $config['num_links'] = 2;
        $config['uri_segment'] = 4;
        $config['first_page'] = 'Awal';
        $config['last_page'] = 'Akhir';
        $config['next_page'] = '&laquo;';
        $config['prev_page'] = '&raquo;';
        $pg = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0 ;
        //inisialisasi config
        $this->pagination->initialize($config);
        //buat pagination
        $data['halaman'] = $this->pagination->create_links();
        //tamplikan data
        $data['total_data']=$this->db->query("select a.*,b.name
                                             from product_comment a
                                             left join customer b on a.id_customer=b.id_customer
                                             where a.id_product='$id'
                                             order by a.id desc
                                             ")->num_rows();
        $data['data'] = $this->db->query("select a.*,b.name
                                         from product_comment a
                                         left join customer b on a.id_customer=b.id_customer
                                         where a.id_product='$id'
                                         order by a.id desc limit ".$pg.",".$config['per_page']."")->result();
        $data['product']=$this->db->query("select id_product,product_code,product_name from product where id_product='$id'")->row();
        $data['view']='main_comment';
        $this->load->view('template',$data);
    }
    
    function comment_search($id){
        $this->load->database('desalite',true);
        if($_POST){
            $page_sr = ($this->input->get_post('page_sr')==""?$this->session->unset_userdata('page_sr'):$this->mproduct_management->handler0("page_sr",$this->input->get_post('page_sr', TRUE)));
            $customer_sr = ($this->input->get_post('customer_sr')==""?$this->session->unset_userdata('customer_sr'):$this->mproduct_management->handler0("customer_sr",$this->input->get_post('customer_sr', TRUE)));
            $comment_sr = ($this->input->get_post('comment_sr')==""?$this->session->unset_userdata('comment_sr'):$this->mproduct_management->handler0("comment_sr",$this->input->get_post('comment_sr', TRUE)));
            $status_sr = ($this->input->get_post('status_sr')==""?$this->session->unset_userdata('status_sr'):$this->mproduct_management->handler0("status_sr",$this->input->get_post('status_sr', TRUE)));
        }else{
            $page_sr = $this->mproduct_management->handler0("page_sr",$this->input->get_post('page_sr', TRUE));
            $customer_sr = $this->mproduct_management->handler0("customer_sr",$this->input->get_post('customer_sr', TRUE));
            $comment_sr = $this->mproduct_management->handler0("comment_sr",$this->input->get_post('comment_sr', TRUE));
            $status_sr = $this->mproduct_management->handler0("status_sr",$this->input->get_post('status_sr', TRUE));
        }
        $limit = ($this->uri->segment(4) > 0)?$this->uri->segment(4):0;

        $config['base_url'] = base_url() .'product_management/search';
        $config['total_rows'] = $this->db->query("select a.*,b.name
                                                 from product_comment a
                                                 left join customer b on a.id_customer=b.id_customer
                                                 where a.id_product='$id' and
                                                 b.name like '%$customer_sr%' and a.comment like '%$comment_sr%' and a.status like '%$status_sr%'
                                                 order by a.id desc
                                                 ")->num_rows();
        $config['per_page'] = ($page_sr > 0)?$page_sr:10;
        $config['uri_segment'] = 4;
        $choice = $config['total_rows']/$config['per_page'];
        $config['num_links'] = 2;		
        $this->pagination->initialize($config);

        $data['data'] = $this->db->query("select a.*,b.name
                                         from product_comment a
                                         left join customer b on a.id_customer=b.id_customer
                                         where a.id_product='$id' and
                                         b.name like '%$customer_sr%' and a.comment like '%$comment_sr%' and a.status like '%$status_sr%'
                                         order by a.id desc limit ".$limit.",".$config['per_page']."")->result();
        $data['halaman'] = $this->pagination->create_links();
        $data['total_data']= $this->db->query("select a.*,b.name
                                             from product_comment a
                                             left join customer b on a.id_customer=b.id_customer
                                             where a.id_product='$id' and
                                             b.name like '%$customer_sr%' and a.comment like '%$comment_sr%' and a.status like '%$status_sr%'
                                             order by a.id desc")->num_rows();
        $data['product']=$this->db->query("select id_product,product_code,product_name from product where id_product='$id'")->row();
        $data['customer_sr'] = $customer_sr;
        $data['comment_sr'] = $comment_sr;
        $data['status_sr'] = $status_sr;
        $data['page_sr'] = $page_sr;
        $data['view']='search_comment';
        $this->load->view('template',$data);
    }
    
     function comment_update($id,$posisi){
        $this->load->database('desalite',true);
        $data['detail']=$this->db->query("select a.*,b.name from product_comment a left join customer b on a.id_customer=b.id_customer where a.id='$id'")->row();
        $data['posisi']=$posisi;
        $data['view']='edit_comment';
        $this->load->view('template',$data);
     }
     
     function update_comment(){
        $this->load->database('desalite',true);
        error_reporting(0);
        $posisi=$this->input->post('posisi');
        $id=$this->input->post('id');
        $comment=$this->input->post('comment');
        $comment_reply=$this->input->post('comment_reply');
        $status=$this->input->post('status');
        $data=array(
            'comment'=>$comment,
            'status'=>$status,
            'comment_reply'=>$comment_reply
        );
        $this->main_model->update("product_comment","id",$id,$data);
        redirect('product_management/comment_search/'.$posisi);
     }
     
     function comment_delete($id,$posisi){
         $this->load->database('desalite',true);
         $this->main_model->delete("product_comment","id",$id);
         redirect('product_management/comment_search/'.$posisi);
     }
}