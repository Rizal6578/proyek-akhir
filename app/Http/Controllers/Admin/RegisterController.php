<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\RoleModel;
use App\Models\Admin\UserModel;
use App\Models\Admin\WebModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class RegisterController extends Controller
{
    public function index()
    {
        $data["title"] = "Register";
        $data["web"] = WebModel::first();
        $data["role"] = RoleModel::latest()->get();
        return view('Admin.Register.index', $data);
    }

    public function prosesregister(Request $request)
    {
        //create user
        UserModel::create([
            'user_foto' => 'undraw_profile.svg',
            'user_nmlengkap' => $request->nmlengkap,
            'user_nama'   => $request->user,
            'user_email' => $request->email,
            'role_id' => $request->role,
            'user_password' => md5($request->pwd)
        ]);

        Session::flash('status', 'success');
        Session::flash('msg', 'Registrasi Berhasil, silahkan login.');

        //redirect to index
        return redirect('admin/login');
    }
}
