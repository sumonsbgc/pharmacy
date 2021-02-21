<?php  

namespace App\Services;

use App\Models\Sale;

class SalesService{
    
    private $sale;

    public function __construct(Sale $sale)
    {
        $this->sale = $sale;
    }

    public function getTotalNetSalesAmount($month){

        return $this->sale->whereMonth('created_at', $month)->get()->reduce(function($carry, $sale) { 
            return $carry += $sale->net_amount;
        });
        
    }

    public function getTotalDueSalesAmount($month){

        return $this->sale->whereMonth('created_at', $month)->get()->reduce(function($carry, $sale){
            return $carry += $sale->due_amount;
        });

    }

    public function getTotalCashSalesAmount($month){

        return $this->sale->whereMonth('created_at', $month)->get()->reduce(function($carry, $sale){
            return $carry += $sale->paid_amount;
        });

    }

    public function getTotalSales($month){
        return $this->sale->whereMonth('created_at', $month)->get()->count();
    }
    
    public function getTwelveMonthsSaleAmount(){
        $months = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12'];

        $sales_amounts = [];

        foreach($months as $month){
            array_push($sales_amounts, $this->getTotalNetSalesAmount($month));
        }

        return $sales_amounts;

    }

}




?>