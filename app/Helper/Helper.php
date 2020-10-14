<?php 

use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\OptionController;
use Illuminate\Support\Facades\Cookie;
use App\Models\UserDetails;
use Steevenz\Rajaongkir;
use Anam\Phpcart\Cart;

function getProductCategory()
{
  $product_category = DB::table('terms')
                      ->where('terms.type','product_cat')
                      ->where('terms.parent',0)
                      ->orderBy('terms.indeks','ASC')
                      ->leftjoin('term_extras as a','a.term_id','terms.term_id')
                      ->where('a.key_name','_category_img_url')
                      ->leftjoin('term_extras as b','b.term_id','terms.term_id')
                      ->where('b.key_name','_category_description')
                      ->select('terms.name','terms.slug','a.key_value as category_img','b.key_value as category_description')
                      ->get();
  return $product_category;
}

function string_decode($str){
  $decode = html_entity_decode($str, ENT_QUOTES | ENT_IGNORE, "UTF-8");
  return $decode;
}

function money($value) {
  $format = "Rp " . number_format((float)$value,0,',','.');
  return $format;
}

function get_author_id_by_product_id($product_id){
  $author_id = null;
  $get_post = DB::table('products')->where(['id' => $product_id])->first();

  if(!empty($get_post)){
    $author_id = $get_post->author_id; 
  }

  return $author_id;
}

function get_current_frontend_user_info(){
  $userData = array();
  
  if(Session::has('beangasm_frontend_buyer_id')){
    $getuserdata = DB::table('users')->find(Session::get('beangasm_frontend_buyer_id'));
    $getpointdata = DB::table('wallets')->where('user_id', Session::get('beangasm_frontend_buyer_id'))->first();
    if(!empty($getuserdata)){
      $userData['user_display_name'] = $getuserdata->display_name;
      $userData['user_name'] = $getuserdata->name;
      $userData['user_email'] = $getuserdata->email;
      $userData['user_photo_url'] = $getuserdata->user_photo_url;
      $userData['user_status'] = $getuserdata->user_status;
      $userData['user_id'] = Session::get('beangasm_frontend_buyer_id');
      $userData['member_since'] = $getuserdata->created_at;
      $userData['total_points'] = (isset($getpointdata->amount)) ? $getpointdata->amount : 0 ;
    }
  }
  else{
    $userData['user_role_id'] = '';
    $userData['user_role'] = '';
    $userData['user_role_slug'] = '';
    $userData['user_display_name'] = '';
    $userData['user_name'] = '';
    $userData['user_email'] = '';
    $userData['user_photo_url'] = '';
    $userData['user_status'] = '';
    $userData['user_id'] = '';
    $userData['member_since'] = '';
    // $userData['total_points'] = '';
  }
  
  return $userData;
}

function is_frontend_user_logged_in(){
  $is_logged_in = false;
  
  if(Session::has('beangasm_frontend_buyer_id')){
    $is_logged_in = true;
  }
  
  return $is_logged_in;
}

function get_current_currency_name()
{
  $option                     =   new OptionController();
  $unserialize_settings_data  = $option->getSettingsData();

  return $unserialize_settings_data['general_settings']['currency_options']['currency_name'];
}

function get_product_price_html_by_filter( $amount ){
  $price               =   0;
  $from_currency       =   '';
  $to_currency         =   '';
  
  $current_currency_name = get_current_currency_name();
  
  if(Cookie::has('beangasm_multi_currency')){
    $from_currency  =  $current_currency_name;
    $to_currency    =  Cookie::get('beangasm_multi_currency');
    
    $results = convertCurrency($from_currency, $to_currency, $amount);
    
    if(!is_null($results)){
      $price =  $results;
    }
    else{
      $price = $amount;
    }
  }
  else{
    $price = $amount;
  }
  
  return $price;
}

function convertCurrency($from, $to, $amount){
  $convert_amount = null;
  $option  =  new OptionController();
  $get_settings_option = $option->getSettingsData();
  
  $endpoint = 'convert';
  $access_key = $get_settings_option['general_settings']['fixer_config_option']['fixer_api_access_key'];

  // initialize CURL:
  $ch = curl_init('https://data.fixer.io/api/'.$endpoint.'?access_key='.$access_key.'&from='.$from.'&to='.$to.'&amount='.$amount.'');   
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

  // get the JSON data:
  $json = curl_exec($ch);
  curl_close($ch);

  // Decode JSON response:
  $conversionResult = json_decode($json, true);
  if(isset($conversionResult['success']) && $conversionResult['success'] && isset($conversionResult['result'])){
    $convert_amount = $conversionResult['result'];
  }

  return $convert_amount;
}

function get_product_type($product_id = '')
{
  $product_type =  '';
  $get_product = DB::table('products')->where('id', $product_id)->first();

  if(!empty($get_product)){
    $product_type = $get_product->type;
  }

  return $product_type;
}

function get_product_slug($product_id = '')
{
  $slug = '';
  $get_product = DB::table('products')->where('id', $product_id)->first();

  if(!empty($get_product)){
      $slug = $get_product->slug;
  }

  return $slug;
}

function get_role_based_price_by_product_id ($product_id, $price)
{
  $final_price = 0;
  $get_pricing = role_based_pricing_by_product_id( $product_id );
  $get_current_user_data  =  get_current_frontend_user_info();

  if(is_frontend_user_logged_in() && isset($get_current_user_data['user_role_slug']) && $get_pricing['is_enable'] == 'yes'){
    if(isset($get_pricing['pricing'][$get_current_user_data['user_role_slug']])){
      $regular_price = $get_pricing['pricing'][$get_current_user_data['user_role_slug']]['regular_price'];
      $sale_price    = $get_pricing['pricing'][$get_current_user_data['user_role_slug']]['sale_price'];
      
      if(isset($regular_price) && $regular_price && isset($sale_price) && $sale_price && $regular_price > $sale_price){
        $final_price = $sale_price;
      }
      elseif(isset($regular_price) && $regular_price){
        $final_price = $regular_price;
      }
    }
  }
  else{
    $final_price = $price;
  }

  return $final_price;
}

function role_based_pricing_by_product_id($product_id){
  $pricing_data = array();
  $get_is_role_based_pricing_enable  =  DB::table('product_extras')->where(['product_id' => $product_id, 'key_name' => '_is_role_based_pricing_enable'])->first();
  $get_role_based_pricing  =  DB::table('product_extras')->where(['product_id' => $product_id, 'key_name' => '_role_based_pricing'])->first();

  if(!empty($get_is_role_based_pricing_enable)){
    $pricing_data['is_enable'] = $get_is_role_based_pricing_enable->key_value;
  }
  else{
    $pricing_data['is_enable'] = null;
  }

  if(!empty($get_role_based_pricing)){
    $pricing_data['pricing'] = unserialize($get_role_based_pricing->key_value);
  }
  else{
    $pricing_data['pricing'] = array();
  }

  return $pricing_data;
}

function price_html($price, $currency_code = null)
{
  $option  =  new OptionController();
  $currency   =   '';
  $price_html =   '';
  $settings =  $option->getSettingsData();
  $get_price = 0;

  if($price){
      $get_price = $price;
  }

  $number = number_format( $get_price , $settings['general_settings']['currency_options']['number_of_decimals'] , $settings['general_settings']['currency_options']['decimal_separator'] , $settings['general_settings']['currency_options']['thousand_separator'] );

  if($currency_code){
      $currency = get_currency_symbol_by_code( $currency_code );
  }
  else{
      $currency = get_currency_symbol_by_code( $settings['general_settings']['currency_options']['currency_name'] );
  }

  if($settings['general_settings']['currency_options']['currency_position'] == 'left'){
      $price_html = $currency.'<b>'.$number.'</b>';
  }
  elseif($settings['general_settings']['currency_options']['currency_position'] == 'right'){
      $price_html = '<b>'.$number.'</b>'.$currency;
  }
  elseif($settings['general_settings']['currency_options']['currency_position'] == 'left_with_space'){
      $price_html = $currency.' <b>'.$number.'</b>';
  }
  elseif($settings['general_settings']['currency_options']['currency_position'] == 'right_with_space'){
      $price_html = '<b>'.$number .'</b> '. $currency;
  }

  return $price_html;
}

function get_comments_rating_details($object_id, $target){
  $total  =  0;
  $individual  =  0;
  $comment_details =  array();
  
  if(!empty($object_id) && $object_id >0 && !empty($target)){
    $data = DB::table("comments")
          ->where(['object_id' => $object_id, 'target' => $target, 'status' => 1])
          ->select(DB::raw("COUNT(*) as count_row, rating"))
          ->groupBy(DB::raw("rating"))
          ->get()
          ->toArray();
    
    if(count($data) > 0){
      foreach($data as $row){
        $total += $row->count_row;
        $individual += $row->rating * $row->count_row;
        $comment_details[$row->rating] = $row->count_row * 100;
      }
    }  
      
    if(!empty($total) && $total > 0){
      $comment_details['total']  =  $total;
    }
    else{
      $comment_details['total']  =  0;
    }

    if(!empty($individual) && !empty($total) && $individual > 0 && $total >0){
      $comment_details['average']  =  number_format(($individual / $total), 2);
    }
    else{
      $comment_details['average']  =  0;
    }

    if(isset($comment_details['average']) && !empty($comment_details['average'])){
      $comment_details['percentage']   =  round((($comment_details['average'] / 5) * 100), 2);
    }
    else{
      $comment_details['percentage']   =  0;
    }

    if(isset($comment_details[5])){
      $comment_details[5] = round(($comment_details[5] / $comment_details['total']), 2);
    }
    else{
      $comment_details[5] = 0;
    }

    if(isset($comment_details[4])){
      $comment_details[4] = round(($comment_details[4] / $comment_details['total']), 2);
    }
    else{
      $comment_details[4] = 0;
    }

    if(isset($comment_details[3])){
      $comment_details[3] = round(($comment_details[3] / $comment_details['total']), 2);
    }
    else{
      $comment_details[3] =0;
    }

    if(isset($comment_details[2])){
      $comment_details[2] = round(($comment_details[2] / $comment_details['total']), 2);
    }
    else{
      $comment_details[2] = 0;
    }

    if(isset($comment_details[1])){
      $comment_details[1] = round(($comment_details[1] / $comment_details['total']), 2);
    }
    else{
      $comment_details[1] = 0;
    }
  }
  
  return $comment_details;
}

function get_currency_symbol_by_code( $currency = '' )
{
  switch ( $currency ) {
      case 'AED' :
          $currency_symbol = 'د.إ';
          break;
      case 'AUD' :
      case 'ARS' :
      case 'CAD' :
      case 'CLP' :
      case 'COP' :
      case 'HKD' :
      case 'MXN' :
      case 'NZD' :
      case 'SGD' :
      case 'USD' :
          $currency_symbol = '&#36;';
          break;
      case 'BDT':
          $currency_symbol = '&#2547;&nbsp;';
          break;
      case 'BGN' :
          $currency_symbol = '&#1083;&#1074;.';
          break;
      case 'BRL' :
          $currency_symbol = '&#82;&#36;';
          break;
      case 'CHF' :
          $currency_symbol = '&#67;&#72;&#70;';
          break;
      case 'CNY' :
      case 'JPY' :
      case 'RMB' :
          $currency_symbol = '&yen;';
          break;
      case 'CZK' :
          $currency_symbol = '&#75;&#269;';
          break;
      case 'DKK' :
          $currency_symbol = 'DKK';
          break;
      case 'DOP' :
          $currency_symbol = 'RD&#36;';
          break;
      case 'EGP' :
          $currency_symbol = 'EGP';
          break;
      case 'EUR' :
          $currency_symbol = '&euro;';
          break;
      case 'GBP' :
          $currency_symbol = '&pound;';
          break;
      case 'HRK' :
          $currency_symbol = 'Kn';
          break;
      case 'HUF' :
          $currency_symbol = '&#70;&#116;';
          break;
      case 'IDR' :
          $currency_symbol = 'Rp';
          break;
      case 'ILS' :
          $currency_symbol = '&#8362;';
          break;
      case 'INR' :
          $currency_symbol = 'Rs.';
          break;
      case 'ISK' :
          $currency_symbol = 'Kr.';
          break;
      case 'KIP' :
          $currency_symbol = '&#8365;';
          break;
      case 'KRW' :
          $currency_symbol = '&#8361;';
          break;
      case 'MYR' :
          $currency_symbol = '&#82;&#77;';
          break;
      case 'NGN' :
          $currency_symbol = '&#8358;';
          break;
      case 'NOK' :
          $currency_symbol = '&#107;&#114;';
          break;
      case 'NPR' :
          $currency_symbol = 'Rs.';
          break;
      case 'PHP' :
          $currency_symbol = '&#8369;';
          break;
      case 'PLN' :
          $currency_symbol = '&#122;&#322;';
          break;
      case 'PYG' :
          $currency_symbol = '&#8370;';
          break;
      case 'RON' :
          $currency_symbol = 'lei';
          break;
      case 'RUB' :
          $currency_symbol = '&#1088;&#1091;&#1073;.';
          break;
      case 'SEK' :
          $currency_symbol = '&#107;&#114;';
          break;
      case 'THB' :
          $currency_symbol = '&#3647;';
          break;
      case 'TRY' :
          $currency_symbol = '&#8378;';
          break;
      case 'TWD' :
          $currency_symbol = '&#78;&#84;&#36;';
          break;
      case 'UAH' :
          $currency_symbol = '&#8372;';
          break;
      case 'VND' :
          $currency_symbol = '&#8363;';
          break;
      case 'ZAR' :
          $currency_symbol = '&#82;';
          break;
      default :
          $currency_symbol = '';
          break;
  }

  return $currency_symbol;
}

function get_frontend_selected_currency()
{
  $selected_currency_name   =   '';
  $option  =  new OptionController();
  $settings = $option->getSettingsData();
  
  if(Cookie::has('shopist_multi_currency')){
    $selected_currency_name = Cookie::get('shopist_multi_currency');
  }
  else{
    if(isset($settings['general_settings']['currency_options']['currency_name'])){
      $selected_currency_name = $settings['general_settings']['currency_options']['currency_name'];
    }
  }

  return $selected_currency_name;
}

function get_vendor_details_by_product_id($product_id)
{
  $vendor_final = array();
  $get_author_id  = DB::table('products')->where(['id' => $product_id])->first();
 
  if(!empty($get_author_id)){
    $get_role_id = DB::table('role_user')->where(['user_id' => $get_author_id->author_id])->orderBy('created_at', 'desc')->first();
    
    if(!empty($get_role_id)){
      $get_vendor_details = get_roles_details_by_role_id($get_role_id->role_id);
      
      if(!empty($get_vendor_details) && $get_vendor_details->slug == 'vendor'){
        $vendor_details = get_user_details( $get_author_id->author_id );
        $get_account_details = get_store_account_details_by_user_id( $get_author_id->author_id );

        $vendor_final = array_merge($vendor_details,  array_shift($get_account_details));
      }
    }
  }
  
  return $vendor_final;
}

function get_roles_details_by_role_id($role_id)
{
  $get_role_data_obj = null;
  $role_data = DB::table('roles')->where('roles.id', '=', $role_id)
  ->join('user_role_permissions', 'user_role_permissions.role_id', '=', 'roles.id')
  ->select('roles.*', 'user_role_permissions.role_id', 'user_role_permissions.permissions')        
  ->first();
    
  if(!empty($role_data)){
    $get_role_data  = $role_data;
    $get_role_data->permissions = unserialize($get_role_data->permissions);
    $get_role_data_obj = $get_role_data;
  }
  
  return $get_role_data_obj;
}

function get_user_details( $user_id )
{
  $userData = array();
  $getuserdata = DB::table('users')->where('id', $user_id)->orderBy('created_at', 'DESC')->first();
  if(!empty($getuserdata)){
    $userData['user_id']            =   $getuserdata->id;
    $userData['user_display_name']  =   $getuserdata->display_name;
    $userData['user_name']          =   $getuserdata->name;
    $userData['user_email']         =   $getuserdata->email;
    $userData['user_password']      =   $getuserdata->password;
    $userData['user_secret_key']    =   $getuserdata->secret_key;
    $userData['user_photo_url']     =   $getuserdata->user_photo_url;
    $userData['user_status']        =   $getuserdata->user_status;
  }

  return $userData;
}

function get_store_account_details_by_user_id( $user_id )
{
  $userAccuntData = array();
  $getUserAccuntData = UserDetails::where( ['user_id' => $user_id] )->where('details','LIKE','%profile_details%')->get()->toArray();
  
  if(count($getUserAccuntData) > 0){
    $userAccuntData = $getUserAccuntData;
  }
  
  return $userAccuntData;
}

function get_store_details( $user_id )
{
  $getUserAccuntData = UserDetails::where( ['user_id' => $user_id] )->where('details','LIKE','%profile_details%')->first();
  
  return $getUserAccuntData;
}

function get_buyer_account_details_by_user_id( $user_id )
{
  $userAccuntData = array();
  $getUserAccuntData = UserDetails::where( ['user_id' => $user_id] )->where('details','LIKE','%address_details%')->get()->toArray();
  
  if(count($getUserAccuntData) > 0){
    $userAccuntData = $getUserAccuntData;
  }
  
  return $userAccuntData;
}


function get_shipping_address_by_user_id( $user_id ){
  $userAccountData = array();
  $getUserAccountData = UserDetails::where('user_id', $user_id)->where('details','LIKE','%address_details%')->select('details')->first();
 
  if(!empty($getUserAccountData)){
    $userAccountData = json_decode($getUserAccountData->details);
    $userAccountData = $userAccountData->address_details;
  }
  
  return $userAccountData;
}

function get_store_name($author_id)
{
  $store_name = '';
  $get_user = get_user_details($author_id);
  
  if(count($get_user) > 0 && isset($get_user['user_display_name'])){
    $store_name = $get_user['user_display_name'];
  }
  
  return $store_name;
}

function group_by($key, $data) {
  $result = array();

  foreach($data as $val) {
      if(array_key_exists($key, $val)){
          $result[$val->$key][] = $val;
      }else{
          $result[""][] = $val;
      }
  }

  return $result;
}

function _group_by($array, $key) {
  $return = array();
  foreach($array as $val) {
      $return[$val->$key][] = $val;
  }
  return $return;
}

function getShippingOptionBySellerID($seller_id, $originCityID, $destinationCityID, $totalProductWeightGram){
  $shippingOption = array();
  $jne_only = array("18", "143", "37", "241", "383", "424", "716", "971", "1028", "1157", "1083", "1717", "748", "813", "2001", '2013', '68');
      //Beangasm, Pop Crack Bang, Consignment, Gustavo Coffee Roastery, Common Grounds Coffee Roasters, Bloom Coffee Project, Monomania Coffee Roastery, People Temple.id, Moonshine, Missiburoaster, Coffeea Circulor, Robbery Coffee, Supreme Roastworks, Tumach Roastery, prologcoffe, hirosan
  $jnt_only = array("1122"); // Titik Temu Roastery

  $tiki_only = array("333"); // Toko Kopi Mantap

  $jne_and_jnt = array("412", "665", "1154"); //Andrew's Roastworks, Moksa Coffee, The Dancing Tongue Club

  $jne_and_tiki = array("348", "1978"); // 9 Cups Coffee, Hobb's Coffee Roaster

  $jne_jnt_sicepat = array("1578", "1975"); // Vins Coffee, Arcanist

  $jne_sicepat = array("1563", "1642", "1535"); // Dailio Roaster, Sky nine coffee, NARAKOPI

  $rajaongkir = new Rajaongkir('a0079286b01e3b6d68ddfb09f4239698', Rajaongkir::ACCOUNT_PRO);

  if(in_array($seller_id, $jne_only)){
      $shippingOption = [$rajaongkir->getCost(['city' => $originCityID], ['city' => $destinationCityID], $totalProductWeightGram, 'jne')];
  } else if(in_array($seller_id, $jne_and_jnt)){
      $shippingOption = [$rajaongkir->getCost(['city' => $originCityID], ['city' => $destinationCityID], $totalProductWeightGram, 'jne'),$rajaongkir->getCost(['city' => $originCityID], ['city' => $destinationCityID], $totalProductWeightGram, 'jnt')];
  } else if(in_array($seller_id, $jne_and_tiki)){
      $shippingOption = [$rajaongkir->getCost(['city' => $originCityID], ['city' => $destinationCityID], $totalProductWeightGram, 'jne'),$rajaongkir->getCost(['city' => $originCityID], ['city' => $destinationCityID], $totalProductWeightGram, 'tiki')];
  } else if(in_array($seller_id, $jnt_only)){
      $shippingOption = [$rajaongkir->getCost(['city' => $originCityID], ['city' => $destinationCityID], $totalProductWeightGram, 'jnt')];
  } else if(in_array($seller_id, $tiki_only)){
      $shippingOption = [$rajaongkir->getCost(['city' => $originCityID], ['city' => $destinationCityID], $totalProductWeightGram, 'tiki')];
  } else if(in_array($seller_id, $jne_jnt_sicepat)){
      $shippingOption = [$rajaongkir->getCost(['city' => $originCityID], ['city' => $destinationCityID], $totalProductWeightGram, 'jne'),$rajaongkir->getCost(['city' => $originCityID], ['city' => $destinationCityID], $totalProductWeightGram, 'jnt'), $rajaongkir->getCost(['city' => $originCityID], ['city' => $destinationCityID], $totalProductWeightGram, 'sicepat')];
  } else if(in_array($seller_id, $jne_sicepat)){
      $shippingOption = [$rajaongkir->getCost(['city' => $originCityID], ['city' => $destinationCityID], $totalProductWeightGram, 'jne'),$rajaongkir->getCost(['city' => $originCityID], ['city' => $destinationCityID], $totalProductWeightGram, 'sicepat')];
  } else{
      $shippingOption = [$rajaongkir->getCost(['city' => $originCityID], ['city' => $destinationCityID], $totalProductWeightGram, 'jne'),$rajaongkir->getCost(['city' => $originCityID], ['city' => $destinationCityID], $totalProductWeightGram, 'jnt'), $rajaongkir->getCost(['city' => $originCityID], ['city' => $destinationCityID], $totalProductWeightGram, 'tiki'), $rajaongkir->getCost(['city' => $originCityID], ['city' => $destinationCityID], $totalProductWeightGram, 'pos'), $rajaongkir->getCost(['city' => $originCityID], ['city' => $destinationCityID], $totalProductWeightGram, 'sicepat')];
  }

  return $shippingOption;
}

function bestSeller($author) {
  $is_best_seller = array();
  $pickup_at_tcb_store_id = array("18", "143", "37", "179", "716", "813", "1028", "1157", "68", "1717", "2013");

  if(in_array($author, $pickup_at_tcb_store_id)){
    $is_best_seller = true;
  }

  return $is_best_seller;
}

function totalProductWeight($id_store = null){
  $cart =  new Cart();
  $products = _group_by($cart->getItems(),'store_id');
  $points_array = array();

  foreach ($products as $group => $value) {
      foreach ($value as $key) {
          if( !isset( $points_array[$group] )) {
              $points_array[$group] = 0;
          }
          $points_array[$group] += $key->weight * $key->quantity;
      }
  }
  $total_product_weight = $points_array[$id_store];

  return $total_product_weight;
}

function get_email($author_id){
  $getemail = DB::table('users')->find($author_id);
  $email = $getemail->email;
  return $email;
}

function get_package_details_by_vendor_id($vendor_id){
  $package_details = null;
  $get_details = get_store_account_details_by_user_id( $vendor_id );
  
  if(count($get_details) > 0){
    $details  = array_shift($get_details);
    $get_details = json_decode($details['details']);
    
    if(isset($get_details->package) || !empty($get_details->package)){
      $get_selected_package = $get_details->package->package_name;

      if(!empty($get_selected_package)){
        $get_package_details = DB::table('vendor_packages')->where(['id' => $get_selected_package])->first();

        if(!empty($get_package_details) && !is_null($get_package_details)){
          $package_details = json_decode($get_package_details->options);
        }
      }
    }
  }
  
  return $package_details;
}