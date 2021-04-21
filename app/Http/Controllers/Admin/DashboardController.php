<?php

namespace App\Http\Controllers\Admin;

use App\Models\Expense;
use App\Models\Customer;
use App\Models\Supplier;
use App\Services\SalesService;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Services\PurchaseService;

class DashboardController extends Controller
{
    private $salesService;
    private $purchaseService;

    public function __construct(SalesService $salesService, PurchaseService $purchaseService)
    {
        $this->salesService = $salesService;
        $this->purchaseService = $purchaseService;
    }

    public function home(){

        $month = date('03');
        
        $data  = [];
        // dd($this->salesService->getTwelveMonthsSaleAmount());
        // $data['customers']               = Customer::whereMonth('created_at', $month)->count();
        // $data['suppliers']               = Supplier::whereMonth('created_at', $month)->count();

        $data['customers']               = Customer::count();
        $data['suppliers']               = Supplier::count();
        $data['total_expense_amount']    = Expense::sum('expense_amount');

        $data['purchase_invoices']       = $this->purchaseService->getTotalPurchase($month);
        $data['total_purchase']          = $this->purchaseService->getTwelveMonthsPurchaseAmount();

        $data['sales_invoice']           = $this->salesService->getTotalSales($month);
        $data['total_net_sales_amount']  = $this->salesService->getTotalNetSalesAmount($month);
        $data['total_due_sales_amount']  = $this->salesService->getTotalDueSalesAmount($month);
        $data['total_cash_sales_amount'] = $this->salesService->getTotalCashSalesAmount($month);
        $data['total_sales']             = $this->salesService->getTwelveMonthsSaleAmount();
        
        $data['lessStockProducts']       = Product::with(['category', 'brand'])->where('total_quantity', '<=', 10)->take(5)->get();

        return view('admin.dashboard', $data);

    }
}
