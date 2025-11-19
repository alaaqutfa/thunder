<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessSetting extends Model
{
    use HasFactory;

    /**
     * الحقول التي يمكن تعبئتها جماعياً
     *
     * @var array
     */
    protected $fillable = [
        'type',
        'value',
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
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * الحصول على قيمة إعداد حسب النوع
     *
     * @param string $type
     * @return string|null
     */
    public static function getValue($type)
    {
        $setting = self::where('type', $type)->first();
        return $setting ? $setting->value : null;
    }

    /**
     * حفظ أو تحديث إعداد
     *
     * @param string $type
     * @param string $value
     * @return void
     */
    public static function setValue($type, $value)
    {
        self::updateOrCreate(
            ['type' => $type],
            ['value' => $value]
        );
    }

    /**
     * الحصول على جميع الإعدادات كمصفوفة
     *
     * @return array
     */
    public static function getAllSettings()
    {
        return self::all()->pluck('value', 'type')->toArray();
    }
}
