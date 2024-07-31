<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LanguageRequest;
use App\Models\Language;
use Illuminate\Http\Request;

class LanguagesController extends Controller
{


    public function index(){
        $languages = Language::all(); // جلب جميع اللغات من قاعدة البيانات
        return view('admin.languages.index', compact('languages'));
    }






    //////////////////////////################### begin create ###################\\\\\\\\\\\\\\\\\\\\\\\\\\

    public function create(){
        return view('admin.languages.create');
    }

    public function store(LanguageRequest $request){
        try {


            $language = Language::create($request->except(['_token']));
            $language->active = $request->has('active') ? 1 : 0;

            return redirect()->route('admin.languages')->with(['success' => 'تم حفظ اللغة بنجاح']);
        } catch (\Exception $ex) {
            return redirect()->route('admin.languages')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
        }
    }



    //////////////////////////###################  end create  ###################\\\\\\\\\\\\\\\\\\\\\\\\\\








    //////////////////////////################### begin edit ###################\\\\\\\\\\\\\\\\\\\\\\\\\\

    public function edit($id){

        $language = Language::find($id);

        if (!$language) {
            return redirect()->route('admin.languages')->with(['error' => 'اللغة غير موجودة']);
        }

        return view('admin.languages.edit', compact('language'));

    }

    public function update(LanguageRequest $request, $id)
    {
        try {
            // ابحث عن اللغة بواسطة المعرف (ID)
            $language = Language::find($id);

            $language->active = $request->has('active') ? 1 : 0;
            // إذا لم يتم العثور على اللغة، ارجع برسالة خطأ
            if (!$language) {
                    return redirect()->route('admin.languages.edit', $id)->with(['error' => 'هذه اللغة غير موجوده']);
                }

                // إذا لم يكن الحقل 'active' موجوداً في الطلب، أضفه بقيمة 0
                if (!$request->has('active'))
                    $request->request->add(['active' => 0]);

                // قم بتحديث اللغة باستخدام البيانات المرسلة، باستثناء حقل '_token'
                $language->update($request->except('_token'));

                // ارجع برسالة نجاح
                return redirect()->route('admin.languages')->with(['success' => 'تم تحديث اللغة بنجاح']);
                } catch (\Exception $ex) {
                    // في حال حدوث أي استثناء، ارجع برسالة خطأ عامة
                    return redirect()->route('admin.languages')->with(['error' => 'هناك خطأ ما يرجى المحاولة فيما بعد']);
                }
    }


    //////////////////////////###################  end edit  ###################\\\\\\\\\\\\\\\\\\\\\\\\\\







    //////////////////////////################### begin delete ###################\\\\\\\\\\\\\\\\\\\\\\\\\\

            public function delete($id)
            {
                try {
                    $language = Language::find($id);
                    if (!$language) {
                        return redirect()->route('admin.languages', $id)->with(['error' => 'هذه اللغة غير موجوده']);
                    }
                    $language->delete();

                    return redirect()->route('admin.languages')->with(['success' => 'تم حذف اللغة بنجاح']);

                    } catch (\Exception $ex) {
                        return redirect()->route('admin.languages')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
                    }
            }

    //////////////////////////###################  end delete  ###################\\\\\\\\\\\\\\\\\\\\\\\\\\



}
