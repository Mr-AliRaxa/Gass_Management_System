@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb mb-4">
        <div class="d-flex justify-content-between align-items-center">
            <h2>Attendance Details</h2>
            <a class="btn btn-primary" href="{{ route('attendances.index') }}"> Back</a>
        </div>
    </div>
</div>

<div class="card shadow">
    <div class="card-body">
         <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                <div class="form-group">
                    <label class="form-label"><strong>Team Member:</strong></label>
                    {{ $attendance->teamMember->name }}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                <div class="form-group">
                    <label class="form-label"><strong>Date:</strong></label>
                    {{ $attendance->date }}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                <div class="form-group">
                    <label class="form-label"><strong>Status:</strong></label>
                    @if($attendance->status == 'present')
                        <span class="badge bg-success">Present</span>
                    @elseif($attendance->status == 'absent')
                        <span class="badge bg-danger">Absent</span>
                    @else
                        <span class="badge bg-warning text-dark">Leave</span>
                    @endif
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                <div class="form-group">
                    <label class="form-label"><strong>Note:</strong></label>
                    {{ $attendance->note }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
