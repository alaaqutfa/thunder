<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): Response
    {
        try {
            $request->authenticate();

            $user = Auth::user();

            // التحقق من حالة المستخدم
            if (!$user->is_active) {
                Auth::logout();
                return response([
                    'message' => 'Your account is disabled. Please contact administration.',
                ], 403);
            }

            // تحديث وقت آخر دخول (تحديث مباشر لتجنب استدعاء دالة غير معرفة)
            // Ensure $user is an Eloquent model with save(), otherwise use query builder update as fallback
            if ($user instanceof \App\Models\User) {
                $user->last_login_at = now();
                $user->save();
            } elseif (isset($user->id)) {
                \App\Models\User::where('id', $user->id)->update(['last_login_at' => now()]);
            }

            $request->session()->regenerate();

            return response()->noContent();

        } catch (\Illuminate\Validation\ValidationException $e) {
            // معالجة أخطاء المصادقة
            throw $e;
        } catch (\Exception $e) {
            // معالجة الأخطاء العامة
            return response([
                'message' => 'An error occurred during login. Please try again.',
            ], 500);
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): Response
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return response()->noContent();
    }
}
