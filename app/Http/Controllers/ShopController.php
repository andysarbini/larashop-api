<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Province;
use App\Http\Resources\Provinces as ProvinceResourceCollection;
use App\City;
use App\Http\Resources\Cities as CityResourceCollection;

class ShopController extends Controller
{
    //
    public function provinces()
    {
        return new ProvinceResourceCollection(Province::get());
    }

    public function cities()
    {
        return new CityResourceCollection(City::get());
    }

    public function shipping(Request $request)
    {
        $user = Auth::user(); // mendapatkan current user yang login
        $status = "error";
        $message = "";
        $data = null;
        $code = 200;
        if ($user) {
            $this->validate($request, [
                'nama' => 'required',
                'address' => 'required',
                'phone' => 'required',
                'province_id' => 'required',
                'city_id' => 'required',
            ]);
            $user->name = $request->name;
            $user->address = $request->address;
            $user->phone = $request->phone;
            $user->province_id = $request->province_id;
            $user->city_id = $request->city_id;
            if($user->save()) {
                $status = "success";
                $message = "Update shipping success";
                $data = $user->toArray();
            }
            else {
                $message = "Update shipping failed";
            }
        }
    else {
        $message = "User not found";
    }

    return response()->json([
        'status' => $status,
        'message' => $message,
        'data' => $data
     ], $code);
    }
}
