<?php  

namespace App\Services;

use App\Models\Sale;

class SalesService{
    
    private $sale;

    public function __construct(Sale $sale)
    {
        $this->sale = $sale;
    }

    // public function getSales(){
    //     return $this->sale->get();
    // }

    public function getTotalNetSalesAmount($month){
        return $this->sale->whereMonth('created_at', $month)->get()->sum('net_amount');
    }

    public function getTotalDueSalesAmount($month){
        return $this->sale->whereMonth('created_at', $month)->get()->sum('due_amount');
    }

    public function getTotalCashSalesAmount($month){
        return $this->sale->whereMonth('created_at', $month)->get()->sum('paid_amount');
    }

    public function getTotalSales($month){
        return $this->sale->whereMonth('created_at', $month)->get()->count();
    }
    
    public function getTwelveMonthsSaleAmount(){
        $months = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12'];

        return collect($months)->map(function($month){
            return $this->getTotalNetSalesAmount($month);
        });
    }

}




?>