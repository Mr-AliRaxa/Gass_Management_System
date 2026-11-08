@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb mb-4">
        <div class="d-flex justify-content-between align-items-center">
            <h2> {{ __('messages.sale_invoiceno') }} #{{ $sale->id }}</h2>
            <div>
                 <a class="btn btn-secondary" href="{{ route('sales.downloadPdf', $sale->id) }}"><i class="fas fa-file-pdf"></i> {{ __('messages.download_pdf') }} </a>
                 <a class="btn btn-primary" href="{{ route('sales.index') }}"> {{ __('messages.back') }}  </a>
            </div>
        </div>
    </div>
</div>

<div class="card shadow">
    <div class="card-body">
         <div class="row mb-4">
             <div class="col-md-6">
                 <h5> {{ __('messages.sale_cus_details') }} </h5>
                 <p><strong> {{ __('messages.sale_Name') }} : </strong> {{ $sale->customer->name }}</p>
                 <p><strong> {{ __('messages.sale_address') }} :</strong> {{ $sale->customer->address }}</p>
                 <p><strong> {{ __('messages.sale_mobileno') }} :</strong> {{ $sale->customer->mobile }}</p>
             </div>
             <div class="col-md-6 text-end">
                 <h5> {{ __('messages.sale_indetail') }} </h5>
                 <p><strong> {{ __('messages.sale_datee') }} :</strong> {{ $sale->date }}</p>
                 <p><strong> {{ __('messages.sale_invoiceno') }} :</strong> #{{ $sale->id }}</p>
             </div>
         </div>

         <div class="table-responsive">
             <table class="table table-bordered">
                 <thead>
                     <tr>
                         <th> {{ __('messages.sale_items') }} </th>
                         <th> {{ __('messages.sale_qyt') }} </th>
                         <th> {{ __('messages.sale_unprice') }} </th>
                         <th> {{ __('messages.sale_total') }} </th>
                     </tr>
                 </thead>
                 <tbody>
                     @foreach($sale->saleItems as $item)
                     <tr>
                         <td>{{ str_replace('_', ' ', ucfirst($item->type)) }}</td>
                         <td>{{ $item->quantity }}</td>
                         <td>{{ number_format($item->price, 3) }}</td>
                         <td>{{ number_format($item->quantity * $item->price, 3) }}</td>
                     </tr>
                     @endforeach
                     <tr>
                         <td colspan="3" class="text-end"><strong>  {{ __('messages.sale_total') }}   </strong></td>
                         <td><strong>{{ number_format($sale->total_amount, 3) }}</strong></td>
                     </tr>
                 </tbody>
             </table>
         </div>
    </div>
</div>
@endsection
