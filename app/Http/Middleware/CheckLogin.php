<?php

namespace App\Http\Middleware;

use Closure;

class CheckLogin
{
    /**
     * Run the request filter.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next){
        $member = $request->session()->get('member', '');
        //echo $member;exit;
        if($member == '') {
          return redirect('/login');
        }
        return $next($request);
    }

}
