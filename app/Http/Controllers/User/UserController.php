<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function userData()
    {
        return auth()->user();
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if($validator->fails()){
            return $validator->errors();
        }

        $user = User::where('email', $request->email)->first();

        if (is_null($user) || !Hash::check($request->password, $user->password)) {
            return response()->json(['status' => -1, 'message' => 'Usuário ou senha incorretos!', 401]);
        }

        $user->tokens()->delete();
        $token = $user->createToken('user-token')->plainTextToken;

        return ['token' => $token];
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            //chave e regra
            'name' => 'required|unique:users',
            'email' => 'required|unique:users|email',
            'password' => 'required|min:6'
        ]);

        if($validator->fails()){
            return $validator->errors();
        }

        //eloquent - laravel mexendo no banco de dados
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return ['user' => $user];
    }
    public function show(User $user)
    {
        //
    }
    public function edit(User $user)
    {
        //
    }
    public function update(Request $request, User $user)
    {
        //
    }
    public function destroy(User $user)
    {
        //
    }
}
