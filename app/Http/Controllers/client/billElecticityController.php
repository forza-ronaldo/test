<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class billElecticityController extends Controller
{
    public function index()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }
    public function pay($hour_number,$course_number,$id_bank)
    {
        $bill= file_get_contents("http://localhost:777/billingCorporation/public/api/getNewElectricityBill/$hour_number/$course_number");
        $bill=json_decode($bill);
        $bill=$bill->data;
        //dd($bill);
        $amount_due_of_payment=$bill->amount_due_of_payment;
        $result_check=file_get_contents('http://localhost:777/bemoBank/public/api/checkInformation/'.$id_bank.'/value/'.$amount_due_of_payment.'?hour_number='.$hour_number.'&course_number='.$course_number.'&'.'bill_type=electricity');

        $result_check=json_decode($result_check);

        if($result_check[0]==true)
        {

            file_get_contents('http://localhost:777/billingCorporation/public/api/complatePayElectricity/'.$hour_number.'/'.$course_number.'/'.$result_check[1].'/'.auth()->id());
            session()->flash('msg','تم الدفع');
            return redirect(url()->previous());
        }
        else{
            session()->flash('msg','الرصيد غير كافي لاتمام عملية الدفع');
            return redirect(url()->previous());
        }
    }
    public function show($hour_number,$course_number)
    {
        $bill= file_get_contents('http://localhost:777/billingCorporation/public/api/getNewElectricityBill/'. $hour_number.'/'.$course_number);
        $bill=json_decode($bill);
        $bill=$bill->data;
        return view('client.bill.showElectricityBill',compact('bill'));
    }// end show

    public function destroy($id)
    {
        //
    }
}
