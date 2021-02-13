@include('admin.invoices.header')
<?php 
use NumberToWords\NumberToWords;
$numberToWords = new NumberToWords();
$numberTransformer = $numberToWords->getNumberTransformer('en');

?>
<div class="invoice-row" style="margin-bottom: 1rem">
    <div class="invoice-col-6">
        <p class="customer_name">Customer: <strong>{{ $sale->customer->name }}</strong></p>
    </div>
    <div class="invoice-col-6 text-right">
        <p>Transaction Type: <strong>{{ $sale->sales_type }}</strong></p>
    </div>
</div>

<table>
    <thead>
        <tr>
            <th>Sl No.</th>
            <th width="600px">Description of Goods</th>
            <th>Quantity</th>
            <th width="80px">Unit Price</th>
            <th>Unit</th>
            <th width="120px">Amount</th>
        </tr>
    </thead>
    <tbody>
        @foreach($sale->products as $product)
        <tr>
            <td align="center">{{ $loop->index + 1 }}</td>
            <td>
                {{ $product->name }}
            </td>
            <td align="right">
                {{ $product->pivot->quantity }}
            </td>
            <td align="right">
                {{ $product->pivot->sales_price }}
            </td>
            <td>
                {{ "-" }}
            </td>
            <td align="right">
                {{ $product->pivot->total_amount }}
            </td>
        </tr>
        @endforeach
        <tr>
            <td></td>
            <td>
                <strong>Gross Amount</strong><br>
                <div style="margin-top: 10px">
                    Less: <br>
                    <strong>Discount Amount</strong><br>
                    <strong>Due Amount</strong><br>
                </div>
            </td>
            <td></td>
            <td></td>
            <td></td>
            <td align="right">                
                <hr>
                <strong>{{ number_format($sale->gross_amount, 2) }}</strong> <br>
                <br>
                <div style="margin-top: 10px">
                    <strong>{{ $sale->discount_amount > 0 ? number_format($sale->discount_amount, 2) : '' }}</strong><br>
                    <strong>{{ $sale->due_amount > 0 ? number_format($sale->due_amount, 2) : '' }}</strong><br>
                </div>
            </td>
        </tr>
    </tbody>
    <tfoot>
        <tr>
            <th></th>
            <th align="right"><strong>Total</strong></th>
            <th align="right">
                <?php 
                    $total_quantity = $sale->products->reduce(function($sum, $product){
                        return $sum + $product->pivot->quantity;
                    });                     
                ?>
                <strong>{{ $total_quantity }}</strong>
            </th>
            <th></th>
            <th></th>
            <th align="right"><strong>{{ number_format($sale->paid_amount, 2) }}</strong></th>
        </tr>
    </tfoot>
</table>

<div class="invoice-row" style="margin: 1rem 0px">
    <div class="invoice-col-6">
        <P>Amount Chargeable (In words)</P>
        <h4>{{ ucwords($numberTransformer->toWords($sale->paid_amount)) }} Only</h4>
    </div>
    <div class="invoice-col-6 text-right">
        E. & O. E.
    </div>
</div>
@include('admin.invoices.footer')