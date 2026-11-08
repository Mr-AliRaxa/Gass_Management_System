@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb mb-4">
        <div class="d-flex justify-content-between align-items-center">
            <h2>{{ __('messages.add_salary') }}</h2>
            <a class="btn btn-primary" href="{{ route('salaries.index') }}">{{ __('messages.back') }}</a>
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
        <form action="{{ route('salaries.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
             <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-6 mb-3">
                    <div class="form-group">
                        <label class="form-label"><strong>{{ __('messages.team_member') }}:</strong></label>
                        <select name="team_member_id" id="salaryTeamMember" class="form-control" required>
                            <option value="">{{ __('messages.select_member') }}</option>
                            @foreach($teamMembers as $member)
                                <option value="{{ $member->id }}" {{ old('team_member_id') == $member->id ? 'selected' : '' }}>{{ $member->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 mb-3">
                    <div class="form-group">
                        <label class="form-label"><strong>{{ __('messages.date') }}:</strong></label>
                        <input type="date" name="date" id="salaryDate" class="form-control" value="{{ old('date', date('Y-m-d')) }}" required>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 mb-3">
                    <div class="form-group">
                        <label class="form-label"><strong>{{ __('messages.amount') }}:</strong></label>
                        <input type="number" step="0.001" name="amount" class="form-control" placeholder="0.000">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 mb-3">
                    <div class="form-group">
                        <label class="form-label"><strong>{{ __('messages.bonus') }}:</strong></label>
                        <input type="number" step="0.001" name="bonus" class="form-control" placeholder="0.000">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                    <div class="form-group">
                        <label class="form-label"><strong>{{ __('messages.salary_slip') }}:</strong></label>
                        <input type="file" name="salary_slip" class="form-control" accept="image/*,application/pdf">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                    <div class="form-group">
                        <label class="form-label"><strong>{{ __('messages.note') }}:</strong></label>
                        <textarea class="form-control" style="height:100px" name="note" placeholder="{{ __('messages.note') }}"></textarea>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 text-center mt-3">
                    <button type="submit" id="submitSalaryBtn" class="btn btn-primary">{{ __('messages.submit') }}</button>
                </div>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const memberSelect = document.getElementById('salaryTeamMember');
    const dateInput = document.getElementById('salaryDate');
    const submitBtn = document.getElementById('submitSalaryBtn');

    let isChecking = false;

    async function checkSalaryMonth() {
        const memberId = memberSelect ? memberSelect.value : '';
        const dateVal = dateInput ? dateInput.value : '';

        if (!memberId || !dateVal) return;

        try {
            isChecking = true;
            const res = await fetch(`{{ route('salaries.checkMonthPaid') }}?team_member_id=${encodeURIComponent(memberId)}&date=${encodeURIComponent(dateVal)}`);
            const data = await res.json();

            if (data.paid) {
                // Show in-app modal warning
                if (typeof showBlockedModal === 'function') {
                    showBlockedModal(data.message, '{{ addslashes(__('messages.salary_already_paid_title')) }}');
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
            console.error('Error checking salary status:', e);
        } finally {
            isChecking = false;
        }
    }

    if (memberSelect) {
        memberSelect.addEventListener('change', checkSalaryMonth);
    }
    if (dateInput) {
        dateInput.addEventListener('change', checkSalaryMonth);
    }

    const form = document.querySelector('form[action="{{ route('salaries.store') }}"]');
    if (form) {
        form.addEventListener('submit', async function (e) {
            const memberId = memberSelect ? memberSelect.value : '';
            const dateVal = dateInput ? dateInput.value : '';
            if (!memberId || !dateVal) return;

            e.preventDefault();
            try {
                const res = await fetch(`{{ route('salaries.checkMonthPaid') }}?team_member_id=${encodeURIComponent(memberId)}&date=${encodeURIComponent(dateVal)}`);
                const data = await res.json();
                if (data.paid) {
                    if (typeof showBlockedModal === 'function') {
                        showBlockedModal(data.message, '{{ addslashes(__('messages.salary_already_paid_title')) }}');
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

    // Run on initial load if old inputs exist
    if (memberSelect && memberSelect.value && dateInput && dateInput.value) {
        checkSalaryMonth();
    }
});
</script>
@endpush
@endsection
