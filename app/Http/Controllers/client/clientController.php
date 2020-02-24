<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class clientController extends Controller
{

    public function edit(User $Client)
    {
        return view('client.edit',compact('Client'));
    }
    public function update(Request $request, User $Client)
    {
        $request->validate([
            'user_name' => ['required', 'string', 'min:6', 'max:30', 'unique:users,user_name,'.$Client->id],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'password_confirmation' => ['required', 'string', 'min:8'],
        ]);

        $request_data=$request->only(['user_name']);
        $request_data['password']=Hash::make($request->password);
        $Client->update($request_data);
        session()->flash('msg','تم التعديل بنجاح');
        return redirect(route('home'));
    }

}
