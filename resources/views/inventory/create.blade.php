@extends('layouts.app')

@push('styles')
<style>
    .inventory-create-page { background: #f0f4ff; min-height: 100vh; padding: 24px; }
    
    .form-card {
        background: #ffffff;
        border-radius: 20px;
        box-shadow: 0 4px 20px rgba(30, 41, 59, 0.06);
        border: 1.5px solid #edf2f7;
        padding: 32px;
        max-width: 820px;
        margin: 0 auto;
    }

    .form-header-badge {
        width: 50px;
        height: 50px;
        border-radius: 14px;
        background: linear-gradient(135deg, #4e7fff 0%, #2563eb 100%);
        color: #ffffff;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        box-shadow: 0 4px 12px rgba(78, 127, 255, 0.3);
    }

    .form-label {
        font-size: 13px;
        font-weight: 700;
        color: #334155;
        margin-bottom: 8px;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .form-control, .form-select {
        border: 1.5px solid #e2e8f0;
        border-radius: 12px;
        padding: 11px 16px;
        font-size: 14px;
        color: #1e293b;
        transition: all 0.2s ease;
    }
    .form-control:focus, .form-select:focus {
        border-color: #4e7fff;
        box-shadow: 0 0 0 3px rgba(78, 127, 255, 0.15);
        outline: none;
    }

    .calculation-preview {
        background: linear-gradient(135deg, #eff6ff 0%, #f0fdf4 100%);
        border: 1.5px dashed #93c5fd;
        border-radius: 14px;
        padding: 16px 20px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-top: 10px;
    }
    .calculation-label { font-size: 13px; font-weight: 700; color: #1e40af; }
    .calculation-value { font-size: 22px; font-weight: 800; color: #047857; }

    .btn-submit-stock {
        background: linear-gradient(135deg, #4e7fff 0%, #2563eb 100%);
        color: #ffffff;
        font-weight: 700;
        padding: 12px 32px;
        border-radius: 12px;
        border: none;
        box-shadow: 0 4px 14px rgba(78, 127, 255, 0.35);
        transition: opacity 0.2s ease;
    }
    .btn-submit-stock:hover { opacity: 0.9; color: #fff; }
</style>
@endpush

@section('content')
<div class="inventory-create-page">
    <div class="d-flex align-items-center justify-content-between mb-4" style="max-width: 820px; margin: 0 auto 20px;">
        <div class="d-flex align-items-center gap-3">
            <div class="form-header-badge">
                <i class="fas fa-boxes"></i>
            </div>
            <div>
                <h2 class="font-weight-bold mb-0" style="color: #1a1f36; font-size: 24px;">{{ __('messages.add_stock') }}</h2>
                <p class="text-muted mb-0" style="font-size: 13px;">{{ __('messages.add_stock_subtitle') }}</p>
            </div>
        </div>
        <a class="btn btn-outline-secondary rounded-pill px-4" href="{{ route('inventory.index') }}">
            <i class="fas fa-arrow-left me-1"></i> {{ __('messages.back_to_inventory') }}
        </a>
    </div>

    @if ($errors->any())
    <div class="alert alert-danger rounded-3 mb-4" style="max-width: 820px; margin: 0 auto 20px;">
        <strong>{{ __('messages.whoops') }}</strong> {{ __('messages.input_errors') }}<br>
        <ul class="mb-0 mt-2">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="form-card">
        <form action="{{ route('inventory.store') }}" method="POST" id="stockForm">
            @csrf
            
            <div class="row g-4">
                {{-- Cylinder Type --}}
                <div class="col-md-6">
                    <label class="form-label">
                        <i class="fas fa-gas-pump text-primary"></i> {{ __('messages.cylinder_type_size') }}:
                    </label>
                    <select name="type" class="form-select" required>
                        <option value="11kg_empty" {{ old('type') == '11kg_empty' ? 'selected' : '' }}>11kg Cylinder (Empty / New Pole)</option>
                        <option value="22kg_empty" {{ old('type') == '22kg_empty' ? 'selected' : '' }}>22kg Cylinder (Empty / New Pole)</option>
                        <option value="44kg_empty" {{ old('type') == '44kg_empty' ? 'selected' : '' }}>44kg Cylinder (Empty / New Pole)</option>
                    </select>
                </div>

                {{-- Purchase Date --}}
                <div class="col-md-6">
                    <label class="form-label">
                        <i class="fas fa-calendar-alt text-primary"></i> {{ __('messages.purchase_entry_date') }}:
                    </label>
                    <input type="date" name="transaction_date" class="form-control" value="{{ old('transaction_date', date('Y-m-d')) }}" required>
                </div>

                {{-- Quantity --}}
                <div class="col-md-6">
                    <label class="form-label">
                        <i class="fas fa-layer-group text-primary"></i> {{ __('messages.quantity_cylinders') }}:
                    </label>
                    <input type="number" id="qtyInput" name="quantity" class="form-control" placeholder="e.g. 50" value="{{ old('quantity') }}" required>
                    <small class="text-muted" style="font-size: 11px;">{{ __('messages.qty_help') }}</small>
                </div>

                {{-- Purchase Unit Price --}}
                <div class="col-md-6">
                    <label class="form-label">
                        <i class="fas fa-tag text-primary"></i> {{ __('messages.purchase_unit_price') }}:
                    </label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0 font-weight-bold text-muted">OMR</span>
                        <input type="number" step="0.01" id="priceInput" name="unit_price" class="form-control border-start-0" placeholder="e.g. 15.50" value="{{ old('unit_price', '0.00') }}">
                    </div>
                    <small class="text-muted" style="font-size: 11px;">{{ __('messages.unit_price_help') }}</small>
                </div>

                {{-- Supplier / Company Name --}}
                <div class="col-md-12">
                    <label class="form-label">
                        <i class="fas fa-truck text-primary"></i> {{ __('messages.supplier_name') }}:
                    </label>
                    <input type="text" name="supplier_name" class="form-control" placeholder="e.g. Muscat Gas Co." value="{{ old('supplier_name') }}">
                </div>

                {{-- Auto Total Cost Preview --}}
                <div class="col-md-12">
                    <div class="calculation-preview">
                        <div>
                            <div class="calculation-label"><i class="fas fa-calculator me-1"></i> {{ __('messages.total_purchase_cost') }}</div>
                            <small class="text-muted">{{ __('messages.qty_x_price') }}</small>
                        </div>
                        <div class="calculation-value">
                            <span id="displayTotalCost">0.00</span> <span style="font-size: 14px; font-weight: 600;">OMR</span>
                        </div>
                    </div>
                </div>

                {{-- Notes / Description --}}
                <div class="col-md-12">
                    <label class="form-label">
                        <i class="fas fa-clipboard-list text-primary"></i> {{ __('messages.remarks_invoice') }}:
                    </label>
                    <textarea class="form-control" style="height: 90px;" name="note" placeholder="...">{{ old('note') }}</textarea>
                </div>

                {{-- Submit Button --}}
                <div class="col-md-12 text-end pt-2">
                    <a href="{{ route('inventory.index') }}" class="btn btn-light rounded-pill px-4 me-2">{{ __('messages.cancel') }}</a>
                    <button type="submit" class="btn btn-submit-stock">
                        <i class="fas fa-check-circle me-1"></i> {{ __('messages.save_stock') }}
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    const qtyInput = document.getElementById('qtyInput');
    const priceInput = document.getElementById('priceInput');
    const displayTotalCost = document.getElementById('displayTotalCost');

    function calculateTotalCost() {
        const qty = parseFloat(qtyInput.value) || 0;
        const price = parseFloat(priceInput.value) || 0;

        if (qty > 0 && price > 0) {
            const total = qty * price;
            displayTotalCost.textContent = total.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 });
        } else {
            displayTotalCost.textContent = '0.00';
        }
    }

    qtyInput.addEventListener('input', calculateTotalCost);
    priceInput.addEventListener('input', calculateTotalCost);
    calculateTotalCost();
</script>
@endpush
@endsection
