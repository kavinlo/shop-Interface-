<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\Member;
use Validator;
use \Firebase\JWT\JWT;
use Illuminate\Support\Facades\Hash;

class MemberController extends Controller
{
    // 注册用户
    public function insert(Request $req)
    {

        // 表单验证
        $validator = Validator::make($req->all(), [

            'uName' => 'required | min:3 | max: 15 | unique:members',
            'uPassword' => 'required | min:6 | max:15 | confirmed',

        ]);

        if ( $validator->fails() ) {
            // 获取错误信息
            $errors = $validator->errors();

            // 返回JSON 对象 422 状态码
            return errors($errors, 422);
        }

        // hash 加密
        $memberInfo = [
            'uPassword' => bcrypt($req->uPassword),
            'uName' => $req->uName
        ];

        $data = Member::create($memberInfo);
        return success($data);
    }

    // 用户登录
    public function login(Request $req)
    {

        // 表单验证
        $validator = Validator::make($req->all(), [
            'uName' => 'required | min:3 | max:15',
            'uPassword' => 'required | min:6 | max:15'
        ]);

        // 验证不通过
        if ($validator->fails()) {
            // 获取错误信息
            $errors = $validator->errors();

            // 返回JSON 对象 422 状态码
            return errors($errors, 422);
        }

        $member = Member::select('id', 'uPassword')->where('uName', $req->uName)->first();
        if ($member) {
            // 判断密码
            if (Hash::check($req->uPassword , $member->uPassword)) {

                // 把用户的信息保存到JWT 中 发给前端
                $now = time();

                // 读取秘钥
                $key = env('JWT_KEY');

                // 过期时间
                $expire = $now + env('JWT_EXPIRE');

                // 定义令牌中的数据
                $data = [
                    'iat' => $now, // 当前时间
                    'exp' => $expire, //过期时间
                    'id' => $member->id //用户ID
                ];

                // 生成 令牌
                $jwt = JWT::encode($data, $key);

                // 发送数据
                return success($jwt);

            } else {
                return errors('密码不正确！', 400);
            }

        } else {
            return errors('账户不存在！', 400);
        }

    }

    public function order(Request $req)
    {
        return $req->jwt->id;;
    }
}
