@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb mb-4">
        <div class="d-flex justify-content-between align-items-center">
            <h2>{{ __('messages.edit_attendance') }}</h2>
            <a class="btn btn-primary" href="{{ route('attendances.index') }}">{{ __('messages.back') }}</a>
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
        <form action="{{ route('attendances.update',$attendance->id) }}" method="POST">
            @csrf
            @method('PUT')
            
             <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-6 mb-3">
                    <div class="form-group">
                        <label class="form-label"><strong>{{ __('messages.team_member') }}:</strong></label>
                         <select name="team_member_id" class="form-control">
                            @foreach($teamMembers as $member)
                                <option value="{{ $member->id }}" {{ $attendance->team_member_id == $member->id ? 'selected' : '' }}>{{ $member->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 mb-3">
                    <div class="form-group">
                        <label class="form-label"><strong>{{ __('messages.date') }}:</strong></label>
                        <input type="date" name="date" value="{{ $attendance->date }}" class="form-control">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 mb-3">
                    <div class="form-group">
                        <label class="form-label"><strong>{{ __('messages.status') }}:</strong></label>
                        <select name="status" class="form-control">
                            <option value="present" {{ $attendance->status == 'present' ? 'selected' : '' }}>{{ __('messages.present') }}</option>
                            <option value="absent" {{ $attendance->status == 'absent' ? 'selected' : '' }}>{{ __('messages.absent') }}</option>
                            <option value="leave" {{ $attendance->status == 'leave' ? 'selected' : '' }}>{{ __('messages.leave') }}</option>
                        </select>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                    <div class="form-group">
                        <label class="form-label"><strong>{{ __('messages.note') }}:</strong></label>
                        <textarea class="form-control" style="height:100px" name="note" placeholder="{{ __('messages.note') }}">{{ $attendance->note }}</textarea>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 text-center mt-3">
                    <button type="submit" class="btn btn-primary">{{ __('messages.update') }}</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
