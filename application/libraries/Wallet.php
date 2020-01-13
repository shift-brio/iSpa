<?php 
class Wallet{
  public function __construct() {
    $CI = & get_instance();      
    $CI->load->library('session');
    $CI->load->helper('form');        
    $CI->load->library('user_agent');
    $CI->load->helper('url_helper');
    $CI->load->helper('date'); 
    $CI->load->model("commonDatabase");              
  }
  
  static function balance($account = false){
    if (!$account && isset($_SESSION["user"]->ispa_id)) {
      $account = $_SESSION["user"]->ispa_id;
    }
    if ($account) {
      $CI = &get_instance();
      $wallet = $CI->commonDatabase->get_data("ispa_wallet",1,false,"account",$account);
      if ($wallet) {
        $w = [
          "balance" => $wallet[0]["balance"],
          "status" => true
        ];
      }else{
        if (wallet::add($account)) {          
          $w = [
            "balance" => 0,
            "status" => true
          ];
        }else{
          $w = [
            "balance" => 0,
            "status" => false
          ];
        }
      }
    }else{
      $w = [
        "balance" => 0,
        "status" => false
      ];
    }
    return json_decode(json_encode($w));
  }
  static function subscribe($bus = false,$sub = false,$amnt = false,$type = false){    
    if ($bus && $sub && $amnt) {
      $CI  = &get_instance();
      for ($i=0; $i < sizeof($CI->config->item("subs")); $i++) { 
        $s = $CI->config->item("subs")[$i];        
              
        if ($s == $sub) {        

          if ($amnt >= 0) {
            $bus = common::getBus($bus);
            if ($bus) {
              $ch_sub = $CI->commonDatabase->get_data("ispa_subscriptions",1,false,"account",$bus['identifier'],"status",0);
              if (!$ch_sub) {
                $time = time();
                $t_id = md5($amnt.$time.$bus['identifier']);
                $data = [
                  "account" => $bus["identifier"],
                  "type" => $type,
                  "date" => time(),
                  "status" => 0,
                  "amount" => $amnt,
                  "transaction_id" => $t_id,               
                ];
                $CI->commonDatabase->add("ispa_subscriptions",$data);
                $data = [
                  "appointment_id" => "",
                  "type" => "subscription",
                  "payer" => $bus["identifier"],
                  "paid" => "ispa",
                  "amount" => $amnt,
                  "disc" => 0,
                  "ref" => $t_id,
                  "date" => $time,
                  "state" => 1,
                  "spent" => 1
                ];
                $CI->commonDatabase->add("ispa_transactions",$data);
                wallet::spend($bus["identifier"],$amnt);
                if ($type == "year") {
                  $type == "Annually";
                }                
                common::notify($bus["identifier"], "Confirmed, Ksh. ".number_format($amnt,2)." has been paid to iSpa.","Subscription");
                return true;
              }else{
                return json_decode(json_encode(["status" => false , "m" => "There is an active subscription for this account."]));
              }
            }
            return false;
          }
          return false;
        }
      }    
    }    
    return false;
  }
  static function add($account = false, $balance = 0){
    if ($account) {
      $CI = &get_instance();
      $wallet = $CI->commonDatabase->get_data("ispa_wallet",1,false,"account",$account);
      if (!$wallet) {
        $data = [
          "account" => $account,
          "initial" => $balance,
          "balance" => $balance,
          "date_added" => time()
        ];
        $CI->commonDatabase->add("ispa_wallet",$data);
        return true;
      }
    }
    return false;
  }
  static function spend($account = false, $amount = 0){
    if ($account) {
      $CI = &get_instance();
      $wallet = wallet::balance($account);
      if ($wallet) {
        $w_data = [
          "balance" => $wallet->balance - $amount 
        ];
        $CI->commonDatabase->update("ispa_wallet",$w_data,"account",$account);        
      }
    }
  }
  static function chargeApp($user = false,$amnt = 0,$appointment = false,$paid = false,$editing = false){
    if ($user && $amnt > 0 && $appointment && $paid) {
      $wallet = wallet::balance($user);
      $CI = &get_instance();
      $bal = $amnt;     
      if ($wallet->balance >= $amnt) {              
        if ($editing) {
          $tr = $CI->commonDatabase->get_data("ispa_transactions",1,false,"appointment_id",$appointment);         
          if ($tr) {
            $bal = (Float)$tr[0]["amount"] - (Float)$amnt;
          }else{
            $bal = 0;
          }
          $data = [
            "amount" => $amnt
          ];
          $CI->commonDatabase->update("ispa_transactions",$data,"id",$tr[0]["id"]);
        }else{
          $t_data = [
            "paid" => $paid,
            "payer" => $user,
            "ref" => md5(sha1(json_encode($wallet).time())),
            "amount" => $amnt,
            "appointment_id" => $appointment,           
          ];
          $CI->commonDatabase->add("ispa_transactions",$t_data);              
        }   
        wallet::spend($user,$bal);        
        return true;          
      }
    }
    return false;
  }
  static function deposit($code = false,$ac = false){
    if ($code && $ac) {
      $CI = &get_instance();
      $transaction = $CI->commonDatabase->get_data("ispa_mpesa_data",1,false,"transaction_reference",$code,"status",0);
      if ($transaction) {
       $amount = $transaction[0]["amount"];
       $wallet = wallet::balance($ac);
       $bal = $wallet->balance;
       $time = time();

       $data = [
        "balance" => $bal + $amount
       ];

       $CI->commonDatabase->update("ispa_wallet",$data,"account",$ac);
       common::notify($ac, "Ksh. ",$title = false);
      }
    }
    return false;
  }
  static function status($bus = ""){
    $CI = &get_instance();

    $trial = $CI->config->item("trial") * (60 * 60 * 24);
    $shop = common::getBus($bus);
    if ($shop) {
      $sub = $CI->commonDatabase->get_data("ispa_subscriptions",1,false,"status",0);
      if ($sub) {
        $date = $sub[0]["date"];
        $dur = $CI->config->item("durations");
        $subs = $CI->config->item("subs");

       $dur = $CI->config->item("subs_dur")[$sub[0]["type"]];

       if ($dur >= 0) {
         $end = $date + ($dur * (60 * 60 * 24));
         if ($end > time()) {
          return json_decode(json_encode(["sub" => true,"m" => $subs[$sub[0]["type"]],"end" => $end]));
         }else{
          return json_decode(json_encode(["sub" => false]));
         }
       }else{
        return json_decode(json_encode(["sub" => false]));
       }
      }else{
        $start = $shop["date_added"];
        if (($start + $trial) >= time() ) {
          return json_decode(json_encode(["sub" => true,"m" => "trial","end" => ($start + $trial)]));
        }else{
          return json_decode(json_encode(["sub" => false]));
        }
      }
    }else{
      return json_decode(json_encode(["sub" => false]));
    }
  }
}
?>