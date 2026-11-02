@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb mb-4">
        <div class="d-flex justify-content-between align-items-center">
            <h2>{{ __('messages.create_user') }}</h2>
            <a class="btn btn-primary" href="{{ route('users.index') }}">{{ __('messages.back') }}</a>
        </div>
    </div>
</div>

@if (count($errors) > 0)
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
        <form action="{{ route('users.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                    <div class="form-group">
                        <label class="form-label"><strong>{{ __('messages.name') }}:</strong></label>
                        <input type="text" name="name" class="form-control" placeholder="{{ __('messages.name') }}">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                    <div class="form-group">
                        <label class="form-label"><strong>{{ __('messages.email') }}:</strong></label>
                        <input type="email" name="email" class="form-control" placeholder="{{ __('messages.email') }}">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                    <div class="form-group">
                        <label class="form-label"><strong>{{ __('messages.password') }}:</strong></label>
                        <input type="password" name="password" class="form-control" placeholder="{{ __('messages.password') }}">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                    <div class="form-group">
                        <label class="form-label"><strong>{{ __('messages.confirm_password') }}:</strong></label>
                        <input type="password" name="confirm-password" class="form-control" placeholder="{{ __('messages.confirm_password') }}">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 mb-4">
                    <div class="form-group">
                        <label class="form-label"><strong>{{ __('messages.account_type_role') }}:</strong></label>
                        <select class="form-control" name="roles[]">
                            @foreach($roles as $role)
                                <option value="{{ $role }}">{{ $role }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                    @php
                        $moduleMeta = [
                            'customer'        => ['label' => __('messages.customers'), 'icon' => 'fas fa-users', 'color' => '#2563eb'],
                            'team-member'     => ['label' => __('messages.team_members'), 'icon' => 'fas fa-user-friends', 'color' => '#10b981'],
                            'attendance'      => ['label' => __('messages.attendance'), 'icon' => 'fas fa-calendar-check', 'color' => '#06b6d4'],
                            'inventory'       => ['label' => __('messages.inventory'), 'icon' => 'fas fa-cubes', 'color' => '#8b5cf6'],
                            'sale'            => ['label' => __('messages.sales'), 'icon' => 'fas fa-shopping-cart', 'color' => '#3b82f6'],
                            'expense'         => ['label' => __('messages.expenses'), 'icon' => 'fas fa-receipt', 'color' => '#ef4444'],
                            'expense-type'    => ['label' => __('messages.expense_types'), 'icon' => 'fas fa-tags', 'color' => '#f97316'],
                            'salary'          => ['label' => __('messages.salaries'), 'icon' => 'fas fa-money-bill-wave', 'color' => '#14b8a6'],
                            'gas-reading'     => ['label' => __('messages.gas_readings'), 'icon' => 'fas fa-burn', 'color' => '#f59e0b'],
                            'customer-report' => ['label' => __('messages.customer_reports'), 'icon' => 'fas fa-file-invoice-dollar', 'color' => '#6366f1'],
                            'agency-setting'  => ['label' => __('messages.agency_settings'), 'icon' => 'fas fa-cog', 'color' => '#475569'],
                            'visa-detail'     => ['label' => __('messages.visa_details'), 'icon' => 'fas fa-passport', 'color' => '#ec4899'],
                            'user'            => ['label' => __('messages.staff_management'), 'icon' => 'fas fa-user-shield', 'color' => '#64748b'],
                        ];

                        $multiPrefixes = ['team-member', 'gas-reading', 'expense-type', 'customer-report', 'agency-setting', 'visa-detail'];

                        $grouped = [];
                        foreach ($permissions as $p) {
                            $key = null;
                            foreach ($multiPrefixes as $prefix) {
                                if (str_starts_with($p->name, $prefix . '-')) {
                                    $key = $prefix;
                                    break;
                                }
                            }
                            if (!$key) {
                                $key = explode('-', $p->name)[0];
                            }
                            $grouped[$key][] = $p;
                        }

                        // Order according to sidebar flow
                        $orderedGrouped = [];
                        foreach (array_keys($moduleMeta) as $k) {
                            if (isset($grouped[$k])) {
                                $orderedGrouped[$k] = $grouped[$k];
                            }
                        }
                        // Any remaining
                        foreach ($grouped as $k => $v) {
                            if (!isset($orderedGrouped[$k])) {
                                $orderedGrouped[$k] = $v;
                            }
                        }
                    @endphp

                    <div class="card border-0 shadow-sm rounded-4 mb-4" style="background: #f8fafc; border: 1.5px solid #e2e8f0 !important;">
                        <div class="card-header bg-white border-0 py-3 px-4 rounded-top-4 d-flex justify-content-between align-items-center flex-wrap gap-2">
                            <div>
                                <h5 class="mb-0 fw-bold text-dark d-flex align-items-center gap-2">
                                    <i class="fas fa-shield-alt text-primary"></i> {{ __('messages.module_permissions') }}
                                </h5>
                                <small class="text-muted">{{ __('messages.permissions_help') }}</small>
                            </div>
                            <div class="d-flex align-items-center gap-2 flex-wrap">
                                <span id="permCountBadge" class="badge rounded-pill bg-secondary px-3 py-2 fw-semibold">0 {{ __('messages.selected_count') }}</span>
                                <button type="button" class="btn btn-sm btn-outline-primary rounded-pill px-3 fw-bold" onclick="toggleAllGlobal(true)">
                                    <i class="fas fa-check-double me-1"></i> {{ __('messages.select_all_perms') }}
                                </button>
                                <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3 fw-bold" onclick="toggleAllGlobal(false)">
                                    <i class="fas fa-times me-1"></i> {{ __('messages.deselect_all') }}
                                </button>
                            </div>
                        </div>

                        <div class="card-body p-4">
                            <div class="row g-3">
                                @foreach($orderedGrouped as $group => $items)
                                    @php
                                        $meta = $moduleMeta[$group] ?? ['label' => ucfirst(str_replace('-', ' ', $group)), 'icon' => 'fas fa-folder', 'color' => '#2563eb'];
                                    @endphp
                                    <div class="col-xl-4 col-md-6">
                                        <div class="card h-100 border-0 shadow-sm rounded-3 permission-group-card" style="background: #ffffff; border: 1px solid #edf2f7 !important;">
                                            <div class="card-header bg-light py-2 px-3 border-0 d-flex justify-content-between align-items-center" style="border-radius: 10px 10px 0 0;">
                                                <div class="d-flex align-items-center gap-2">
                                                    <span style="color: {{ $meta['color'] }}; font-size: 15px;">
                                                        <i class="{{ $meta['icon'] }}"></i>
                                                    </span>
                                                    <strong class="text-dark small text-uppercase" style="letter-spacing: 0.5px;">{{ $meta['label'] }}</strong>
                                                </div>
                                                <a href="javascript:void(0)" class="text-muted small text-decoration-none fw-semibold" onclick="toggleGroup('{{ $group }}')" title="Select/Deselect all">
                                                    {{ __('messages.toggle_all') }}
                                                </a>
                                            </div>
                                            <div class="card-body p-3">
                                                @foreach($items as $value)
                                                    @php
                                                        $action = str_replace($group . '-', '', $value->name);
                                                        $actionLabels = [
                                                            'list'   => ['label' => __('messages.list_view_perm'), 'badge' => 'bg-info bg-opacity-10 text-info'],
                                                            'create' => ['label' => __('messages.create_add_perm'), 'badge' => 'bg-success bg-opacity-10 text-success'],
                                                            'edit'   => ['label' => __('messages.edit_update_perm'), 'badge' => 'bg-warning bg-opacity-10 text-warning'],
                                                            'delete' => ['label' => __('messages.delete_perm'), 'badge' => 'bg-danger bg-opacity-10 text-danger'],
                                                        ];
                                                        $actionInfo = $actionLabels[$action] ?? ['label' => ucfirst($action), 'badge' => 'bg-secondary bg-opacity-10 text-secondary'];
                                                    @endphp
                                                    <div class="form-check py-1">
                                                        <input class="form-check-input perm-checkbox group-{{ $group }}"
                                                               type="checkbox"
                                                               name="permissions[]"
                                                               value="{{ $value->name }}"
                                                               id="perm_{{ $value->id }}"
                                                               onchange="updatePermCount()">
                                                        <label class="form-check-label small d-flex justify-content-between align-items-center w-100" for="perm_{{ $value->id }}">
                                                            <span class="text-dark fw-medium">{{ $actionInfo['label'] }}</span>
                                                            <code class="text-muted" style="font-size: 10px;">{{ $value->name }}</code>
                                                        </label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <script>
                    function updatePermCount() {
                        const total = document.querySelectorAll('.perm-checkbox').length;
                        const checked = document.querySelectorAll('.perm-checkbox:checked').length;
                        const badge = document.getElementById('permCountBadge');
                        if (badge) {
                            badge.textContent = `${checked} / ${total} {{ __('messages.selected_count') }}`;
                            badge.className = checked > 0
                                ? 'badge rounded-pill bg-success px-3 py-2 fw-semibold'
                                : 'badge rounded-pill bg-secondary px-3 py-2 fw-semibold';
                        }
                    }

                    function toggleAllGlobal(state) {
                        document.querySelectorAll('.perm-checkbox').forEach(cb => {
                            cb.checked = state;
                        });
                        updatePermCount();
                    }

                    function toggleGroup(group) {
                        const checkboxes = document.querySelectorAll(`.group-${group}`);
                        const allChecked = Array.from(checkboxes).every(cb => cb.checked);
                        checkboxes.forEach(cb => {
                            cb.checked = !allChecked;
                        });
                        updatePermCount();
                    }

                    document.addEventListener('DOMContentLoaded', updatePermCount);
                </script>
                <div class="col-xs-12 col-sm-12 col-md-12 text-center mt-3">
                    <button type="submit" class="btn btn-primary">{{ __('messages.submit') }}</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
