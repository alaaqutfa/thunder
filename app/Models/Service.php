<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Service extends Model
{
    use HasFactory;

    /**
     * الحقول التي يمكن تعبئتها جماعياً
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'icon',
        'slug',
        'order',
        'is_active',
    ];

    /**
     * الحقول التي يجب إخفاؤها عند التحويل إلى JSON
     *
     * @var array
     */
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    /**
     * الحقول التي يجب تحويلها إلى أنواع بيانات محددة
     *
     * @var array
     */
    protected $casts = [
        'order'      => 'integer',
        'is_active'  => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * نطاق الاستعلام للخدمات النشطة فقط
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
     * العلاقة مع المشاريع
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function projects(): HasMany
    {
        return $this->hasMany(Project::class);
    }

    /**
     * الحصول على المشاريع النشطة فقط
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function activeProjects(): HasMany
    {
        return $this->hasMany(Project::class)->active();
    }

    /**
     * الحصول على عدد المشاريع النشطة
     *
     * @return int
     */
    public function getActiveProjectsCountAttribute(): int
    {
        return $this->activeProjects()->count();
    }

    /**
     * الحصول على أيقونة الخدمة مع قيمة افتراضية
     *
     * @return string
     */
    public function getIconAttribute($value): string
    {
        return $value ?: 'fas fa-cube';
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($service) {
            if (empty($service->slug)) {
                $service->slug = \Illuminate\Support\Str::slug($service->name);
            }
        });

        static::updating(function ($service) {
            if ($service->isDirty('name') && empty($service->slug)) {
                $service->slug = \Illuminate\Support\Str::slug($service->name);
            }
        });
    }
}
