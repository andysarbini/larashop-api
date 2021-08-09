<?php

namespace App\Http\Controllers;

use Hash;
use App\User;
use Illuminate\Http\Request;

// use App\Http\Controllers\Controller;
use Illmuminate\Validation\Rule;

class AuthController extends Controller
{
    //
    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required',
        ]);
        // $data = $request->validate([
        //     'email' => 'required',
        //     'password' => 'required',
        // ]);

        $user = User::where('email', '=', $request->email)->first();
        $status = "error";
        $message = "";
        $data = null;
        $code = 401;

        if($user) {
            // jika hasil hash dari password yang diinput user sama dengan password di database user maka
            if (Hash::check($request->password, $user->password)) {
                // generate token
                $user->generateToken();
                $status = 'success';
                $message = 'Login sukses';
                // tampilkan data user menggunakan method toArray
                $data = $user->toArray();
                $code = 200;
            }
            else {
                $message = "Login gagal, password salah";
            }
        }
        else {
            $message = "Login gagal, username salah";
        }

        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $data
        ], $code);
        // return response()->json();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function register(Request $_request)
    {

    }

    public function logout(Request $request)
    {

    }

    public function view($id)
    {
        $book = new BookResource(Book::find($id));
        return $book;
    }
}
