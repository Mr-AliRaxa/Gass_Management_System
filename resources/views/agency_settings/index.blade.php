@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 text-primary fw-bold"><i class="fas fa-cog me-2"></i>{{ __('messages.agency_settings_title') }}</h5>
                </div>
                <div class="card-body p-4">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form action="{{ route('agency_settings.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <label class="form-label fw-bold d-block">{{ __('messages.agency_logo') }}</label>
                                    <p class="text-muted small mb-3">{{ __('messages.agency_logo_desc') }}</p>
                                    
                                    @if($setting->logo)
                                        <div class="mb-3 text-center">
                                            <div class="border rounded p-3 bg-light">
                                                <img src="{{ asset('storage/' . $setting->logo) }}" alt="Logo" class="img-fluid" style="max-height: 80px;">
                                            </div>
                                        </div>
                                    @else
                                        <div class="mb-3 p-4 border-dashed rounded text-center bg-light">
                                            <i class="fas fa-building fa-2x text-muted opacity-25"></i>
                                            <p class="small text-muted mb-0">{{ __('messages.no_logo_uploaded') }}</p>
                                        </div>
                                    @endif

                                    <div class="input-group">
                                        <input type="file" name="logo" class="form-control @error('logo') is-invalid @enderror" id="logo" accept="image/*">
                                        @error('logo')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <label class="form-label fw-bold d-block">{{ __('messages.report_letterhead') }}</label>
                                    <p class="text-muted small mb-3">{{ __('messages.report_letterhead_desc') }}</p>
                                    
                                    @if($setting->letterhead)
                                        <div class="mb-3 text-center">
                                            <div class="border rounded p-3 bg-light">
                                                <img src="{{ asset('storage/' . $setting->letterhead) }}" alt="Letterhead" class="img-fluid" style="max-height: 80px;">
                                            </div>
                                        </div>
                                    @else
                                        <div class="mb-3 p-4 border-dashed rounded text-center bg-light">
                                            <i class="fas fa-file-invoice fa-2x text-muted opacity-25"></i>
                                            <p class="small text-muted mb-0">{{ __('messages.no_letterhead_uploaded') }}</p>
                                        </div>
                                    @endif

                                    <div class="input-group">
                                        <input type="file" name="letterhead" class="form-control @error('letterhead') is-invalid @enderror" id="letterhead" accept="image/*">
                                        @error('letterhead')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-md-6 mb-3">
                                <label for="top_margin" class="form-label fw-bold">{{ __('messages.top_margin') }}</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-arrows-alt-v"></i></span>
                                    <input type="number" name="top_margin" class="form-control @error('top_margin') is-invalid @enderror" id="top_margin" value="{{ old('top_margin', $setting->top_margin ?? 120) }}" min="0" max="500">
                                </div>
                                <div class="form-text small text-muted">{{ __('messages.top_margin_desc') }}</div>
                                @error('top_margin')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="bottom_margin" class="form-label fw-bold">{{ __('messages.bottom_margin') }}</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-arrows-alt-v"></i></span>
                                    <input type="number" name="bottom_margin" class="form-control @error('bottom_margin') is-invalid @enderror" id="bottom_margin" value="{{ old('bottom_margin', $setting->bottom_margin ?? 80) }}" min="0" max="500">
                                </div>
                                <div class="form-text small text-muted">{{ __('messages.bottom_margin_desc') }}</div>
                                @error('bottom_margin')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <hr class="my-4">

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary px-5 shadow-sm">
                                <i class="fas fa-save me-2"></i>{{ __('messages.save_settings') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            
            <style>
                .border-dashed {
                    border: 2px dashed #dee2e6 !important;
                }
            </style>
        </div>
    </div>
</div>
@endsection
