<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function register(Request $request){
        try {
            $userData=$request->all();
            $userData=$request['password']=Hash::make($request['password']);

            $user=User::create($userData);

            return response()->json(
                ['msg'=>'Usuáruio criado com sucesso'],
            200);
        } catch (\Throwable $th) {
            return response()->json(
                ['error'=>$th->getMessage()],
            401);
        }
    }
}
