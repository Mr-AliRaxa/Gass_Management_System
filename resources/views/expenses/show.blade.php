@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb mb-4">
        <div class="d-flex justify-content-between align-items-center">
            <h2>Expense Details</h2>
            <a class="btn btn-primary" href="{{ route('expenses.index') }}"> Back</a>
        </div>
    </div>
</div>

<div class="card shadow">
    <div class="card-body">
         <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                <div class="form-group">
                    <label class="form-label"><strong>Expense Type:</strong></label>
                    {{ $expense->type->name }}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                <div class="form-group">
                    <label class="form-label"><strong>Date:</strong></label>
                    {{ $expense->date }}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                <div class="form-group">
                    <label class="form-label"><strong>Amount:</strong></label>
                    {{ number_format($expense->amount, 2) }}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                <div class="form-group">
                    <label class="form-label"><strong>Note:</strong></label>
                    {{ $expense->note }}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                <div class="form-group">
                    <label class="form-label d-block"><strong>Slip:</strong></label>
                    @if($expense->slip_image)
                        <a href="{{ asset('storage/'.$expense->slip_image) }}" target="_blank" class="btn btn-info">View Slip</a>
                    @else
                        <span>No Slip</span>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
