@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb mb-4">
        <div class="d-flex justify-content-between align-items-center">
            <h2>{{ __('messages.create_expense_type') }}</h2>
            <a class="btn btn-primary" href="{{ route('expense_types.index') }}">{{ __('messages.back') }}</a>
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
        <form action="{{ route('expense_types.store') }}" method="POST">
            @csrf
            
             <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                    <div class="form-group">
                        <label class="form-label"><strong>{{ __('messages.name') }}: <span class="text-danger">*</span></strong></label>
                        <input type="text" name="name" value="{{ old('name') }}" class="form-control" placeholder="{{ __('messages.name') }}" required>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                    <div class="form-group">
                        <label class="form-label"><strong>{{ __('messages.description') }}:</strong></label>
                        <textarea name="description" class="form-control" rows="4" placeholder="{{ __('messages.expense_type_description_placeholder') }}">{{ old('description') }}</textarea>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 text-center mt-3">
                    <button type="submit" class="btn btn-primary px-4 font-weight-bold">{{ __('messages.submit') }}</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
