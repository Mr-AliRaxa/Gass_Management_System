@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb mb-4">
        <div class="d-flex justify-content-between align-items-center">
            <h2>{{ __('messages.stock_details') }}</h2>
            <a class="btn btn-primary" href="{{ route('inventory.index') }}"> {{ __('messages.back') }}</a>
        </div>
    </div>
</div>

<div class="card shadow">
    <div class="card-body">
         <p>{{ __('messages.stock_entry_details') }}</p>
         <ul>
             <li><strong>{{ __('messages.cylinder_type') }}:</strong> {{ $inventory->type }}</li>
             <li><strong>{{ __('messages.quantity') }}:</strong> {{ $inventory->quantity }}</li>
             <li><strong>{{ __('messages.date') }}:</strong> {{ $inventory->created_at ? $inventory->created_at->format('d M Y') : '—' }}</li>
             <li><strong>{{ __('messages.note') }}:</strong> {{ $inventory->note ?? '—' }}</li>
         </ul>
    </div>
</div>
@endsection
