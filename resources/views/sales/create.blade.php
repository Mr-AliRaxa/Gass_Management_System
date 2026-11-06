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
                                    <input type="number" name="filled_{{ $weight }}_qty" class="form-control bg-light border-0 qty-input" value="" min="" data-weight="{{ $weight }}" data-cat="filled">
                                </div>
                                <div class="col-6">
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-0 text-muted small">OMR</span>
                                        <input type="number" step="0.01" name="filled_{{ $weight }}_price" class="form-control bg-light border-0 price-input" value="" min="">
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
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h3 class="font-weight-bold mb-0">{{ __('messages.new_cylinders_sold_title') }}</h3>
                            <span class="badge bg-primary-subtle text-primary border border-primary-subtle px-2 py-1 small">
                                <i class="fas fa-boxes me-1"></i>{{ __('messages.stock_monitored') ?? 'Stock Monitored' }}
                            </span>
                        </div>
                        
                        @foreach(['11kg', '22kg', '44kg'] as $weight)
                        @php 
                            $stockType = $weight . '_empty'; 
                            $stock = max(0, (int) ($stockLevels[$stockType] ?? 0));
                        @endphp
                        <div class="mb-4 p-3 rounded-3 {{ $stock <= 0 ? 'bg-danger-subtle bg-opacity-25 border border-danger-subtle' : 'bg-white border' }}">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <label class="form-label font-weight-bold mb-0 text-dark">
                                    <i class="fas fa-gas-pump text-primary me-1"></i> {{ $weight }} {{ __('messages.quantity_label') }}
                                </label>
                                @if($stock <= 0)
                                    <span class="badge bg-danger text-white py-1 px-2" style="font-size: 0.75rem;">
                                        <i class="fas fa-ban me-1"></i>{{ __('messages.out_of_stock') }}
                                    </span>
                                @else
                                    <span class="badge bg-success-subtle text-success border border-success-subtle py-1 px-2" style="font-size: 0.75rem;">
                                        <i class="fas fa-check-circle me-1"></i>{{ __('messages.stock_label') }}: {{ $stock }}
                                    </span>
                                @endif
                            </div>
                            <div class="row g-2">
                                <div class="col-6 position-relative">
                                    <input type="number" 
                                           name="new_{{ $weight }}_qty" 
                                           class="form-control qty-input new-cylinder-qty {{ $stock <= 0 ? 'out-of-stock-input' : 'bg-light border-0' }}" 
                                           value="" 
                                           min="0"
                                           max="{{ $stock }}"
                                           data-weight="{{ $weight }}" 
                                           data-stock="{{ $stock }}"
                                           data-cat="new"
                                           placeholder="{{ $stock <= 0 ? '0' : '0' }}"
                                           {{ $stock <= 0 ? 'readonly' : '' }}>
                                    <div class="text-xs mt-1 {{ $stock <= 0 ? 'text-danger font-weight-bold' : ($stock <= 5 ? 'text-warning font-weight-bold' : 'text-muted') }}">
                                        @if($stock <= 0)
                                            <i class="fas fa-exclamation-triangle me-1"></i>{{ __('messages.new_cylinder_not_in_stock') }} (0)
                                        @else
                                            <i class="fas fa-box-open me-1"></i>{{ __('messages.stock_label') }}: <strong>{{ $stock }}</strong>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-0 text-muted small">OMR</span>
                                        <input type="number" 
                                               step="0.01" 
                                               name="new_{{ $weight }}_price" 
                                               class="form-control bg-light border-0 price-input new-cylinder-price" 
                                               value="" 
                                               min="0" 
                                               placeholder="0.00"
                                               {{ $stock <= 0 ? 'readonly' : '' }}>
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
    .out-of-stock-input {
        background-color: #fee2e2 !important;
        border: 1.5px dashed #ef4444 !important;
        color: #991b1b !important;
        cursor: not-allowed !important;
        font-weight: bold;
    }
    .out-of-stock-input::placeholder {
        color: #b91c1c !important;
        opacity: 0.8;
    }
</style>

<!-- SweetAlert2 for modern interactive alerts -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const qtyInputs = document.querySelectorAll('.qty-input');
        const priceInputs = document.querySelectorAll('.price-input');
        const displayTotal = document.getElementById('displayTotal');
        const saleForm = document.getElementById('saleForm');

        // Centralized Alert Helper
        function showStockAlert(title, message) {
            if (typeof Swal !== 'undefined') {
                Swal.fire({
                    icon: 'warning',
                    title: title,
                    text: message,
                    confirmButtonColor: '#2563eb',
                    confirmButtonText: '{{ __('messages.ok') ?? 'OK' }}',
                    customClass: {
                        popup: 'rounded-4 shadow'
                    }
                });
            } else {
                alert(title + "\n\n" + message);
            }
        }

        // Calculate Grand Total
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

        // New Cylinders Stock Validation Logic
        const newQtyInputs = document.querySelectorAll('.new-cylinder-qty');
        newQtyInputs.forEach(input => {
            const stock = parseInt(input.getAttribute('data-stock'), 10) || 0;
            const weight = input.getAttribute('data-weight') || '';

            // 1. If stock is 0, alert user on click or focus
            input.addEventListener('click', function(e) {
                if (stock <= 0) {
                    this.blur();
                    showStockAlert(
                        '{{ __('messages.new_cylinder_not_in_stock') }}',
                        '{{ __('messages.new_cylinder_not_in_stock') }}! ' + weight + ' New Cylinder stock is currently 0. You cannot add or sell this item.'
                    );
                }
            });

            input.addEventListener('focus', function(e) {
                if (stock <= 0) {
                    this.blur();
                    showStockAlert(
                        '{{ __('messages.new_cylinder_not_in_stock') }}',
                        '{{ __('messages.new_cylinder_not_in_stock') }}! ' + weight + ' New Cylinder stock is currently 0. You cannot add or sell this item.'
                    );
                }
            });

            // 2. Validate input quantity against stock
            input.addEventListener('input', function() {
                const val = parseFloat(this.value);

                if (stock <= 0) {
                    this.value = '';
                    calculateTotal();
                    showStockAlert(
                        '{{ __('messages.new_cylinder_not_in_stock') }}',
                        '{{ __('messages.new_cylinder_not_in_stock') }}! ' + weight + ' New Cylinder stock is currently 0.'
                    );
                    return;
                }

                if (val > stock) {
                    this.value = stock;
                    calculateTotal();
                    showStockAlert(
                        '{{ __('messages.insufficient_stock_title') }}',
                        '{{ __('messages.insufficient_stock_title') }}! Only ' + stock + ' units are available in stock for ' + weight + ' New Cylinder.'
                    );
                }
            });
        });

        // If stock is 0 for a new cylinder, also alert when clicking the price box
        const newPriceInputs = document.querySelectorAll('.new-cylinder-price');
        newPriceInputs.forEach(priceInput => {
            priceInput.addEventListener('click', function() {
                const name = this.getAttribute('name');
                const catWeight = name.replace('_price', '');
                const qtyInput = document.querySelector(`input[name="${catWeight}_qty"]`);
                if (qtyInput) {
                    const stock = parseInt(qtyInput.getAttribute('data-stock'), 10) || 0;
                    const weight = qtyInput.getAttribute('data-weight') || '';
                    if (stock <= 0) {
                        this.blur();
                        showStockAlert(
                            '{{ __('messages.new_cylinder_not_in_stock') }}',
                            '{{ __('messages.new_cylinder_not_in_stock') }}! ' + weight + ' New Cylinder stock is 0.'
                        );
                    }
                }
            });
        });

        // 3. Form Submit Guard
        if (saleForm) {
            saleForm.addEventListener('submit', function(e) {
                for (let input of newQtyInputs) {
                    const qty = parseFloat(input.value) || 0;
                    const stock = parseInt(input.getAttribute('data-stock'), 10) || 0;
                    const weight = input.getAttribute('data-weight') || '';

                    if (qty > 0 && stock <= 0) {
                        e.preventDefault();
                        input.value = '';
                        calculateTotal();
                        showStockAlert(
                            '{{ __('messages.new_cylinder_not_in_stock') }}',
                            '{{ __('messages.new_cylinder_not_in_stock') }}! You cannot sell ' + weight + ' New Cylinder because stock is 0.'
                        );
                        input.focus();
                        return false;
                    }

                    if (qty > stock) {
                        e.preventDefault();
                        input.value = stock;
                        calculateTotal();
                        showStockAlert(
                            '{{ __('messages.insufficient_stock_title') }}',
                            'Insufficient stock! You cannot sell ' + qty + ' units of ' + weight + ' New Cylinder when only ' + stock + ' are available.'
                        );
                        input.focus();
                        return false;
                    }
                }
            });
        }

        qtyInputs.forEach(input => input.addEventListener('input', calculateTotal));
        priceInputs.forEach(input => input.addEventListener('input', calculateTotal));
    });
</script>
@endsection
