<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Laravel\Cashier\PaymentMethod;
class PaymentController extends Controller
{
    public function create()
    {
        $plans = [
            'monthly' => 'plan_H10LZtUIgSGpAi',
            'yearly' => 'plan_H10Mt1NsxB53l3'
        ];
         $data['plans'] = $plans;
        $data['intent'] = Auth::user()->createSetupIntent();
         return view('payment.payment', $data);
    }
    public function subscription(Request $request)
    {
       // dd('hi');
        $paymentMethod = $request->payment_method;
        $planId = $request->plan;
        Auth::user()->newSubscription('main', $planId)->create($paymentMethod);
        return response([
            'success_url'=> redirect()->intended('/')->getTargetUrl(),
            'message'=>'success'
        ]);
    }
}
