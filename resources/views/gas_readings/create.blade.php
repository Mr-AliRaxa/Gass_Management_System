@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb mb-4">
        <div class="d-flex justify-content-between align-items-center">
            <h2>{{ __('messages.add_gas_reading') }}</h2>
            <a class="btn btn-primary" href="{{ route('gas_readings.index') }}">{{ __('messages.back') }}</a>
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
        <form action="{{ route('gas_readings.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
             <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                    <div class="form-group">
                        <label class="form-label"><strong>{{ __('messages.date') }}:</strong></label>
                        <input type="date" name="date" class="form-control" value="{{ date('Y-m-d') }}">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 mb-3">
                    <div class="form-group">
                        <label class="form-label"><strong>{{ __('messages.start_reading') }}:</strong></label>
                        <input type="number" step="0.01" name="start_reading" class="form-control" placeholder="{{ __('messages.start_reading') }}">
                    </div>
                </div>
                 <div class="col-xs-12 col-sm-12 col-md-6 mb-3">
                    <div class="form-group">
                        <label class="form-label"><strong>{{ __('messages.start_image') }}:</strong></label>
                        <input type="file" name="start_image" class="form-control">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 mb-3">
                    <div class="form-group">
                        <label class="form-label"><strong>{{ __('messages.end_reading') }}:</strong></label>
                        <input type="number" step="0.01" name="end_reading" class="form-control" placeholder="{{ __('messages.end_reading') }}">
                    </div>
                </div>
                 <div class="col-xs-12 col-sm-12 col-md-6 mb-3">
                    <div class="form-group">
                        <label class="form-label"><strong>{{ __('messages.end_image') }}:</strong></label>
                        <input type="file" name="end_image" class="form-control">
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12 text-center mt-3">
                    <button type="submit" class="btn btn-primary">{{ __('messages.submit') }}</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
