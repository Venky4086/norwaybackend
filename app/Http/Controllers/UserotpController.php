<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use sendotp\sendotp;
use App\Models\User;
use DB;
class UserotpController extends Controller
{
    function sendotp(Request $req){
        // $otp = new sendotp('AUTK-KEY','Message Template : My otp is {{otp}}. Please do not share Me.');
        $chars = "0123456789";
        $otpval = "";
        for ($i = 0; $i < 4; $i++){
          $otpval .= $chars[mt_rand(0, strlen($chars)-1)];
        }
        $mobileno = $req->phone;
        $user = DB::table('users')->where('phone', $mobileno)->first();
        // $user = User::where('phone', $mobileno);
        if($user){
            $chars = "0123456789";
            $otpval = "";
            for ($i = 0; $i < 4; $i++){
              $otpval .= $chars[mt_rand(0, strlen($chars)-1)];
            }
            $mobileno = $req->phone;
            $user = DB::table('users')->where('phone', $mobileno)->update(['otp'=>$otpval]);
            $message = array('message'=>'Succesfully send to the otp');
            return  $message;
        }
        else{
            $user = new User;
            $user->phone = $mobileno;
            $user->otp = $otpval;
            $user->status = 0;
            $result = $user->save();
            $message = array('message'=>'Succesfully send to the otp');
            return $message;
             if($result){
                $result = $otp->send($mobileno, 'hi hru');
                $message = array('message'=>'Succesfully send to the otp');
                return $message;
             }
             else{
                $message = array('message'=>'Somthing wants wrong');
                return  $message;
             }
        }
        // $getAuthKey = "301307Avh9j3eGT55db92087";
    }
    function verificationotp(Request $req){
            $mobileno = $req->phone;
            $otp = $req->otp;
            $user = DB::table('users')->where('phone', $mobileno)->first();
            // $status = $user->status;
            if($user->otp == $otp){
                $message = array('message'=>'Otp verification successfully done', 'data'=>$user);
                return $message;
            }
            else{
                $message = array('message'=>'Inccorect otp number', 'status'=>"5");
                return $message;
            }
    }
    function singup(Request $req){
            $mobileno = $req->phone;
            $result = DB::table('users')->where('phone', $mobileno)->update([
                'name'=>$req->name,
                'email'=>$req->email,
                'address'=>$req->address,
                'status'=> 1,
            ]);
            if($result){
                $userdata = DB::table('users')->where('phone', $mobileno)->first();
                $message = array('message'=>'Succesfully singup done', 'data'=>$userdata);
                return $message;
            }
            else{
                $message = array('message'=>'Somthing wants wrong');
                return $message;
            }
    }

    function profileedit(Request $req, $id){
        // $mobileno = $req->phone;
        return $id;
        $result = DB::table('users')->where('id', $id)->update([
            'name'=>$req->name,
            'email'=>$req->email,
            'address'=>$req->address,
        ]);
        // return $result;
        if($result){
            $message = array('messasge'=>"Profile succesfully updated");
            return $message;
        }
        else{
            $message = array('messsage'=>"somthing wents wrong");
            return $message;
        }
    }
}
