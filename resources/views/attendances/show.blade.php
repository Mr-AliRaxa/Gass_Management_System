@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb mb-4">
        <div class="d-flex justify-content-between align-items-center">
            <h2> {{ __('messages.A_atendnace_detail') }}   </h2>
            <a class="btn btn-primary" href="{{ route('attendances.index') }}"> {{ __('messages.back') }}  </a>
        </div>
    </div>
</div>

<div class="card shadow">
    <div class="card-body">
         <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                <div class="form-group">
                    <label class="form-label"><strong> {{ __('messages.A_temmenber') }}   :</strong></label>
                    {{ $attendance->teamMember->name }}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                <div class="form-group">
                    <label class="form-label"><strong> {{ __('messages.A_date') }} : </strong></label>
                    {{ $attendance->date }}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                <div class="form-group">
                    <label class="form-label"><strong> {{ __('messages.A_status') }} : </strong></label>
                    @if($attendance->status == 'present')
                        <span class="badge bg-success"> {{ __('messages.A_present') }} </span>
                    @elseif($attendance->status == 'absent')
                        <span class="badge bg-danger"> {{ __('messages.A_absent') }} </span>
                    @else
                        <span class="badge bg-warning text-dark"> {{ __('messages.A_leave') }} </span>
                    @endif
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                <div class="form-group">
                    <label class="form-label"><strong> {{ __('messages.A_note') }} :</strong></label>
                    {{ $attendance->note }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
