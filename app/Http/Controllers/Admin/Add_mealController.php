<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MainCategoriesRequest;
use App\Models\Add_meal;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class Add_mealController extends Controller
{

    public function index()
    {
        // الحصول على اللغة الافتراضية
        $default_lang = get_default_language();

        // جلب الفئات الرئيسية بترتيب تصاعدي حسب الاسم
        $meals = Add_meal::where('translation_lang', $default_lang)
            ->selection()
            ->orderBy('name', 'asc')
            ->get();

        // عرض الفئات في العرض
        return view('admin.meals.index', compact('meals'));
    }



    public function create()
    {
        $categories = SubCategory::where('translation_of', 0)->active()->get();
        return view('admin.meals.create', compact('categories'));
    }


    public function store(MainCategoriesRequest $request)
    {
        try {
            // استخراج المعلومات من الطلب
            $add_meal = collect($request->meal);

            // استخدام الفلتر للعثور على اللغة الافتراضية
            $filter = $add_meal->filter(function ($value, $key) {
                return $value['abbr'] == get_default_language();
            });

            // استخراج اللغة الافتراضية
            $default_meal = $filter->first();

            if (!$default_meal) {
                throw new \Exception('Default language meal data is missing.');
            }

            $filePath = "";
            if ($request->has('photo')) {
                // استخدام الدالة المساعدة
                $filePath = uploadImage('meals', $request->photo);

                // تحقق من المسار والصورة
                if (!$filePath || !file_exists(public_path($filePath))) {
                    throw new \Exception('Failed to upload image');
                }
            }

            $category_id = $request->category_id;
            $price = $request->price;
            $description = $default_meal['description'] ?? '';

            // بدء عملية الحفظ
            DB::beginTransaction();

            // إنشاء السجل الرئيسي وتخزين الصورة
            $default_meal_id = Add_meal::create([
                'translation_lang' => $default_meal['abbr'],
                'translation_of' => 0,
                'category_id' => $category_id,
                'name' => $default_meal['name'],
                'slug' => $default_meal['name'],
                'price' => $price,
                'description' => $description,
                'photo' => $filePath,
                'active' => $default_meal['active'] ?? 1
            ])->id;

            // إنشاء السجلات الفرعية
            foreach ($add_meal as $meal) {
                if ($meal['abbr'] != $default_meal['abbr']) {
                    Add_meal::create([
                        'translation_lang' => $meal['abbr'],
                        'translation_of' => $default_meal_id,
                        'category_id' => $category_id,
                        'name' => $meal['name'],
                        'slug' => $meal['name'],
                        'price' => $price,
                        'description' => $meal['description'] ?? '',
                        'photo' => $filePath,
                        'active' => $meal['active'] ?? 1
                    ]);
                }
            }

            // إنهاء عملية الحفظ وتطبيق التغييرات
            DB::commit();

            return redirect()->route('admin.meals')->with(['success' => 'تم الحفظ بنجاح']);
        } catch (\Exception $ex) {
            // في حالة حدوث أي استثناء، يتم إلغاء التغييرات
            DB::rollback();

            // إرسال رسالة الخطأ إلى الجلسة لعرضها في العرض
            return redirect()->route('admin.meals.create')->with(['error' => 'حدث خطأ ما برجاء المحاولة لاحقاً: ' . $ex->getMessage()]);
        }
    }

}
