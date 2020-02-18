<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\dashbord\userRequestCreate;
use App\Http\Requests\dashbord\userRequestUpdate;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use RealRashid\SweetAlert\Facades\Alert;

class userController extends Controller
{
    public  function __construct()
    {
        $this->middleware('permission:create_users')->only('create');
        $this->middleware('permission:read_users')->only('index');
        $this->middleware('permission:update_users')->only('edit');
        $this->middleware('permission:delete_users')->only('destroy');
    }
    public function index(Request $request)
    {
        $users = User::when($request->searsh, function ($query) use ($request) {
            return $query->where('name', 'like', '%' . $request->searsh . '%');
        })->whereIn('group_id', [0])->whereRoleIs('admin')
            ->paginate(3);

        return view('dashboard.admin.users.index', compact('users'));
    } //end of index


    public function create()
    {
        return view('dashboard.admin.users.create');
    }

    public function store(userRequestCreate $request)
    {
        $url = 'http://localhost:777/bemoBank/public/api/checkRegister/' . $request->bank_id . '/idNumber/' . $request->id_number;
        $found = file_get_contents($url);
        if ($found == 'true') {
            $request_data = $request->except(['password', 'password_confirmation', 'permissions']);
            $request_data['password'] = bcrypt($request->password);
            $request_data['group_id'] = '0';
            $user = User::create($request_data);
            $user->attachRole('admin');
            $user->syncPermissions($request->permissions);
            session()->flash('success', __('site.msg_add'));
            return redirect(route('dashboard.user.index'));
        } else {
            session()->flash('success', 'الرقم الوطني ورقم الحساب غير متطابقين');
            return redirect(route('dashboard.user.create'));
        }
    }

    public function show()
    {
    }


    public function edit(User $user)
    {
        return  view('dashboard.admin.users.edit')->with('user', $user);
    }


    public function update(userRequestUpdate $request, User $user)
    {
        $request_data = $request->except('permissions');
        $user->update($request_data);
        if ($request->permissions) {
            $user->syncPermissions($request->permissions);
        }
        session()->flash('success', __('site.msg_edit'));
        return redirect(route('dashboard.user.index'));
    }


    public function destroy(User $user)
    {
        $user->delete();
        session()->flash('success', __('site.msg_delete'));
        return redirect(route('dashboard.admin.user.index'));
    }
}
