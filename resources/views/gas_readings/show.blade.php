@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb mb-4">
            <div class="d-flex justify-content-between align-items-center">
                <h2>Gas Reading Details</h2>
                <a class="btn btn-primary" href="{{ route('gas_readings.index') }}"> Back</a>
            </div>
        </div>
    </div>

    <div class="card shadow">
        <div class="card-body">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                    <div class="form-group">
                        <label class="form-label"><strong>Date:</strong></label>
                        {{ $gasReading->date }}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 mb-3">
                    <div class="card">
                        <div class="card-header">Start Reading</div>
                        <div class="card-body text-center">
                            <h3>{{ $gasReading->start_reading }}</h3>
                            @if($gasReading->start_image)
                                <img src="{{ asset('storage/' . $gasReading->start_image) }}" class="img-fluid mt-2"
                                    style="max-height: 200px;">
                            @else
                                <p>No Image</p>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 mb-3">
                    <div class="card">
                        <div class="card-header">End Reading</div>
                        <div class="card-body text-center">
                            <h3>{{ $gasReading->end_reading }}</h3>
                            @if($gasReading->end_image)
                                <img src="{{ asset('storage/' . $gasReading->end_image) }}" class="img-fluid mt-2"
                                    style="max-height: 200px;">
                            @else
                                <p>No Image</p>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 mb-3 text-center">
                    <h4>Total Consumption Gas (Ton): {{ $gasReading->end_reading - $gasReading->start_reading }}</h4>
                </div>
            </div>
        </div>
    </div>
@endsection