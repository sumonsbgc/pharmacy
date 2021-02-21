<?php

namespace App\Http\Controllers\Admin;

use App\Models\Sale;
use App\Models\Expense;
use App\Models\Invoice;
use App\Models\Customer;
use App\Models\Purchase;
use App\Models\Supplier;
use App\Services\SalesService;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    private $salesService;

    public function __construct(SalesService $salesService)
    {
        $this->salesService = $salesService;
    }

    public function home(){

        $month = date('m'); // 02

        $customers = Customer::whereMonth('created_at', $month)->get()->count();
        $suppliers = Supplier::whereMonth('created_at', $month)->get()->count();
        $sales_invoice = $this->salesService->getTotalSales($month);
        $purchase_invoices = Purchase::whereMonth('created_at', $month)->get()->count();

        $total_net_sales_amount = $this->salesService->getTotalNetSalesAmount($month);
        $total_due_sales_amount = $this->salesService->getTotalDueSalesAmount($month);
        $total_cash_sales_amount = $this->salesService->getTotalCashSalesAmount($month);

        $total_expense_amount = Expense::whereMonth('transaction_date', $month)->get()->reduce(function($total_expense, $expense){
            return $total_expense += $expense->expense_amount;
        });

        $total_sales = $this->salesService->getTwelveMonthsSaleAmount();

        $months = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12'];

        $total_purchase = [];
        foreach($months as $month){
            $monthlyPurchase = Purchase::whereMonth('created_at', $month)->get()->reduce(function($carry, $purchase){
                return $carry += $purchase->total_amount;
            });
            array_push($total_purchase, $monthlyPurchase);
        }

        return view('admin.dashboard', compact('customers', 'suppliers', 'sales_invoice', 'purchase_invoices', 'total_net_sales_amount','total_due_sales_amount', 'total_cash_sales_amount', 'total_expense_amount', 'total_sales', 'total_purchase'));
    }
}
