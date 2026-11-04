<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Arr;
use Spatie\Permission\Models\Permission;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:user-list', ['only' => ['index', 'show']]);
        $this->middleware('permission:user-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:user-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:user-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */


    public function index(Request $request)
    {
        $query = User::orderBy('id','DESC');
        
        if (!auth()->user()->hasRole('Super Admin')) {
            $query->where('agency_id', auth()->user()->agency_id);
        }

        $perPage = $request->input('per_page', 10);
        $data = $query->paginate($perPage)->withQueryString();
        return view('users.index',compact('data'));
    }

    public function create()
    {
        $rolesQuery = Role::query();
        if (!auth()->user()->hasRole('Super Admin')) {
            $rolesQuery->where('name', '!=', 'Super Admin');
        }
        $roles = $rolesQuery->pluck('name','name')->all();

        // Pass available permissions
        $excludedPermissions = [
            'agency-list', 'agency-create', 'agency-edit', 'agency-delete',
            'role-list', 'role-create', 'role-edit', 'role-delete',
        ];
        $permissions = Permission::whereNotIn('name', $excludedPermissions)->get();

        return view('users.create', compact('roles', 'permissions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles' => 'required'
        ]);
    
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);

        if (!auth()->user()->hasRole('Super Admin')) {
            $input['agency_id'] = auth()->user()->agency_id;
        }

        // Sub-users created inside agency should never be marked as primary agency owner
        $input['is_owner'] = false;
    
        $user = User::create($input);
        $user->assignRole($request->input('roles'));

        if ($request->has('permissions')) {
            $user->syncPermissions($request->input('permissions'));
        }
    
        return redirect()->route('users.index')
                        ->with('success','User created successfully');
    }

    public function show($id)
    {
        $user = User::find($id);
        return view('users.show',compact('user'));
    }

    public function edit($id)
    {
        $user = User::find($id);
        $rolesQuery = Role::query();
        if (!auth()->user()->hasRole('Super Admin')) {
            $rolesQuery->where('name', '!=', 'Super Admin');
        }
        $roles = $rolesQuery->pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();
        
        $excludedPermissions = [
            'agency-list', 'agency-create', 'agency-edit', 'agency-delete',
            'role-list', 'role-create', 'role-edit', 'role-delete',
        ];
        $permissions = Permission::whereNotIn('name', $excludedPermissions)->get();
        $userPermissions = $user->permissions->pluck('name')->toArray();
    
        return view('users.edit', compact('user', 'roles', 'userRole', 'permissions', 'userPermissions'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'same:confirm-password',
            'roles' => 'required'
        ]);
    
        $input = $request->all();
        if(!empty($input['password'])){ 
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = Arr::except($input,array('password'));    
        }
    
        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id',$id)->delete();
    
        $user->assignRole($request->input('roles'));

        if ($request->has('permissions')) {
            $user->syncPermissions($request->input('permissions'));
        } else {
            $user->syncPermissions([]);
        }
    
        return redirect()->route('users.index')
                        ->with('success','User updated successfully');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        // 1. Prevent deleting Super Admin
        if ($user->hasRole('Super Admin')) {
            return redirect()->route('users.index')
                            ->with('error', __('messages.cannot_delete_super_admin'));
        }

        // 2. Prevent deleting Agency Owner / Primary Admin
        if ($user->isAgencyOwner()) {
            return redirect()->route('users.index')
                            ->with('error', __('messages.cannot_delete_agency_owner'));
        }

        // 3. Prevent deleting own active logged-in account
        if (auth()->id() === $user->id) {
            return redirect()->route('users.index')
                            ->with('error', __('messages.cannot_delete_yourself'));
        }

        // 4. Ensure non-super-admins cannot delete users outside their agency
        if (!auth()->user()->hasRole('Super Admin') && (int) $user->agency_id !== (int) auth()->user()->agency_id) {
            abort(403, 'Unauthorized action.');
        }

        $user->delete();
        return redirect()->route('users.index')
                        ->with('success', __('messages.user_deleted_successfully'));
    }
}
