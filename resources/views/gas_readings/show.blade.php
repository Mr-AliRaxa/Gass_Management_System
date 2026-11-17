@extends('layouts.app')

@section('content')
    <style>
        .reading-img-link {
            display: inline-block;
            position: relative;
            overflow: hidden;
            border-radius: 8px;
            text-decoration: none;
            transition: all 0.25s ease-in-out;
        }

        .reading-img-link img {
            transition: transform 0.25s ease-in-out, box-shadow 0.25s ease-in-out;
            cursor: pointer;
        }

        .reading-img-link:hover img {
            transform: scale(1.03);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.18) !important;
        }

        .reading-img-badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            margin-top: 8px;
            font-size: 12px;
            color: #0b5fa5;
            font-weight: 600;
        }

        .reading-img-link:hover .reading-img-badge {
            color: #084275;
            text-decoration: underline;
        }
    </style>

    <div class="row">
        <div class="col-lg-12 margin-tb mb-4">
            <div class="d-flex justify-content-between align-items-center">
                <h2> {{ __('messages.gasredingdetail') }} </h2>
                <a class="btn btn-primary" href="{{ route('gas_readings.index') }}"> {{ __('messages.back') }} </a>
            </div>
        </div>
    </div>

    <div class="card shadow">
        <div class="card-body">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                    <div class="form-group">
                        <label class="form-label"><strong> {{ __('messages.date') }}:</strong></label>
                        {{ $gasReading->date }}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 mb-3">
                    <div class="card h-100 shadow-sm border">
                        <div class="card-header bg-light fw-bold"> {{ __('messages.re_startreading') }} </div>
                        <div class="card-body text-center d-flex flex-column align-items-center justify-content-center">
                            <h3 class="fw-bold text-primary">{{ number_format($gasReading->start_reading, 3) }}</h3>
                            @if($gasReading->start_image)
                                <div class="mt-2">
                                    <a href="{{ asset('storage/' . $gasReading->start_image) }}" target="_blank"
                                        rel="noopener noreferrer" class="reading-img-link"
                                        title="Click to view full size in new tab">
                                        <img src="{{ asset('storage/' . $gasReading->start_image) }}" alt="Start Reading Image"
                                            class="img-fluid rounded border shadow-sm" style="max-height: 220px; object-fit: contain;">
                                        <div>
                                            <span class="reading-img-badge">
                                                <i class="fas fa-arrow-up-right-from-square"></i> Click to view full size
                                            </span>
                                        </div>
                                    </a>
                                </div>
                            @else
                                <p class="text-muted mt-3 mb-0">{{ __('messages.redingimg') }} </p>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 mb-3">
                    <div class="card h-100 shadow-sm border">
                        <div class="card-header bg-light fw-bold"> {{ __('messages.re_endtreading') }} </div>
                        <div class="card-body text-center d-flex flex-column align-items-center justify-content-center">
                            <h3 class="fw-bold text-success">{{ number_format($gasReading->end_reading, 3) }}</h3>
                            @if($gasReading->end_image)
                                <div class="mt-2">
                                    <a href="{{ asset('storage/' . $gasReading->end_image) }}" target="_blank"
                                        rel="noopener noreferrer" class="reading-img-link"
                                        title="Click to view full size in new tab">
                                        <img src="{{ asset('storage/' . $gasReading->end_image) }}" alt="End Reading Image"
                                            class="img-fluid rounded border shadow-sm" style="max-height: 220px; object-fit: contain;">
                                        <div>
                                            <span class="reading-img-badge text-success">
                                                <i class="fas fa-arrow-up-right-from-square"></i> Click to view full size
                                            </span>
                                        </div>
                                    </a>
                                </div>
                            @else
                                <p class="text-muted mt-3 mb-0">{{ __('messages.redingimg') }}</p>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 mb-3 text-center mt-3">
                    <div class="alert alert-info d-inline-block px-4 py-2 shadow-sm mb-0">
                        <h4 class="mb-0 fw-bold"> {{ __('messages.todaycongasston') }} :
                            {{ number_format($gasReading->end_reading - $gasReading->start_reading, 3) }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
