<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class billWaterController extends Controller
{
    public function index()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }
    public function pay($counter_number,$course_number,$id_bank)
    {
        $bill= file_get_contents("http://localhost:777/billingCorporation/public/api/getNewWaterBill/$counter_number/$course_number");
        $bill=json_decode($bill);
        $bill=$bill->data;
        //dd($bill);
        $amount_due_of_payment=$bill->amount_due_of_payment;
        $result_check=file_get_contents('http://localhost:777/bemoBank/public/api/checkInformation/'.$id_bank.'/value/'.$amount_due_of_payment.'?counter_number='.$counter_number.'&course_number='.$course_number.'&'.'bill_type=water');

        $result_check=json_decode($result_check);

        if($result_check[0]==true)
        {
            file_get_contents('http://localhost:777/billingCorporation/public/api/complatePayWater/'.$counter_number.'/'.$course_number.'/'.$result_check[1].'/'.auth()->id());
            session()->flash('msg','تم الدفع');
            return redirect(url()->previous());
        }
        else{
            session()->flash('msg','الرصيد غير كافي لاتمام عملية الدفع');
            return redirect(url()->previous());
        }
    }
    public function show($counter_number,$course_number)
    {
        $bill= file_get_contents('http://localhost:777/billingCorporation/public/api/getNewWaterBill/'. $counter_number.'/'.$course_number);
        $bill=json_decode($bill);
        $bill=$bill->data;
        return view('client.bill.showWaterBill',compact('bill'));
    }//end show
    public function destroy($id)
    {
        //
    }
}
