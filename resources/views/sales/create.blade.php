@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row mb-4">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <div>
                <h2 class="font-weight-bold mb-1">{{ __('messages.add_new_sale') }}</h2>
                <p class="text-muted">{{ __('messages.sale_details_desc') }}</p>
            </div>
            <a class="btn btn-outline-secondary" href="{{ route('sales.index') }}">
                <i class="fas fa-arrow-left"></i> {{ __('messages.back_to_sales') }}
            </a>
        </div>
    </div>

    @if ($errors->any())
    <div class="alert alert-danger shadow-sm">
        <strong>{{ __('messages.whoops') }}</strong> {{ __('messages.input_errors') }}<br>
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('sales.store') }}" method="POST" id="saleForm">
        @csrf
        
        <div class="row">
            <!-- Customer and Date Row -->
            <div class="col-md-6 mb-4">
                <div class="form-group">
                    <label class="form-label text-gray-700 font-weight-bold">{{ __('messages.customer') }}</label>
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0"><i class="fas fa-user text-primary"></i></span>
                        <select name="customer_id" class="form-select border-start-0" required>
                            <option value="">{{ __('messages.select_customer') }}</option>
                            @foreach($customers as $customer)
                                <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="form-group">
                    <label class="form-label text-gray-700 font-weight-bold">{{ __('messages.date') }}</label>
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0"><i class="fas fa-calendar-alt text-primary"></i></span>
                        <input type="date" name="date" class="form-control border-start-0" value="{{ date('Y-m-d') }}" required>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4">
            <!-- Filled Cylinders Card -->
            <div class="col-lg-6">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body p-4">
                        <h3 class="font-weight-bold mb-4">{{ __('messages.filled_cylinders_sold_title') }}</h3>
                        
                        @foreach(['11kg', '22kg', '44kg'] as $weight)
                        <div class="mb-4">
                            <label class="form-label text-muted small mb-1">{{ $weight }} {{ __('messages.quantity_label') }}</label>
                            <div class="row g-2">
                                <div class="col-6">
                                    <input type="number" name="filled_{{ $weight }}_qty" class="form-control bg-light border-0 qty-input" value="0" min="0" data-weight="{{ $weight }}" data-cat="filled">
                                </div>
                                <div class="col-6">
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-0 text-muted small">OMR</span>
                                        <input type="number" step="0.01" name="filled_{{ $weight }}_price" class="form-control bg-light border-0 price-input" value="0" min="0">
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- New Cylinders Card -->
            <div class="col-lg-6">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body p-4">
                        <h3 class="font-weight-bold mb-4">{{ __('messages.new_cylinders_sold_title') }}</h3>
                        
                        @foreach(['11kg', '22kg', '44kg'] as $weight)
                        @php $stockType = $weight . '_empty'; @endphp
                        <div class="mb-4">
                            <label class="form-label text-muted small mb-1">{{ $weight }} {{ __('messages.quantity_label') }}</label>
                            <div class="row g-2">
                                <div class="col-6">
                                    <input type="number" name="new_{{ $weight }}_qty" class="form-control bg-light border-0 qty-input" value="0" min="0" data-weight="{{ $weight }}" data-cat="new">
                                    <div class="text-xs mt-1 {{ ($stockLevels[$stockType] ?? 0) <= 5 ? 'text-danger' : 'text-success' }}">
                                        {{ __('messages.stock_label') }}: {{ $stockLevels[$stockType] ?? 0 }}
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-0 text-muted small">OMR</span>
                                        <input type="number" step="0.01" name="new_{{ $weight }}_price" class="form-control bg-light border-0 price-input" value="0" min="0">
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer Total and Submit -->
        <div class="row mt-5">
            <div class="col-12 d-flex justify-content-end align-items-center bg-white p-4 shadow-sm rounded">
                <h4 class="mb-0 me-4 font-weight-bold">{{ __('messages.total_amount_label') }}: <span id="displayTotal" class="text-primary">0.00</span> OMR</h4>
                <button type="submit" class="btn btn-primary btn-lg px-5 font-weight-bold">
                    {{ __('messages.add_new_sale') }}
                </button>
            </div>
        </div>
    </form>
</div>

<style>
    .form-control, .form-select, .input-group-text {
        padding: 0.75rem 1rem;
        border-radius: 8px;
    }
    .card { border-radius: 12px; }
    .bg-light { background-color: #f1f3f5 !important; }
    .text-xs { font-size: 0.75rem; }
    .qty-input:focus, .price-input:focus {
        background-color: #fff !important;
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.15) !important;
        border: 1px solid #0d6efd !important;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const qtyInputs = document.querySelectorAll('.qty-input');
        const priceInputs = document.querySelectorAll('.price-input');
        const displayTotal = document.getElementById('displayTotal');

        function calculateTotal() {
            let grandTotal = 0;
            const rows = document.querySelectorAll('.qty-input');
            
            rows.forEach(qtyInput => {
                const name = qtyInput.getAttribute('name');
                const catWeight = name.replace('_qty', '');
                const priceInput = document.querySelector(`input[name="${catWeight}_price"]`);
                
                const qty = parseFloat(qtyInput.value) || 0;
                const price = parseFloat(priceInput.value) || 0;
                
                grandTotal += (qty * price);
            });
            
            displayTotal.innerText = grandTotal.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 });
        }

        qtyInputs.forEach(input => input.addEventListener('input', calculateTotal));
        priceInputs.forEach(input => input.addEventListener('input', calculateTotal));
    });
</script>
@endsection
