<?php
    use NumberToWords\NumberToWords;
    $numberToWords = new NumberToWords();
    $numberTransformer = $numberToWords->getNumberTransformer('en');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link rel="stylesheet" href="{{ asset('assets/custom.css') }}">
    <title>Invoice</title>
    <style>
        *{
            margin: 0px;
            padding: 0px;
        }
        @page{
            size: A4 landscape;
        }
        .page-break {
            page-break-after: always;
        }
        .invoice-container{
            width: 95%;
            margin: 0px auto;
        }

        .py-5{
            padding-top: 1rem;
            padding-bottom: 1rem;
        }

        .inovice-body{
            width: 100%;
            border-collapse: collapse;
        }

        .inovice-body th{
            border: 1px solid #000;
        }

        .inovice-body td {
            border-left: 1px solid #000;        
            border-right: 1px solid #000;        
        }

        .inovice-body td, 
        .inovice-body th{
            padding: 7px 12px;
        }
        
        .address {
            width: 280px;
            margin: auto;
        }
    </style>
</head>
<body>
    <table>
        <thead>
            <tr>
                <td>
                    Invoice: <strong>{{ $invoice_number ?? "" }}</strong><br>
                    Ref. No: <strong>{{ $ref_number ?? "" }}</strong>
                </td>
                <td align="right">
                    Dated: <strong>{{ $sale->created_at->format('j-M-Y') }}</strong>
                </td>
            </tr>
            <tr>
                <td colspan="2" align="center">
                    <h3 class="company_name">{{ $setting->get('name') ?? '' }}</h3>
                    <p class="address">206/1, Haji Chand Meah Road Shamsherpara, Chandgaon, Chattogram.</p>
                    <p class="contact-info">Pharmacy-01516120343, Reception-01812974410</p>
                    <h2 class="invoice-heading">Invoice</h2>
                </td>
            </tr>
            <tr>
                <td>
                    Customer: <strong>{{ $sale->customer->name ?? '' }}</strong>
                </td>
                <td align="right">
                    Transaction Type: <strong>{{ $sale->sales_type ?? '' }}</strong>
                </td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="2">
                    <table class="inovice-body">
                        <thead>
                            <tr>
                                <th width="50px">Sl No.</th>
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
                                <th colspan="2" align="right">Total</th>
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
                                <th align="right"><strong>{{ number_format($sale->paid_amount, 2) }}</strong></th>                            </tr>
                        </tfoot>
                    </table>
                </td>
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <td>
                    <P>Amount Chargeable (In words)</P>
                    <h4>{{ ucwords($numberTransformer->toWords($sale->paid_amount)) }} Only</h4>
                </td>
                <td align="right">
                    E. & O. E.
                </td>
            </tr>
            <tr>
                <td>
                    <p>Declaration</p>
                    <p>
                        {{ __('Some Declaration') }}
                    </p>
                </td>
                <td align="right">
                    <span>{{ $setting->get('name') }}</span>
                </td>
            </tr>
            <tr>
                <td colspan="2" align="right">
                    <p>Authorized Signature</p>
                    <p>({{ Auth::user()->name ?? "" }})</p>
                    <p class="py-5"></p>
                </td>
            </tr>
            <tr>
                <td colspan="2" align="center">
                    <u>This is a Computer Generated Invoice</u>
                </td>
            </tr>
            <tr>
                <td colspan="2" align="right">
                    <p>Printed On: <strong>{{ date('j-M-Y') }} at {{ date('H:i') }}</strong></p>
                </td>
            </tr>
        </tfoot>
    </table>
</body>
</html>