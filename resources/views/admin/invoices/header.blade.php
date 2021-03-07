<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link rel="stylesheet" href="{{ asset('assets/custom.css') }}">
    {{-- <title>Invoice</title> --}}
    <style>
        *{
            margin: 0px;
            padding: 0px;
        }
        @page{
            size: A4 landscape;
        }
        @page{
            padding-bottom: 50px;
        }
        .page-break {
            page-break-after: always;
        }
        .invoice-container{
            width: 95%;
            margin: 0px auto;
        }
        table{
            width: 100%;
            border-collapse: collapse;
        }
        th{
            border: 1px solid #000;
        }
        table, tr, td, th{
            border-left: 1px solid #000;        
            border-right: 1px solid #000;        
        }
        td,th{
            padding: 7px 12px;
        }
        .address {
            width: 280px;
            margin: auto;
        }
    </style>
</head>
<body>

    <div class="invoice-container">
        <div class="invoice-row" style="margin-bottom: 1rem">
            <div class="invoice-col-6">
                <p>Invoice. <strong>{{ $invoice_number }}</strong></p>
                <p>Ref. No</p>
            </div>
            <div class="invoice-col-6" style="text-align: right">
                <p>Dated: <strong>{{ date('j-M-Y', strtotime( $sale->created_at )) }}</strong></p>
            </div>
        </div>

        <div class="invoice-row" style="margin-bottom: 1.5rem">
            <div class="invoice-col-12 text-center">
                <h3 class="company_name">XYZ Hospital Pharmacy</h3>
                <p class="address">206/1, Haji Chand Meah Road Shamsherpara, Chandgaon, Chattogram.</p>
                <p class="contact-info">Pharmacy-01516120343, Reception-01812974410</p>
                <h2 class="invoice-heading">Invoice</h2>
            </div>
        </div>