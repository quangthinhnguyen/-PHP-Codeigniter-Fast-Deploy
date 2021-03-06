<?php

defined("BASEPATH") or exit("No direct script access allowed");

class Users extends Am_controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Mdl_users');
	}

	public function GET($page_number = 0){
		$page_number = (int)$page_number;
		$this->setting_info['pagination_per_page'] = 20;

		//Search All Field
		$id = $this->input->get('id');
		$username = $this->input->get('username');
		$password = $this->input->get('password');
		$title = $this->input->get('title');
		$name = $this->input->get('name');
		$email = $this->input->get('email');
		$create_date = $this->input->get('create_date');
		$status = $this->input->get('status');

		$config['suffix'] = "/";
		//New
		$arg_where = array();

		if($id != false){
			$arg_where[]  = array(  
								'field'=> 'id',
								'operator'=>'=',
								'value'=> $id,
								'connect'=>'AND',
								'group'=> 1,
								'type'=>'id'
		                    );
			$this->data['id'] = $id;
			if($config['suffix'] == '/'){
		        $config['suffix'] .= '?'.$field.'=$'.$field;
		    }else{
		        $config['suffix'] .= '&'.$field.'=$'.$field;
		    }
		}

		if($username != false){
			$arg_where[]  = array(  
								'field'=> 'username',
								'operator'=>'=',
								'value'=> $username,
								'connect'=>'AND',
								'group'=> 1,
								'type'=>'id'
		                    );
			$this->data['username'] = $username;
			if($config['suffix'] == '/'){
		        $config['suffix'] .= '?'.$field.'=$'.$field;
		    }else{
		        $config['suffix'] .= '&'.$field.'=$'.$field;
		    }
		}

		if($password != false){
			$arg_where[]  = array(  
								'field'=> 'password',
								'operator'=>'=',
								'value'=> $password,
								'connect'=>'AND',
								'group'=> 1,
								'type'=>'id'
		                    );
			$this->data['password'] = $password;
			if($config['suffix'] == '/'){
		        $config['suffix'] .= '?'.$field.'=$'.$field;
		    }else{
		        $config['suffix'] .= '&'.$field.'=$'.$field;
		    }
		}

		if($title != false){
			$arg_where[]  = array(  
								'field'=> 'title',
								'operator'=>'=',
								'value'=> $title,
								'connect'=>'AND',
								'group'=> 1,
								'type'=>'id'
		                    );
			$this->data['title'] = $title;
			if($config['suffix'] == '/'){
		        $config['suffix'] .= '?'.$field.'=$'.$field;
		    }else{
		        $config['suffix'] .= '&'.$field.'=$'.$field;
		    }
		}

		if($name != false){
			$arg_where[]  = array(  
								'field'=> 'name',
								'operator'=>'=',
								'value'=> $name,
								'connect'=>'AND',
								'group'=> 1,
								'type'=>'id'
		                    );
			$this->data['name'] = $name;
			if($config['suffix'] == '/'){
		        $config['suffix'] .= '?'.$field.'=$'.$field;
		    }else{
		        $config['suffix'] .= '&'.$field.'=$'.$field;
		    }
		}

		if($email != false){
			$arg_where[]  = array(  
								'field'=> 'email',
								'operator'=>'=',
								'value'=> $email,
								'connect'=>'AND',
								'group'=> 1,
								'type'=>'id'
		                    );
			$this->data['email'] = $email;
			if($config['suffix'] == '/'){
		        $config['suffix'] .= '?'.$field.'=$'.$field;
		    }else{
		        $config['suffix'] .= '&'.$field.'=$'.$field;
		    }
		}

		if($create_date != false){
			$arg_where[]  = array(  
								'field'=> 'create_date',
								'operator'=>'=',
								'value'=> $create_date,
								'connect'=>'AND',
								'group'=> 1,
								'type'=>'id'
		                    );
			$this->data['create_date'] = $create_date;
			if($config['suffix'] == '/'){
		        $config['suffix'] .= '?'.$field.'=$'.$field;
		    }else{
		        $config['suffix'] .= '&'.$field.'=$'.$field;
		    }
		}

		if($status != false){
			$arg_where[]  = array(  
								'field'=> 'status',
								'operator'=>'=',
								'value'=> $status,
								'connect'=>'AND',
								'group'=> 1,
								'type'=>'id'
		                    );
			$this->data['status'] = $status;
			if($config['suffix'] == '/'){
		        $config['suffix'] .= '?'.$field.'=$'.$field;
		    }else{
		        $config['suffix'] .= '&'.$field.'=$'.$field;
		    }
		}

		$arg_default = array('where'=> $arg_where,
		                     'limit_start' => 0,
		                     'limit_offset' => 99,
		                     'order' => 'DESC',
		                     'order_field' => 'id',
		                     'result'=>'rows',
		                     'debug'=> false
		                    );

		$this->data['data'] = $this->mdl_company->select($arg_default);
		$config['base_url'] = base_url('users/get');
		
		$config['total_rows'] = $this->data['data']['count'];
		
		//Get pagination_per_page from setting
		$this->data['data']['page'] = $page_number;
		$this->data['data']['per_page'] = $this->setting_info['pagination_per_page'];
		$config['per_page'] = $this->setting_info['pagination_per_page'];
		$this->pagination->initialize($config); 

	}
  	//Add new row
    public function POST(){
  		

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
          //Form validation       
            $this->form_validation->set_rules_val('id','id','required',$this->form_fields);
            $this->form_validation->set_rules_val('username','Tên','required',$this->form_fields);
            $this->form_validation->set_rules_val('password','password','required',$this->form_fields);
            $this->form_validation->set_rules_val('title','title','required',$this->form_fields);
            $this->form_validation->set_rules_val('name','name','required',$this->form_fields);
            $this->form_validation->set_rules_val('email','email','required',$this->form_fields);
            $this->form_validation->set_rules_val('create_date','create_date','required',$this->form_fields);
            $this->form_validation->set_rules_val('status','status','required',$this->form_fields);
            //Run from validation
              if($this->form_validation->run()){
                  $fields = $this->form_validation->get_field_value($this->form_fields);
                      extract($fields);
  
                    if($this->mdl_companies->insert($fields,1)){
                        $this->qt_success('Thêm mới thành công!');
                   }else{
                       $this->qt_error('Thêm mới không thành công!');
                   }
           }else{
               //show validate
                $this->qt_error_validate();
             }
          }else{
          	$this->data['view'] = array('title'=>'THÊM MỚI');
          	$db = $this->load->database('dbname');
			$this->load->model('amtools/Mdl_dbinfo');
			$data_result = $this->Mdl_dbinfo->getFields();
			// print_r($data_result);
			$this->data['data'] = $data_result['tbl_users'];
            $this->load->view('POST', $this->data);
       }
    }
}