<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class billElecticityController extends Controller
{
    public function pay($hour_number, $course_number, $id_bank)
    {

        $bill = file_get_contents("http://localhost:777/billingCorporation/public/api/getNewElectricityBill/$hour_number/$course_number");
        $bill = json_decode($bill);
        $bill = $bill->data;

        $amount_due_of_payment = $bill->amount_due_of_payment;
        $result_check = file_get_contents('http://localhost:777/bemoBank/public/api/checkInformation/' . $id_bank . '/value/' . $amount_due_of_payment . '?number=' . $hour_number . '&course_number=' . $course_number . '&' . 'bill_type=electricity');

        $result_check = json_decode($result_check);

        if ($result_check[0] == true) {
            file_get_contents('http://localhost:777/billingCorporation/public/api/complatePayElectricity/' . $hour_number . '/' . $course_number . '/' . $result_check[1] . '/' . auth()->id());
            session()->flash('msg', 'تم الدفع');
            $details = [
                'body' => "تم دفع الفاتورة بنجاح ",
            ];
            \Mail::to(Auth::user()->email)->send(new \App\Mail\send_msg_pay_successfully($details));
            return \redirect('http://127.0.0.1:8000/en/myBills/new/electricity?hour_number=' . $hour_number);
        } else {
            session()->flash('msg', 'الرصيد غير كافي لاتمام عملية الدفع');
            return \redirect('http://127.0.0.1:8000/en/myBills/new/electricity?hour_number=' . $hour_number);
        }
    } //end pay
    public  function payAll(Request $request)
    {
        $hours = $request->number;
        $courses = $request->course_number;
        $bank_id = Auth::user()->bank_id;
        $arr = [];
        for ($i = 0; $i < count($hours); $i++) {
            $this->pay($hours[$i], $courses[$i], $bank_id);
            $arr[$i] = ' الدورة رقم ' . $courses[$i] . " " . session()->get('msg');
        }
        session()->flash('all_msg_results_pay', $arr);
        return redirect(url()->previous());
    } //end payAll
    public function show($hour_number, $course_number)
    {
        $bill = file_get_contents('http://localhost:777/billingCorporation/public/api/getNewElectricityBill/' . $hour_number . '/' . $course_number);
        $bill = json_decode($bill);
        $bill = $bill->data;
        return view('client.bill.showElectricityBill', compact('bill'));
    } // end show
    public function showArchived($hour_number, $course_number)
    {
        $bill = file_get_contents('http://localhost:777/billingCorporation/public/api/getArchivedElectricityBill/' . $hour_number . '/' . $course_number);
        $bill = json_decode($bill);
        $bill = $bill->data;
        $receipt = file_get_contents('http://localhost:777/bemoBank/public/api/getReceipt/' . $bill->receipt_id);
        $receipt = json_decode($receipt);
        $receipt = $receipt->data;
        return view('client.bill.showElectricityBill', compact('bill', 'receipt'));
    } // end showArchived
    public  function archived(Request $request)
    {
        $request->validate([
            'hour_number' => 'required|numeric'
        ]);
        $electricity_statistic = file_get_contents('http://localhost:777/billingCorporation/public/api/electricity/RestoreConsumptionRates?hour_number=' . $request->hour_number);
        $electricity_statistic = json_decode($electricity_statistic);
        $statistic = $electricity_statistic->data;
        $code = $electricity_statistic->code;
        $hour_number = $request->hour_number;
        $data = file_get_contents('http://localhost:777/billingCorporation/public/api/archivedElectricityBill?searsh=' . $hour_number);
        $data = json_decode($data);
        $bills = $data->data;
        if ($bills == "هذا الرقم غير موجود") {
            return view('error.4042');
        }
        return view('client.bill.yourBillsArchived  ', compact('bills', 'statistic', 'code'));
    } //end archived

}
