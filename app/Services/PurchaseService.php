<?php 

namespace App\Services;

use App\Models\Purchase;

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
        return $this->purchase->whereMonth('created_at', $month)->get()->sum('total_amount');
    }

    public function getTotalPurchase($month){
        return $this->purchase->whereMonth('created_at', $month)->get()->count();
    }

    public function getTwelveMonthsPurchaseAmount(){        
        $months = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12'];
        return collect($months)->map(function($month){
            return $this->getTotalMonthlyPurchase($month);
        });
    }

}

?>