<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/login');
});


Auth::routes();

// Agency Registration (Overriding default registration if needed, or adding specific name)
Route::get('/register', [App\Http\Controllers\Auth\AgencyRegisterController::class, 'showRegistrationForm'])->name('agency.register');
Route::post('/register', [App\Http\Controllers\Auth\AgencyRegisterController::class, 'register'])->name('agency.register.submit');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
    // Customer Management
    Route::resource('customers', App\Http\Controllers\CustomerController::class)->middleware('permission:customer-list');
    
    // Team Management
    Route::resource('team_members', App\Http\Controllers\TeamMemberController::class)->middleware('permission:team-member-list');
    Route::get('team_members/{team_member}/print', [App\Http\Controllers\TeamMemberController::class, 'print'])->name('team_members.print')->middleware('permission:team-member-list');
    
    // Attendance
    Route::get('attendances/download-pdf', [App\Http\Controllers\AttendanceController::class, 'downloadPdf'])->name('attendances.downloadPdf')->middleware('permission:attendance-list');
    Route::resource('attendances', App\Http\Controllers\AttendanceController::class)->middleware('permission:attendance-list');

    // Expenses
    Route::resource('expense_types', App\Http\Controllers\ExpenseTypeController::class)->middleware('permission:expense-list');
    Route::get('expenses/download-pdf', [App\Http\Controllers\ExpenseController::class, 'downloadPdf'])->name('expenses.downloadPdf')->middleware('permission:expense-list');
    Route::resource('expenses', App\Http\Controllers\ExpenseController::class)->middleware('permission:expense-list');

    // Salaries
    Route::get('salaries/download-pdf', [App\Http\Controllers\SalaryController::class, 'downloadPdf'])->name('salaries.downloadPdf')->middleware('permission:salary-list');
    Route::resource('salaries', App\Http\Controllers\SalaryController::class)->middleware('permission:salary-list');

    // Inventory
    Route::get('inventory/download-pdf', [App\Http\Controllers\InventoryController::class, 'downloadPdf'])->name('inventory.downloadPdf')->middleware('permission:inventory-list');
    Route::resource('inventory', App\Http\Controllers\InventoryController::class)->middleware('permission:inventory-list');

    // Sales
    Route::get('sales/export/pdf', [App\Http\Controllers\SaleController::class, 'downloadFilteredPdf'])->name('sales.exportFilteredPdf')->middleware('permission:sale-list');
    Route::get('sales/{sale}/download-pdf', [App\Http\Controllers\SaleController::class, 'downloadPdf'])->name('sales.downloadPdf')->middleware('permission:sale-list');
    Route::resource('sales', App\Http\Controllers\SaleController::class)->middleware('permission:sale-list');

    // Gas Readings
    Route::get('gas_readings/download-pdf', [App\Http\Controllers\GasReadingController::class, 'downloadPdf'])->name('gas_readings.downloadPdf')->middleware('permission:gas-reading-list');
    Route::resource('gas_readings', App\Http\Controllers\GasReadingController::class)->middleware('permission:gas-reading-list');

    // Customer Reports (Sales & Cylinder Breakdown)
    Route::get('customer_reports/download-pdf', [App\Http\Controllers\CustomerReportController::class, 'downloadPdf'])->name('customer_reports.downloadPdf')->middleware('permission:customer-report-list');
    Route::get('customer_reports', [App\Http\Controllers\CustomerReportController::class, 'index'])->name('customer_reports.index')->middleware('permission:customer-report-list');

    // Visa Details
    Route::get('visa_details/download-pdf', [App\Http\Controllers\VisaDetailController::class, 'downloadPdf'])->name('visa_details.downloadPdf')->middleware('permission:visa-detail-list');
    Route::resource('visa_details', App\Http\Controllers\VisaDetailController::class)->middleware('permission:visa-detail-list');

    // Roles & Users (Admin Only)
    Route::resource('roles', App\Http\Controllers\RoleController::class)->middleware('permission:role-list');
    Route::resource('users', App\Http\Controllers\UserController::class)->middleware('permission:user-list');

    // Agency Settings
    Route::get('/agency-settings', [App\Http\Controllers\AgencySettingController::class, 'index'])->name('agency_settings.index')->middleware('permission:agency-setting-list');
    Route::post('/agency-settings', [App\Http\Controllers\AgencySettingController::class, 'update'])->name('agency_settings.update')->middleware('permission:agency-setting-edit');

    Route::get('/reports/download/{type}', [App\Http\Controllers\ReportController::class, 'download'])->name('reports.download');
    Route::get('/reports/data', [App\Http\Controllers\ReportController::class, 'getData'])->name('reports.data');

    Route::get('/lang/{locale}', function ($locale) {
        if (in_array($locale, ['en', 'ar'])) {
            session()->put('locale', $locale);
        }
        return redirect()->back();
    })->name('lang.switch');

    // Profile Management
    Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');

    // Super Admin Routes
    Route::group(['prefix' => 'super-admin', 'as' => 'super_admin.', 'middleware' => ['permission:agency-list']], function () {
        Route::get('/dashboard', [App\Http\Controllers\SuperAdminDashboardController::class, 'index'])->name('dashboard');
        
        Route::get('/agencies', [App\Http\Controllers\SuperAdminController::class, 'index'])->name('agencies.index');
        Route::get('/agencies/create', [App\Http\Controllers\SuperAdminController::class, 'create'])->name('agencies.create');
        Route::post('/agencies', [App\Http\Controllers\SuperAdminController::class, 'store'])->name('agencies.store');
        Route::get('/agencies/{id}/edit', [App\Http\Controllers\SuperAdminController::class, 'edit'])->name('agencies.edit');
        Route::put('/agencies/{id}', [App\Http\Controllers\SuperAdminController::class, 'update'])->name('agencies.update');
        Route::delete('/agencies/{id}', [App\Http\Controllers\SuperAdminController::class, 'destroy'])->name('agencies.destroy');
        
        // Request Management
        Route::get('/requests', [App\Http\Controllers\SuperAdminController::class, 'manageRequests'])->name('requests.index');
        Route::get('/requests/{request}/process', [App\Http\Controllers\SuperAdminController::class, 'showProcessRequest'])->name('requests.process');
        Route::post('/requests/{request}/approve', [App\Http\Controllers\SuperAdminController::class, 'approve'])->name('requests.approve');
        Route::post('/requests/{request}/reject', [App\Http\Controllers\SuperAdminController::class, 'reject'])->name('requests.reject');
    });
});

// ══════════════════════════════════════════════════════════════════════
// HOSTINGER / SHARED HOSTING STORAGE SUPPORT
// ══════════════════════════════════════════════════════════════════════

// 1. One-click storage link creator (can be visited from browser: yoursite.com/create-symlink)
Route::get('/create-symlink', function () {
    try {
        \Illuminate\Support\Facades\Artisan::call('storage:link');
        return '<div style="font-family:sans-serif;padding:30px;text-align:center;"><h2 style="color:#16a34a;">Storage Link Created Successfully!</h2><p>Your symlink is now active.</p><a href="/home" style="display:inline-block;padding:10px 20px;background:#2563eb;color:#fff;border-radius:6px;text-decoration:none;">Go to Dashboard</a></div>';
    } catch (\Exception $e) {
        return '<div style="font-family:sans-serif;padding:30px;text-align:center;"><h2 style="color:#dc2626;">Error</h2><p>' . $e->getMessage() . '</p></div>';
    }
});

// 2. Direct storage image serving fallback
// Ensures images always display even if Hostinger symlinks fail, are missing, or blocked
Route::get('/storage/{path}', function ($path) {
    $basePath = realpath(storage_path('app/public'));
    $targetPath = storage_path('app/public/' . $path);
    $fullPath = realpath($targetPath);

    if (!$fullPath || !str_starts_with($fullPath, $basePath) || !is_file($fullPath)) {
        abort(404);
    }

    return response()->file($fullPath);
})->where('path', '.*');
