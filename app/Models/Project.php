<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Project extends Model
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
        'main_image',
        'gallery_images',
        'service_id',
        'order',
        'is_active'
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
        'gallery_images' => 'array',
        'order' => 'integer',
        'is_active' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    /**
     * نطاق الاستعلام للمشاريع النشطة فقط
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
        return $query->orderBy('order')->orderBy('created_at', 'desc');
    }

    /**
     * نطاق الاستعلام للمشاريع حسب الخدمة
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param int $serviceId
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeByService($query, $serviceId)
    {
        return $query->where('service_id', $serviceId);
    }

    /**
     * العلاقة مع الخدمة
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    /**
     * الحصول على الصور المعرضة كمصفوفة
     *
     * @return array
     */
    public function getGalleryImagesArrayAttribute(): array
    {
        return $this->gallery_images ?: [];
    }

    /**
     * الحصول على عدد الصور في المعرض
     *
     * @return int
     */
    public function getGalleryImagesCountAttribute(): int
    {
        return count($this->gallery_images_array);
    }

    /**
     * الحصول على أول صورة في المعرض أو الصورة الرئيسية
     *
     * @return string
     */
    public function getFirstGalleryImageAttribute(): string
    {
        $galleryImages = $this->gallery_images_array;
        return !empty($galleryImages) ? $galleryImages[0] : $this->main_image;
    }

    /**
     * التحقق مما إذا كان للمشروع صور معرضة
     *
     * @return bool
     */
    public function hasGalleryImages(): bool
    {
        return $this->gallery_images_count > 0;
    }

    /**
     * إضافة صورة إلى المعرض
     *
     * @param string $imagePath
     * @return void
     */
    public function addGalleryImage(string $imagePath): void
    {
        $galleryImages = $this->gallery_images_array;
        $galleryImages[] = $imagePath;
        $this->gallery_images = $galleryImages;
        $this->save();
    }

    /**
     * إزالة صورة من المعرض
     *
     * @param string $imagePath
     * @return void
     */
    public function removeGalleryImage(string $imagePath): void
    {
        $galleryImages = $this->gallery_images_array;
        $key = array_search($imagePath, $galleryImages);

        if ($key !== false) {
            unset($galleryImages[$key]);
            $this->gallery_images = array_values($galleryImages);
            $this->save();
        }
    }
}
