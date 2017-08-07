<?php

namespace App\Http\Controllers\Service;

use App\Tool\Validate\ValidateCode;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\ORM\ValidateEmail;
use App\ORM\Member;
use App\Tool\SMS\SendTemplateSMS;
use App\Models\M3Result;

class ValidateController extends Controller
{
  public function create(Request $request){
    $validateCode = new ValidateCode;
    $request->session()->put('validate_code', $validateCode->getCode());
    return $validateCode->doimg();
  }
  
  public function validateEmail(Request $request) {
        $member_id = $request->input('member_id', '');
        $code = $request->input('code', '');
        if ($member_id == '' || $code == '') {
            return '验证异常';
        }

        $tempEmail = ValidateEmail::where('member_id', $member_id)->first();
        if ($tempEmail == null) {
            return '验证异常';
        }

        if ($tempEmail->code == $code) {
            if (time() > strtotime($tempEmail->deadline)) {
                return "已超过限定时间，请重新验证邮箱。";
            }

            $member = Member::find($member_id);
            $member->status = 1;
            $member->save();

//            return redirect('/login');
            return "已成功验证邮箱，<a href='../login'>点击此处去登录</a>";
        } else {
            return '该链接已失效';
        }
    }
}
