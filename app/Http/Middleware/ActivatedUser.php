<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Models\Settings;

class ActivatedUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = Auth::user();
        $setting = Settings::all()->first();
        $transactions = count($user->salesPharmacy);
        $max_transaction_number = $setting->max_transaction_number;
        
        if($transactions >= $max_transaction_number){
            abort(403,'لقد تخطيت عدد الطلبات المجانية');
        }
        
        if ($user->activated == 1) {
            return $next($request);
        } 
        
        abort(403,' من فضلك تأكد من تفعيل حسابك  ');

    }
}
