@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb mb-4">
        <div class="d-flex justify-content-between align-items-center">
            <h2> {{ __('messages.exp_h_detail') }}  </h2>
            <a class="btn btn-primary" href="{{ route('expenses.index') }}"> {{ __('messages.back') }}   </a>
        </div>
    </div>
</div>

<div class="card shadow">
    <div class="card-body">
         <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                <div class="form-group">
                    <label class="form-label"><strong> {{ __('messages.expense_types') }} :</strong></label>
                    {{ $expense->type->name }}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                <div class="form-group">
                    <label class="form-label"><strong> {{ __('messages.sale_INV_DATE') }} :</strong></label>
                    {{ $expense->date }}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                <div class="form-group">
                    <label class="form-label"><strong> {{ __('messages.amount') }} :</strong></label>
                    {{ number_format($expense->amount, 3) }} OMR
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                <div class="form-group">
                    <label class="form-label"><strong> {{ __('messages.notes') }}    :</strong></label>
                    {{ $expense->note }}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                <div class="form-group">
                    <label class="form-label d-block"><strong> {{ __('messages.expslipee') }} :</strong></label>
                    @if($expense->slip_image)
                        <a href="{{ asset('storage/'.$expense->slip_image) }}" target="_blank" class="btn btn-info"> {{ __('messages.viewslipee') }}    </a>
                    @else
                        <span> {{ __('messages.sipnoup') }}    </span>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
