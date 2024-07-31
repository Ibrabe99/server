<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MainCategoriesRequest;
use App\Models\MainCategory;
use App\Models\SubCategory;
use App\Models\Add_meal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SubCategoriesController extends Controller
{


    public function index()
    {
        // الحصول على اللغة الافتراضية
        $default_lang = get_default_language();

        // جلب الفئات الرئيسية بترتيب تصاعدي حسب الاسم
        $categories = SubCategory::where('translation_lang', $default_lang)
            ->selection()
            ->orderBy('name', 'asc')
            ->get();

        // عرض الفئات في العرض
        return view('admin.subcategories.index', compact('categories'));
    }



    public function create()
    {
        $categories = MainCategory::where('translation_of',0)->active()->get();
        return view('admin.subcategories.create', compact('categories'));
    }

    public function store(Request $request)
    {
        try {
            // استخراج المعلومات من الطلب
            $sub_categories = collect($request->category);

            // استخدام الفلتر للعثور على اللغة الافتراضية
            $filter = $sub_categories->filter(function ($value, $key) {
                return $value['abbr'] == get_default_language();
            });

            // استخراج اللغة الافتراضية
            $default_category = $filter->first();

            $filePath = "";
            if ($request->has('photo')) {
                // استخدام الدالة المساعدة
                $filePath = uploadImage('subcategories', $request->photo);

                // تحقق من المسار والصورة
                if (!$filePath || !file_exists(public_path($filePath))) {
                    throw new \Exception('Failed to upload image');
                }
            }

            $category_id = $request -> category_id;


            // بدء عملية الحفظ
            DB::beginTransaction();

            // إنشاء السجل الرئيسي وتخزين الصورة
            $default_category_id = SubCategory::create([
                'translation_lang' => $default_category['abbr'],
                'translation_of' => 0,
                'category_id' => $category_id,
                'name' => $default_category['name'],
                'slug' => $default_category['name'],
                'photo' => $filePath,
                'active' => $default_category['active'] ?? 1
            ])->id;

            // إنشاء السجلات الفرعية
            foreach ($sub_categories as $category) {
                if ($category['abbr'] != $default_category['abbr']) {
                    SubCategory::create([
                        'translation_lang' => $category['abbr'],
                        'translation_of' => $default_category_id,
                        'category_id' => $category_id,
                        'name' => $category['name'],
                        'slug' => $category['name'],
                        'photo' => $filePath,
                        'active' => $category['active'] ?? 1
                    ]);
                }
            }

            // إنهاء عملية الحفظ وتطبيق التغييرات
            DB::commit();

            return redirect()->route('admin.subcategories')->with(['success' => 'تم الحفظ بنجاح']);
        } catch (\Exception $ex) {
            // في حالة حدوث أي استثناء، يتم إلغاء التغييرات

            DB::rollback();
            return redirect()->route('admin.subcategories')->with(['error' => 'حدث خطأ ما برجاء المحاولة لاحقاً.']);
        }
    }






    public function edit($subCat_id)
    {
        $subCategory = SubCategory::with('categories')
            ->selection()
            ->find($subCat_id);

        if (!$subCategory)
            return redirect()->route('admin.subcategory')->with(['error' => 'هذا القسم غير موجود ']);

        return view('admin.subcategories.edit', compact('subCategory'));
        return get_default_language();
    }




    public function update($subCat_id, MainCategoriesRequest $request)
    {
        try {
            $sub_category = SubCategory::find($subCat_id);

            if (!$sub_category)
                return redirect()->route('admin.subcategories')->with(['error' => 'هذا القسم غير موجود ']);

            // تحديث الحقل الرئيسي
            $default_category = array_values($request->category)[0];

            if (!$request->has('category.0.active'))
                $request->request->add(['active' => 0]);
            else
                $request->request->add(['active' => 1]);

            SubCategory::where('id', $subCat_id)
                ->update([
                    'name' => $default_category['name'],
                    'active' => $request->active,
                ]);

            // حفظ الصورة
            if ($request->has('photo')) {
                $filePath = uploadImage('subcategories', $request->photo);
                SubCategory::where('id', $subCat_id)
                    ->update([
                        'photo' => $filePath,
                    ]);
            }

            // تحديث باقي اللغات
            foreach ($request->category as $category_data) {
                if ($category_data['abbr'] != $default_category['abbr']) {
                    SubCategory::where('translation_of', $subCat_id)
                        ->where('translation_lang', $category_data['abbr'])
                        ->update([
                            'name' => $category_data['name'],
                            'active' => $category_data['active'] ?? 0,
                        ]);
                }
            }

            return redirect()->route('admin.subcategories')->with(['success' => 'تم التحديث بنجاح']);
        } catch (\Exception $ex) {
            return redirect()->route('admin.subcategories')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }







    public function delete($id)
    {

        try {
            $subcategory = SubCategory::find($id);
            if (!$subcategory)
                return redirect()->route('admin.subcategories')->with(['error' => 'هذا القسم غير موجود ']);

            $vendors = $subcategory->vendors();
            if (isset($vendors) && $vendors->count() > 0) {
                return redirect()->route('admin.subcategories')->with(['error' => 'لا يمكن حذف هذا القسم  ']);
            }

            $image = Str::after($subcategory->photo, 'assets/');
            $image = base_path('public/assets/' . $image);
            unlink($image); //delete from folder

            $subcategory->delete();
            $subcategory -> categories() -> delete();
            return redirect()->route('admin.subategories')->with(['success' => 'تم حذف القسم بنجاح']);

        } catch (\Exception $ex) {
            return $ex;
            return redirect()->route('admin.subcategories')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }



    public function changeStatus($id)
    {
        try {
            $subcategory = SubCategory::find($id);
            if (!$subcategory)
                return redirect()->route('admin.subcategories')->with(['error' => 'هذا القسم غير موجود ']);

            $status =  $subcategory -> active  == 0 ? 1 : 0;

            $subcategory -> update(['active' =>$status ]);

            return redirect()->route('admin.subcategories')->with(['success' => ' تم تغيير الحالة بنجاح ']);

        } catch (\Exception $ex) {
            return redirect()->route('admin.subcategories')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }

}
