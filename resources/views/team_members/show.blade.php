@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb mb-4">
        <div class="d-flex justify-content-between align-items-center">
            <h2>{{ __('messages.team_member_details') }}</h2>
            <a class="btn btn-primary" href="{{ route('team_members.index') }}">{{ __('messages.back') }}</a>
        </div>
    </div>
</div>

<div class="card shadow">
    <div class="card-body">
         <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                <div class="form-group">
                    <label class="form-label"><strong>{{ __('messages.name') }}:</strong></label>
                    {{ $teamMember->name }}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                <div class="form-group">
                    <label class="form-label"><strong>{{ __('messages.mobile') }}:</strong></label>
                    {{ $teamMember->mobile }}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                <div class="form-group">
                    <label class="form-label"><strong>{{ __('messages.address') }}:</strong></label>
                    {{ $teamMember->address }}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6 mb-3">
                <div class="form-group">
                    <label class="form-label"><strong>{{ __('messages.designation') }}:</strong></label>
                    {{ $teamMember->designation }}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6 mb-3">
                <div class="form-group">
                    <label class="form-label"><strong>{{ __('messages.basic_salary') }}:</strong></label>
                    {{ number_format($teamMember->basic_salary, 3) }} OMR
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-4 mb-3">
                <div class="form-group">
                    <label class="form-label d-block"><strong>{{ __('messages.profile_picture') }}:</strong></label>
                    @if($teamMember->profile_pic)
                        <img src="{{ asset('storage/'.$teamMember->profile_pic) }}" class="img-fluid rounded" style="max-height: 200px;">
                    @else
                        <span>{{ __('messages.no_image') }}</span>
                    @endif
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-4 mb-3">
                <div class="form-group">
                    <label class="form-label d-block"><strong>{{ __('messages.id_card_front') }}:</strong></label>
                    @if($teamMember->id_card_front)
                        <img src="{{ asset('storage/'.$teamMember->id_card_front) }}" class="img-fluid rounded" style="max-height: 200px;">
                    @else
                        <span>{{ __('messages.no_image') }}</span>
                    @endif
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-4 mb-3">
                <div class="form-group">
                    <label class="form-label d-block"><strong>{{ __('messages.id_card_back') }}:</strong></label>
                    @if($teamMember->id_card_back)
                        <img src="{{ asset('storage/'.$teamMember->id_card_back) }}" class="img-fluid rounded" style="max-height: 200px;">
                     @else
                        <span>{{ __('messages.no_image') }}</span>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
