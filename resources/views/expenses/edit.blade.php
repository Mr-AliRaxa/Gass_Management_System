@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb mb-4">
        <div class="d-flex justify-content-between align-items-center">
            <h2>{{ __('messages.edit_expense') }}</h2>
            <a class="btn btn-primary" href="{{ route('expenses.index') }}">{{ __('messages.back') }}</a>
        </div>
    </div>
</div>

@if ($errors->any())
<div class="alert alert-danger">
    <strong>{{ __('messages.whoops') }}</strong> {{ __('messages.input_errors') }}<br><br>
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="card shadow">
    <div class="card-body">
        <form action="{{ route('expenses.update',$expense->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
             <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-6 mb-3">
                    <div class="form-group">
                        <label class="form-label"><strong>{{ __('messages.expense_type_label') }}:</strong></label>
                        <select name="expense_type_id" class="form-control">
                            @foreach($expenseTypes as $type)
                                <option value="{{ $type->id }}" {{ $expense->expense_type_id == $type->id ? 'selected' : '' }}>{{ $type->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 mb-3">
                    <div class="form-group">
                        <label class="form-label"><strong>{{ __('messages.date') }}:</strong></label>
                        <input type="date" name="date" value="{{ $expense->date }}" class="form-control">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 mb-3">
                    <div class="form-group">
                        <label class="form-label"><strong>{{ __('messages.amount') }}:</strong></label>
                        <input type="number" step="0.001" name="amount" value="{{ $expense->amount }}" class="form-control" placeholder="0.000">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 mb-3">
                    <div class="form-group">
                        <label class="form-label"><strong>{{ __('messages.slip_image') }}:</strong></label>
                        <input type="file" name="slip_image" class="form-control mb-2" accept="image/*,application/pdf">
                        @if($expense->slip_image)
                            <a href="{{ asset('storage/'.$expense->slip_image) }}" target="_blank">{{ __('messages.view_current_slip') }}</a>
                        @endif
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                    <div class="form-group">
                        <label class="form-label"><strong>{{ __('messages.note') }}:</strong></label>
                        <textarea class="form-control" style="height:100px" name="note" placeholder="{{ __('messages.note') }}">{{ $expense->note }}</textarea>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 text-center mt-3">
                    <button type="submit" class="btn btn-primary">{{ __('messages.update') }}</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
