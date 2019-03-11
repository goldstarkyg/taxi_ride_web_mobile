<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Admin extends CI_Controller
{
	public $zone_name = CUSTOM_ZONE_NAME;
	public $base_path = BASE_URL;
    public $base_ip  = BASE_IP;
	// construct call
	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->helper('date');
		$this->load->helper('file');
		$this->load->library('form_validation');
		$this->load->model('Model_admin','home');
		$this->load->database();
		$this->load->library('session');
		$this->load->library('image_lib');
		$this->load->helper('cookie');
		$this->load->helper('url');
		$this->load->library('email');
		$this->load->library("braintree_lib");
		session_start();
	}

	// permission call
	public function permission()
	{
		//$data=$_POST;
		$permission="";
		$this->seesion_set();

		if(($this->session->userdata('permission'))) {
			$ff = $this->router->fetch_method();

			$pm = $this->db->query("SELECT * FROM  pages WHERE pages='$ff'");

			if($pm->num_rows == 1) {
				$upm = $pm->row('p_id');
				$id=explode(',',$this->session->userdata('permission'));
				if(in_array($upm,$id)) {
					$permission = "access";
				} else {
					$permission = "failed";
					redirect('admin/not_admin');
				}
			} else {
				$permission = "failed";
			}
		}
		return $permission;
	}

	// index page call
	public function index()
	{
   	$this->load->view('admin-login');
	}

	// admin login call
	public function adminlogin()
	{
		$data=$_POST;
		$result = $this->home->login($data);
		echo $result;
	}

	// admin logout call
	public function logout()
	{
		$this->session->unset_userdata('username-admin');
		//redirect('/', 'refresh');
		delete_cookie('username-admin');
		redirect('/admin', 'refresh');
	}

	// drivesignup call
	public function driversignup()
	{
		$this->seesion_set();

		if($this->session->userdata('username-admin') ||   $this->input->cookie('username-admin', false)){
			$permission = $this->permission();
			if(($this->session->userdata('role-admin') == 'admin') || ($permission == "access")) {
				$this->load->view('driver_signup');
			}else{
				redirect('admin/not_admin');
			}
		}else{
			redirect('admin/index');
		}
	}

	//add staff

	public function add_staff()
	{
		$this->seesion_set();

		if($this->session->userdata('username-admin') ||   $this->input->cookie('username-admin', false)){
			$permission = $this->permission();
			if(($this->session->userdata('role-admin') == 'admin') || ($permission == "access")) {
				if($this->input->get('flag')){
					$filter='flag';
					$data['query']=$filter;
					 $this->load->view('manage_staff');
				}
				else{
					 $data['query']= NULL;
					 $this->load->view('add_staff');
				}
			}else{
				redirect('admin/not_admin');
			}
		}else{
			redirect('admin/index');
		}
	}








	// admin profile call
	public function profile()
	{
		$this->seesion_set();
		//$data=$_POST;
		if($this->session->userdata('username-admin') ||   $this->input->cookie('username-admin', false)){
			$permission = $this->permission();
			if(($this->session->userdata('role-admin') == 'admin') || ($permission == "access")) {
				$this->load->view('admin-profile');
			}else{
				redirect('admin/not_admin');
			}
		}else{
			redirect('admin/index');
		}
	}

	// admin password change call
	public function password_change()
	{
		$this->seesion_set();

		//$data=$_POST;
		if($this->session->userdata('username-admin') ||   $this->input->cookie('username-admin', false)){
			$permission = $this->permission();
			if(($this->session->userdata('role-admin') == 'admin') || ($permission == "access")) {
				$this->load->view('admin-change-password');
			}else{
				redirect('admin/not_admin');
			}
		}else{
			redirect('admin/index');
		}
	}
	public function user_change_password()
	{
		$this->seesion_set();

		if($this->session->userdata('username-admin') ||   $this->input->cookie('username-admin', false)){
			$permission = $this->permission();
			if(($this->session->userdata('role-admin') == 'admin') || ($permission == "access")) {
				$this->load->view('user_password_change');
			}else{
				redirect('admin/not_admin');
			}
		}else{
			redirect('admin/index');
		}
	}
	public function driver_change_password()
	{
		$this->seesion_set();

		if($this->session->userdata('username-admin') ||   $this->input->cookie('username-admin', false)){
			$permission = $this->permission();
			if(($this->session->userdata('role-admin') == 'admin') || ($permission == "access")) {
				$this->load->view('driver_password_change');
			}else{
				redirect('admin/not_admin');
			}
		}else{
			redirect('admin/index');
		}
	}
	public function seesion_set(){
		$arr = array('username-admin', 'username', 'staff-type', 'log-name', 'staff-id', 'role-admin','permission','permission_page');
		foreach($arr as $h)
			if (isset($_SESSION[$h]))
				$this->session->set_userdata($h, $_SESSION[$h]);
	}
	//dashboard call
	public function dashboard()
	{
		$this->seesion_set();
		
		if($this->session->userdata('username-admin') ||   $this->input->cookie('username-admin', false)){
			$permission = $this->permission();
			if(($this->session->userdata('role-admin') == 'admin') || ($permission == "access")) {
				$this->load->view('dashboard');
			}else{
				redirect('admin/not_admin');
			}
		}else{
			redirect('admin/index');
		}
	}

	// real time mapping
	public function real_time_mapping()
	{
		$this->seesion_set();

		if($this->session->userdata('username-admin') ||   $this->input->cookie('username-admin', false)){
			$permission = $this->permission();
			if(($this->session->userdata('role-admin') == 'admin') || ($permission == "access")) {
				//$data['query1'] = $this->home->real_time_driver();
				$this->load->view('real_time_mapping');
			}else{
				redirect('admin/not_admin');
			}
		}else{
			redirect('admin/index');
		}
	}
	//driver earnings
	public function Daily_Driver_Earnings()
	{
		$this->seesion_set();

		if($this->session->userdata('username-admin') ||   $this->input->cookie('username-admin', false)){
			$permission = $this->permission();
			if(($this->session->userdata('role-admin') == 'admin') || ($permission == "access"))
			{
				//$data['query1'] = $this->home->real_time_driver();
				$this->load->view('daily_driver_earnings');
			}else{
				redirect('admin/not_admin');
			}
		}else{
			redirect('admin/index');
		}
	}

	// find markers
	public function find_markers()
	{
		$lat = $_POST['lat'];
		$long = $_POST['lng'];
		$json_arr = array();
		$marker_array = array();
		//$lat = $this->input->get('lat');
		//$long = $this->input->get('lng');
		$json_array = array(
			'coords' => array((float)$lat, (float)$long),
		);
		//echo json_encode($json_array);exit;
		$new_json_array = json_encode($json_array,JSON_UNESCAPED_SLASHES);
		//print_r($new_json_array);
		//exit;
		$url = $this->base_ip.":4040/searchDriverForLocation?".$new_json_array;
		//$url = "192.168.1.118:4040/searchDriver?".$new_json_array;
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		// This is what solved the issue (Accepting gzip encoding)
		curl_setopt($ch, CURLOPT_ENCODING, "gzip,deflate");
		$response = curl_exec($ch);
		//echo json_encode($response);
		curl_close($ch);

		if($response){
			$response_data = json_decode($response,true);
			foreach($response_data['data'] as $res){
				if($res['driver_id'] && $res['driver_id']!=null){
					$book_link = '';
					$marker_array['driver_id'] = $res['driver_id'];
					$this->db->where('id',$res['driver_id']);
					$row = $this->db->get('driver_details')->row();
					if($row) {
						if ($row->image !='') {
							$image = base_url() . 'driverimages/' . $row->image;
						} else {
							$image = base_url() . 'upload/no-image-icon.png';
						}
					}
					else{
						$image = base_url() . 'upload/no-image-icon.png';
					}
					$marker_array['driver_name'] = $res['driver_name'];
					$marker_array['car_type'] = $res['car_type'];
					$marker_array['lat'] = $res['loc'][0];
					$marker_array['lng'] = $res['loc'][1];
					$geocode=file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?latlng='.$res['loc'][0].','.$res['loc'][1].'&sensor=false&key=AIzaSyC8ltwu5mPtC98NbRh7hf-pXnKqGqXl6_4');

					$output= json_decode($geocode);
					$address = $output->results[0]->formatted_address;
					if($res['driver_status']==1){
						$query = $this->db->query("SELECT driver_flag FROM driver_status WHERE driver_id=$res[driver_id] ORDER BY id DESC LIMIT 1");
						if($query->num_rows()>0) {
							$detail = $query->row();
							if ($detail->driver_flag == 0 || $detail->driver_flag == 1) {
								$marker_array['type'] = 'Busy';
							} else {
								$marker_array['type'] = 'Online';
								$book_link = '<a id="my-modal" data-toggle="modal" href="javascript:void(0)" onclick="openModal()" style="background-color:green;padding:3px;color:white;margin-top:2px;">Assign Booking</a>';
							}
						}
						else{
							$marker_array['type'] = 'Online';
							$book_link = '<a id="my-modal" data-toggle="modal" href="javascript:void(0)" onclick="openModal()" style="background-color:green;padding:3px;color:white;margin-top:2px;">Assign Booking</a>';
						}
						/*if($res['booking_status']==1 || $res['booking_status']==2){
							$marker_array['type'] = 'Busy';
						}
						else{
							$marker_array['type'] = 'Online';
							$book_link = '<a data-toggle="modal" href="#myModal" style="background-color:green;padding:3px;color:white;margin-top:2px;">Assign Booking</a>';
						}*/
					}
					else{
						$marker_array['type'] = 'Offline';
					}

					if($book_link!=''){
						$marker_array['description'] = '<div style="float:left;margin-right:10px;"><img src="'.$image.'" width="100" height="100" style="border-radius:50%;border:1px solid gray;"/></div><strong>Driver Name: </strong>'.$res['driver_name'].'<br/><strong>Current Location: </strong>'.$address.'<br/><strong>Status: </strong></strong>'.$marker_array['type'].'<br/>'.$book_link;
					}
					else{
						$marker_array['description'] = '<div style="float:left;margin-right:10px;"><img src="'.$image.'" width="100" height="100" style="border-radius:50%;border:1px solid gray;"/></div><strong>Driver Name: </strong>'.$res['driver_name'].'<br/><strong>Current Location: </strong>'.$address.'<br/><strong>Status: </strong></strong>'.$marker_array['type'];
					}
					//$json_arr = [];
					$json_arr[] = $marker_array;
				}
			}
			echo json_encode($json_arr);
		}
	}

	// driver earnings call
	public function get_driver_earnings_data(){
		//$requestData= $_REQUEST;
		$driver_id=$_POST['data_id'];
		$min_date = $_POST['min_date'];
        $max_date = $_POST['max_date'];
		if($driver_id==''){
			$driver_id='';
		}
		if($min_date==''){
			$min_date = '';
		}
        if($max_date==''){
            $max_date = '';
        }
		// storing  request (ie, get/post) global array to a variable
		$requestData= $_REQUEST;
		$driver=$this->home->getdriverearnings($requestData,$driver_id,$min_date,$max_date,$where=null);
		echo $driver;
	}
	//driver inspection record
	public function get_driver_inspection_record() {
		//$requestData= $_REQUEST;
		$driver_id=$_POST['data_id'];		
		// storing  request (ie, get/post) global array to a variable
		$requestData= $_REQUEST;
		$driver=$this->home->getInspectionRecord($requestData, $driver_id, $where=null);
		echo $driver;
	}

	// transaction history call
	public function get_transaction_history_data(){
        //$requestData= $_REQUEST;
        $driver_id=$_POST['data_id'];
        $min_date = $_POST['min_date'];
        $max_date = $_POST['max_date'];
        if($driver_id==''){
            $driver_id='';
        }
        if($min_date==''){
        	$min_date = '';
		}
		if($max_date==''){
        	$max_date= '';
		}
        // storing  request (ie, get/post) global array to a variable
        $requestData= $_REQUEST;
        $transaction=$this->home->gettransactionhistory($requestData,$driver_id,$min_date,$max_date,$where=null);
        echo $transaction;
	}
	// manage user call
	public function manage_user()
	{
		$this->seesion_set();

		if($this->session->userdata('username-admin') ||   $this->input->cookie('username-admin', false)){
			$permission = $this->permission();
			if(($this->session->userdata('role-admin') == 'admin') || ($permission == "access")) {
				if($this->input->get('flag')){
					$filter='flag';
					$data['query']=$filter;
				}
				else{
					$data['query']= NULL;
				}
				$this->load->view('manage-user',$data);
			}else{
				redirect('admin/not_admin');
			}
		}else{
			redirect('admin/index');
		}
	}

	//add fix_price_area
    public function add_fix_price_area()
    {
		$this->seesion_set();
        //$data=$_POST;
        if($this->session->userdata('username-admin') ||   $this->input->cookie('username-admin', false)){
            $permission = $this->permission();
            if(($this->session->userdata('role-admin') == 'admin') || ($permission == "access")) {

                $this->load->view('add_fix_price_area');
            }else{
                redirect('admin/not_admin');
            }
        }else{
            redirect('admin/index');
        }
    }

    //manage_fix_price_area
    public function manage_fix_price_area()
    {
		$this->seesion_set();
        //$data=$_POST;
        if($this->session->userdata('username-admin') ||   $this->input->cookie('username-admin', false)){
            $permission = $this->permission();
            if(($this->session->userdata('role-admin') == 'admin') || ($permission == "access")) {

                $this->load->view('manage_fix_price_area');
            }else{
                redirect('admin/not_admin');
            }
        }else{
            redirect('admin/index');
        }
    }


	// get area data
    public function get_area_data()
    {
        // storing  request (ie, get/post) global array to a variable
        $requestData= $_REQUEST;
        $area=$this->home->getarea($requestData,$where=null);
        echo $area;
    }

    // delete area data
    public function delete_area_data()
    {
        $data_ids = $_REQUEST['data_ids'];
        $this->home->delarea($data_ids);
    }

    //delete single area data call
    public function delete_single_area_data()
    {
        $data_id = $_REQUEST['data_id'];
        $this->home->delsinglearea($data_id);
    }

	// add user call
	/*public function adduser()
	{
		if($this->session->userdata('username-admin') ||   $this->input->cookie('username-admin', false)){
			$permission = $this->permission();
			if(($this->session->userdata('role-admin') == 'admin') || ($permission == "access")) {
				$this->load->view('admin-add-userdetails');
			}else{
				redirect('admin/not_admin');
			}
		}else{
			redirect('admin/index');
		}
	}*/

	// insert user call
	/*public function insertuser()
	{
		$data=$_POST;
		//echo $data['value'];exit;
		$res=$this->home->userinsert($data);
		// print_r($res);
		echo $res;
	}*/

	// view user details call
	public function view_userdetails()
	{
		$this->seesion_set();
		//$data=$_POST;
		if($this->session->userdata('username-admin') ||   $this->input->cookie('username-admin', false)){
			$permission=$this->permission();
			if(($this->session->userdata('role-admin') == 'admin') || ($permission == "access")) {
				$this->load->view('user-details');
			}else{
				redirect('admin/not_admin');
			}
		}else{
			redirect('admin/index');
		}
	}

	// get staff data call
	public function get_staff_data()
	{
		// storing  request (ie, get/post) global array to a variable
		$requestData= $_REQUEST;
		$filterData=$_POST['data_id'];
		if($filterData=='yes'){
			$flagfilter=$filterData;
		}
		else{
			$flagfilter='';
		}
		$user=$this->home->getstaff($requestData,$flagfilter,$where=null);
		echo $user;
	}
	// get user data call
	public function get_user_data()
	{
		// storing  request (ie, get/post) global array to a variable
		$requestData= $_REQUEST;
		$filterData=$_POST['data_id'];
		if($filterData=='yes'){
			$flagfilter=$filterData;
		}
		else{
			$flagfilter='';
		}
		$user=$this->home->getuser($requestData,$flagfilter,$where=null);
		echo $user;
	}

	//delete user data call
	public function delete_user_data()
	{
		$data_ids = $_REQUEST['data_ids'];
		$this->home->deluser($data_ids);
	}

		//delete staff data call
	public function delete_staff_data()
	{
		$data_ids = $_REQUEST['data_ids'];
		$this->home->delstaff($data_ids);
	}
	//delete single user data call
	public function delete_single_user_data()
	{
		$data_id = $_REQUEST['data_id'];
		$this->home->delsingleuser($data_id);
	}
	
	//delete single user data call
	public function delete_single_staff_data()
	{
		$data_id = $_REQUEST['data_id'];
		$this->home->delsinglestaff($data_id);
	}

	// manage booking call
	public function manage_booking()
	{
		$this->seesion_set();

		if($this->session->userdata('username-admin') ||   $this->input->cookie('username-admin', false)){
			$permission = $this->permission();
			if(($this->session->userdata('role-admin') == 'admin') || ($permission == "access")) {
				if($this->input->get('user_id')){
					$filter='user_id';
					$data['query']=$filter;
				}
				else if($this->input->get('status_code')){
					$filter='status_code';
					$data['query']=$filter;
				}
				else{
					$data['query']= NULL;
				}
				$this->load->view('manage-booking',$data);
			}else{
				redirect('admin/not_admin');
			}
		}else{
			redirect('admin/index');
		}
	}

	//manage booking refund
	public function manage_booking_refund()
	{
		$refund_name = $_POST['refund_name'];
		$refund_price = $_POST['refund_price'];
		$transaction_id = $_POST['transaction_id'];
		$status_code =  $_POST['status_code'];
		$booking_id =  $_POST['booking_id'];
		$final_amount =  $_POST['final_amount'];
		//payment_status



//		$nonceFromTheClient = 'fake-valid-nonce';
//		$result = Braintree_Transaction::sale([
//			'amount' => '192.00',
//			'paymentMethodNonce' => $nonceFromTheClient,
//			'options' => [
//				'submitForSettlement' => True
//			]
//		]);
//
//		echo  $result->success;
//		echo  $result->transaction->id;
//		$result = Braintree_Transaction::refund($transaction_id,3);
//		echo $result->success.'::::::';
//		echo $result->transaction->status.":::;" ;
//        echo $result->transaction->processorSettlementResponseCode."::::::";
//        echo $result->transaction->processorSettlementResponseText."::::::";
			if($status_code == 'completed') {
				if ($refund_name == 'full')
					$result = Braintree_Transaction::refund($transaction_id);
				else
					$result = Braintree_Transaction::refund($transaction_id, $refund_price);
			}else {
				if ($refund_name == 'full')
					$result = Braintree_Transaction::void($transaction_id);
				else
					$result = Braintree_Transaction::void($transaction_id, $refund_price);
			}

		if($result) {
			if($refund_name == 'full') $final_amount = 0;
			else $final_amount = $final_amount - $refund_price;
			$refund = $this->home->updateamountrefund($booking_id,$final_amount, $result);
			echo $refund;
		}else {
			$json_data = array();
			$json_data['final_amount'] = $final_amount ;
			$json_data['booking_id'] = $booking_id;
			$json_data['refund_result'] = false;
			$json_data['result_transaction_type'] = '';
			$json_data['result_transaction_amount'] = '';
			$json_data['result_transaction_status'] = '';
			echo json_encode($json_data);;
		}
	}

	// booking details call
	public function view_booking_details()
	{
		$this->seesion_set();

		if($this->session->userdata('username-admin') ||   $this->input->cookie('username-admin', false)){
			$permission = $this->permission();
			if(($this->session->userdata('role-admin') == 'admin') || ($permission == "access")) {
				$data['query']=$this->home->get_booking_details($this->input->get('id'));
				if($data['query']){
				$data['query4']=$this->home->get_explicit_selected_drivers($this->input->get('id'));
				$data['query1']=$this->home->get_car_list();
				$data['query2']=$this->home->get_driver_list();
				}
				$this->load->view('booking-details',$data);
			}else{
				redirect('admin/not_admin');
			}
		}else{
			redirect('admin/index');
		}
	}

	// get booking data call
	public function get_booking_data()
	{
		// storing  request (ie, get/post) global array to a variable
		$requestData= $_REQUEST;
		$filterData=$_POST['data_id'];
		if($filterData=='user-cancelled'){
			$filterstatusid='4';
			$filterbookingid='';
		}
		else if($filterData=='driver-unavailable'){
			$filterstatusid='6';
			$filterbookingid='';
		}
		else if($filterData=='completed'){
			$filterstatusid='9';
			$filterbookingid='';
		}
		else if(is_numeric($filterData)){
			$filterstatusid='';
			$filterbookingid=$filterData;
		}
		else{
			$filterstatusid='';
			$filterbookingid='';
		}
		$booking=$this->home->getbooking($requestData,$filterstatusid,$filterbookingid,$where=null,$filterData);
		echo $booking;
	}
	// get non disp booking data call
	public function get_nondisp_booking_data()
	{
		// storing  request (ie, get/post) global array to a variable
		$requestData= $_REQUEST;
		$booking=$this->home->getnondispbooking($requestData,$where=null);
		echo $booking;
	}

	//update booking call
	public function update_booking_data()
	{
		require_once(APPPATH.'views/push_messages.php');
		// storing  request (ie, get/post) global array to a variable
		$id= $_POST['id'];
		$data_id= $_POST['data_id'];
		$taxi_type = $_POST['taxi_type'];
		$amount = $_POST['amount'];
		$updatebooking=$this->home->updatebooking($id,$data_id,$taxi_type,$amount);
		if($updatebooking){
			$did='d_'.$data_id;
		    //$description=sprintf("Booking ID:%s New Booking Request Arrived.",$id);
		    $description=sprintf($new_booking_request_push,$id);
		    //---- Notification Start ---------//
		    $urlNotification = $this->base_ip.":8002/send";
			$data_json= sprintf('{
				"users": ["%s"],
				"ios": {
					"badge": 0,
					"alert": "%s",
					"sound": "soundName"
				}
			}',$did,$description,$description);
			//print_r($data_json);
			$ch1 = curl_init();
			curl_setopt($ch1, CURLOPT_URL, $urlNotification);
			curl_setopt($ch1, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
			curl_setopt($ch1, CURLOPT_POST, 1);
			curl_setopt($ch1, CURLOPT_POSTFIELDS,$data_json);
			curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true);
			$notification_response  = curl_exec($ch1);

			//print_r($response );
            $curl = curl_init();
            $driverId = $did;
			$pushTitle = urlencode($push_message_title);
			$pushBody = urlencode($description);
			curl_setopt_array($curl, array(
                CURLOPT_PORT => "4040",
                //CURLOPT_URL => "http://192.168.1.118:4141/send?driverId=u_333&pushTitle=Test%20Title&pushBody=Test%20Body",
                CURLOPT_URL => $this->base_ip.":4040/sendDriver?driverId=".$driverId."&pushTitle=".$pushTitle."&pushBody=".$pushBody."",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                //CURLOPT_POSTFIELDS => "id=5&title=sdfgn%20sdnfsd%20sdfs",
                CURLOPT_HTTPHEADER => array(
                	"cache-control: no-cache",
                    "content-type: application/x-www-form-urlencoded"
                ),
            ));

			$response = curl_exec($curl);
			$err = curl_error($curl);
			curl_close($curl);
			if ($err) {
				//echo "cURL Error #:" . $err;
			} else {
				//echo $response;
			}
			curl_close($ch);
			//---- Notification End ---------//
		}
	}

	//update driver data
	public function update_driver_data()
	{
		require_once(APPPATH.'views/push_messages.php');
		// storing  request (ie, get/post) global array to a variable
		$driver_id= $_POST['driver_id'];
		$data_id= $_POST['data_id'];
		$updatedriver=$this->home->updatedriver($driver_id,$data_id);
		//echo $updatedriver;
		if($updatedriver){
			$did='d_'.$driver_id;
		    //$description=sprintf("Booking ID:%s New Booking Request Arrived.",$data_id);
		    $description=sprintf($new_booking_request_push,$data_id);
		    //---- Notification Start ---------//
		    $urlNotification = $this->base_ip.":8002/send";
			$data_json= sprintf('{
				"users": ["%s"],
				"ios": {
					"badge": 0,
					"alert": "%s",
					"sound": "soundName"
				}
			}',$did,$description,$description);
			//print_r($data_json);
			$ch1 = curl_init();
			curl_setopt($ch1, CURLOPT_URL, $urlNotification);
			curl_setopt($ch1, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
			curl_setopt($ch1, CURLOPT_POST, 1);
			curl_setopt($ch1, CURLOPT_POSTFIELDS,$data_json);
			curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true);
			$notification_response  = curl_exec($ch1);

			//print_r($response );
            $curl = curl_init();
            $driverId = $did;
			$pushTitle = urlencode($push_message_title);
			$pushBody = urlencode($description);
			curl_setopt_array($curl, array(
                CURLOPT_PORT => "4040",
                //CURLOPT_URL => "http://192.168.1.118:4141/send?driverId=u_333&pushTitle=Test%20Title&pushBody=Test%20Body",
                CURLOPT_URL => $this->base_ip.":4040/sendDriver?driverId=".$driverId."&pushTitle=".$pushTitle."&pushBody=".$pushBody."",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                //CURLOPT_POSTFIELDS => "id=5&title=sdfgn%20sdnfsd%20sdfs",
                CURLOPT_HTTPHEADER => array(
                	"cache-control: no-cache",
                    "content-type: application/x-www-form-urlencoded"
                ),
            ));

			$response = curl_exec($curl);
			$err = curl_error($curl);
			curl_close($curl);
			if ($err) {
				//echo "cURL Error #:" . $err;
			} else {
				//echo $response;
			}
			curl_close($ch);
			//---- Notification End ---------//
		}
	}

	// multi booking delete call
	public function multi_booking_delete()
	{
		$data=$_POST['result'];
		$data=json_decode("$data",true);
		//print_r($data);exit;
		//echo $data['value'];exit;
		$user=$this->home->deletemultibooking($data);
		// print_r($res);
		echo $user;
	}

	//delete booking data call
	public function delete_booking_data()
	{
		$data_ids = $_REQUEST['data_ids'];
		$this->home->delbooking($data_ids);
	}

	//delete single booking call
	public function delete_single_booking_data()
	{
		$data_id = $_REQUEST['data_id'];
		$this->home->delsinglebooking($data_id);
	}

	// manage driver call
	public function manage_driver()
	{
		$this->seesion_set();

		if($this->session->userdata('username-admin') ||   $this->input->cookie('username-admin', false)){
			$permission = $this->permission();
			if(($this->session->userdata('role-admin') == 'admin') || ($permission == "access")) {
				if($this->input->get('flag')){
					$filter='flag';
					$data['query']=$filter;
				}
				else{
					$data['query']= NULL;
				}
				$this->load->view('manage-driver',$data);
			}else{
				redirect('admin/not_admin');
			}
		}else{
			redirect('admin/index');
		}
	}

	// manage cashout call
	public function manage_cashout()
	{
		$this->seesion_set();

		if($this->session->userdata('username-admin') ||   $this->input->cookie('username-admin', false)){
			$permission = $this->permission();
			if(($this->session->userdata('role-admin') == 'admin') || ($permission == "access")) {
				if($this->input->get('flag')){
					$filter='flag';
					$data['query']=$filter;
				}
				else{
					$data['query']= NULL;
				}
				$this->load->view('manage-cashout',$data);
			}else{
				redirect('admin/not_admin');
			}
		}else{
			redirect('admin/index');
		}
	}
	// manage flagged driver call
	public function manage_flagged_driver()
	{
		$this->seesion_set();

		if($this->session->userdata('username-admin') ||   $this->input->cookie('username-admin', false)){
			$permission = $this->permission();
			if(($this->session->userdata('role-admin') == 'admin') || ($permission == "access")) {
				$this->load->view('manage-flagged-driver');
			}else{
				redirect('admin/not_admin');
			}
		}else{
			redirect('admin/index');
		}
	}

	// driver details call
	public function view_driver_details()
	{
		$this->seesion_set();

		//$data=$_POST;
		if($this->session->userdata('username-admin') ||   $this->input->cookie('username-admin', false)){
			$permission = $this->permission();
			if(($this->session->userdata('role-admin') == 'admin') || ($permission == "access")) {
				$this->load->view('driver-details');
			}else{
				redirect('admin/not_admin');
			}
		}else{
			redirect('admin/index');
		}
	}
	// cashout details call
	public function view_cashout_details()
	{
		$this->seesion_set();

		//$data=$_POST;
		if($this->session->userdata('username-admin') ||   $this->input->cookie('username-admin', false)){
			$permission = $this->permission();
			if(($this->session->userdata('role-admin') == 'admin') || ($permission == "access")) {
				$this->load->view('cashout-details');
			}else{
				redirect('admin/not_admin');
			}
		}else{
			redirect('admin/index');
		}
	}
	// add driver call
	public function add_driver()
	{
		$this->seesion_set();

		//$data=$_POST;
		if($this->session->userdata('username-admin') ||   $this->input->cookie('username-admin', false)){
			$permission = $this->permission();
			if(($this->session->userdata('role-admin') == 'admin') || ($permission == "access")) {
				$this->load->view('add-driver');
			}else{
				redirect('admin/not_admin');
			}
		}else{
			redirect('admin/index');
		}
	}

	// insert driver data call
	public function insert_driver()
	{
		if(isset($_POST['save']))
		{
			$config['upload_path'] = './driverimages/';
			$config['allowed_types'] = 'gif|jpg|jpeg|png';
			$config['max_size']    = '2000';
			$config['max_width']  = '1024';
			$config['max_height']  = '768';

			$this->load->library('upload', $config);
			if (!$this->upload->do_upload('driverimage'))
			{
				$response = $this->session->set_flashdata('error_msg', $this->upload->display_errors());
				redirect(base_url().'admin/add_driver');
				// uploading failed. $error will holds the errors.
			}
			else {
				$email=$_POST['email'];
				$username=$_POST['username'];
				$check_email_username=$this->home->checkemailusername($email,$username);
				if($check_email_username) {
					$response = $this->session->set_flashdata('error_msg', 'email or username already exists');
					redirect(base_url().'admin/add_driver');
				}
				else {
					$upload_data = $this->upload->data();
					$data = array(
						'name' => $_POST['driverName'],
						'user_name' => $_POST['username'],
						'phone' => $_POST['driverPhone'],
						'address' => $_POST['driverAddress'],
						'email' => $_POST['email'],
						'license_no' => $_POST['licenseno'],
						'car_type' => $_POST['car_type'],
						'car_no' => $_POST['carno'],
						'gender' => $_POST['gender'],
						'dob' => $_POST['dob'],
						'Lieasence_Expiry_Date' => $_POST['licennex'],
						'license_plate' => $_POST['licenseplate'],
						'Insurance' => $_POST['insurance'],
						'Car_Model' => $_POST['car_model'],
						'Car_Make' => $_POST['car_make'],
						'image' => $upload_data['file_name'],
						'status' => 'Active'
					);
					$response = $this->home->insertdriverdata($data);
					redirect(base_url() . 'admin/manage_driver');
				}
			}
		}
	}

	// add transaction
	public function add_transact()
	{
		$driverId = $_POST['driverId'];
		$transact_mode = $_POST['transact_mode'];
        $transact_date = $_POST['transact_date'];
        $transact_amount = $_POST['transact_amount'];
        $transact_description = $_POST['transact_description'];
        $transact_comment = $_POST['transact_comment'];

		if($driverId!='' && $transact_mode!='' && $transact_date!='' && $transact_amount!='' && $transact_description!='' && $transact_comment!=''){
			$data = array(
				't_driver_id' => $driverId,
				'payment_mode' => $transact_mode,
				'payment_date' => $transact_date,
				'description' => $transact_description,
				'comment' => $transact_comment,
				'amount' => $transact_amount
			);

			$result = $this->home->inserttransact($data);
			if($result){
				return true;
			}
			else{
				return false;
			}
		}
	}

	//create accuarate
	public function add_accurate()
	{

		$url = 'https://api.accuratebackground.com/v3/candidate';
		$method = 'POST';
		$username = ACCURATE_USERNAME;
		$password = ACCURATE_PASS;
		$auth = base64_encode($username.':'.$password);
		$driver_id = $_POST['driver_id'];
		$id = $_POST['id'];
		$first_name = $_POST['firstName'];
		$last_name = $_POST['lastName'];
		$phone = $_POST['phone'];
		$address = $_POST['address'];
		$dataOfBirth = $_POST['dateOfBirth'];
		$dataOfBirth = date("Y-m-d", strtotime($dataOfBirth));
		$email = $_POST['email'];
		$post_val = 'firstName='.$first_name;
		$post_val .= '&lastName='.$last_name;
		$post_val .= '&dateOfBirth='.$dataOfBirth;
		$post_val .= '&phone='.$phone;
		$post_val .= '&address='.$address;
		$post_val .= '&email='.$email;
		$ssn = $_POST['ssn'];
		$post_val .= '&ssn='.$ssn;
		$alias_firstName = $_POST['alias_firstName'];
		$post_val .= '&alias.firstName='.$alias_firstName;

		$alias_lastName = $_POST['alias_lastName'];
		$post_val .= '&alias.lastName='.$alias_lastName;

		$alias_middleName = $_POST['alias_middleName'];
		$post_val .= '&alias.middleName='.$alias_middleName;

		$governmentId_country =$_POST['governmentId_country'];
		$post_val .= '&governmentId.country='.$governmentId_country;

		$governmentId_type = $_POST['governmentId_type'];
		$post_val .= '&governmentId.type='.$governmentId_type;

		$governmentId_number = $_POST['governmentId_number'];
		$post_val .= '&governmentId.number='.$governmentId_number;

		$city = $_POST['city'];
		$post_val .= '&city='.$city;

		$region =$_POST['region'];
		$post_val .= '&region='.$region;

		$country = $_POST['country'];
		$post_val .= '&country='.$country;

		$postalCode = $_POST['postalCode'];
		$post_val .= '&postalCode='.$postalCode;

		//Required for EMP product only in Express workflow. EMP=Employment Verification
//		$prevEmployed = $_POST['prevEmployed'];
//		$post_val .= '&prevEmployed='.$prevEmployed;
//
//		$employments_employer = $_POST['employments_employer'];
//		$post_val .= '&employments[0].employer='.$employments_employer;
//
//		$employments_country = $_POST['employments_country'];
//		$post_val .= '&employments[0].country='.$employments_country;
//
//		$employments_region = $_POST['employments_region'];
//		$post_val .= '&employments[0].region='.$employments_region;
//
//		$employments_city = $_POST['employments_city'];
//		$post_val .= '&employments[0].city='.$employments_city;
//
//		$employments_startDate = $_POST['employments_startDate'];
//		$post_val .= '&employments[0].startDate='.$employments_startDate;
//
//		$employments_endDate =$_POST['employments_endDate'];
//		$post_val .= '&employments[0].endDate='.$employments_endDate;
//
//		$employments_presentlyEmployed = $_POST['employments_presentlyEmployed'];
//		$post_val .= '&employments[0].presentlyEmployed='.$employments_presentlyEmployed;
//
//		$employments_okToCall = $_POST['employments_okToCall'];
//		$post_val .= '&employments[0].okToCall='.$employments_okToCall;

		//Required for EDU product only in Express workflow;
//		$educations_school = $_POST['educations_school'];
//		$post_val .= '&educations[0].school='.$educations_school;
//
//		$educations_country = $_POST['educations_country'];
//		$post_val .= '&educations[0].country='.$educations_country;
//
//		$educations_region = $_POST['educations_region'];
//		$post_val .= '&educations[0].region='.$educations_region;
//
//		$educations_city = $_POST['educations_city'];
//		$post_val .= '&educations[0].city='.$educations_city;
//
//		$educations_degree = $_POST['educations_degree'];
//		$post_val .= '&educations[0].degree='.$educations_degree;
//
//		$educations_major  = $_POST['educations_major'];
//		$post_val .= '&educations[0].major='.$educations_major;
//
//		$educations_startDate = $_POST['educations_startDate'];
//		$post_val .= '&educations[0].startDate='.$educations_startDate;
//
//		$educations_endDate = $_POST['educations_endDate'];
//		$post_val .= '&educations[0].endDate='.$educations_endDate;
//
//		$educations_graduationDate = $_POST['educations_graduationDate'];
//		$post_val .= '&educations[0].graduationDate='.$educations_graduationDate;
//
//
//		$educations_graduated = $_POST['educations_graduated'];
//		$post_val .= '&educations[0].graduated='.$educations_graduated;
//
//		$educations_presentlyEnrolled = $_POST['educations_presentlyEnrolled'];
//		$post_val .= '&educations[0].presentlyEnrolled='.$educations_presentlyEnrolled;

		//Required for MVR and PLV products only in Express workflow
		$licenses_category = $_POST['licenses_category'];
		$post_val .= '&licenses[0].category='.$licenses_category;

		$licenses_type = $_POST['licenses_type'];
		$post_val .= '&licenses[0].type='.$licenses_type;

		$licenses_number = $_POST['licenses_number'];
		$post_val .= '&licenses[0].number='.$licenses_number;

		$licenses_issuingAuthority = $_POST['licenses_issuingAuthority'];
		$post_val .= '&licenses[0].issuingAuthority='.$licenses_issuingAuthority;

		$licenses_country = $_POST['licenses_country'];
		$post_val .= '&licenses[0].country='.$licenses_country;

		$licenses_region = $_POST['licenses_region'];
		$post_val .= '&licenses[0].region='.$licenses_region;

		$licenses_city = $_POST['licenses_city'];
		$post_val .= '&licenses[0].city='.$licenses_city;

		//Required for REF1 product only in Express workflow;
//		$references_name = $_POST['references_name'];
//		$post_val .= '&references[0].name='.$references_name;
//
//		$references_relationship = $_POST['references_relationship'];
//		$post_val .= '&references[0].relationship='.$references_relationship;
//
//		$references_phone = $_POST['references_phone'];
//		$post_val .= '&references[0].phone='.$references_phone;
//
//		$references_email = $_POST['references_email'];
//		$post_val .= '&references[0].email='.$references_email;
//
//		$references_country = $_POST['references_country'];
//		$post_val .= '&references[0].country='.$references_country;
//
//		$references_region = $_POST['references_region'];
//		$post_val .= '&references[0].region='.$references_region;
//
//		$references_city = $_POST['references_city'];
//		$post_val .= '&references[0].city='.$references_city;
//
//		$references_postalCode = $_POST['references_postalCode'];
//		$post_val .= '&references[0].postalCode='.$references_postalCode;

		if($id != '') {
			$url = 'https://api.accuratebackground.com/v3/candidate/'.$id;
			$method = 'PUT';//GET
		}

		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_PORT => "443",
			CURLOPT_URL => $url,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => $method,
//			CURLOPT_POSTFIELDS => "firstName=Gold&lastName=Starkyg&email=gold@gmail.com",
			CURLOPT_POSTFIELDS => $post_val,
			CURLOPT_HTTPHEADER => array(
				"Content-Type: application/x-www-form-urlencoded",
//				"Authorization: Basic ZDcxOWI3YzktYWVlMC00ZDAwLTlkYjYtZDhlZGI1M2JjMWJlOmEzMTAzNTQ4LTBkM2MtNDBlOS1iMWI5LTVjN2EzMmViOTA2YQ=="
				"Authorization: Basic ".$auth,
				'Cache-Control: no-cache'
			),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);
		curl_close($curl);

		if ($err) {
			echo "cURL Error #:" . $err;
		} else {
			$param = 'insert';
			if($_POST['id'] != '') $param = 'update';
			$result = $this->home->insert_update_accurate_create(json_decode($response), $driver_id, $param);
			//place and order
			if(!empty($result['id']))
				$result = $this->order_accurate($result, $driver_id) ;
			echo json_encode($result);
		}
	}

	//order
	public function order_accurate($result, $driver_id)
	{

		$url = 'https://api.accuratebackground.com/v3/order';
		$method = 'POST';
		$username = ACCURATE_USERNAME;
		$password = ACCURATE_PASS;
		$auth = base64_encode($username.':'.$password);
		$package_type = 'PKG_BASIC'; // PKG_BASIC, PKG_STANDARD, PKG_PRO, PKG_EMPTY
		$workflow = 'EXPRESS' ;// EXPRESS ,  INTERACTIVE
		$country = 'US';
		$region = 'CA';
		$city = 'Irvine';
		$post_val = 'candidateId='.$result['id'];
		$post_val .= '&packageType='.$package_type;
		$post_val .= '&workflow='.$workflow;
		$post_val .= '&jobLocation.country='.$country;
		$post_val .= '&jobLocation.region='.$region;
		$post_val .= '&jobLocation.city='.$city;

		//Required for MVR and PLV products only in Express workflow
//		$licenses_category = $_POST['licenses_category'];
//		$post_val .= '&licenses[0].category='.$licenses_category;
//
//		$licenses_type = $_POST['licenses_type'];
//		$post_val .= '&licenses[0].type='.$licenses_type;
//
//		$licenses_number = $_POST['licenses_number'];
//		$post_val .= '&licenses[0].number='.$licenses_number;
//
//		$licenses_issuingAuthority = $_POST['licenses_issuingAuthority'];
//		$post_val .= '&licenses[0].issuingAuthority='.$licenses_issuingAuthority;
//
//		$licenses_country = $_POST['licenses_country'];
//		$post_val .= '&licenses[0].country='.$licenses_country;
//
//		$licenses_region = $_POST['licenses_region'];
//		$post_val .= '&licenses[0].region='.$licenses_region;
//
//		$licenses_city = $_POST['licenses_city'];
//		$post_val .= '&licenses[0].city='.$licenses_city;

		$post_val .= '&additionalProductTypes[0].productType=MVR';

		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_PORT => "443",
			CURLOPT_URL => $url,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => $method,
//			CURLOPT_POSTFIELDS => "firstName=Gold&lastName=Starkyg&email=gold@gmail.com",
			CURLOPT_POSTFIELDS => $post_val,
			CURLOPT_HTTPHEADER => array(
				"Content-Type: application/x-www-form-urlencoded",
//				"Authorization: Basic ZDcxOWI3YzktYWVlMC00ZDAwLTlkYjYtZDhlZGI1M2JjMWJlOmEzMTAzNTQ4LTBkM2MtNDBlOS1iMWI5LTVjN2EzMmViOTA2YQ=="
				"Authorization: Basic ".$auth,
				'Cache-Control: no-cache'
			),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);
		curl_close($curl);
		
		if ($err) {
			//echo "cURL Error #:" . $err;
			return "cURL Error #:" . $err;
		} else {
			$result = $this->home->insert_update_accurate_order(json_decode($response), $driver_id);
//			echo json_encode($result);
			return $result;
		}
	}

	//check order status
	public function check_order_accurate()
	{
		$order_id = $_POST['order_id'];
		$driver_id = $_POST['driver_id'];
		$url = 'https://api.accuratebackground.com/v3/order/'.$order_id;
		$method = 'GET';
		$username = ACCURATE_USERNAME;
		$password = ACCURATE_PASS;
		$auth = base64_encode($username.':'.$password);

		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_PORT => "443",
			CURLOPT_URL => $url,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => $method,
//			CURLOPT_POSTFIELDS => "firstName=Gold&lastName=Starkyg&email=gold@gmail.com",
			CURLOPT_HTTPHEADER => array(
				"Content-Type: application/x-www-form-urlencoded",
//				"Authorization: Basic ZDcxOWI3YzktYWVlMC00ZDAwLTlkYjYtZDhlZGI1M2JjMWJlOmEzMTAzNTQ4LTBkM2MtNDBlOS1iMWI5LTVjN2EzMmViOTA2YQ=="
				"Authorization: Basic ".$auth,
				'Cache-Control: no-cache'
			),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);
		curl_close($curl);
		if ($err) {
			echo "cURL Error #:" . $err;
		} else {
			$result = $this->home->insert_update_accurate_check(json_decode($response), $driver_id);
			echo json_encode($result);
		}
	}
	
	// add transaction
	public function add_inspect_appoint()
	{
		$inspect_date = $_POST['inspect_date'];
		$inspect_time = $_POST['inspect_time'];
		$inspector = $_POST['inspector'];
		$location = $_POST['location'];
		$driver_id = $_POST['driver_id'];
		$inspect_checked = $_POST['inspect_checked'];

		if($inspect_checked == 'true'){
			$data = array(
				'inspect_date' => $inspect_date,
				'inspect_time' => $inspect_time,
				'inspector' => $inspector,
				'location' => $location,
				'driver_id' => $driver_id
			);

			$result = $this->home->insertinspectappoint($data);
			if($result){
				return true;
			}
			else{
				return false;
			}
		}else {
			$data = array(
				'driver_id' => $driver_id
			);
			$result = $this->home->deleteinspectappoint($data);
			if($result){
				return true;
			}
			else{
				return false;
			}
		}
	}
	// get driver data call
	public function get_driver_data()
	{
		$requestData= $_REQUEST;
		$filterData=$_POST['data_id'];

		if($filterData=='yes'){
			$flagfilter=$filterData;
		}
		else{
			$flagfilter='';
		}
		// storing  request (ie, get/post) global array to a variable
		$requestData= $_REQUEST;
		$driver=$this->home->getdriver($requestData,$flagfilter,$where=null);
		echo $driver;
	}

	// get cashout data call
	public function get_cashout_data()
	{
		$requestData= $_REQUEST;
		$filterData=$_POST['data_id'];
		if($filterData=='yes'){
			$flagfilter=$filterData;
		}
		else{
			$flagfilter='';
		}
		// storing  request (ie, get/post) global array to a variable
		$requestData= $_REQUEST;
		$driver=$this->home->getcashout($requestData,$flagfilter,$where=null);
		echo $driver;
	}
	//get select driver data call
	public function get_select_driver_data()
	{
		// storing  request (ie, get/post) global array to a variable
		$requestData= $_REQUEST;
		$booking_id=$_POST['booking_id'];
		$user=$this->home->getselectdriver($requestData,$booking_id,$where=null);
		echo $user;
	}

	// get select booking data call
	public function get_select_booking_data()
	{
		// storing  request (ie, get/post) global array to a variable
		$requestData= $_REQUEST;
		$driver_id=$_POST['driver_id'];
		$car_type = $_POST['car_type'];
		$user=$this->home->getselectbooking($requestData,$driver_id,$car_type,$where=null);
		echo $user;
	}
	// get car type data call
	public function get_cartype_data()
	{
		$cab_id=$_POST['cab_id'];
		$cab_details=$this->home->getcartypedata($cab_id);
		if($cab_details){
			echo json_encode($cab_details);
		}
	}
	//delete driver data call
	public function delete_driver_data()
	{
		$get_data_ids = $_REQUEST['data_ids'];
		$data_ids[] = $_REQUEST['data_ids'];
		$implode_driver_ids = implode(',',$data_ids);
		$integerIDs = array_map('intval', explode(',', $implode_driver_ids));
		$json_array = array(
            'driverId' => $integerIDs
		);
		$new_json_array = json_encode($json_array,JSON_UNESCAPED_SLASHES);
		$this->home->deldriver($get_data_ids);
		$ch = curl_init();
	    curl_setopt($ch, CURLOPT_URL, $this->base_ip.':4040/deleteDriver?'.$new_json_array); //Url together with parameters
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //Return data instead printing directly in Browser
	    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT , 7); //Timeout after 7 seconds
	    curl_setopt($ch, CURLOPT_USERAGENT , "Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1)");
	    curl_setopt($ch, CURLOPT_HEADER, 0);
		$result = curl_exec($ch);
	    curl_close($ch);
	}
	public function delete_rating_data()
	{
		$data_ids = $_REQUEST['data_ids'];
		$this->home->delrating($data_ids);
	}
	public function delete_driver_rating_data()
	{
		$data_ids = $_REQUEST['data_ids'];
		$this->home->del_driverrating($data_ids);
	}
	//delete_single_driverrating_data
	public function delete_single_driverrating_data()
	{
		$data_id = $_REQUEST['data_id'];
		$this->home->delsingle_userrating($data_id);
	}
	public function delete_single_rating_data()
	{
		$data_id = $_REQUEST['data_id'];
		$this->home->delsinglerating($data_id);
	}
	//delete single driver data call
	public function delete_single_driver_data()
	{
		$single_id = $_REQUEST['data_id'];
		$data_id[] = $_REQUEST['data_id'];
		$implode_driver_ids = implode(',',$data_id);
		$integerIDs = array_map('intval', explode(',', $implode_driver_ids));
		$json_array = array(
            'driverId' => $integerIDs
		);
		$new_json_array = json_encode($json_array,JSON_UNESCAPED_SLASHES);
		$this->home->delsingledriver($single_id);
		$ch = curl_init();
	    curl_setopt($ch, CURLOPT_URL, $this->base_ip.':4040/deleteDriver?'.$new_json_array ); //Url together with parameters
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //Return data instead printing directly in Browser
	    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT , 7); //Timeout after 7 seconds
	    curl_setopt($ch, CURLOPT_USERAGENT , "Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1)");
	    curl_setopt($ch, CURLOPT_HEADER, 0);
		$result = curl_exec($ch);
	    curl_close($ch);
	}

	// manage car type call
	public function manage_car_type()
	{
		$this->seesion_set();

		if($this->session->userdata('username-admin') ||   $this->input->cookie('username-admin', false)){
			$permission = $this->permission();
			if(($this->session->userdata('role-admin') == 'admin') || ($permission == "access")) {
				$this->load->view('manage-cartype');
			}else{
				redirect('admin/not_admin');
			}
		}else{
			redirect('admin/index');
		}
	}

	// view car call
	/*public function view_car()
	{

		if ($this->session->userdata('username-admin') || $this->input->cookie('username-admin', false)) {
			$permission = $this->permission();
			if (($this->session->userdata('role-admin') == 'admin') || ($permission == "access")) {
				$this->load->view('view_car');
			} else {
				redirect('admin/not_admin');
			}
		} else {
			redirect('admin/index');
		}
	}*/

	// edit car type call
	public function view_cartype_details()
	{
		$this->seesion_set();

		//$data=$_POST;
		if($this->session->userdata('username-admin') ||   $this->input->cookie('username-admin', false)){
			$permission = $this->permission();
			if(($this->session->userdata('role-admin') == 'admin') || ($permission == "access")) {
				$this->load->view('cartype-details');
			}else{
				redirect('admin/not_admin');
			}
		}else{
			redirect('admin/index');
		}
	}

	// add car call
	public function add_car()
	{
		$this->seesion_set();

		if($this->session->userdata('username-admin') ||   $this->input->cookie('username-admin', false)){
			$permission = $this->permission();
			if(($this->session->userdata('role-admin') == 'admin') || ($permission == "access")) {
				$this->load->view('add-car');
			}else{
				redirect('admin/not_admin');
			}
		}else{
			redirect('admin/index');
		}
	}

	// add inspection
	public function add_inspection()
	{
		$this->seesion_set();

		if($this->session->userdata('username-admin') ||   $this->input->cookie('username-admin', false)){
			$permission = $this->permission();
			if(($this->session->userdata('role-admin') == 'admin') || ($permission == "access")) {
				$this->load->view('add-inspection');
			}else{
				redirect('admin/not_admin');
			}
		}else{
			redirect('admin/index');
		}
	}

	// insert car data call
	public function insert_car()
	{
		if(isset($_POST['save']))
		{
			$config['upload_path'] = './car_image/';
			$config['allowed_types'] = 'gif|jpg|jpeg|png';
			$config['max_size']    = '2000';
			$config['max_width']  = '1024';
			$config['max_height']  = '768';

			$this->load->library('upload', $config);
			if (!$this->upload->do_upload('uploadImageFile'))
			{
				$response = $this->session->set_flashdata('error_msg', $this->upload->display_errors());
				redirect(base_url().'admin/add_car');
				// uploading failed. $error will holds the errors.
			}
			else {
				$upload_data = $this->upload->data();
				$data = array(
					'cartype' => $_POST['cartype'],
//					'cartype_arabic' => $_POST['cartype_arabic'],
					'car_rate' => $_POST['carrate'],
					'transfertype' => $_POST['transfertype'],
//					'transfertype_arabic' => $_POST['transfertype_arabic'],
					'intialkm' => $_POST['intialkm'],
					'fromintialkm' => $_POST['fromintialkm'],
					'fromintailrate' => $_POST['fromintailrate'],
					'night_fromintailrate' => $_POST['night_fromintailrate'],
					'timetype' => $_POST['timetype'],
					'icon' => $upload_data['file_name'],
					'description' => $_POST['description'],
//					'description_arabic' => $_POST['description_arabic'],
					'ride_time_rate' => $_POST['ride_time_rate'],
					'night_ride_time_rate' => $_POST['night_ride_time_rate'],
					'night_intailrate' => $_POST['night_intailrate'],
					'seat_capacity' => $_POST['seating_capacity']
				);
				$response = $this->home->insertcardata($data);
				redirect(base_url().'admin/manage_car_type');
			}
		}
	}

	public function return_val($params, $val) {
		$property = '' ;
		if(!empty($params[$val])) $property = $params[$val];
		return $property;
	}
	// insert car data call
	public function insert_inspection()
	{
		$driver_id = 0;
		if(isset($_POST['save']))
		{
			extract( $_POST);
			$param = $_POST;
			$driver_id = $_POST['driver_id'];
				$data = array(
					'driver_id' => $param['driver_id'],
					'staff_id' => $param['staff_id'],
					'staff_type' => $param['staff_type'],
					'inspect_result' => $this->return_val($param,'inspect_result'),
					'head_lights' => $this->return_val($param,'head_lights'),
					'tail_lights' => $this->return_val($param,'tail_lights'),
					'turn_indicator_lights' => $this->return_val($param,'turn_indicator_lights'),
					'stop_lights' => $this->return_val($param,'stop_lights'),
					'brake_pad' => $this->return_val($param,'brake_pad'),
					'min_per_manufacture' => $this->return_val($param,'min_per_manufacture'),
					'right_front_measurements' => $this->return_val($param,'right_front_measurements'),
					'left_front_measurements' => $this->return_val($param,'left_front_measurements'),
					'right_rear_measurements' => $this->return_val($param,'right_rear_measurements'),
					'left_rear_measurements' => $this->return_val($param,'left_rear_measurements'),
					'parking_brake' => $this->return_val($param,'parking_brake'),
					'steering_mechanism' => $this->return_val($param,'steering_mechanism'),
					'ball_joints' => $this->return_val($param,'ball_joints'),
					'tie_rods' => $this->return_val($param,'tie_rods'),
					'rack_pinion' => $this->return_val($param,'rack_pinion'),
					'bushings' => $this->return_val($param,'bushings'),
					'windshield' => $this->return_val($param,'windshield'),
					'large_crack' => $this->return_val($param,'large_crack'),
					'small_crack' => $this->return_val($param,'small_crack'),
					'other_glass' => $this->return_val($param,'other_glass'),
					'windshield_wipers' => $this->return_val($param,'windshield_wipers'),
					'front_seat_adjustment' => $this->return_val($param,'front_seat_adjustment'),
					'doors' => $this->return_val($param,'doors'),
					'horn' => $this->return_val($param,'horn'),
					'speedometer' => $this->return_val($param,'speedometer'),
					'bumper' => $this->return_val($param,'bumper'),
					'exhaust_system' => $this->return_val($param,'exhaust_system'),
					'tread_depth' => $this->return_val($param,'tread_depth'),
					'right_front' => $this->return_val($param,'right_front'),
					'left_front' => $this->return_val($param, 'left_front'),
					'right_rear' => $this->return_val($param, 'right_rear'),
					'left_rear' => $this->return_val($param, 'left_rear'),
					'mirrops' => $this->return_val($param, 'mirrops'),
					'passenger' => $this->return_val($param, 'passenger'),
					'vehicle_mileage' => $this->return_val($param, 'vehicle_mileage'),
					'license_plate' => $this->return_val($param, 'license_plate'),
					'vin' => $this->return_val($param, 'vin'),
					'vehicle_make' => $this->return_val($param, 'vehicle_make'),
					'vehicle_model' => $this->return_val($param, 'vehicle_model'),
					'model_year' => $this->return_val($param, 'model_year'),
					'of_doors' => $this->return_val($param, 'of_doors'),
					'inspector_name' => $this->return_val($param, 'inspector_name'),
					'inspection_address' => $this->return_val($param, 'inspection_address')
				);

				$response = $this->home->insertinspection($data);
				redirect(base_url().'admin/view_driver_details?id='.$driver_id);

		}
	}
	// get car data call
	public function get_car_data()
	{
		// storing  request (ie, get/post) global array to a variable
		$requestData= $_REQUEST;
		$user=$this->home->getcar($requestData,$where=null);
		echo $user;
	}

	//delete car data call
	public function delete_car_data()
	{
		$data_ids = $_REQUEST['data_ids'];
		$this->home->delcar($data_ids);
	}

	//delete single car data call
	public function delete_single_car_data()
	{
		$data_id = $_REQUEST['data_id'];
		$this->home->delsinglecar($data_id);
	}

	//manage time type call
	public function manage_time_type()
	{
		$this->seesion_set();

		if($this->session->userdata('username-admin') ||   $this->input->cookie('username-admin', false)){
			$permission = $this->permission();
			if(($this->session->userdata('role-admin') == 'admin') || ($permission == "access")) {
				$this->load->view('manage-daytime');
			}else{
				redirect('admin/not_admin');
			}
		}else{
			redirect('admin/index');
		}
	}

	// edit time type call
	public function edit_time_type()
	{
		$this->seesion_set();

		if($this->session->userdata('username-admin') ||   $this->input->cookie('username-admin', false)){
			$permission = $this->permission();
			if(($this->session->userdata('role-admin') == 'admin') || ($permission == "access")) {
				$this->load->view('daytime-details');
			}else{
				redirect('admin/not_admin');
			}
		}else{
			redirect('admin/index');
		}
	}

	//get time type call
	public function get_time_type_data()
	{
		// storing  request (ie, get/post) global array to a variable
		$requestData= $_REQUEST;
		$user=$this->home->gettimetype($requestData,$where=null);
		echo $user;
	}

	// manage delay reasons call
	public function manage_delay_reasons()
	{
		$this->seesion_set();

		if($this->session->userdata('username-admin') ||   $this->input->cookie('username-admin', false)){
			$permission = $this->permission();
			if(($this->session->userdata('role-admin') == 'admin') || ($permission == "access")) {
				$this->load->view('manage-delay-reason');
			}else{
				redirect('admin/not_admin');
			}
		}else{
			redirect('admin/index');
		}
	}

	// edit delay reason call
	public function view_delayreason_details()
	{
		$this->seesion_set();

		if($this->session->userdata('username-admin') ||   $this->input->cookie('username-admin', false)){
			$permission = $this->permission();
			if(($this->session->userdata('role-admin') == 'admin') || ($permission == "access")) {
				$this->load->view('delayreason-details');
			}else{
				redirect('admin/not_admin');
			}
		}else{
			redirect('admin/index');
		}
	}

	// add delay reason call
	public function add_reason()
	{
		$this->seesion_set();

		if($this->session->userdata('username-admin') ||   $this->input->cookie('username-admin', false)){
			$permission = $this->permission();
			if(($this->session->userdata('role-admin') == 'admin') || ($permission == "access")) {
				$this->load->view('add-reason');
			}else{
				redirect('admin/not_admin');
			}
		}else{
			redirect('admin/index');
		}
	}

	//get reason data call
	public function get_reason_data()
	{
		// storing  request (ie, get/post) global array to a variable
		$requestData= $_REQUEST;
		$reason=$this->home->getreasons($requestData,$where=null);
		echo $reason;
	}

	//delete reason data call
	public function delete_reason_data()
	{
		$data_ids = $_REQUEST['data_ids'];
		$this->home->delres($data_ids);
	}

	//delete single reason data call
	public function delete_single_reason_data()
	{
		$data_id = $_REQUEST['data_id'];
		$this->home->delsingleres($data_id);
	}

	// update settings call
	public function update_settings()
	{
		$this->seesion_set();

		//$data=$_POST;
		if($this->session->userdata('username-admin') ||   $this->input->cookie('username-admin', false)){
			$permission = $this->permission();
			if(($this->session->userdata('role-admin') == 'admin') || ($permission == "access")) {

				$this->load->view('update_settings');
			}else{
				redirect('admin/not_admin');
			}
		}else{
			redirect('admin/index');
		}
	}

	// update web commision call
	public function update_web_commision()
	{
		$this->seesion_set();

		//$data=$_POST;
		if($this->session->userdata('username-admin') ||   $this->input->cookie('username-admin', false)){
			$permission = $this->permission();
			if(($this->session->userdata('role-admin') == 'admin') || ($permission == "access")) {

				$this->load->view('update_web_commision');
			}else{
				redirect('admin/not_admin');
			}
		}else{
			redirect('admin/index');
		}
	}
	public function update_user_status()
	{
		$data_id = $_REQUEST['data_id'];
		$this->home->statususer($data_id);
	}
		public function update_staff_status()
	{
		$data_id = $_REQUEST['data_id'];
		$this->home->statusstaff($data_id);
	}
	public function update_driver_status()
	{
		require_once(APPPATH.'views/email_messages.php');
		require_once(APPPATH.'views/push_messages.php');
		$data_id = $_REQUEST['data_id'];
		$result=$this->home->statusdriver($data_id);
		if($result!='1') {
		$table = 'driver_details';
							$select_data = "*";
							$this->db->select($select_data);
							$this->db->where("id",$data_id);
							$query = $this->db->get($table);
							$result_driver = $query->result_array();
							$email=$result_driver[0]["email"];
							//$email='tismember1@gmail.com';
							$password=$result_driver[0]["password"];
							//$password='123';
							$subject = $account_activate_str;
							$email_body ='<div style="background-color: #00bcd4; color: #0b0b0b;">
			     			<table style="background-color:#292A6B;border:1px solid #20264a;padding:10px;font-family:Verdana;font-size:12px" width="100%"><tbody><tr><td align="center"><img class="CToWUd" src="'.$this->base_path.'upload/logo.png" style="min-height:5%;width:5%"></td></tr>
			     			<tr> <td>
			     			 <table style="padding:10px;font-size:12px;background-color:#fff;border:1px solid #2d62ac" cellpadding="5" width="100%">
			     			 <tbody>
			     			 <tr><td colspan="4">&nbsp;</td></tr>
			     			 <tr>
			     			 <td colspan="4" style="font-family:Verdana,Geneva,sans-serif;font-size:12px;text-align:left"> '.$hello_str.' '.$email.'</td></tr>
			     			 <tr><td colspan="4" style="font-family:Verdana,Geneva,sans-serif;font-size:12px;text-align:left"> <br><br> '.$account_verification_str.'  </td></tr>
			     			 <tr> <td colspan="4"> <table style="font-family:Verdana,Geneva,sans-serif;font-size:12px;width:600px;border-collapse:collapse" height="30"> <tbody>
			     			 <tr> <th style="border:1px solid #808080!important;font-size:1.1em;text-align:left;padding-top:5px;padding-left:10px;padding-bottom:5px;background-color:#cdcdcd!important;color:#000000!important" width="20%">'.$email_str.'</th>
			     			 <th style="border:1px solid #808080!important;font-size:1.1em;text-align:left;padding-top:5px;padding-left:10px;padding-bottom:5px;background-color:#cdcdcd!important;color:#000000!important" width="35%">'.$email.'</th> </tr>
			     			 <tr> <th style="border:1px solid #808080!important;font-size:1.1em;text-align:left;padding-top:5px;padding-left:10px;padding-bottom:5px;background-color:#cdcdcd!important;color:#000000!important" width="20%">'.$password_str.'</th>
			     			  <th style="border:1px solid #808080!important;font-size:1.1em;text-align:left;padding-top:5px;padding-left:10px;padding-bottom:5px;background-color:#cdcdcd!important;color:#000000!important" width="35%">'.$password.'</th> </tr>
			     			  <tr><td colspan="4" style="font-family:Verdana,Geneva,sans-serif;font-size:12px;text-align:left"></td></tr> <tr><td colspan="4" style="font-family:Verdana,Geneva,sans-serif;font-size:12px;text-align:left"><br>
			     			  <br> '.$contact_str.' <a href="mailto:noreplyokayswiss@gmail.com" target="_blank">noreplyokayswiss@gmail.com</a>. <br><br><br>'.$thanks_str.'. </td></tr> <tr><td>'.$okay_team_str.'.</td></tr></tbody> </table> </td> </tr> </tbody>
			     			  </table> </td> </tr>
			     			  </tbody></table>
			     			</div>';
							$this->load->library('My_PHPMailer');
					        $mail = new PHPMailer();
					        $mail->IsSMTP(); // we are going to use SMTP
					        //$mail->SMTPDebug = 3;
					        $mail->SMTPAuth   = true; // enabled SMTP authentication
					        $mail->SMTPSecure = "tls";  // prefix for secure protocol to connect to the server
					        $mail->Host       = "smtp.gmail.com";      // setting GMail as our SMTP server
					        $mail->Port       = 587;                   // SMTP port to connect to GMail
					        $mail->Username   = $send_mail_id;  // user email address
					        $mail->Password   = $send_mail_password;            // password in GMail
					        $mail->SetFrom($send_mail_id, $send_mail_name);  //Who is sending the email
					        $mail->AddReplyTo($send_mail_id,$send_mail_name);  //email address that receives the response
					        $mail->Subject    = $subject;
					        $mail->Body      = $email_body;
					        $mail->AltBody    = "OCRIDES New Email";
					        $mail->AddAddress($email, "Receiver");
						$mail->Send();
					$did = 'd_'.$data_id;
            	//$description1=sprintf("HOWDY !! your account is been verified successfully. You can now login to our app");
					$description1=sprintf($account_verification_push);
            	//---- Notification Start ---------//
                    $curl = curl_init();
                    $driverId = $did;
                    $pushTitle = urlencode($push_message_title);
                    $pushBody = urlencode($description1);
                    curl_setopt_array($curl, array(
                      CURLOPT_PORT => "4040",
                      //CURLOPT_URL => "http://192.168.1.118:4141/send?driverId=u_333&pushTitle=Test%20Title&pushBody=Test%20Body",
                      CURLOPT_URL => $this->base_ip.":4040/sendDriver?driverId=".$driverId."&pushTitle=".$pushTitle."&pushBody=".$pushBody."",
                      CURLOPT_RETURNTRANSFER => true,
                      CURLOPT_ENCODING => "",
                      CURLOPT_MAXREDIRS => 10,
                      CURLOPT_TIMEOUT => 30,
                      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                      CURLOPT_CUSTOMREQUEST => "GET",
                      //CURLOPT_POSTFIELDS => "id=5&title=sdfgn%20sdnfsd%20sdfs",
                      CURLOPT_HTTPHEADER => array(
                        "cache-control: no-cache",
                        "content-type: application/x-www-form-urlencoded"
                      ),
                    ));

                    $response = curl_exec($curl);
                    $err = curl_error($curl);
                    curl_close($curl);
                    if ($err) {
                      //echo "cURL Error #:" . $err;
                    } else {
                      //echo $response;
                    }
                      curl_close($curl);
                    //---- Notification End ---------//
			$urlNotification = $this->base_ip.":8002/send";
			$data_json= sprintf('{
                    "users": ["%s"],
                        "ios": {
                            "badge": 0,
                            "alert": "%s",
                            "sound": "soundName"
                        }
                    }',$driverId,$description1,$description1);
			//print_r($data_json);
			$ch1 = curl_init();
			curl_setopt($ch1, CURLOPT_URL, $urlNotification);
			curl_setopt($ch1, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
			curl_setopt($ch1, CURLOPT_POST, 1);
			curl_setopt($ch1, CURLOPT_POSTFIELDS,$data_json);
			curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true);
			$notification_response  = curl_exec($ch1);

		}
		if($result){
			$json_array = array(
                            //'driverId' => (int)$driveridarr,
                            'driverId' => $data_id,
                            'driver_status' => 0
                        );
                        $new_json_array = json_encode($json_array,JSON_UNESCAPED_SLASHES);
                        //print_r($new_json_array);
                        //exit;
                        $url = $this->base_ip.":4040/changeDriverStatus?".$new_json_array;
                        //$url = "192.168.1.118:4040/searchDriver?".$new_json_array;
                        $ch = curl_init();
                        curl_setopt($ch, CURLOPT_URL, $url);
                        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
                        // This is what solved the issue (Accepting gzip encoding)
                        curl_setopt($ch, CURLOPT_ENCODING, "gzip,deflate");
                        $response = curl_exec($ch);
                        curl_close($ch);
                        if($response)
                        {


                        	return true;
                        }
		}
	}

	public function calculate_ride_rates()
	{
		if(isset($_POST['pickup_date_time']) && isset($_POST['cab_id']) && isset($_POST['approx_distance']) && isset($_POST['approx_time']))
		{
			//echo 'test';
			$result=$this->home->calculaterates($_POST['pickup_date_time'],$_POST['cab_id'],$_POST['approx_distance'],$_POST['approx_time']);
			echo $result;
		}
	}
	/*public function delete()
	{
		$data=$_POST;
		//print_r($data);exit;
		//echo $data['value'];exit;
       	$user=$this->home->deleteuser($data);
		// print_r($res);
       	echo $user;
	}
	public function multipledelete()
	{
		$data=$_POST;
		//print_r($data);exit;
		//echo $data['value'];exit;
		$user=$this->home->deleteuser($data);
		// print_r($res);
		echo $user;
	}*/



	/*public function pointview()
	{
	   if($this->session->userdata('username-admin') ||   $this->input->cookie('username-admin', false)){
		$permission=$this->permission();
		if(($this->session->userdata('role-admin') == 'admin') || ($permission == "access")) {
		 $this->load->view('admin-point');
		}else{
			redirect('admin/not_admin');
		}
		}else{
	     redirect('admin/index');
         }
	}
	public  function userpointview()
	{
		if($this->session->userdata('username-admin') ||   $this->input->cookie('username-admin', false)){
			$permission=$this->permission();
			if(($this->session->userdata('role-admin') == 'admin') || ($permission == "access")) {
				$this->load->view('userpointview');
			}else{
				redirect('admin/not_admin');
			}
		}else{
			redirect('admin/index');
		}
	}
	public function cancelpointview()
	{
		if($this->session->userdata('username-admin') ||   $this->input->cookie('username-admin', false)){
			$permission=$this->permission();
			if(($this->session->userdata('role-admin') == 'admin') || ($permission == "access")) {
				$this->load->view('cancelpointview');
			}else{
				redirect('admin/not_admin');
			}
		}else{
			redirect('admin/index');
		}
	}
	public function SuccessFully_Booking()
	{
		if($this->session->userdata('username-admin') ||   $this->input->cookie('username-admin', false)){
			$permission=$this->permission();
			if(($this->session->userdata('role-admin') == 'admin') || ($permission == "access")) {
				$this->load->view('SuccessFully_Booking');
			}else{
				redirect('admin/not_admin');
			}
		}else{
			redirect('admin/index');
		}
	}
	 public function airportview()
	{
	    if($this->session->userdata('username-admin') ||   $this->input->cookie('username-admin', false)){
			$permission=$this->permission();
		if(($this->session->userdata('role-admin') == 'admin') || ($permission == "access")) {
		 $this->load->view('admin-airport');
		}else{
			redirect('admin/not_admin');
		}
		}else{
	     redirect('admin/index');
         }
	}
	 public function hourlyview()
	{
		if($this->session->userdata('username-admin') ||   $this->input->cookie('username-admin', false)){
			$permission=$this->permission();
		if(($this->session->userdata('role-admin') == 'admin') || ($permission == "access")) {
		 $this->load->view('admin-hourly');
		 }else{
			redirect('admin/not_admin');
		}
		}else{
	     redirect('admin/index');
         }
	}
	 public function outstationview()
	{
		if($this->session->userdata('username-admin') ||   $this->input->cookie('username-admin', false)){
			$permission=$this->permission();
		if(($this->session->userdata('role-admin') == 'admin') || ($permission == "access")) {
		 $this->load->view('admin-outstation');
		 }else{
			redirect('admin/not_admin');
		}
		}else{
	     redirect('admin/index');
         }
	}
	public function bookingdelete()
	{
		$data=$_POST;
             //print_r($data);exit;
              //echo $data['value'];exit;
       $user=$this->home->deletebook($data);
               // print_r($res);
       echo $user;
	}
	 public function edit_user()
	{
		//$data=$_POST;
		if($this->session->userdata('username-admin') ||   $this->input->cookie('username-admin', false)){
			$permission=$this->permission();
		if(($this->session->userdata('role-admin') == 'admin') || ($permission == "access")) {
		$this->load->view('admin-edit-userdetails');
		}else{
			redirect('admin/not_admin');
		}
		}else{
	     redirect('admin/index');
         }
	}
	public function updateuser()
	{
		$data=$_POST;

        $user=$this->home->edituser($data);

           echo $user;
	}
	 public function edit_point()
	{
		//$data=$_POST;
		if($this->session->userdata('username-admin') ||   $this->input->cookie('username-admin', false)){
			$permission=$this->permission();
		if(($this->session->userdata('role-admin') == 'admin') || ($permission == "access")) {
		$this->load->view('edit-point');
		}else{
			redirect('admin/not_admin');
		}
		}else{
	     redirect('admin/index');
         }
	}

	public function update_point()
	{
		$data=$_POST;
       //print_r($data);exit;
           //echo $data['value'];exit;
        $point=$this->home->pointupdate($data);
       // print_r($res);
           echo $point;
	}
	 public function edit_airport()
	{
		//$data=$_POST;
		if($this->session->userdata('username-admin') ||   $this->input->cookie('username-admin', false)){
			$permission=$this->permission();
		if(($this->session->userdata('role-admin') == 'admin') || ($permission == "access")) {
		$this->load->view('edit-airport');
		}else{
			redirect('admin/not_admin');
		}
		}else{
	     redirect('admin/index');
         }
	}
	 public function edit_hourly()
	{
		//$data=$_POST;
		if($this->session->userdata('username-admin') ||   $this->input->cookie('username-admin', false)){
			$permission = $this->permission();
		if(($this->session->userdata('role-admin') == 'admin') || ($permission == "access")) {
		$this->load->view('edit-hourly');
		}else{
			redirect('admin/not_admin');
		}
		}else{
	     redirect('admin/index');
         }
	}
	 public function edit_outstation()
	{
		//$data=$_POST;
		if($this->session->userdata('username-admin') ||   $this->input->cookie('username-admin', false)){
			$permission = $this->permission();
		if(($this->session->userdata('role-admin') == 'admin') || ($permission == "access")) {
		$this->load->view('edit-outstation');
		}else{
			redirect('admin/not_admin');
		}
		}else{
	     redirect('admin/index');
         }
	}

	public function promocode()
	{
		//$data=$_POST;
		if($this->session->userdata('username-admin') ||   $this->input->cookie('username-admin', false)){
			$permission = $this->permission();
		if(($this->session->userdata('role-admin') == 'admin') || ($permission == "access")) {
		$this->load->view('add-promocode');
		}else{
			redirect('admin/not_admin');
		}
		}else{
	     redirect('admin/index');
         }
	}
	public function insert_promocode()
	{
		$data=$_POST;
   //echo $data['value'];exit;
   $prom=$this->home->pormoadd($data);
    // print_r($res);
    echo $prom;
	}
	public function view_promocode()
	{
		//$data=$_POST;
		if($this->session->userdata('username-admin') ||   $this->input->cookie('username-admin', false)){
			$permission = $this->permission();
		if(($this->session->userdata('role-admin') == 'admin') || ($permission == "access")) {
		$this->load->view('view-promocode');
		}else{
			redirect('admin/not_admin');
		}
		}else{
	     redirect('admin/index');
         }
	}
	public function promo_delete()
	{
		$data=$_POST;
             //print_r($data);exit;
              //echo $data['value'];exit;
       $delete=$this->home->deleteprom($data);
               // print_r($res);
       echo $delete;
	}
	public function edit_promocode()
	{
		//$data=$_POST;
		if($this->session->userdata('username-admin') ||   $this->input->cookie('username-admin', false)){
			$permission = $this->permission();
		if(($this->session->userdata('role-admin') == 'admin') || ($permission == "access")) {
		$this->load->view('edit-promocode');
		}else{
			redirect('admin/not_admin');
		}
		}else{
	     redirect('admin/index');
         }
	}
	public function update_promocode()
	{
		$data=$_POST;
       //print_r($data);exit;
           //echo $data['value'];exit;
        $pt=$this->home->promoupdate($data);
       // print_r($res);
           echo $pt;
	}
	 public function taxi_details()
	{
		//$data=$_POST;
		if($this->session->userdata('username-admin') ||   $this->input->cookie('username-admin', false)){
			$permission = $this->permission();
		if(($this->session->userdata('role-admin') == 'admin') || ($permission == "access")) {
		$this->load->view('add-taxi-details');
		}else{
			redirect('admin/not_admin');
		}
		}else{
	     redirect('admin/index');
         }
	}
	public  function insert_status()
	{
		$data=$_POST;
		$status=$this->home->addstatus($data);
		echo $status;
	}
	public function insert_taxi()
	{
		$data=$_POST;
   //echo $data['value'];exit;

			$taxi = $this->home->taxiadd($data);
			echo $taxi;
    // print_r($res);

	}
	public function insert_time()
	{
		$data=$_POST;
		$taxi = $this->home->timeadd($data);
		echo $taxi;
	}
	public  function insert_new_taxi5july()
	{
		$data=$_POST;
		$taxi=$this->home->addtaxi($data);
		// print_r($res);
		echo $taxi;
	}
	public  function insert_new_taxi()
	{
		$data=$_POST;

		$config = array(
			'upload_path'   => $path,
			'allowed_types' => 'jpg|gif|png',
			'overwrite'     => 1,
		);

		$this->load->library('upload', $config);

		$images = array();

		foreach ($files['name'] as $key => $image) {
			$_FILES['images[]']['name']= $files['name'][$key];
			$_FILES['images[]']['type']= $files['type'][$key];
			$_FILES['images[]']['tmp_name']= $files['tmp_name'][$key];
			$_FILES['images[]']['error']= $files['error'][$key];
			$_FILES['images[]']['size']= $files['size'][$key];

			$fileName = $title .'_'. $image;

			$images[] = $fileName;

			$config['file_name'] = $fileName;

			$this->upload->initialize($config);

			if ($this->upload->do_upload('images[]')) {
				$this->upload->data();
			} else {
				return false;
			}
		}

		return $images;
	}

	 public function taxi_view()
	{
		//$data=$_POST;
		if($this->session->userdata('username-admin') ||   $this->input->cookie('username-admin', false)){
			$permission = $this->permission();
		if(($this->session->userdata('role-admin') == 'admin') || ($permission == "access")) {
		$this->load->view('view-cab-details');
		}else{
			redirect('admin/not_admin');
		}
		}else{
	     redirect('admin/index');
         }
	}

	public function edit_taxi()
	{
		//$data=$_POST;
		if($this->session->userdata('username-admin') ||   $this->input->cookie('username-admin', false)){
			$permission = $this->permission();
		if(($this->session->userdata('role-admin') == 'admin') || ($permission == "access")) {
		$this->load->view('edit-cab-details');
		}else{
			redirect('admin/not_admin');
		}
		}else{
	     redirect('admin/index');
         }
	}


	public function update_car()
	{
		$data=$_POST;
		//print_r($data);exit;
		//echo $data['value'];exit;
		$taxi=$this->home->updatecar($data);
		// print_r($res);
		echo $taxi;
	}

	public function update_taxi()
	{
		$data=$_POST;
       //print_r($data);exit;
           //echo $data['value'];exit;
        $taxi=$this->home->updatetaxi($data);
       // print_r($res);
           echo $taxi;
	}
	public function update_status()
	{
		$data=$_POST;
		//print_r($data);exit;
		//echo $data['value'];exit;
		$status=$this->home->update_status($data);
		// print_r($res);
		echo $status;
	}
	public function update_time()
	{
		$data=$_POST;
		$time=$this->home->updatetime($data);
		echo $time;
	}
	public function delete_taxi()
	{
		$data=$_POST;
             //print_r($data);exit;
              //echo $data['value'];exit;
       $user=$this->home->delcabdetails($data);
               // print_r($res);
       echo $user;
	}
	public  function delete_status()
	{
		$data=$_POST;
		$status=$this->home->deletestatus($data);
		echo $status;
	}
	public function delete_car()
	{
		$data=$_POST;
		//print_r($data);exit;
		//echo $data['value'];exit;
		$user=$this->home->delcardetails($data);
		// print_r($res);
		echo $user;
	}
	public function change_password()
	{
		//$data=$_POST;
		if($this->session->userdata('username-admin') ||   $this->input->cookie('username-admin', false)){

		$this->load->view('change-password');
		}else{
			redirect('admin/index');
		}

	}
	public function check_password()
	{
		$data=$_POST;
       //print_r($data);exit;
           //echo $data['value'];exit;
        $pass=$this->home->updatepass($data);
       // print_r($res);
           echo $pass;
	}
	 public function taxi_airport()
	{
		//$data=$_POST;
		if($this->session->userdata('username-admin') ||   $this->input->cookie('username-admin', false)){
			$permission = $this->permission();
		if(($this->session->userdata('role-admin') == 'admin') || ($permission == "access")) {
		$this->load->view('view-cab-airport');
		}else{
			redirect('admin/not_admin');
		}
		}else{
	     redirect('admin/index');
         }
	}
	 public function taxi_details_air()
	{
		//$data=$_POST;
		if($this->session->userdata('username-admin') ||   $this->input->cookie('username-admin', false)){
			$permission = $this->permission();
		if(($this->session->userdata('role-admin') == 'admin') || ($permission == "access")) {
		$this->load->view('add-taxi-air');
		}else{
			redirect('admin/not_admin');
		}
		}else{
	     redirect('admin/index');
         }
	}
	 public function edit_airport_taxi()
	{
		//$data=$_POST;
		if($this->session->userdata('username-admin') ||   $this->input->cookie('username-admin', false)){
			$permission = $this->permission();
		if(($this->session->userdata('role-admin') == 'admin') || ($permission == "access")) {
		$this->load->view('edit-taxi-air');
		}else{
			redirect('admin/not_admin');
		}
		}else{
	     redirect('admin/index');
         }
	}
	 public function taxi_hourly()
	{
		//$data=$_POST;
		if($this->session->userdata('username-admin') ||   $this->input->cookie('username-admin', false)){
			$permission = $this->permission();
		if(($this->session->userdata('role-admin') == 'admin') || ($permission == "access")) {
		$this->load->view('view-cab-hourly');
		}else{
			redirect('admin/not_admin');
		}
		}else{
	     redirect('admin/index');
         }
	}
	 public function taxi_details_hourly()
	{
		//$data=$_POST;
		if($this->session->userdata('username-admin') ||   $this->input->cookie('username-admin', false)){
			$permission = $this->permission();
		if(($this->session->userdata('role-admin') == 'admin') || ($permission == "access")) {
		$this->load->view('add-taxi-hourly');
		}else{
			redirect('admin/not_admin');
		}
		}else{
	     redirect('admin/index');
         }
	}

	public function add_new_status()
	{
		//$data=$_POST;
		if($this->session->userdata('username-admin') ||   $this->input->cookie('username-admin', false)){
			$permission = $this->permission();
			if(($this->session->userdata('role-admin') == 'admin') || ($permission == "access")) {
				$this->load->view('add_status');
			}else{
				redirect('admin/not_admin');
			}
		}else{
			redirect('admin/index');
		}
	}
	 public function edit_hourly_taxi()
	{
		//$data=$_POST;
		if($this->session->userdata('username-admin') ||   $this->input->cookie('username-admin', false)){
			$permission = $this->permission();
		if(($this->session->userdata('role-admin') == 'admin') || ($permission == "access")) {
		$this->load->view('edit-taxi-hourly');
		}else{
			redirect('admin/not_admin');
		}
		}else{
	     redirect('admin/index');
         }
	}
	public function edit_status()
	{
		//$data=$_POST;
		if($this->session->userdata('username-admin') ||   $this->input->cookie('username-admin', false)){
			$permission = $this->permission();
			if(($this->session->userdata('role-admin') == 'admin') || ($permission == "access")) {
				$this->load->view('edit_status');
			}else{
				redirect('admin/not_admin');
			}
		}else{
			redirect('admin/index');
		}
	}
	 public function  taxi_details_outstation()
	{
		//$data=$_POST;
		if($this->session->userdata('username-admin') ||   $this->input->cookie('username-admin', false)){
			$permission = $this->permission();
		if(($this->session->userdata('role-admin') == 'admin') || ($permission == "access")) {
		$this->load->view('add-taxi-outstation');
		}else{
			redirect('admin/not_admin');
		}
		}else{
	     redirect('admin/index');
         }
	}
	public function taxi_outstation()
	{
		//$data=$_POST;
		if($this->session->userdata('username-admin') ||   $this->input->cookie('username-admin', false)){
			$permission = $this->permission();
		if(($this->session->userdata('role-admin') == 'admin') || ($permission == "access")) {
		$this->load->view('view-cab-outstation');
		}else{
			redirect('admin/not_admin');
		}
		}else{
	     redirect('admin/index');
         }
	}
	  public function edit_outstation_taxi()
	{
		//$data=$_POST;
		if($this->session->userdata('username-admin') ||   $this->input->cookie('username-admin', false)){
			$permission = $this->permission();
		if(($this->session->userdata('role-admin') == 'admin') || ($permission == "access")) {
		$this->load->view('edit-taxi-outstation');
		}else{
			redirect('admin/not_admin');
		}
		}else{
	     redirect('admin/index');
	     redirect('admin/index');
         }
	}

	public function Driver_Status()
	{
		if($this->session->userdata('username-admin') ||   $this->input->cookie('username-admin', false)){
			$permission = $this->permission();
			if(($this->session->userdata('role-admin') == 'admin') || ($permission == "access")) {
				$this->load->view('view_driver_status');
			}else{
				redirect('admin/not_admin');
			}
		}else{
			redirect('admin/index');
		}

	}
	public function insert_driver()
	{
		$data=$_POST;
  //print_r($data);exit;
   $taxi=$this->home->driveradd($data);
    // print_r($res);
    echo $taxi;
	}
	  public function view_driver()
	{
		//$data=$_POST;
		if($this->session->userdata('username-admin') ||   $this->input->cookie('username-admin', false)){
			$permission = $this->permission();
		if(($this->session->userdata('role-admin') == 'admin') || ($permission == "access")) {
		$this->load->view('view-driver-details');
		}else{
			redirect('admin/not_admin');
		}
		}else{
	     redirect('admin/index');
         }
	}

	  public function edit_driver()
	{
		//$data=$_POST;
		if($this->session->userdata('username-admin') ||   $this->input->cookie('username-admin', false)){
			$permission = $this->permission();
		if(($this->session->userdata('role-admin') == 'admin') || ($permission == "access")) {

		$this->load->view('edit-driver');
		}else{
			redirect('admin/not_admin');
		}
		}else{
	     redirect('admin/index');
         }
	}
	public function update_driver()
	{
		$data=$_POST;
       //print_r($data);exit;
           //echo $data['value'];exit;
        $taxi=$this->home->updatedriver($data);
       // print_r($res);
           echo $taxi;
	}
	public function delete_driver()
	{
		$data=$_POST;
             //print_r($data);exit;
              //echo $data['value'];exit;
       $user=$this->home->deletedriver($data);
               // print_r($res);
       echo $user;
	}
	  public function add_settings()
	{
		//$data=$_POST;
		if($this->session->userdata('username-admin') ||   $this->input->cookie('username-admin', false)){
			$permission = $this->permission();
		if(($this->session->userdata('role-admin') == 'admin') || ($permission == "access")) {

		$this->load->view('add-settings',array('error'=>''));
		}else{
			redirect('admin/not_admin');
		}
		}else{
	     redirect('admin/index');
         }
	}
	public function  set_time()
	{
		if($this->session->userdata('username-admin') ||   $this->input->cookie('username-admin', false)){
			$permission = $this->permission();
			if(($this->session->userdata('role-admin') == 'admin') || ($permission == "access")) {

				$this->load->view('view_time',array('error'=>''));
			}else{
				redirect('admin/not_admin');
			}
		}else{
			redirect('admin/index');
		}
	}
	public function  edit_time()
	{
		if($this->session->userdata('username-admin') ||   $this->input->cookie('username-admin', false)){
			$permission = $this->permission();
			if(($this->session->userdata('role-admin') == 'admin') || ($permission == "access")) {

				$this->load->view('set_time',array('error'=>''));
			}else{
				redirect('admin/not_admin');
			}
		}else{
			redirect('admin/index');
		}
	}


	public function upload()
	{
		$data=$_POST;



		if($_FILES['logo']['name']){

		$config = $this->set_upload_options();
		//load the upload library
		$this->load->library('upload');

        $this->upload->initialize($config);

 $imgInfo = getimagesize($_FILES["logo"]["tmp_name"]);


	 $extension = image_type_to_extension($imgInfo[2]);
if ($extension != '.png' ){
   $this->session->set_flashdata('item', array('message' => 'select only png image types','class' => 'error') );

			$d = $this->session->flashdata('item');

			redirect('admin/add_settings');
}


else if (($imgInfo[0] != 130) && ($imgInfo[1] != 117)){
   $this->session->set_flashdata('item', array('message' => 'select images of 130/117 size(logo)','class' => 'error') );

			$d = $this->session->flashdata('item');

			redirect('admin/add_settings');
}else{
	if ( !$this->upload->do_upload('logo'))
		{

			$this->session->set_flashdata('item', array('message' => $this->upload->display_errors('logo') ,'class' => 'error') );

			$d = $this->session->flashdata('item');

			redirect('admin/add_settings');

		}
		else{
			$data2 = array('upload_data' => $this->upload->data('logo'));

			 $data['logo']=$config['upload_path']."/logo.png";

		}
}
}if($_FILES['favicon']['name']){
			$config = $this->set_upload_favicon();
		//load the upload library
		$this->load->library('upload');

            $this->upload->initialize($config);

			if ( !$this->upload->do_upload('favicon'))
		{

			$this->session->set_flashdata('item', array('message' => $this->upload->display_errors('favicon'),'class' => 'error') );

			$d = $this->session->flashdata('item');

			redirect('admin/add_settings');
		}
			else{
		 $this->upload->overwrite = true;
			$data1 = array('upload_datas' => $this->upload->data('favicon'));

         $data['favicon']=$config['upload_path']."/".$data1['upload_datas']['file_name'];
           	}
		}
		if(!$this->session->flashdata('item')){



		$taxi=$this->home->settings($data);
		}else{

			$d=$this->session->flashdata('item');
			redirect('admin/add_settings');
		}
		}
 public function set_upload_options()
	{
		$config['file_name']='logo';
		$config['upload_path'] = 'upload';
        $config['allowed_types'] = 'png';

		$config['maintain_ratio'] = TRUE;

		$config['overwrite'] = 'TRUE';
		return $config;
	}
public function set_upload_favicon()
	{
		$config['file_name']='favicon';
		$config['upload_path'] = 'upload';
        $config['allowed_types'] = '*';

		$config['maintain_ratio'] = TRUE;

		$config['overwrite'] = 'TRUE';
		return $config;
	}
	  public function dashboard()
	{
		//$data=$_POST;
		if($this->session->userdata('username-admin') ||   $this->input->cookie('username-admin', false)){
			$permission = $this->permission();
		if(($this->session->userdata('role-admin') == 'admin') || ($permission == "access")) {

		$this->load->view('dashbord');
		}else{
			redirect('admin/not_admin');
		}
		}else{
	     redirect('admin/index');
         }
	}

	public function insert_role()
	{
		$data=$_POST;
   //echo $data['value'];exit;
        $role=$this->home->roleadd($data);
    // print_r($res);
    echo $role;
	}

	public function role_delete()
	{
		$data=$_POST;
             //print_r($data);exit;
              //echo $data['value'];exit;
       $delete=$this->home->deleterole($data);
               // print_r($res);
       echo $delete;
	}

	public function update_role()
	{
		$data=$_POST;
       //print_r($data);exit;
           //echo $data['value'];exit;
        $role=$this->home->updaterole($data);
       // print_r($res);
           echo $role;
	}
	public function add_role()
	{
		$data=$_POST;
       //print_r($data);exit;
           //echo $data['value'];exit;
        $role=$this->home->addrole($data);
       // print_r($res);
           echo $role;
	}
	public function not_admin()
	{

	 $this->load->view('admin-404');
	}
	public function role_management()
	{
		//$data=$_POST;
		if($this->session->userdata('username-admin') ||   $this->input->cookie('username-admin', false)){
			$permission = $this->permission();
		if(($this->session->userdata('role-admin') == 'admin') || ($permission == "access")) {
		$this->load->view('role-management');
		}else{
			redirect('admin/not_admin');
		}
		}else{
	        redirect('admin/index');
         }
	}

	public function backened_user()
	{
		//$data=$_POST;
		if($this->session->userdata('username-admin') ||   $this->input->cookie('username-admin', false)){
			$permission = $this->permission();
		if(($this->session->userdata('role-admin') == 'admin') || ($permission == "access")) {

   $this->load->view('backend-user-lists');

		}else{
			redirect('admin/not_admin');
		}
		}else{
	     redirect('admin/index');
         }
	}
	public function delete_backend()
	{
		$data=$_POST;
             //print_r($data);exit;
              //echo $data['value'];exit;
       $user=$this->home->delete_backend_user($data);
               // print_r($res);
       echo $user;
	}
	 public function edit_bakend_user()
	{
		//$data=$_POST;
		if($this->session->userdata('username-admin') ||   $this->input->cookie('username-admin', false)){
		$permission = $this->permission();
		if(($this->session->userdata('role-admin') == 'admin') || ($permission == "access")) {
		$this->load->view('backend-edit-userdetails');
		}else{
			redirect('admin/not_admin');
		}
		}else{
	     redirect('admin/index');
         }
	}

 public function add_backend_user()
	{
		if($this->session->userdata('username-admin') ||   $this->input->cookie('username-admin', false)){
			$permission = $this->permission();
		if(($this->session->userdata('role-admin') == 'admin') || ($permission == "access")) {
		 $this->load->view('backend-add-userdetails');
		 }else{
			redirect('admin/not_admin');
		}
		}else{
	     redirect('admin/index');
         }
	}
	public function insert_backend_user()
	{
		$data=$_POST;
   //echo $data['value'];exit;
   $res=$this->home->user_backend_insert($data);
    // print_r($res);
    echo $res;
	}
		public function update_backend_user()
	{
		$data=$_POST;
       //print_r($data);exit;
           //echo $data['value'];exit;
        $user=$this->home->edit_backend_user($data);
       // print_r($res);
           echo $user;
	}
	 public function view_airmanage()
	{
		if($this->session->userdata('username-admin') ||   $this->input->cookie('username-admin', false)){
			$permission = $this->permission();
		if(($this->session->userdata('role-admin') == 'admin') || ($permission == "access")) {
		 $this->load->view('airport-details');
		 }else{
			redirect('admin/not_admin');
		}
		}else{
	     redirect('admin/index');
         }
	}
	 public function view_package()
	{
		if($this->session->userdata('username-admin') ||   $this->input->cookie('username-admin', false)){
			$permission = $this->permission();
		if(($this->session->userdata('role-admin') == 'admin') || ($permission == "access")) {
		 $this->load->view('package-details');
		 }else{
			redirect('admin/not_admin');
		}
		}else{
	     redirect('admin/index');
         }
	}
	 public function edit_air_manage()
	{
		//$data=$_POST;
		if($this->session->userdata('username-admin') ||   $this->input->cookie('username-admin', false)){
		$permission = $this->permission();
		if(($this->session->userdata('role-admin') == 'admin') || ($permission == "access")) {
		$this->load->view('edit-air-manage');
		}else{
			redirect('admin/not_admin');
		}
		}else{
	     redirect('admin/index');
         }
	}
	public function edit_package()
	{
		//$data=$_POST;
		if($this->session->userdata('username-admin') ||   $this->input->cookie('username-admin', false)){
		$permission = $this->permission();
		if(($this->session->userdata('role-admin') == 'admin') || ($permission == "access")) {
		$this->load->view('edit-package');
		}else{
			redirect('admin/not_admin');
		}
		}else{
	     redirect('admin/index');
         }
	}
	public function delete_air_manage()
	{
		$data=$_POST;
             //print_r($data);exit;
              //echo $data['value'];exit;
       $user=$this->home->delete_air($data);
               // print_r($res);
       echo $user;
	}
	public function delete_package()
	{
		$data=$_POST;
             //print_r($data);exit;
              //echo $data['value'];exit;
       $user=$this->home->delete_package($data);
               // print_r($res);
       echo $user;
	}
	public function add_airmanage()
	{
		if($this->session->userdata('username-admin') ||   $this->input->cookie('username-admin', false)){
			$permission = $this->permission();
		if(($this->session->userdata('role-admin') == 'admin') || ($permission == "access")) {
		 $this->load->view('add-airmanage');
		 }else{
			redirect('admin/not_admin');
		}
		}else{
	     redirect('admin/index');
         }
	}
	public function add_package()
	{
		if($this->session->userdata('username-admin') ||   $this->input->cookie('username-admin', false)){
			$permission = $this->permission();
		if(($this->session->userdata('role-admin') == 'admin') || ($permission == "access")) {
		 $this->load->view('add-package');
		 }else{
			redirect('admin/not_admin');
		}
		}else{
	     redirect('admin/index');
         }
	}

	public function update_airmanage()
	{
		$data=$_POST;
       //print_r($data);exit;
           //echo $data['value'];exit;
        $pt=$this->home->airmanage_update($data);
       // print_r($res);
           echo $pt;
	}
	public function update_package()
	{
		$data=$_POST;
       //print_r($data);exit;
           //echo $data['value'];exit;
        $pt=$this->home->package_update($data);
       // print_r($res);
           echo $pt;
	}
	public function places_add()
	{
		if($this->session->userdata('username-admin') ||   $this->input->cookie('username-admin', false)){
			$permission = $this->permission();
		if(($this->session->userdata('role-admin') == 'admin') || ($permission == "access")) {

   $this->load->view('add-places');
   }else{
			redirect('admin/not_admin');
		}
		}else{
	     redirect('admin/index');
         }
	}
	public function insert_places()
	{
		$data=$_POST;
   //echo $data['value'];exit;
   $res=$this->home->places_insert($data);
    // print_r($res);
    echo $res;
	}
	public function view_places()
	{
	if($this->session->userdata('username-admin') ||   $this->input->cookie('username-admin', false)){
			$permission = $this->permission();
		if(($this->session->userdata('role-admin') == 'admin') || ($permission == "access")) {

   $this->load->view('view-places');
   }else{
			redirect('admin/not_admin');
		}
		}else{
	     redirect('admin/index');
         }
	}
	public function delete_places()
	{
		$data=$_POST;
             //print_r($data);exit;
              //echo $data['value'];exit;
       $user=$this->home->deleteplaces($data);
               // print_r($res);
       echo $user;
	}
	public function update_places()
	{
		$data=$_POST;
       //print_r($data);exit;
           //echo $data['value'];exit;
        $role=$this->home->updateplace($data);
       // print_r($res);
           echo $role;
	}
	public function edit_places()
	{
		if($this->session->userdata('username-admin') ||   $this->input->cookie('username-admin', false)){
			$permission = $this->permission();
		if(($this->session->userdata('role-admin') == 'admin') || ($permission == "access")) {

   $this->load->view('edit-places');
   }else{
			redirect('admin/not_admin');
		}
		}else{
	     redirect('admin/index');
         }
	}
	public function auto_places()
	{
		if($this->session->userdata('username-admin') ||   $this->input->cookie('username-admin', false)){
			$permission = $this->permission();
		if(($this->session->userdata('role-admin') == 'admin') || ($permission == "access")) {


   $this->load->view('auto-places');
   }else{
			redirect('admin/not_admin');
		}
		}else{
	     redirect('admin/index');
         }
	}
	public function insert_airmanag()
	{
		$data=$_POST;
       //print_r($data);exit;
           //echo $data['value'];exit;
        $role=$this->home->insertairport($data);
       // print_r($res);
           echo $role;
	}
	public function insert_package()
	{
		$data=$_POST;
       //print_r($data);exit;
           //echo $data['value'];exit;
        $role=$this->home->insertpackage($data);
       // print_r($res);
           echo $role;
	}
public function searchs_p()
	{

   $this->load->view('spoint');

	}
	public function bookingstatus()
	{
		$data=$_POST;
       //print_r($data);exit;
           //echo $data['value'];exit;
        $status=$this->home->status_update($data);

           echo $status;
	}
	public function pointdriver()
	{
	if($this->session->userdata('username-admin') ||   $this->input->cookie('username-admin', false))
	{
		$permission = $this->permission();
		if(($this->session->userdata('role-admin') == 'admin') || ($permission == "access")) {


   $this->load->view('admin-point-driver');
   }else{
			redirect('admin/not_admin');
		}
		}else{
	     redirect('admin/index');
         }
	}
	public function airportdriver()
	{
		if($this->session->userdata('username-admin') ||   $this->input->cookie('username-admin', false)){
			$permission = $this->permission();
		if(($this->session->userdata('role-admin') == 'admin') || ($permission == "access")) {



   $this->load->view('admin-airport-driver');
   }else{
			redirect('admin/not_admin');
		}
		}else{
	     redirect('admin/index');
         }
	}
	public function hourlydriver()
	{
		if($this->session->userdata('username-admin') ||   $this->input->cookie('username-admin', false)){
			$permission = $this->permission();
		if(($this->session->userdata('role-admin') == 'admin') || ($permission == "access")) {



   $this->load->view('admin-hourly-driver');
   }else{
			redirect('admin/not_admin');
		}
		}else{
	     redirect('admin/index');
         }
	}
	public function outdriver()
	{

		if($this->session->userdata('username-admin') ||   $this->input->cookie('username-admin', false)){
			$permission = $this->permission();
		if(($this->session->userdata('role-admin') == 'admin') || ($permission == "access")) {


   $this->load->view('admin-out-driver');
   }else{
			redirect('admin/not_admin');
		}
		}else{
	     redirect('admin/index');
         }
	}
	public function addpoint()
	{

		if($this->session->userdata('username-admin') ||   $this->input->cookie('username-admin', false)){
			$permission = $this->permission();
		if(($this->session->userdata('role-admin') == 'admin') || ($permission == "access")) {


   $this->load->view('admin-add-point');
   }else{
			redirect('admin/not_admin');
		}
		}else{
	     redirect('admin/index');
         }
	}
	public function admin_book()
	{
		$data=$_POST;

        $status=$this->home->book_admin($data);

           echo $status;
	}
	public function upload1()
	{
		$data=$_POST;
		 $delete=$this->home->insta($data);
	}
	public function addair()
	{
		if($this->session->userdata('username-admin') ||   $this->input->cookie('username-admin', false)){
			$permission = $this->permission();
		if(($this->session->userdata('role-admin') == 'admin') || ($permission == "access")) {



   $this->load->view('admin-add-air');
   }else{
			redirect('admin/not_admin');
		}
		}else{
	     redirect('admin/index');
         }
	}


	public function addhourly()
	{

		if($this->session->userdata('username-admin') ||   $this->input->cookie('username-admin', false)){
			$permission = $this->permission();
		if(($this->session->userdata('role-admin') == 'admin') || ($permission == "access")) {


   $this->load->view('admin-add-hourly');
   }else{
			redirect('admin/not_admin');
		}
		}else{
	     redirect('admin/index');
         }
	}
	public function addout()
	{
		if($this->session->userdata('username-admin') ||   $this->input->cookie('username-admin', false)){
			$permission = $this->permission();
		if(($this->session->userdata('role-admin') == 'admin') || ($permission == "access")) {



   $this->load->view('admin-add-out');
   }else{
			redirect('admin/not_admin');
		}
		}else{
	     redirect('admin/index');
         }
	}

	public function view_page()
	{

		if($this->session->userdata('username-admin') ||   $this->input->cookie('username-admin', false)){
			$permission = $this->permission();
		if(($this->session->userdata('role-admin') == 'admin') || ($permission == "access")) {


   $this->load->view('admin-view-static');
   }else{
			redirect('admin/not_admin');
		}
		}else{
	     redirect('admin/index');
         }
	}




	public function view_language()
	{
		//$data=$_POST;
		if($this->session->userdata('username-admin') ||   $this->input->cookie('username-admin', false)){
			$permission = $this->permission();
		if(($this->session->userdata('role-admin') == 'admin') || ($permission == "access")) {
		$this->load->view('view-language');
		}else{
			redirect('admin/not_admin');
		}
		}else{
	     redirect('admin/index');
         }
	}

	public function edit_language()
	{
		//$data=$_POST;
		if($this->session->userdata('username-admin') ||   $this->input->cookie('username-admin', false)){
			$permission = $this->permission();
		if(($this->session->userdata('role-admin') == 'admin') || ($permission == "access")) {
		$this->load->view('edit-language');
		}else{
			redirect('admin/not_admin');
		}
		}else{
	     redirect('admin/index');
         }
	}



	public function update_language_set()
	{
		$data=$_POST;
       //print_r($data);exit;
           //echo $data['value'];exit;
        $pt=$this->home->languagesetupdate($data);
       // print_r($res);
           echo $pt;
	}

	public function add_language()
	{
		if($this->session->userdata('username-admin') ||   $this->input->cookie('username-admin', false)){
			$permission = $this->permission();
		if(($this->session->userdata('role-admin') == 'admin') || ($permission == "access")) {
		 $this->load->view('add-language');
		 }else{
			redirect('admin/not_admin');
		}
		}else{
	     redirect('admin/index');
         }
	}

	public function insert_language()
	{
		$data=$_POST;

        $role=$this->home->insertlanguage($data);

          echo $role;
	}
	public function upload_blog()
	{
		$data=$_POST;

        $role=$this->home->blog_upload($data);

          echo $role;
	}


	public function add_select_language()
	{
		//$data=$_POST;
		if($this->session->userdata('username-admin') ||   $this->input->cookie('username-admin', false)){
			$permission = $this->permission();
		if(($this->session->userdata('role-admin') == 'admin') || ($permission == "access")) {
		$this->load->view('add-select-language');
		}else{
			redirect('admin/not_admin');
		}
		}else{
	     redirect('admin/index');
         }
	}

	public function insert_addnew_languages()
	{
		$data=$_POST;
   //echo $data['value'];exit;
   $taxi=$this->home->languagesadd($data);
    // print_r($res);
    echo $taxi;
	}

	public function languages_delete()
	{
		$data=$_POST;

       $user=$this->home->delete_langauge($data);

       echo $user;
	}
	public function add_page()
	{
		if($this->session->userdata('username-admin') ||   $this->input->cookie('username-admin', false)){
			$permission = $this->permission();
		if(($this->session->userdata('role-admin') == 'admin') || ($permission == "access")) {



   $this->load->view('admin-add-static');
   }else{
			redirect('admin/not_admin');
		}
		}else{
	     redirect('admin/index');
         }

	}
	public function add_banner()
	{
		if($this->session->userdata('username-admin') ||   $this->input->cookie('username-admin', false)){
			$permission = $this->permission();
		if(($this->session->userdata('role-admin') == 'admin') || ($permission == "access")) {



   $this->load->view('admin-add-banner');
   }else{
			redirect('admin/not_admin');
		}
		}else{
	     redirect('admin/index');
         }

	}

	public function set_upload_baner()
	{
		$config['file_name']='banner-inner';
		$config['upload_path'] = 'assets/images/images';
        $config['allowed_types'] = 'png';

		$config['maintain_ratio'] = TRUE;

		$config['overwrite'] = 'TRUE';
		return $config;
	}
	public function set_upload_taxi()
	{
		$config['file_name']='banner-taxi';
		$config['upload_path'] = 'img';
		$config['allowed_types'] = 'jpeg';

		$config['maintain_ratio'] = TRUE;

		$config['overwrite'] = 'TRUE';
		return $config;
	}
	public function set_upload_car()
	{
		$config['file_name']='car';
		$config['upload_path'] = 'application/views/img/';
        $config['allowed_types'] = 'png';

		$config['maintain_ratio'] = TRUE;

		$config['overwrite'] = 'TRUE';
		return $config;
	}
	public function banner()
	{
		$data=$_POST;

		if(isset($_FILES['blog_content']['name'])){

		$config = $this->set_upload_baner();
		$this->load->library('upload');
        $this->upload->initialize($config);

        $imgInfo = getimagesize($_FILES["blog_content"]["tmp_name"]);
        $extension = image_type_to_extension($imgInfo[2]);
        if ($extension != '.png' ){
           $this->session->set_flashdata('item', array('message' => 'select only png image types','class' => 'error') );

			$d = $this->session->flashdata('item');

			redirect('admin/add_banner');
        }

        else if (($imgInfo[0] != 361) && ($imgInfo[1] != 403)){
            $this->session->set_flashdata('item', array('message' => 'select images of 361/403 size(baner1)','class' => 'error') );

			$d = $this->session->flashdata('item');

			redirect('admin/add_banner');
        }else{
	        if ( !$this->upload->do_upload('blog_content'))
		    {

			   $this->session->set_flashdata('item', array('message' => $this->upload->display_errors('blog_content') ,'class' => 'error') );

			   $d = $this->session->flashdata('item');

			   redirect('admin/add_banner');

		    }
		    else{
			   $data2 = array('upload_data' => $this->upload->data('blog_content'));

			   echo $data['blog_content']=$config['upload_path']."/banner-inner.png";

		    }
        }
}  if(isset($_FILES['baner_car']['name'])){
		$config = $this->set_upload_car();

		$this->load->library('upload');

        $this->upload->initialize($config);
	    $imgInfo = getimagesize($_FILES["baner_car"]["tmp_name"]);
        $extension = image_type_to_extension($imgInfo[2]);
        if ($extension != '.png' ){
           $this->session->set_flashdata('item', array('message' => 'select only png image types','class' => 'error') );

			$d = $this->session->flashdata('item');

			redirect('admin/add_banner');
        }

        else if (($imgInfo[0] != 466) && ($imgInfo[1] != 264)){
            $this->session->set_flashdata('item', array('message' => 'select images of 466/264 size(banercar)','class' => 'error') );

			$d = $this->session->flashdata('item');

			redirect('admin/add_banner');
        }else{
		if ( !$this->upload->do_upload('baner_car'))
		{

			$this->session->set_flashdata('item', array('message' => $this->upload->display_errors('favicon'),'class' => 'error') );

			$d = $this->session->flashdata('item');

			redirect('admin/add_banner');
		}
		else{
		    $this->upload->overwrite = true;
			$data1 = array('upload_datas' => $this->upload->data('baner_car'));
            echo $data['baner_car']=$config['upload_path']."/car.png";

			}
		}
}
		if(!$this->session->flashdata('item')){

		$taxi=$this->home->baners($data);
		}else{

			$d=$this->session->flashdata('item');
			redirect('admin/add_banner');
		}
}
   public function add_pages()
	{
		if($this->session->userdata('username-admin') ||   $this->input->cookie('username-admin', false)){
			$permission = $this->permission();
		if(($this->session->userdata('role-admin') == 'admin') || ($permission == "access")) {



		$this->load->view('add-pages');
		}else{
			redirect('admin/not_admin');
		}
		}else{
	     redirect('admin/index');
         }

	}

	public function insert_page()
	{
		$data=$_POST;

        $role=$this->home->page_insert($data);

          echo $role;
	}
	public function view_pages()
	{
		$this->load->view('view-pages');
	}
	public function delete_pages()
	{
		$data=$_POST;
             //print_r($data);exit;
              //echo $data['value'];exit;
       $user=$this->home->deletepages($data);
               // print_r($res);
       echo $user;
	}
	public function edit_pages()
	{
		$this->load->view('edit-pages');
	}
	public function update_pages()
	{
		$data=$_POST;
             //print_r($data);exit;
              //echo $data['value'];exit;
       $user=$this->home->pages_updates($data);
               // print_r($res);
       echo $user;
	}
	public function wallet_list()
	{

   $this->load->view('wallet_lists');

	}public function select_driver()
	{
		$data=$_POST;

$paypal=$this->home->driver_assign_auto($data);

echo $paypal;
	}
	public function callback_list()
	{

   $this->load->view('callback_lists');

	}
	public function approval_driver()
	{
		$data=$_POST;
             //print_r($data);exit;
              //echo $data['value'];exit;
       $user=$this->home->driver_approvel($data);
               // print_r($res);
       echo $user;
	}
	public function callback_delete()
	{
		$data=$_POST;
             //print_r($data);exit;
              //echo $data['value'];exit;
       $user=$this->home->delete_callback($data);
               // print_r($res);
       echo $user;
	}public function rating()
	{
		$data=$_POST;
		 $user=$this->home->rate_driver($data);
		 if($user==true){
			 $this->load->view('rating');
		 }

	}*/


	// Language change code for mobile apps Edited
	public function languageChageForDriverApp(){
		$this->seesion_set();

		if($this->session->userdata('username-admin') ||   $this->input->cookie('username-admin', false)){
			 $permission = $this->permission();
				if(($this->session->userdata('role-admin') == 'admin') || ($permission == "access")) {
				//$this->load->helper('language_helper');
				$this->db->select('language_name');
				$query = $this->db->get('app_languages');
				$allLanguages = $query->result_array();

				if(isset($allLanguages[0]['language_name'])){
					  $currentlanguage=$allLanguages[0]['language_name'];
				}

				$viewData['allLanguages']=$allLanguages;
				//$viewData['languageMeta']=$languageMeta;

				$this->load->view('view-appLanguage',$viewData);
			}else{
				redirect('admin/not_admin');
			}
  		}else{
 		redirect('admin/index');
		}
	}

	// Show stored language call
	public function showStoredLanguage(){
		$request = $this->input->post();
		$currentlanguage= $request['fetchLanguage'];

		$app= $request['app'];
		if($app=='user'){
				$table='user_app_language';
		}else{
				$table='app_languages';
		}

		$this->db->select('language_meta');
		$this->db->where('language_name', $currentlanguage);
		$query = $this->db->get($table);
		$languageMeta = $query->row();
		$languageMeta=json_decode($languageMeta->language_meta, true);
		//var_dump($languageMeta);
		print json_encode($languageMeta);
	}

	// Save new language call
	public function saveNewLanguage()
	{
		$request = $this->input->post();
		$newLanguage= $request['newLanguage'];
		// $this->load->helper('language_helper');
		// $getArray=getLanguageForDriverApp();
		// $getArray=json_encode($getArray);
		$app= $request['app'];
		if($app=='user'){
				$table='user_app_language';
		}else{
				$table='app_languages';
		}

		$this->db->select("count(*) as count");
		$this->db->where("language_name",$newLanguage);
		$this->db->from($table);
		$count = $this->db->get()->row();
		if($count->count > 0) {
			$this->db->where("language_name",language_name);
			$result = $this->db->update('language_name', $newLanguage);
		}else {
			$ins = array(
										'language_name' => $newLanguage,
										'language_meta' => '',
										'status'  => '0'
									);
		 $result=$this->db->insert($table, $ins);
		}
		if($result){
			echo 1;
		}else{
			echo 0;
		}
	}

	// Save driver app language call
	public function saveDriverApplang()
	{
 		ob_start();
		$request = $this->input->post();

		$hidden_lang=$request['hidden_lang'];
		$languageMeta=json_encode($request);



		 $data = array( 'language_meta' => $languageMeta);
		 $this->db->where('language_name', $hidden_lang);
		 $result=$this->db->update('app_languages', $data);
		 redirect(base_url().'admin/languageChageForDriverApp');
	}

	// Delete app langauge all
	public function deleteAppLanguage(){
		$request = $this->input->post();
		$id=$request['id'];
		$this->db->where('id', $id);
		$del=$this->db->delete('app_languages');
		if($del){
			echo 1;
		}else {
			echo 0;
		}
	}

	// Language change for user app call
	public function languageChageForUserApp()
	{
		$this->seesion_set();

		if($this->session->userdata('username-admin') ||   $this->input->cookie('username-admin', false)){
			 	$permission = $this->permission();
				if(($this->session->userdata('role-admin') == 'admin') || ($permission == "access")) {
				//$this->load->helper('language_helper');
				$this->db->select('language_name');
				$query = $this->db->get('user_app_language');
				$allLanguages = $query->result_array();

				if(isset($allLanguages[0]['language_name'])){
						$currentlanguage=$allLanguages[0]['language_name'];
				}

				$viewData['allLanguages']=$allLanguages;
				//$viewData['languageMeta']=$languageMeta;

				$this->load->view('view-userAppLanguage',$viewData);
			}else{
			redirect('admin/not_admin');
			}
		}else{
		redirect('admin/index');
		}
	}

	// Save user app language call
	public function saveUserApplang()
	{
 		ob_start();
		$request = $this->input->post();

		$hidden_lang=$request['hidden_lang'];
		$languageMeta=json_encode($request);
	 	$data = array( 'language_meta' => $languageMeta);
	 	$this->db->where('language_name', $hidden_lang);
	 	$result=$this->db->update('user_app_language', $data);
	 	redirect(base_url().'admin/languageChageForUserApp');
	}

	// Delete user app langauge call
	public function deleteUserAppLanguage(){
		$request = $this->input->post();
		$id=$request['id'];
		$this->db->where('id', $id);
		$del=$this->db->delete('user_app_language');
		if($del){
			echo 1;
		}else {
			echo 0;
		}
	}

	// Set app default language call
	public function setAppDefaultLanguage()
	{
		$request = $this->input->post();
		$language=$request['language'];
		$app=$request['app'];
		if($app=='user'){
				$table='user_app_language';
		}else{
				$table='app_languages';
		}

		$data = array( 'status' => '0');
		$this->db->where('status', '1');
		$result=$this->db->update($table, $data);

		if($result){
			$data = array( 'status' => '1');
			$this->db->where('language_name', $language);
			$setLanguage=$this->db->update($table, $data);
		}
		if($setLanguage)	{	echo 1;	}else{	echo 0;	}
	}
	//user_rating
	public function user_rating()
	{
		$this->seesion_set();

		if($this->session->userdata('username-admin') ||   $this->input->cookie('username-admin', false)){
			$permission = $this->permission();
			if(($this->session->userdata('role-admin') == 'admin') || ($permission == "access")) {
				//$data['query1'] = $this->home->real_time_driver();
				$this->load->view('user_rating');
			}else{
				redirect('admin/not_admin');
			}
		}else{
			redirect('admin/index');
		}
	}
	//edit user rating
	public function edit_user_rating()
	{
		$this->seesion_set();

		if($this->session->userdata('username-admin') ||   $this->input->cookie('username-admin', false)){
			$permission = $this->permission();
			if(($this->session->userdata('role-admin') == 'admin') || ($permission == "access")) {
				//$data['query1'] = $this->home->real_time_driver();
				$this->load->view('edit_user_rating');
			}else{
				redirect('admin/not_admin');
			}
		}else{
			redirect('admin/index');
		}
	}
     //driver_rating
	public function driver_rating()
	{
		$this->seesion_set();

		if($this->session->userdata('username-admin') ||   $this->input->cookie('username-admin', false)){
			$permission = $this->permission();
			if(($this->session->userdata('role-admin') == 'admin') || ($permission == "access")) {
				//$data['query1'] = $this->home->real_time_driver();
				$this->load->view('driver_rating');
			}else{
				redirect('admin/not_admin');
			}
		}else{
			redirect('admin/index');
		}
	}
	//edit_driver_rating
	public function edit_driver_rating()
	{
		$this->seesion_set();

		if ($this->session->userdata('username-admin') || $this->input->cookie('username-admin', false)) {
			$permission = $this->permission();
			if (($this->session->userdata('role-admin') == 'admin') || ($permission == "access")) {
				//$data['query1'] = $this->home->real_time_driver();
				$this->load->view('edit_driver_rating');
			} else {
				redirect('admin/not_admin');
			}
		} else {
			redirect('admin/index');
		}
	}
}
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
?>