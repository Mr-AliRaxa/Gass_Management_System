@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb mb-4">
        <div class="d-flex justify-content-between align-items-center">
            <h2>Stock Detail</h2>
            <a class="btn btn-primary" href="{{ route('inventory.index') }}"> Back</a>
        </div>
    </div>
</div>

<div class="card shadow">
    <div class="card-body">
         <p>Details for this stock entry:</p>
         <ul>
             <li>Type: {{ $inventory->type }}</li>
             <li>Quantity: {{ $inventory->quantity }}</li>
             <li>Date: {{ $inventory->created_at }}</li>
             <li>Note: {{ $inventory->note }}</li>
         </ul>
    </div>
</div>
@endsection
