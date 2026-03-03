<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;

class StaffController extends Controller
{
    public function index()
    {
        $staff = User::where('role_id', '!=', 5)->with('role')->paginate(10);
        return view('admin.staff.index', compact('staff'));
    }

    public function create()
    {
        $roles = Role::where('id', '!=', 5)->orderBy('name')->get();
        return view('admin.staff.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'          => ['required', 'string', 'max:255'],
            'email'         => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone'         => ['nullable', 'string', 'max:20'],
            'password'      => ['required', 'confirmed', Rules\Password::defaults()],
            'role_id'       => ['required', 'exists:roles,id', function ($attribute, $value, $fail) {
                if ($value == 5) {
                    $fail('The customer role cannot be assigned to employees.');
                }
            }],
            'is_active'     => ['sometimes', 'boolean'],
            'show_in_team'  => ['sometimes', 'boolean'],
            'team_position' => ['nullable', 'string', 'max:255'],
        ]);

        $avatarPath = null;
        if ($request->hasFile('avatar')) {
            $avatar     = $request->file('avatar');
            $avatarName = 'avatar_' . time() . '_' . Str::random(10) . '.' . $avatar->getClientOriginalExtension();
            $avatarPath = $avatar->storeAs('avatars', $avatarName, 'public');
        }

        User::create([
            'name'          => $request->name,
            'email'         => $request->email,
            'phone'         => $request->phone,
            'password'      => Hash::make($request->password),
            'role_id'       => $request->role_id,
            'is_active'     => $request->has('is_active'),
            'show_in_team'  => $request->has('show_in_team'),
            'team_position' => $request->team_position,
            'avatar'        => $avatarPath,
        ]);

        return redirect()->route('admin.staff.index')->with('success', 'The employee was added successfully.');
    }

    public function edit(User $staff)
    {
        if ($staff->role_id == 5) {
            abort(403, 'The customer role cannot be modified.');
        }

        $roles = Role::where('id', '!=', 5)->orderBy('name')->get();
        return view('admin.staff.edit', compact('staff', 'roles'));
    }

    public function update(Request $request, User $staff)
    {
        if ($staff->role_id == 5) {
            abort(403, 'The customer role cannot be modified.');

        }

        $request->validate([
            'name'          => ['required', 'string', 'max:255'],
            'email'         => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $staff->id],
            'phone'         => ['nullable', 'string', 'max:20'],
            'password'      => ['nullable', 'confirmed', Rules\Password::defaults()],
            'role_id'       => ['required', 'exists:roles,id', function ($attribute, $value, $fail) {
                if ($value == 5) {
                    $fail('The customer role cannot be assigned to employees.');
                }
            }],
            'is_active'     => ['sometimes', 'boolean'],
            'show_in_team'  => ['sometimes', 'boolean'],
            'team_position' => ['nullable', 'string', 'max:255'],
        ]);

        $data = [
            'name'          => $request->name,
            'email'         => $request->email,
            'phone'         => $request->phone,
            'role_id'       => $request->role_id,
            'is_active'     => $request->has('is_active'),
            'show_in_team'  => $request->has('show_in_team'),
            'team_position' => $request->team_position,
        ];

        if ($request->hasFile('avatar')) {
            // حذف الصورة القديمة إذا وجدت (اختياري)
            if ($staff->avatar) {
                Storage::disk('public')->delete($staff->avatar);
            }
            $avatar         = $request->file('avatar');
            $avatarName     = 'avatar_' . time() . '_' . Str::random(10) . '.' . $avatar->getClientOriginalExtension();
            $data['avatar'] = $avatar->storeAs('avatars', $avatarName, 'public');
        }

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $staff->update($data);

        return redirect()->route('admin.staff.index')->with('success', 'The employee details were updated successfully.');
    }

    public function toggleStatus(User $staff)
    {
        if ($staff->role_id == 5) {
            abort(403, 'The customer role cannot be modified.');
        }

        $staff->is_active = ! $staff->is_active;
        $staff->save();

        return redirect()->route('admin.staff.index')->with('success', 'The employee status was updated successfully.');
    }

    public function toggleTeam(User $staff)
    {
        if ($staff->role_id == 5) {
            abort(403, 'Cannot modify customer role.');
        }

        $staff->show_in_team = ! $staff->show_in_team;
        $staff->save();

        return redirect()->route('admin.staff.index')->with('success', 'Team visibility updated successfully.');
    }

    public function destroy(User $staff)
    {
        if ($staff->role_id == 5) {
            abort(403, 'The customer role cannot be deleted.');
        }

        $staff->delete();

        return redirect()->route('admin.staff.index')->with('success', 'The employee was deleted successfully.');
    }
}
