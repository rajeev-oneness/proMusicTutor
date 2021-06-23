<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe,Session,App\Model\StripeTransaction;
use Razorpay\Api\Api,Exception;

class PaymentController extends Controller
{

/************************* RazorPay Payement Work ****************************/

    public function razorPayPaymentView(Request $req)
    {
        return view('payment.razorpay.index');
    }

    public function storerazorePayPayment(Request $req)
    {
        $req->validate([
            'razorpay_payment_id' => 'required|string',
            'redirectURL' => 'required',
        ]);
        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
        $payment = $api->payment->fetch($req->razorpay_payment_id);
        if($payment){
            try{
                $response = $api->payment->fetch($req->razorpay_payment_id)->capture(array('amount'=>$payment['amount']));
                if($response){
                    dd($response);
                }else{
                    dd('Something went wrong please try after some time');
                }
            }catch(Exception $e){
                dd($e);
            }
        }
    }


/************************* Stripe Payement Work ****************************/
    public function stripeView(Request $req)
    {
        $data = [
            'redirectUrl' => '', //redirect URL will be here
            'price' => 100, // price wil be here
        ];
        return view('payment.stripe.index',compact('data'));
    }

    public function stripePostForm_Submit(Request $req)
    {
        $req->validate([
            '_token' => 'required',
            'stripeToken' => 'required',
            'amount' => 'required',
            'redirectURL' => 'required',
        ]);
        // dd($req->all());
        \Stripe\Stripe::setApiKey('sk_test_4eC39HqLyjWDarjtT1zdp7dc');
        $payment = \Stripe\Charge::create ([
            "amount" => 100 * $req->amount,
            "currency" => "usd",
            "source" => $req->stripeToken,
            "description" => "Test payment from http://switcher.com",
        ]);
        if($payment->status == 'succeeded'){
            $stripe = new StripeTransaction;
            $stripe->transactionId = $payment->id;
            $stripe->balance_transaction = $payment->balance_transaction;
            $stripe->amount = $payment->amount;
            $stripe->description = $payment->description;
            $stripe->payment_method = $payment->payment_method;
            $stripe->card_type = $payment->payment_method_details->type;
            $stripe->exp_month = $payment->payment_method_details->card->exp_month;
            $stripe->exp_year = $payment->payment_method_details->card->exp_year;
            $stripe->last4 = $payment->payment_method_details->card->last4;
            $stripe->save();
            return redirect($req->redirectURL.'?stripeTransactionId='.$stripe->id);
        }
        return back();
    }

    public function thankyouPayment(Request $req,$transactionId)
    {
        $stripe = StripeTransaction::findOrfail($transactionId);
        return view('payment.stripe.thankyou',compact('stripe'));
    }
}
