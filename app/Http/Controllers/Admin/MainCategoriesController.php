<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MainCategoriesRequest;
use App\Http\Requests\MainCategoryRequest;
use App\Models\MainCategory;
use App\Models\Add_meal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class MainCategoriesController extends Controller
{
    public function index()
    {
        // الحصول على اللغة الافتراضية
        $default_lang = get_default_language();

        // جلب الفئات الرئيسية بترتيب تصاعدي حسب الاسم
        $categories = MainCategory::where('translation_lang', $default_lang)
            ->selection()
            ->orderBy('name', 'asc')
            ->get();

        // عرض الفئات في العرض
        return view('admin.maincategories.index', compact('categories'));
    }


    public function create()
    {
        return view('admin.maincategories.create');
    }





    public function store(MainCategoriesRequest $request)
    {
        try {
            // استخراج المعلومات من الطلب
            $main_categories = collect($request->category);

            // استخدام الفلتر للعثور على اللغة الافتراضية
            $filter = $main_categories->filter(function ($value, $key) {
                return $value['abbr'] == get_default_language();
            });

            // استخراج اللغة الافتراضية
            $default_category = $filter->first();

            $filePath = "";
            if ($request->has('photo')) {
                // استخدام الدالة المساعدة
                $filePath = uploadImage('maincategories', $request->photo);

                // تحقق من المسار والصورة
                if (!$filePath || !file_exists(public_path($filePath))) {
                    throw new \Exception('Failed to upload image');
                }
            }

            // بدء عملية الحفظ
            DB::beginTransaction();

            // إنشاء السجل الرئيسي وتخزين الصورة
            $default_category_id = MainCategory::create([
                'translation_lang' => $default_category['abbr'],
                'translation_of' => 0,
                'name' => $default_category['name'],
                'slug' => $default_category['name'],
                'photo' => $filePath,
                'active' => $default_category['active'] ?? 1
            ])->id;

            // إنشاء السجلات الفرعية
            foreach ($main_categories as $category) {
                if ($category['abbr'] != $default_category['abbr']) {
                    MainCategory::create([
                        'translation_lang' => $category['abbr'],
                        'translation_of' => $default_category_id,
                        'name' => $category['name'],
                        'slug' => $category['name'],
                        'photo' => $filePath,
                        'active' => $category['active'] ?? 1
                    ]);
                }
            }

            // إنهاء عملية الحفظ وتطبيق التغييرات
            DB::commit();

            return redirect()->route('admin.maincategories')->with(['success' => 'تم الحفظ بنجاح']);
        } catch (\Exception $ex) {
            // في حالة حدوث أي استثناء، يتم إلغاء التغييرات
            DB::rollback();
            return redirect()->route('admin.maincategories')->with(['error' => 'حدث خطأ ما برجاء المحاولة لاحقاً.']);
        }
    }






    public function edit($mainCat_id)
    {
         $mainCategory = MainCategory::with('categories')
             ->selection()
             ->find($mainCat_id);

         if (!$mainCategory)
             return redirect()->route('admin.maincategory')->with(['error' => 'هذا القسم غير موجود ']);

         return view('admin.maincategories.edit', compact('mainCategory'));
        return get_default_language();
    }




    public function update($mainCat_id, MainCategoriesRequest $request)
    {
        try {
            $main_category = MainCategory::find($mainCat_id);

            if (!$main_category)
                return redirect()->route('admin.maincategories')->with(['error' => 'هذا القسم غير موجود ']);

            // تحديث الحقل الرئيسي
            $default_category = array_values($request->category)[0];

            if (!$request->has('category.0.active'))
                $request->request->add(['active' => 0]);
            else
                $request->request->add(['active' => 1]);

            MainCategory::where('id', $mainCat_id)
                ->update([
                    'name' => $default_category['name'],
                    'active' => $request->active,
                ]);

            // حفظ الصورة
            if ($request->has('photo')) {
                $filePath = uploadImage('maincategories', $request->photo);
                MainCategory::where('id', $mainCat_id)
                    ->update([
                        'photo' => $filePath,
                    ]);
            }

            // تحديث باقي اللغات
            foreach ($request->category as $category_data) {
                if ($category_data['abbr'] != $default_category['abbr']) {
                    MainCategory::where('translation_of', $mainCat_id)
                        ->where('translation_lang', $category_data['abbr'])
                        ->update([
                            'name' => $category_data['name'],
                            'active' => $category_data['active'] ?? 0,
                        ]);
                }
            }

            return redirect()->route('admin.maincategories')->with(['success' => 'تم التحديث بنجاح']);
        } catch (\Exception $ex) {
            return redirect()->route('admin.maincategories')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }







    public function delete($id)
    {

        try {
            $maincategory = MainCategory::find($id);
            if (!$maincategory)
                return redirect()->route('admin.maincategories')->with(['error' => 'هذا القسم غير موجود ']);

            $vendors = $maincategory->vendors();
            if (isset($vendors) && $vendors->count() > 0) {
                return redirect()->route('admin.maincategories')->with(['error' => 'لا يمكن حذف هذا القسم  ']);
            }

            $image = Str::after($maincategory->photo, 'assets/');
            $image = base_path('public/assets/' . $image);
            unlink($image); //delete from folder

            $maincategory->delete();
            $maincategory -> categories() -> delete();
            return redirect()->route('admin.maincategories')->with(['success' => 'تم حذف القسم بنجاح']);

        } catch (\Exception $ex) {
            return redirect()->route('admin.maincategories')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }



    public function changeStatus($id)
    {
        try {
            $maincategory = MainCategory::find($id);
            if (!$maincategory)
                return redirect()->route('admin.maincategories')->with(['error' => 'هذا القسم غير موجود ']);

           $status =  $maincategory -> active  == 0 ? 1 : 0;

           $maincategory -> update(['active' =>$status ]);

            return redirect()->route('admin.maincategories')->with(['success' => ' تم تغيير الحالة بنجاح ']);

        } catch (\Exception $ex) {
            return redirect()->route('admin.maincategories')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }

}
