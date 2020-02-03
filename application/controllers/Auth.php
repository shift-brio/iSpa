<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Auth extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->library('session');
		$this->load->helper('form');
		$this->load->helper('date');
		$this->load->library('user_agent');
		$this->load->helper('url_helper');    
    $this->load->library("common");
    $this->load->model("commonDatabase");
	}
  public function index(){
    common::emitData(['~' => 'TalkPoint Auth ;-)']);
  }	
  public function sign_up(){
    if (!isset($_SESSION["user"])) {         
      $data['title'] = "iSpa - Sign Up";
      $data['page'] = "home";   
      $data['data'] = json_decode(json_encode($data));  
      $this->load->view("templates/base_header",$data);
      $this->load->view("sign_up");
    }
    else{
      redirect(base_url());
    }
  }  
  public function sign(){
    if (!isset($_SESSION["user"]) && isset($_POST["name"]) && isset($_POST["email"]) && isset($_POST["pass"]) && isset($_POST["phone"]) && isset($_POST["location"]) && isset($_POST{'terms'}) && isset($_POST{"phone"})) {
      $name = $_POST["name"];
      $email = $_POST["email"];
      $phone = $_POST["phone"];
      $pass = $_POST["pass"];
      $location = $_POST["location"];
      $terms = $_POST["terms"] == true || $_POST["terms"] == "true" ? true : false;
      if (isset($location["lat"]) && isset($location["lng"]) && isset($location["title"])) {
        if (common::isKenya($location) || $location["lat"] == 0) {
          if (!(mb_substr($phone, 0,4) == +254 || mb_substr($phone, 0,4) == "+254")) {
            if (mb_substr($phone, 0,1) == 0 || mb_substr($phone, 0,1) == "0") {
              $phone = "+254".mb_substr($phone,1,strlen($phone));
            }else{
              $phone = "+254".$phone;
            }
          }
          $ch_phone = $this->commonDatabase->get_data("ispa_users",1,false,"phone",$phone);
          if (!$ch_phone && $phone != "" && $email != "") {
            $ch_email = $this->commonDatabase->get_data("ispa_users",1,false,"email",$email);
            if (!$ch_email) {
              if ($terms == true || $terms == "true") {
                $time = time();
                $id = md5(sha1($time.$phone.$email));
                $pass = common::getPass($pass);
                $data = [
                    "name" => $name,
                    "email" => $email,
                    "phone" => $phone,
                    "location" => json_encode($location),
                    "date_joined" => $time,
                    "last_active" => $time,
                    "pass" => $pass,
                    "ispa_id" => $id
                ];
                $this->commonDatabase->add("ispa_users",$data);
                $r['status'] = true;
                $r["m"] = "Sign up successfull";
                common::update_user_session($id);
              }else{
                $r['status'] = false;
                $r["m"] = "Kindly agree to our terms of service before signing up.";
              }
            }else{
              $r['status'] = false;
              $r["m"] = "The email address you submitted has already been registered.";
            }
          }else{
            if ($email == "") {
              $r['status'] = false;
              $r["m"] = "Enter a valid email address";
            }else{
              $r['status'] = false;
              $r["m"] = "The phone number you submitted has already been registered.";
            }
          }
        }else{
          $r['status'] = false;
          $r["m"] = "Invalid location";
        }
      }else{
        $r['status'] = false;
        $r["m"] = "Invalid location";
      }
    }else{
      $r['status'] = false;
      $r["m"] = "Invalid access";
    }
    common::emitData($r);
  }
  public function logger(){
    if (!isset($_SESSION['user'])) {
      if (isset($_POST['email']) && isset($_POST['pass'])) {
         $email = $_POST['email'];
         $pass  = common::getPass($_POST['pass']);
         $login = $this->commonDatabase->get_data("sms_users",1,false,"email",$email,"password",$pass);
         if ($login) {
           common::update_user_session($login[0]['ispa_id']);
           $r['status'] = true;
           $r['m'] = "logged in";
         }else{
          $r['status'] = false;
          $r['m'] = "Invalid email or password";
         }
      }
    }else{
      $r['status'] = false;
      $r['m'] = "Your are already logged in";
    }
    common::emitData($r);
  }
  public function logout(){
    unset($_SESSION['user']);
    unset($_SESSION['business']);
    unset($_SESSION['business_name']);
    redirect(base_url());
  }
  public function change_pass(){
    if (isset($_SESSION["user"]) && isset($_POST["curr"]) && isset($_POST["new_pass"])) {
      $pass = common::getPass($_POST['curr']);
      $new = common::getPass($_POST["new_pass"]);

      $log = $this->commonDatabase->get_data("ispa_users",1,false,"ispa_id",$_SESSION["user"]->ispa_id,"pass",$pass);
      if ($log) {
        $data = ["pass" => $new];
        $this->commonDatabase->update("ispa_users",$data,"ispa_id",$_SESSION["user"]->ispa_id);
        $r["status"] = true;
      }else{
        $r['status'] = false;
        $r['m'] = "You enter a wrong password.";
      }
    }else{
      $r['status'] = false;
      $r['m'] = "Invalid access.";
    }
    common::emitData($r);
  }
  public function save_prof(){
    if (isset($_SESSION['user']) && isset($_FILES)) {
      if (isset($_FILES['file-0'])) { 
        $filename = md5(sha1($_SESSION["user"]->ispa_id.time()));         
        $config['upload_path']          = './uploads/profiles/';
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['file_name']            = $filename;
        $config['max_size']             = 160000;
        $this->load->library('upload', $config);  

        if (!$this->upload->do_upload('file-0'))
        {
          $r["status"] = false;
          $error = array('error' => $this->upload->display_errors());             
          $r['m'] = $error['error'];          
        } 
        else{
          $data = [
              'profile' => $filename.$this->upload->data('file_ext')
          ];
          if (isset($_SESSION["business"])) {
            $this->commonDatabase->update("ispa_business",$data,'identifier',$_SESSION['business']);
          }else{
            $this->commonDatabase->update("ispa_users",$data,'ispa_id',$_SESSION['user']->ispa_id);
          }
          $r['status'] = true;
          $r['m']['src'] = base_url("uploads/profiles/").$filename.$this->upload->data('file_ext');
          common::update_user_session($_SESSION['user']->ispa_id);         
        }
      }else{
        $r['status'] = false;
        $r['m'] = "Invalid file";
      }
    }else{
      $r['status'] = false;
      $r['m'] = "Invalid access.";
    }
    common::emitData($r);
  }
  public function del_prof(){
    if (isset($_SESSION["user"])) {
      $data = [
          'profile' => "profile.svg"
      ];
      if (isset($_SESSION["business"])) {
        $data = [
            'profile' => "default_bus_prof.png"
        ];
        $this->commonDatabase->update("ispa_business",$data,'identifier',$_SESSION['business']);
      }else{
        $this->commonDatabase->update("ispa_users",$data,'ispa_id',$_SESSION['user']->ispa_id);
      }

      $r['status'] = true;
      $r['m']['src'] = base_url("uploads/profiles/".$data["profile"]);
      common::update_user_session($_SESSION['user']->ispa_id);

    }else{
      $r['status'] = false;
      $r['m'] = "Invalid access.";
    }
    common::emitData($r);
  }
  public function save_edit(){
    if (isset($_SESSION["user"]) && isset($_POST["name"]) && isset($_POST["email"]) && isset($_POST["phone"]) && isset($_POST["location"])) {  

      $user = $_SESSION["user"]->ispa_id;
      $phone = $_POST["phone"];
      $email = $_POST["email"];
      $name  = $_POST["name"];

      $login = $this->commonDatabase->get_data("ispa_users",1,false,"ispa_id",$user);
      $location = $_POST["location"];      
      if ($location == false || $location == "false" || $location == "") {
        $location = [
          "lat" => json_decode($login[0]["location"])->lat,
          "lng" => json_decode($login[0]["location"])->lng,
          "title" => json_decode($login[0]["location"])->title
        ];          
      }

      if (isset($location["lat"]) && isset($location["lng"]) && isset($location["title"]) /*&& common::isKenya($location)*/) {    

        $ch_phone =$this->commonDatabase->get_data("ispa_users",1,false,"phone",$phone);
        $ch_email =$this->commonDatabase->get_data("ispa_users",1,false,"email",$email);
        if (!$ch_phone || $ch_phone[0]["ispa_id"] == $user) {
          if (!$ch_email || $ch_email[0]["ispa_id"] == $user) {
            $data = [
                "name" => $name,
                "email" => $email,
                "phone" => $phone,
                "location" => json_encode($location),                  
            ];
            $this->commonDatabase->update("ispa_users",$data,"ispa_id",$user);
            common::update_user_session($user);
            $r["status"] = true;
            $r["m"] = "Updated";
          }else{
            $r["status"] = false;
            $r["m"] ="The email address has already been registered with another user.";
          }
        }else{
          $r["status"] = false;
          $r["m"] = "The phone number has already been registered with another user.";
        }        
      }else{
        $r["status"] = false;
        $r["m"] = "Invalid location entered";
      }      
    }else{
      $r['status'] = false;
      $r['m'] = "Invalid access.";
    }
    common::emitData($r);
  }
  public function test_login(){
    if (!isset($_SESSION["user"])) {
      if (isset($_POST["email"]) && isset($_POST["password"]) && isset($_POST["remember"])) {
        $email = $_POST["email"];
        $password = common::getPass($_POST["password"]);
        $remember = $_POST["remember"] == "false" || $_POST["remember"] == false ? false: true;
        $get_user = $this->commonDatabase->get_data("ispa_users",1,false,"email",$email,"pass",$password);
        if ($get_user) {
          common::update_user_session($get_user[0]["ispa_id"]);
          $r["status"] = true;
          if ($remember) {
            $_SESSION["remember"] = $email;
            $_SESSION["tested"]   = true;
          }else{
            unset($_SESSION["remember"]);
          }
        }else{
          $r["status"] = false;
          $r["m"] = "Invalid email or password entered";
        }
      }else{
        $r["status"] = false;
        $r["m"] = "An unknown error occurred";
      }
    }else{
      $r["status"] = false;
      $r["m"] = "Oops! Someone is already logged in";
    }
    common::emitData($r);
  }
  public function get_recovery_code(){
    if (isset($_POST["email"]) && !isset($_SESSION["user"])) {
      $email = $_POST["email"];
      $user  = $this->commonDatabase->get_data("ispa_users",1,false,"email",$email);
      $code  = strtoupper(mb_substr(md5(sha1(time().$email.date("d-m-Y"))), 0,6));

      if ($user) {
        $data = [
          "user" => $user[0]["ispa_id"],
          "code" => $code,
          "date_added" => time()
        ];
        $this->commonDatabase->add("ispa_recovery",$data);
        /*send recovery code*/        
      }
      $r["status"] = true;
      $r["m"] = "Recovery code has been sent to ".$email.". Check your email for the recovery code.";
    }else{
      $r["status"] = false;
      $r["m"] = "An unknown error occurred.";
    }
    common::emitData($r);
  }
  public function recover_pass(){
    if (isset($_POST["email"]) && !isset($_SESSION["user"]) && isset($_POST["code"]) && isset($_POST["pass"])) {
      $email = $_POST["email"];
      $code = strtoupper($_POST["code"]);
      $user  = $this->commonDatabase->get_data("ispa_users",1,false,"email",$email);      
      $password = common::getPass($_POST["pass"]);

      if ($user) {
        $get_code = $this->commonDatabase->get_data("ispa_recovery",1,false,"user",$user[0]["ispa_id"],"code",$code);
        if ($get_code && $get_code[0]["status"] == 0) {
           $data = [
            "pass" => $password
           ];
           $this->commonDatabase->update("ispa_users",$data,"email",$email);
           $data = ["status" => 1];
           $this->commonDatabase->update("ispa_recovery",$data,"user",$user[0]["ispa_id"]);
           $r["status"] = true;
        }else{
          $r["status"] = true;
          $r["m"] = "Recovery code not found";
        }     
      }else{
        $r["status"] = true;
        $r["m"] = "An unknown error occurred";
      }      
    }else{
      $r["status"] = false;
      $r["m"] = "An unknown error occurred.";
    }
    common::emitData($r);
  }
}