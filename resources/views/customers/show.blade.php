@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb mb-4">
        <div class="d-flex justify-content-between align-items-center">
            <h2>{{ __('messages.customer_details') }}</h2>
            <a class="btn btn-primary" href="{{ route('customers.index') }}">{{ __('messages.back') }}</a>
        </div>
    </div>
</div>

<div class="card shadow">
    <div class="card-body">
         <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                <div class="form-group">
                    <label class="form-label"><strong>{{ __('messages.name') }}:</strong></label>
                    {{ $customer->name }}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                <div class="form-group">
                    <label class="form-label"><strong>{{ __('messages.mobile') }}:</strong></label>
                    {{ $customer->mobile }}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                <div class="form-group">
                    <label class="form-label"><strong>{{ __('messages.address') }}:</strong></label>
                    {{ $customer->address }}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                <div class="form-group">
                    <label class="form-label"><strong>{{ __('messages.distance') }}:</strong></label>
                    {{ $customer->distance }}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-4 mb-3">
                <div class="form-group">
                    <label class="form-label d-block"><strong>{{ __('messages.profile_picture') }}:</strong></label>
                    @if($customer->profile_pic)
                        <img src="{{ asset('storage/'.$customer->profile_pic) }}" class="img-fluid rounded" style="max-height: 200px;">
                    @else
                        <span>{{ __('messages.no_image') }}</span>
                    @endif
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-4 mb-3">
                <div class="form-group">
                    <label class="form-label d-block"><strong>{{ __('messages.id_card_front') }}:</strong></label>
                    @if($customer->id_card_front)
                        <img src="{{ asset('storage/'.$customer->id_card_front) }}" class="img-fluid rounded" style="max-height: 200px;">
                    @else
                        <span>{{ __('messages.no_image') }}</span>
                    @endif
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-4 mb-3">
                <div class="form-group">
                    <label class="form-label d-block"><strong>{{ __('messages.id_card_back') }}:</strong></label>
                    @if($customer->id_card_back)
                        <img src="{{ asset('storage/'.$customer->id_card_back) }}" class="img-fluid rounded" style="max-height: 200px;">
                     @else
                        <span>{{ __('messages.no_image') }}</span>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
