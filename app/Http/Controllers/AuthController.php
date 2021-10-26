<?php

namespace App\Http\Controllers;

use App\Mail\activeationMail;
use App\Models\User;
use App\Traits\SendResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class AuthController extends Controller
{
    use SendResponse;
    public function register(Request $request)
    {
        $request = $request->json()->all();
        $validator = Validator::make($request, [
            'full_name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);
        if ($validator->fails()) {
            return $this->send_response(401, 'error validation', $validator->errors(), []);
        }
        $request['code'] = substr(str_shuffle("0123456789ABCD"), 0, 6);
        $request['password'] = bcrypt($request['password']);
        $user = User::create($request);
        $notify = [
            'title' => 'رمز تفعيل حسابك في منصة هويتي',
            'body' => $user->code
        ];
        \Mail::to($user->email)->send(new activeationMail($notify));
        $token = $user->createToken($user->email)->accessToken;

        return $this->send_response(200, 'تم انشاء حساب بنجاح', [], User::find($user->id), $token);
    }

    public function login(Request $request)
    {
        $request = $request->json()->all();
        $validator = Validator::make($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            return $this->send_response(401, 'error validation', $validator->errors(), []);
        }
        if (Auth::attempt(['email' => $request['email'], 'password' => $request['password']])) {
            $user = Auth::user();
            $token = $user->createToken($request['email'])->accessToken;
            return $this->send_response(200, 'تسجيل دخول  بنجاح', [], $user, $token);
        } else {
            return $this->send_response(401, 'Unauthorized', null, null, null);
        }
    }
    public function activation(Request $request)
    {
        $request = $request->json()->all();
        $validator = Validator::make($request, [
            'code' => 'required',
        ]);
        if ($validator->fails()) {
            return $this->send_response(401, 'error validation', $validator->errors(), []);
        }
        $user = User::find(auth()->user()->id);
        if ($user->code === $request['code']) {
            $user->update([
                'code' => null,
                'active' => true
            ]);
            return $this->send_response(200, 'تم تفعيل الحساب', [], $user);
        } else {
            return $this->send_response(401, 'يرجى ادخال رمز تفعيل صحيح ', []);
        }
    }
}