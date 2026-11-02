@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb mb-4">
        <div class="d-flex justify-content-between align-items-center">
            <h2>Invoice #{{ $sale->id }}</h2>
            <div>
                 <a class="btn btn-secondary" href="{{ route('sales.downloadPdf', $sale->id) }}"><i class="fas fa-file-pdf"></i> Download PDF</a>
                 <a class="btn btn-primary" href="{{ route('sales.index') }}"> Back</a>
            </div>
        </div>
    </div>
</div>

<div class="card shadow">
    <div class="card-body">
         <div class="row mb-4">
             <div class="col-md-6">
                 <h5>Customer Details</h5>
                 <p><strong>Name:</strong> {{ $sale->customer->name }}</p>
                 <p><strong>Address:</strong> {{ $sale->customer->address }}</p>
                 <p><strong>Mobile:</strong> {{ $sale->customer->mobile }}</p>
             </div>
             <div class="col-md-6 text-end">
                 <h5>Invoice Details</h5>
                 <p><strong>Date:</strong> {{ $sale->date }}</p>
                 <p><strong>Invoice No:</strong> #{{ $sale->id }}</p>
             </div>
         </div>

         <div class="table-responsive">
             <table class="table table-bordered">
                 <thead>
                     <tr>
                         <th>Item</th>
                         <th>Quantity</th>
                         <th>Unit Price</th>
                         <th>Total</th>
                     </tr>
                 </thead>
                 <tbody>
                     @foreach($sale->saleItems as $item)
                     <tr>
                         <td>{{ str_replace('_', ' ', ucfirst($item->type)) }}</td>
                         <td>{{ $item->quantity }}</td>
                         <td>{{ number_format($item->price, 2) }}</td>
                         <td>{{ number_format($item->quantity * $item->price, 2) }}</td>
                     </tr>
                     @endforeach
                     <tr>
                         <td colspan="3" class="text-end"><strong>Grand Total</strong></td>
                         <td><strong>{{ number_format($sale->total_amount, 2) }}</strong></td>
                     </tr>
                 </tbody>
             </table>
         </div>
    </div>
</div>
@endsection
