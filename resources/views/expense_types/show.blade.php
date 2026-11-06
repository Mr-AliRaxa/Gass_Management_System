@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb mb-4">
        <div class="d-flex justify-content-between align-items-center">
            <h2>Expense Type Details</h2>
            <a class="btn btn-primary" href="{{ route('expense_types.index') }}"> Back</a>
        </div>
    </div>
</div>

<div class="card shadow">
    <div class="card-body">
         <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                <div class="form-group">
                    <label class="form-label"><strong>{{ __('messages.name') }}:</strong></label>
                    <p class="fs-5 mb-0">{{ $expenseType->name }}</p>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                <div class="form-group">
                    <label class="form-label"><strong>{{ __('messages.description') }}:</strong></label>
                    <p class="text-muted">{{ $expenseType->description ?: '—' }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
