<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function index()
    {
        //
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'max:255', 'string'],
            'email' => ['email', 'required', 'max:255', 'string', 'unique:users'],
            'password' => ['required', 'min:6', 'string']
        ]);

        if($validator->fails()){
            return response()->json(['Error' => $validator->errors()], 200);
        }

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        if($user->id){
            return response()->json([
                'acccess_token' => $user->createToken('auth-api')->accessToken
            ], 200);
        }

        return response()->json([
            'Error' => 'Erro ao cadastrar'
        ], 200);
    }

    public function show($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
