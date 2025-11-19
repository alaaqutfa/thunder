<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\DB;

class RegisteredUserController extends Controller
{
    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): Response
    {
        $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'phone'    => ['nullable', 'string', 'max:20'],
            'terms'    => ['required', 'accepted'], // التحقق من الموافقة على الشروط
        ]);

        // الدور الافتراضي
        $defaultRoleId = DB::table('roles')->where('slug', 'user')->value('id');

        $user = User::create([
            'name'          => $request->name,
            'email'         => $request->email,
            'password'      => Hash::make($request->password),
            'phone'         => $request->phone,
            'role_id'       => $defaultRoleId,
            'avatar'        => null,
            'is_active'     => true,  // أو false إذا تريد تفعيل يدوي
            'last_login_at' => now(), // أول دخول
        ]);

        event(new Registered($user));

        Auth::login($user);

        return response()->noContent();
    }
}
