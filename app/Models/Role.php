<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Role extends Model
{
    use HasFactory;

    /**
     * الحقول التي يمكن تعبئتها جماعياً
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'slug',
        'description',
        'is_active',
        'order'
    ];

    /**
     * الحقول التي يجب إخفاؤها عند التحويل إلى JSON
     *
     * @var array
     */
    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    /**
     * الحقول التي يجب تحويلها إلى أنواع بيانات محددة
     *
     * @var array
     */
    protected $casts = [
        'is_active' => 'boolean',
        'order' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    /**
     * نطاق الاستعلام للأدوار النشطة فقط
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * نطاق الاستعلام للترتيب
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('order')->orderBy('name');
    }

    /**
     * العلاقة مع المستخدمين
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    /**
     * العلاقة مع الصلاحيات
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class, 'role_permission')
                    ->withTimestamps();
    }

    /**
     * الحصول على عدد المستخدمين النشطين
     *
     * @return int
     */
    public function getActiveUsersCountAttribute(): int
    {
        return $this->users()->where('is_active', true)->count();
    }

    /**
     * التحقق مما إذا كان للدور صلاحية معينة
     *
     * @param string $permission
     * @return bool
     */
    public function hasPermission(string $permission): bool
    {
        return $this->permissions()->where('slug', $permission)->exists();
    }

    /**
     * إضافة صلاحية للدور
     *
     * @param string|array $permissions
     * @return void
     */
    public function assignPermission($permissions): void
    {
        if (is_string($permissions)) {
            $permissions = [$permissions];
        }

        $permissionIds = Permission::whereIn('slug', $permissions)
            ->pluck('id')
            ->toArray();

        $this->permissions()->syncWithoutDetaching($permissionIds);
    }

    /**
     * إزالة صلاحية من الدور
     *
     * @param string|array $permissions
     * @return void
     */
    public function removePermission($permissions): void
    {
        if (is_string($permissions)) {
            $permissions = [$permissions];
        }

        $permissionIds = Permission::whereIn('slug', $permissions)
            ->pluck('id')
            ->toArray();

        $this->permissions()->detach($permissionIds);
    }

    /**
     * مزامنة الصلاحيات للدور
     *
     * @param array $permissions
     * @return void
     */
    public function syncPermissions(array $permissions): void
    {
        $permissionIds = Permission::whereIn('slug', $permissions)
            ->pluck('id')
            ->toArray();

        $this->permissions()->sync($permissionIds);
    }
}
