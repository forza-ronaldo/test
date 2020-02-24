<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class billTelecomeController extends Controller
{
    public function pay($phone_number,$course_number,$id_bank,Request $request)
    {

        $bill= file_get_contents("http://localhost:777/billingCorporation/public/api/getNewTelecomeBill/$phone_number/$course_number");
        $bill=json_decode($bill);
        $bill=$bill->data;
        //dd($bill);
        $amount_due_of_payment=$bill->amount_due_of_payment;
        $result_check=file_get_contents('http://localhost:777/bemoBank/public/api/checkInformation/'.$id_bank.'/value/'.$amount_due_of_payment.'?number='.$phone_number.'&course_number='.$course_number.'&'.'bill_type=telecome');

        $result_check=json_decode($result_check);

        if($result_check[0]==true)
        {
            file_get_contents('http://localhost:777/billingCorporation/public/api/complatePayTelecome/'.$phone_number.'/'.$course_number.'/'.$result_check[1].'/'.auth()->id());
            session()->flash('msg','تم الدفع');
            $details = [
                'body' => "تم دفع الفاتورة بنجاح ",
            ];
            \Mail::to(Auth::user()->email)->send(new \App\Mail\send_msg_pay_successfully($details));
            return \redirect('http://127.0.0.1:8000/en/myBills/new/telecome?phone_number='.$phone_number);
        }
        else{
             session()->flash('msg','الرصيد غير كافي لاتمام عملية الدفع');
             return \redirect('http://127.0.0.1:8000/en/myBills/new/telecome?phone_number='.$phone_number);
        }
    }//end pay
    public  function payAll(Request $request)
    {
        $phones=$request->number;
        $courses=$request->course_number;
        $bank_id=Auth::user()->bank_id;
        $arr=[];
        for($i=0;$i<count($phones);$i++)
        {
            $this->pay($phones[$i],$courses[$i],$bank_id,$request);
            $arr[$i]=' الدورة رقم '.$courses[$i]." ".session()->get('msg');
        }
        session()->flash('all_msg_results_pay',$arr);
        return redirect(url()->previous());
    }//end payAll
    public function show($phone_number,$course_number)
    {
       $bill= file_get_contents('http://localhost:777/billingCorporation/public/api/getNewTelecomeBill/'. $phone_number.'/'.$course_number);
       $bill=json_decode($bill);
       $bill=$bill->data;
       return view('client.bill.showTelecomeBill',compact('bill'));
    }//end show
    public function showArchived($phone_number,$course_number)
    {
       $bill= file_get_contents('http://localhost:777/billingCorporation/public/api/getArchivedTelecomeBill/'. $phone_number.'/'.$course_number);
       $bill=json_decode($bill);
       $bill=$bill->data;
       $receipt=file_get_contents('http://localhost:777/bemoBank/public/api/getReceipt/'.$bill->receipt_id);
       $receipt=json_decode($receipt);
       $receipt=$receipt->data;
       return view('client.bill.showTelecomeBill',compact('bill','receipt'));
    }//end showArchived
    public  function archived(Request $request)
    {
        $request->validate([
            'phone_number'=>'required|numeric'
        ]);
        $telecome_statistic=file_get_contents('http://localhost:777/billingCorporation/public/api/telecome/RestoreConsumptionRates?phone_number='.$request->phone_number);
        $telecome_statistic=json_decode($telecome_statistic);
        $statistic=$telecome_statistic->data;
        $code=$telecome_statistic->code;
        $phone_number=$request->phone_number;
        $data=file_get_contents('http://localhost:777/billingCorporation/public/api/archivedTelecomeBill?searsh='.$phone_number);
        $data=json_decode($data);
        $bills=$data->data;

        return view('client.bill.yourBillsArchived',compact('bills','statistic','code'));

    }//end archived

}
