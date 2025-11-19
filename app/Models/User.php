<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'phone',
        'avatar',
        'is_active'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'last_login_at' => 'datetime',
            'is_active' => 'boolean',
        ];
    }

    /**
     * العلاقة مع الدور
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * العلاقة مع الصلاحيات من خلال الدور
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function permissions(): BelongsToMany
    {
        return $this->role->permissions();
    }

    /**
     * نطاق الاستعلام للمستخدمين النشطين فقط
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * نطاق الاستعلام للمستخدمين حسب الدور
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $roleSlug
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeByRole($query, $roleSlug)
    {
        return $query->whereHas('role', function ($q) use ($roleSlug) {
            $q->where('slug', $roleSlug);
        });
    }

    /**
     * التحقق مما إذا كان المستخدم لديه دور معين
     *
     * @param string $roleSlug
     * @return bool
     */
    public function hasRole(string $roleSlug): bool
    {
        return $this->role && $this->role->slug === $roleSlug;
    }

    /**
     * التحقق مما إذا كان المستخدم لديه أي من الأدوار المحددة
     *
     * @param array $roleSlugs
     * @return bool
     */
    public function hasAnyRole(array $roleSlugs): bool
    {
        return $this->role && in_array($this->role->slug, $roleSlugs);
    }

    /**
     * التحقق مما إذا كان المستخدم لديه صلاحية معينة
     *
     * @param string $permission
     * @return bool
     */
    public function hasPermission(string $permission): bool
    {
        if (!$this->role) {
            return false;
        }

        // إذا كان المستخدم مديراً، فلديه جميع الصلاحيات
        if ($this->isAdmin()) {
            return true;
        }

        return $this->role->hasPermission($permission);
    }

    /**
     * التحقق مما إذا كان المستخدم لديه أي من الصلاحيات المحددة
     *
     * @param array $permissions
     * @return bool
     */
    public function hasAnyPermission(array $permissions): bool
    {
        foreach ($permissions as $permission) {
            if ($this->hasPermission($permission)) {
                return true;
            }
        }

        return false;
    }

    /**
     * التحقق مما إذا كان المستخدم لديه جميع الصلاحيات المحددة
     *
     * @param array $permissions
     * @return bool
     */
    public function hasAllPermissions(array $permissions): bool
    {
        foreach ($permissions as $permission) {
            if (!$this->hasPermission($permission)) {
                return false;
            }
        }

        return true;
    }

    /**
     * الحصول على قائمة الصلاحيات الخاصة بالمستخدم
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getPermissions()
    {
        return $this->role ? $this->role->permissions : collect();
    }

    /**
     * الحصول على اسم الدور أو قيمة افتراضية
     *
     * @return string
     */
    public function getRoleNameAttribute(): string
    {
        return $this->role ? $this->role->name : 'بدون دور';
    }

    /**
     * الحصول على الصورة الشخصية أو صورة افتراضية
     *
     * @return string
     */
    public function getAvatarUrlAttribute(): string
    {
        return $this->avatar ? asset('storage/' . $this->avatar) : asset('images/default-avatar.png');
    }

    /**
     * تحديث وقت آخر تسجيل دخول
     *
     * @return void
     */
    public function updateLastLogin(): void
    {
        $this->last_login_at = now();
        $this->save();
    }

    /**
     * التحقق مما إذا كان المستخدم مديراً
     *
     * @return bool
     */
    public function isAdmin(): bool
    {
        return $this->hasRole('admin');
    }

    /**
     * التحقق مما إذا كان المستخدم موظفاً
     *
     * @return bool
     */
    public function isEmployee(): bool
    {
        return $this->hasRole('employee');
    }

    /**
     * التحقق مما إذا كان المستخدم مصمماً
     *
     * @return bool
     */
    public function isDesigner(): bool
    {
        return $this->hasRole('designer');
    }
}
