@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb mb-4">
        <div class="d-flex justify-content-between align-items-center">
            <h2> {{ __('messages.visa_detailinfo') }}   </h2>
            <a class="btn btn-primary" href="{{ route('visa_details.index') }}">  {{ __('messages.back') }}  </a>
        </div>
    </div>
</div>

<div class="card shadow">
    <div class="card-body">
         <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                <div class="form-group">
                    <label class="form-label"><strong> {{ __('messages.visa_teammembers') }} :</strong></label>
                    {{ $visaDetail->teamMember->name }}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6 mb-3">
                <div class="form-group">
                    <label class="form-label"><strong> {{ __('messages.visa_issuedate') }} :</strong></label>
                    {{ $visaDetail->issue_date }}
                </div>
            </div>
             <div class="col-xs-12 col-sm-12 col-md-6 mb-3">
                <div class="form-group">
                    <label class="form-label"><strong> {{ __('messages.visaexpdate') }}   :</strong></label>
                     {{ $visaDetail->expiry_date }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
