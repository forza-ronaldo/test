<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\question;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class welcomeController extends Controller
{
    public  function __construct()
    {
        $this->middleware('role:admin|super_admin')->only('admin');
    }
    public function admin(Request $request)
    {


        $count_telecome = file_get_contents('http://localhost:777/billingCorporation/public/api/archivedTelecomeBill/count?searsh=' . $request->searsh);
        $count_telecome = json_decode($count_telecome, true);
        $count_telecome = $count_telecome['count'];

        $count_water = file_get_contents('http://localhost:777/billingCorporation/public/api/archivedWaterBill/count?searsh=' . $request->searsh);
        $count_water = json_decode($count_water, true);
        $count_water = $count_water['count'];

        $count_electricty = file_get_contents('http://localhost:777/billingCorporation/public/api/archivedElectricityBill/count?searsh=' . $request->searsh);
        $count_electricty = json_decode($count_electricty, true);
        $count_electricty = $count_electricty['count'];

        $count_total = $count_electricty + $count_water + $count_telecome;

        $count_user = $this->_filter($request);

        $count_question_wait = question::where('status_view', 0)->count();

        if (is_null($count_telecome)) {
            return view('error.404');
        }
        return view('dashboard.admin.admin', compact('count_telecome', 'count_water', 'count_electricty', 'count_total', 'count_user', 'count_question_wait'));
    }

    public function question()
    {
        return view('dashboard.question');
    } // end question

    private function _filter(Request $request)
    {
        $searsh = $request->searsh;
        $arr = ['yesterday', 'current_year', 'last_year', '0', '30', '7','all'];
        if (in_array($searsh, $arr)) {
            if ($searsh == 'yesterday') {
                $count = DB::select(
                    'select count(*) as count from users
                    where
                    created_at =
                    DATE_SUB(CURRENT_DATE,INTERVAL 1 day)'
                );
            } else if ($searsh == 'current_year') {
                $year = now()->year;
                $count = DB::select(
                    'select count(*) as count from users
                    where
                    year(created_at) =' . $year
                );
            } else if ($searsh == 'last_year') {
                $year = now()->year - 1;
                $count = DB::select(
                    'select count(*) as count from users
                    where
                    year(created_at) =' . $year
                );
            }else if($searsh=='all')
            {
                $count=User::count();
                return $count;
            }
            else {

                $count = DB::select(
                    'select count(*) as count from users
                where
                created_at between
                DATE_SUB(CURRENT_DATE,INTERVAL ? day)
                and
                CURRENT_DATE ',
                    [$searsh]
                );
            }
            return $count[0]->count;
        } else {
            return null;
        }
    } // end filter
}
