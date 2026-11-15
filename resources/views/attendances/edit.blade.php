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

@if ($message = Session::get('error'))
<div class="alert alert-danger alert-dismissible fade show rounded-3 mb-4" role="alert">
    <i class="fas fa-exclamation-triangle me-2"></i>{{ $message }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

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
                         <select name="team_member_id" id="editAttendanceTeamMember" class="form-control" required>
                            @foreach($teamMembers as $member)
                                <option value="{{ $member->id }}" {{ (old('team_member_id', $attendance->team_member_id) == $member->id) ? 'selected' : '' }}>{{ $member->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 mb-3">
                    <div class="form-group">
                        <label class="form-label"><strong>{{ __('messages.date') }}:</strong></label>
                        <input type="date" name="date" id="editAttendanceDate" value="{{ old('date', $attendance->date) }}" class="form-control" required>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 mb-3">
                    <div class="form-group">
                        <label class="form-label"><strong>{{ __('messages.status') }}:</strong></label>
                        <select name="status" class="form-control">
                            <option value="present" {{ old('status', $attendance->status) == 'present' ? 'selected' : '' }}>{{ __('messages.present') }}</option>
                            <option value="absent" {{ old('status', $attendance->status) == 'absent' ? 'selected' : '' }}>{{ __('messages.absent') }}</option>
                            <option value="leave" {{ old('status', $attendance->status) == 'leave' ? 'selected' : '' }}>{{ __('messages.leave') }}</option>
                        </select>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                    <div class="form-group">
                        <label class="form-label"><strong>{{ __('messages.note') }}:</strong></label>
                        <textarea class="form-control" style="height:100px" name="note" placeholder="{{ __('messages.note') }}">{{ old('note', $attendance->note) }}</textarea>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 text-center mt-3">
                    <button type="submit" id="updateAttendanceBtn" class="btn btn-primary">{{ __('messages.update') }}</button>
                </div>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const memberSelect = document.getElementById('editAttendanceTeamMember');
    const dateInput = document.getElementById('editAttendanceDate');
    const submitBtn = document.getElementById('updateAttendanceBtn');
    const currentAttendanceId = '{{ $attendance->id }}';

    let isChecking = false;

    async function checkAttendanceDate() {
        const memberId = memberSelect ? memberSelect.value : '';
        const dateVal = dateInput ? dateInput.value : '';

        if (!memberId || !dateVal) return;

        try {
            isChecking = true;
            const res = await fetch(`{{ route('attendances.checkDateRecorded') }}?team_member_id=${encodeURIComponent(memberId)}&date=${encodeURIComponent(dateVal)}&exclude_id=${encodeURIComponent(currentAttendanceId)}`);
            const data = await res.json();

            if (data.recorded) {
                if (typeof showBlockedModal === 'function') {
                    showBlockedModal(data.message, '{{ addslashes(__('messages.attendance_already_recorded_title')) }}');
                } else {
                    alert(data.message);
                }
                if (submitBtn) {
                    submitBtn.classList.add('disabled');
                    submitBtn.setAttribute('title', data.message);
                }
            } else {
                if (submitBtn) {
                    submitBtn.classList.remove('disabled');
                    submitBtn.removeAttribute('title');
                }
            }
        } catch (e) {
            console.error('Error checking attendance status:', e);
        } finally {
            isChecking = false;
        }
    }

    if (memberSelect) {
        memberSelect.addEventListener('change', checkAttendanceDate);
    }
    if (dateInput) {
        dateInput.addEventListener('change', checkAttendanceDate);
    }

    const form = document.querySelector('form[action="{{ route('attendances.update', $attendance->id) }}"]');
    if (form) {
        form.addEventListener('submit', async function (e) {
            const memberId = memberSelect ? memberSelect.value : '';
            const dateVal = dateInput ? dateInput.value : '';
            if (!memberId || !dateVal) return;

            e.preventDefault();
            try {
                const res = await fetch(`{{ route('attendances.checkDateRecorded') }}?team_member_id=${encodeURIComponent(memberId)}&date=${encodeURIComponent(dateVal)}&exclude_id=${encodeURIComponent(currentAttendanceId)}`);
                const data = await res.json();
                if (data.recorded) {
                    if (typeof showBlockedModal === 'function') {
                        showBlockedModal(data.message, '{{ addslashes(__('messages.attendance_already_recorded_title')) }}');
                    } else {
                        alert(data.message);
                    }
                    return false;
                } else {
                    form.submit();
                }
            } catch (err) {
                form.submit();
            }
        });
    }
});
</script>
@endpush
        </form>
    </div>
</div>
@endsection
