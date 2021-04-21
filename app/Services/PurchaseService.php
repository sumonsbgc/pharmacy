<?php 

namespace App\Services;

use App\Models\Purchase;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PurchaseService {

    /** 
     * @var Purchase $purchase 
     * */

    private $purchase;

    public function __construct(Purchase $purchase)
    {
        $this->purchase = $purchase;
    }

    public function getTotalMonthlyPurchase($month){
        return $this->purchase->whereMonth('created_at', $month)->sum('total_amount');
    }

    public function getTotalPurchase($month){
        return $this->purchase->whereMonth('created_at', $month)->count();
    }

    public function getTwelveMonthsPurchaseAmount(){
        $months = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12'];

        $amount = collect($months)->map(function($month){
            return $this->getTotalMonthlyPurchase($month);
        });

        return $amount;
            // $year = date('Y');
            // $now = Carbon::create("01-01-$year")->format('Y-m-d H:i:s');
            // $future = Carbon::create("31-12-$year")->format('Y-m-d H:i:s');

            // $amount = $this->purchase
            //                ->where('created_at', '>=', $now)
            //                ->where('created_at', '<=', $future)
            //                ->select(DB::raw("SUM('total_amount') as amount, DATE_FORMAT(created_at, '%m') as month"))
            //                ->groupBy('month')
            //                ->toSql();
    }

}

?>