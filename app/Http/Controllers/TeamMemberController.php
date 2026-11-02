<?php

namespace App\Http\Controllers;

use App\Models\TeamMember;
use Illuminate\Http\Request;

class TeamMemberController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:team-member-list', ['only' => ['index', 'show', 'print']]);
        $this->middleware('permission:team-member-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:team-member-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:team-member-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = TeamMember::latest();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('mobile', 'like', "%{$search}%")
                  ->orWhere('designation', 'like', "%{$search}%")
                  ->orWhere('address', 'like', "%{$search}%");
            });
        }

        $teamMembers = $query->paginate(10)->withQueryString();
        $totalMembers = TeamMember::count();
        $totalSalaryExpense = TeamMember::sum('basic_salary');
        $uniqueDesignations = TeamMember::distinct('designation')->whereNotNull('designation')->count('designation');
        $activeMembers = TeamMember::count();

        return view('team_members.index', compact('teamMembers', 'totalMembers', 'totalSalaryExpense', 'uniqueDesignations', 'activeMembers'));
    }

    public function create()
    {
        return view('team_members.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'mobile' => 'required',
            'basic_salary' => 'required|numeric',
            'profile_pic' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'id_card_front' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'id_card_back' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $input = $request->all();

        if ($request->hasFile('profile_pic')) {
            $input['profile_pic'] = $request->file('profile_pic')->store('team_members', 'public');
        }
        if ($request->hasFile('id_card_front')) {
            $input['id_card_front'] = $request->file('id_card_front')->store('team_members', 'public');
        }
        if ($request->hasFile('id_card_back')) {
            $input['id_card_back'] = $request->file('id_card_back')->store('team_members', 'public');
        }

        TeamMember::create($input);

        return redirect()->route('team_members.index')
                        ->with('success', 'Team Member created successfully.');
    }

    public function show(TeamMember $teamMember)
    {
        return view('team_members.show', compact('teamMember'));
    }

    public function edit(TeamMember $teamMember)
    {
        return view('team_members.edit', compact('teamMember'));
    }

    public function update(Request $request, TeamMember $teamMember)
    {
        $request->validate([
            'name' => 'required',
            'mobile' => 'required',
            'basic_salary' => 'required|numeric',
            'profile_pic' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'id_card_front' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'id_card_back' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $input = $request->all();

        if ($request->hasFile('profile_pic')) {
            $input['profile_pic'] = $request->file('profile_pic')->store('team_members', 'public');
        }
        if ($request->hasFile('id_card_front')) {
            $input['id_card_front'] = $request->file('id_card_front')->store('team_members', 'public');
        }
        if ($request->hasFile('id_card_back')) {
            $input['id_card_back'] = $request->file('id_card_back')->store('team_members', 'public');
        }

        $teamMember->update($input);

        return redirect()->route('team_members.index')
                        ->with('success', 'Team Member updated successfully');
    }

    public function destroy(TeamMember $teamMember)
    {
        $teamMember->delete();

        return redirect()->route('team_members.index')
                        ->with('success', 'Team Member deleted successfully');
    }

    public function print(TeamMember $teamMember)
    {
        return view('team_members.print', compact('teamMember'));
    }
}
