<?php

namespace App\Http\Controllers\Admin;

use App\Models\Sale;
use App\Models\Product;
use App\Models\Customer;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Invoice;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;

class SaleController extends Controller
{
    public function index()
    {
        $sales = Sale::with('products', 'customer')->get();
        return view('admin.sales.index', compact('sales'));
    }

    public function create()
    {
        $products = Product::all();
        $customers = Customer::all();

        return view('admin.sales.create', compact('products', 'customers'));
    }

    public function store(Request $request)
    {
        $valid = Validator::make($request->all(), [
            'product_id'       => ['required'],
            'customer_id'      => ['required_without:is_new_customer'],
            'customer_name'    => ['required_if:is_new_customer,on'],
            'customer_mobile'  => ['required_if:is_new_customer,on'],
            'quantity'         => ['required'],
            'sales_price'      => ['required'],
            'total_amount'     => ['required'],
            'transaction_type' => ['required'],
            'paid_amount'      => ['required'],
            'due_amount'       => ['required_if:transaction_type,Due'],
            'pay_back_date'    => ['nullable'],
            'transaction_id'   => ['required_if:transaction_type,Mobile Banking'],
        ]);

        if ($valid->fails()) {
            return back()->withErrors($valid)->withInput();
        }

        if (isset($request->is_new_customer)) {
            $customer = new Customer();
            $customer->name = $request->customer_name;
            $customer->mobile = $request->customer_mobile;
            $customer->address = $request->customer_address;
            $customer->save();
        }

        DB::beginTransaction();
        try {
            $sale = new Sale();
            $sale->user_id = Auth::user()->id;
            $sale->customer_id = $request->customer_id ?? $customer->id;
            $sale->sales_type = $request->transaction_type;
            $sale->gross_amount = $request->gross_amount;
            $sale->discount_amount = $request->total_discount;
            $sale->net_amount = $request->net_amount;
            $sale->paid_amount = $request->paid_amount;
            $sale->due_amount = $request->due_amount;
            $sale->pay_back_date = $request->pay_back_date;
            $sale->transaction_id = $request->transaction_id;
            $sale->save();

            foreach ($request->product_id as $key => $value) {

                $sale->products()->attach(
                    $value,
                    [
                        'quantity' => $request->quantity[$key],
                        'sales_price' => $request->sales_price[$key],
                        'total_amount' => $request->total_amount[$key],
                    ]
                );

                $quantity = $request->quantity[$key];
                settype($quantity, "integer");
                Product::where('id', $value)->decrement('total_quantity', $quantity);
            }

            // $invoice_num = DB::table('invoices')->latest('invoice_id')->first() ?? 0;
            // $invoice_number = $this->invoice_num($invoice_num !== 0 ? $invoice_num->invoice_id : 0 + 1);

            // $pdf = PDF::loadView('admin.invoices.saleInvoice', compact('sale', 'invoice_number'))->setPaper('a4', 'landscape');
            // $fileName = 'saleInvoice.pdf';

            // (new Invoice())->create(['sale_id' => $sale->id, 'invoice_id' => $invoice_number]);
            // return $pdf->download($fileName);

            DB::commit();
            return redirect()->route('admin.sales.index')->with(['status' => 'success', 'message' => 'Sales Record Updated Successfully']);
        } catch (QueryException $q) {
            DB::rollBack();
            dd($q);
            throw new InvalidArgumentException($q->getMessage());
        }
    }

    public function edit($id)
    {
        $sale = Sale::findOrFail($id);
        $products = Product::all();
        $customers = Customer::all();

        return view('admin.sales.edit', compact('sale', 'products', 'customers'));
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());
        $valid = Validator::make($request->all(), [
            'product_id'       => ['required'],
            'customer_id'      => ['required_without:is_new_customer'],
            'customer_name'    => ['required_if:is_new_customer,on'],
            'customer_mobile'  => ['required_if:is_new_customer,on'],
            'quantity'         => ['required'],
            'sales_price'      => ['required'],
            'total_amount'     => ['required'],
            'transaction_type' => ['required'],
            'paid_amount'      => ['required'],
            'due_amount'       => ['required_if:transaction_type,Due'],
            'pay_back_date'    => ['nullable'],
            'transaction_id'   => ['required_if:transaction_type,Mobile Banking'],
        ]);

        if ($valid->fails()) {
            return back()->withErrors($valid)->withInput();
        }

        if (isset($request->is_new_customer)) {
            $customer = new Customer();
            $customer->name = $request->customer_name;
            $customer->mobile = $request->customer_mobile;
            $customer->address = $request->customer_address;
            $customer->save();
        }

        DB::beginTransaction();
        $sale = Sale::findOrFail($id);
        $sale->user_id = Auth::user()->id;
        $sale->customer_id = $request->customer_id ?? $customer->id;
        $sale->sales_type = $request->transaction_type;
        $sale->gross_amount = $request->gross_amount;
        $sale->discount_amount = $request->total_discount;
        $sale->net_amount = $request->net_amount;
        $sale->paid_amount = $request->paid_amount;
        $sale->due_amount = $request->due_amount;
        $sale->pay_back_date = $request->pay_back_date;
        $sale->transaction_id = $request->transaction_id;
        $sale->save();

        $syncData = [];
        foreach ($request->product_id as $key => $value) {
            $syncData[$value] = [
                'quantity' => $request->quantity[$key],
                'sales_price' => $request->sales_price[$key],
                'total_amount' => $request->total_amount[$key],
            ];
        }

        $sale->products()->sync($syncData);

        // foreach($request->product_id as $key => $value){
        //     $sale->products()->detach($value);
        //     $sale->products()->attach($value,
        //     [
        //         'quantity' => $request->quantity[$key], 
        //         'sales_price' => $request->sales_price[$key], 
        //         'total_amount' => $request->total_amount[$key],
        //     ]);
        // }

        DB::commit();
        return redirect()->route('admin.sales.index')->with(['status' => 'success', 'message' => 'Sales Record has been updated successfully']);
    }

    public function delete($id)
    {
        $sale = Sale::findOrFail($id);

        foreach ($sale->products as $product) {
            $sale->products()->detach($product->id);
        }

        $sale->delete();
        return redirect()->back()->with(['status' => 'success', 'message' => 'Sales Record has been deleted successfully']);
    }

    function invoice_num($input, $pad_len = 6, $prefix = null)
    {
        if ($pad_len <= strlen($input))
            trigger_error('<strong>$pad_len</strong> cannot be less than or equal to the length of <strong>$input</strong> to generate invoice number', E_USER_ERROR);

        $pad_string = "0";

        if (is_string($prefix))
            return sprintf("%s-%s", $prefix, str_pad($input, $pad_len, $pad_string, STR_PAD_LEFT));

        return str_pad($input, $pad_len, $pad_string, STR_PAD_LEFT);
    }
}
