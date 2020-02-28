<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Notifications\resetPassword;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class clientController extends Controller
{

    public function edit(User $Client)
    {
        return view('client.edit', compact('Client'));
    }
    public function update(Request $request, User $Client)
    {
        $request->validate([
            'current_password' => ['required', 'string', 'min:8'],
            'user_name' => ['string', 'min:6', 'max:30', 'unique:users,user_name,' . $Client->id],
            'password' => ['string', 'min:8', 'confirmed'],
        ]);
        if (Hash::check($request->current_password,  Auth::user()->password)) {
            $request_data = $request->only(['user_name']);
            $request_data['password'] = Hash::make($request->password);
            $Client->update($request_data);
            session()->flash('msg', 'تم التعديل بنجاح');
            return redirect(route('home'));
        }
        return view('client.edit', compact('Client'))->with('msg_result_check_pass', 'كلمة السر القديمة غير صحيحة');
    }

    public function verify($tokeen)
    {
        User::where('token',$tokeen)->firstOrFail()->update(['token'=>null]);
        session()->flash('success','The Verified Is Completed Success');
        return redirect()->route('home');
    }
    public  function showResetPasswordForm()
    {
        return view('client.password.resetPassword');
    }
    public  function searshYourAccount(Request $request)
    {
        $token_reset=Str::random(25);
        $user=User::where('email',$request->email)->first();
        if($user!=null)
        {
            $user->update(['token_reset_password'=>$token_reset]);
            $user->notify(new resetPassword($user));
            return redirect()->back()->with('sendEmailToResetPassword','the email send');
        }
        return redirect()->back()->with('sendEmailToResetPassword','the email is not found');


    }
    public  function  showsetNewPassword($token_reset_password)
    {
        $user=User::where('token_reset_password',$token_reset_password)->first();
        if($user!=null)
        return view('client.password.showsetNewPassword',compact('user'));
        return view('error.404');
    }
    public  function  setNewPassword(Request $request,$id)
    {
        $user=User::find($id)->update([
            'password'=>Hash::make($request->password),
            'token_reset_password'=>null],
        );
        return redirect()->route('login');
    }
}
