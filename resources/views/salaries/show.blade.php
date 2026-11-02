@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb mb-4">
        <div class="d-flex justify-content-between align-items-center">
            <h2>Salary Details</h2>
            <a class="btn btn-primary" href="{{ route('salaries.index') }}"> Back</a>
        </div>
    </div>
</div>

<div class="card shadow">
    <div class="card-body">
         <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                <div class="form-group">
                    <label class="form-label"><strong>Team Member:</strong></label>
                    {{ $salary->teamMember->name }}
                </div>
            </div>
             <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                <div class="form-group">
                    <label class="form-label"><strong>Date:</strong></label>
                    {{ $salary->date }}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6 mb-3">
                <div class="form-group">
                    <label class="form-label"><strong>Amount:</strong></label>
                    {{ number_format($salary->amount, 2) }}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6 mb-3">
                <div class="form-group">
                    <label class="form-label"><strong>Bonus:</strong></label>
                    {{ number_format($salary->bonus, 2) }}
                </div>
            </div>
             <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                <div class="form-group">
                    <label class="form-label"><strong>Note:</strong></label>
                     {{ $salary->note }}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                <div class="form-group">
                    <label class="form-label d-block"><strong>Slip:</strong></label>
                    @if($salary->salary_slip)
                        <a href="{{ asset('storage/'.$salary->salary_slip) }}" target="_blank" class="btn btn-info">View Slip</a>
                    @else
                        <span>No Slip</span>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
