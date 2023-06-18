<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Validator;
use Hash;
use Session;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function showFormLogin()
    {
        if (Auth::check()) {
            $user = Auth()->user(); // true sekalian session field di users nanti bisa dipanggil via Auth
            if ($user->remember_token != 1) {
                Auth()->logout();
                return redirect()->route('login');
            } else {
                DB::table('users')->where('id', $user->id)->update(['remember_token' => 1]);
                return redirect()->route('dashboard');
            }
        }
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $rules = [
            'email'                 => 'required|email',
            'password'              => 'required|string'
        ];

        $messages = [
            'email.required'        => 'Email wajib diisi',
            'email.email'           => 'Email tidak valid',
            'password.required'     => 'Password wajib diisi',
            'password.string'       => 'Password harus berupa string'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all);
        }

        $data = [
            'email'     => $request->input('email'),
            'password'  => $request->input('password'),
        ];

        $user = User::where([
            'email' => $request->input('email'),
            'password' => $request->input('password')
        ])->first();

        if ($user) { // true sekalian session field di users nanti bisa dipanggil via Auth
            //Login Success
            Auth::login($user);
            if ($user->remember_token == 1) {
                DB::table('users')->where('id', $user->id)->update(['remember_token' => 2]);
                $user = Auth()->user();
            } else {
                DB::table('users')->where('id', $user->id)->update(['remember_token' => 1]);
                return redirect()->route('dashboard');
            }
        } else { // false
            //Login Fail
            Session::flash('error', 'Email atau password salah');
            return redirect()->route('login');
        }
    }

    public function logout()
    {
        $user = Auth()->user();
        DB::table('users')->where('id', $user->id)->update(['remember_token' => "0"]);
        Auth()->logout(); // menghapus session yang aktif
        return redirect()->route('login');
    }
}
