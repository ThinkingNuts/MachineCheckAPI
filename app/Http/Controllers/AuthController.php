<?php

namespace App\Http\Controllers;

use Auth;
use JWTAuth;
use App\User;
use Validator;
use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct()
    {
        // 执行 jwt.auth 认证
        $this->middleware('jwt.auth', [
            'only' => ['logout']
        ]);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'job_number' => 'required',
            'password' => 'required|between:6,16',
        ]);

        if ($validator->fails()) {
            return $this->responseError('表单验证失败', $validator->errors()->toArray());
        }

        $credentials = array_merge([
            'job_number' => $request->get('job_number'),
            'password' => $request->get('password'),
        ]);

        try {
            // attempt to verify the credentials and create a token for the user
            if (! $token = JWTAuth::attempt($credentials)) {
                $user = User::where('job_number', $request->get('login'))->first();

                if (is_null($user)) {
                    return $this->responseError('用户名或密码错误');
                }
            }
            $user = Auth::user();
            // 设置JWT令牌
            $user->jwt_token = [
                'access_token' => $token,
                'expires_in' => Carbon::now()->addMinutes(config('jwt.ttl'))->timestamp
            ];
            return $this->responseSuccess('登录成功', $user->toArray());
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return $this->responseError('无法创建令牌');
        }
    }

    public function logout()
    {
        try {
            JWTAuth::parseToken()->invalidate();
        } catch (TokenBlacklistedException $e) {
            return $this->responseError('令牌已被列入黑名单');
        } catch (JWTException $e) {
            // 忽略该异常（Authorization为空时会发生）
        }
        return $this->responseSuccess('登出成功');
    }
}
