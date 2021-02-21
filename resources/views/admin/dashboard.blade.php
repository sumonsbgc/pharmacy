@extends('layouts.app')


@section('content')
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Dashboard</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          {{-- <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Dashboard v1</li>
          </ol> --}}
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      {{-- Info boxes --}}

      <div class="row mb-4">
        <div class="col-md-3">
          <div class="info-box">
            <span class="info-box-icon bg-info"><i class="fas fa-cart-plus"></i></span>

            <div class="info-box-content">
              <span class="info-box-number">Total Sales Amount</span>
              <span class="info-box-number"> {{ number_format($total_net_sales_amount, 2) }} </span>
            </div>
            <!-- /.info-box-content -->
          </div>
        </div>
        <div class="col-md-3">
          <div class="info-box">
            <span class="info-box-icon bg-warning"><i class="fas fa-times-circle"></i></span>

            <div class="info-box-content">
              <span class="info-box-number">Total Sales Due</span>
              <span class="info-box-number">{{ number_format($total_due_sales_amount, 2) }}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
        </div>

        <div class="col-md-3">
          <div class="info-box">
            <span class="info-box-icon bg-success"><i class="fas fa-dollar-sign"></i></span>

            <div class="info-box-content">
              <span class="info-box-number">Total Cash Sales</span>
              <span class="info-box-number">{{ number_format($total_cash_sales_amount, 2) }}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
        </div>

        <div class="col-md-3">
          <div class="info-box">
            <span class="info-box-icon bg-danger"><i class="fas fa-minus"></i></span>

            <div class="info-box-content">
              <span class="info-box-number">Total Expenses Amount</span>
              <span class="info-box-number">{{ number_format($total_expense_amount, 2) }}</span>
            </div>

            <!-- /.info-box-content -->
          </div>
        </div>

        
      </div>


      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-info">
            <div class="inner">
              <h3>{{ $customers }}</h3>

              <p>Customers</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="{{ route('admin.customers.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>

        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-warning">
            <div class="inner">
              <h3>{{ $suppliers }}</h3>

              <p>Suppliers</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="{{ route('admin.suppliers.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>

        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-success">
            <div class="inner">
              <h3>{{ $sales_invoice }}</h3>

              <p>Sales Invoices</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="{{ route('admin.sales.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>

        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-danger">
            <div class="inner">
              <h3>{{ $purchase_invoices }}</h3>

              <p>Purchase Invoices</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="{{ route('admin.purchases.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>

        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->
      
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              Sales and Purchase Comparison
            </div>
            <div class="card-body">
              <div class="d-flex mb-4">
                <p class="d-flex flex-column">
                  <span class="text-bold text-lg">$ {{ number_format($total_net_sales_amount, 2) }}</span>
                  <span>Sales Over Time</span>
                </p>
                <p class="ml-auto d-flex flex-column text-right">
                  <span class="text-success">
                    <i class="fas fa-arrow-up"></i> 33.1%
                  </span>
                  <span class="text-muted">Since last month</span>
                </p>
              </div>
              <div class="position-relative mb-4">
                <canvas id="sales_purchase_comparison" height="300"></canvas>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
@endsection

@push('script')
    <script>

      console.log()

      var sales_purchase_context = document.getElementById('sales_purchase_comparison').getContext('2d');
      var ticksStyle = {
        fontColor: '#495057',
        fontStyle: 'bold'
      };

      var SalesPurchaseChart = new Chart(sales_purchase_context, {
        type: 'bar',
        data: {
          labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
          datasets: [
            {
              label: 'Sales',
              backgroundColor: '#007bff',
              borderColor    : '#007bff',
              data           :  @json($total_sales)
            },
            {
              label: 'Purchase',
              backgroundColor: '#ced4da',
              borderColor    : '#ced4da',
              data           : @json($total_purchase)
            }
          ]
        },
        options: {
          maintainAspectRatio: false,
          tooltips:{
            mode: 'index',
            intersect: true
          },
          hover:{
            mode: 'index',
            intersect: true
          },
          legend: {
            display: true
          },
          scales: {
            yAxes: [{
              gridLines: {
                display      : true,
                lineWidth    : '4px',
                color        : 'rgba(0, 0, 0, 0.2)',
                zeroLineColor: 'rgba(0, 0, 0, 0.2)'
              },
              ticks: $.extend({
                beginAtZero: true,
                callback: function(value, index, values){
                  if (value >= 1000) {
                    value /= 1000
                    value += 'k'
                  }
                  return '$ ' + value
                }
              }, ticksStyle),
            }],
            xAxes: [{
              display : true,
              gridLines : {
                display: true
              },
              ticks : ticksStyle
            }]
          }
        }
      });
    </script>
@endpush