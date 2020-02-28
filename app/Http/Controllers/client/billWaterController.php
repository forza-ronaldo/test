<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class billWaterController extends Controller
{
    public function pay($counter_number, $course_number, $id_bank, $send_email = true)
    {
        $bill = file_get_contents("http://localhost:777/billingCorporation/public/api/getNewWaterBill/$counter_number/$course_number");
        $bill = json_decode($bill);
        $bill = $bill->data;
        //dd($bill);
        $amount_due_of_payment = $bill->amount_due_of_payment;
        $result_check = file_get_contents('http://localhost:777/bemoBank/public/api/checkInformation/' . $id_bank . '/value/' . $amount_due_of_payment . '?number=' . $counter_number . '&course_number=' . $course_number . '&' . 'bill_type=water');

        $result_check = json_decode($result_check);

        if ($result_check[0] == true) {
            file_get_contents('http://localhost:777/billingCorporation/public/api/complatePayWater/' . $counter_number . '/' . $course_number . '/' . $result_check[1] . '/' . auth()->id());
            session()->flash('msg', 'تم الدفع');
            $details = [
                'body' => "تم دفع الفاتورة بنجاح ",
            ];
            if ($send_email) {
                \Mail::to(Auth::user()->email)->send(new \App\Mail\send_msg_pay_successfully($details));
                return \redirect('http://127.0.0.1:8000/en/myBills/new/water?counter_number=' . $counter_number);
            }
        } else {
            session()->flash('msg', 'الرصيد غير كافي لاتمام عملية الدفع');
            return \redirect('http://127.0.0.1:8000/en/myBills/new/water?counter_number=' . $counter_number);
        }
    } //end pay
    public  function payAll(Request $request)
    {
        $counters = $request->number;
        $courses = $request->course_number;
        $bank_id = Auth::user()->bank_id;
        $arr = [];
        for ($i = 0; $i < count($counters); $i++) {
            $this->pay($counters[$i], $courses[$i], $bank_id, false);
            $arr[$i] = ' الدورة رقم ' . $courses[$i] . " " . session()->get('msg');
        }
        $details = [
            'body' => "تم دفع الفاتورة بنجاح ",
        ];
        \Mail::to(Auth::user()->email)->send(new \App\Mail\send_msg_pay_successfully($details));
        session()->flash('all_msg_results_pay', $arr);
        return redirect(url()->previous());
    } //end payAll
    public function show($counter_number, $course_number)
    {
        $bill = file_get_contents('http://localhost:777/billingCorporation/public/api/getNewWaterBill/' . $counter_number . '/' . $course_number);
        $bill = json_decode($bill);
        $bill = $bill->data;
        dd($bill);
        return view('client.bill.showWaterBill', compact('bill'));
    } //end show
    public function showArchived($counter_number, $course_number)
    {
        $bill = file_get_contents('http://localhost:777/billingCorporation/public/api/getArchivedWaterBill/' . $counter_number . '/' . $course_number);
        $bill = json_decode($bill);
        $bill = $bill->data;
        $receipt = file_get_contents('http://localhost:777/bemoBank/public/api/getReceipt/' . $bill->receipt_id);
        $receipt = json_decode($receipt);
        $receipt = $receipt->data;
        return view('client.bill.showWaterBill', compact('bill', 'receipt'));
    } //end showArchived
    public  function archived(Request $request)
    {
        $request->validate([
            'counter_number' => 'required|numeric'
        ]);
        $water_statistic = file_get_contents('http://localhost:777/billingCorporation/public/api/water/RestoreConsumptionRates?counter_number=' . $request->counter_number);
        $water_statistic = json_decode($water_statistic);
        $statistic = $water_statistic->data;
        $code = $water_statistic->code;
        $counter_number = $request->counter_number;
        $data = file_get_contents('http://localhost:777/billingCorporation/public/api/archivedWaterBill?searsh=' . $counter_number);
        $data = json_decode($data);
        $bills = $data->data;
        if ($bills == "هذا الرقم غير موجود") {
            return view('error.4042');
        }
        return view('client.bill.yourBillsArchived', compact('bills', 'statistic', 'code'));
    } //end archived

}
