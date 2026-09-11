<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\SearchController;
use App\Models\News;
use App\Models\WhyChooseUs;
use App\Models\Faq;
use App\Models\StudentLife;
use App\Models\Banner;
use App\Models\Admission;
use App\Models\Page;
use App\Models\Career;
use App\Models\CareerBanner;
// 📍 ថែម ៣ បន្ទាត់នេះសម្រាប់ Setup Database & Admin
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

// ១. ទំព័រដើម (Home)
Route::get('/', function () {
    $news = News::latest()->take(4)->get();
    $whyChooseUs = WhyChooseUs::all();
    $faqs = Faq::all();
    $banner = Banner::first(); 
    $admission = Admission::first(); 
    return view('welcome', compact('news', 'whyChooseUs', 'faqs', 'banner', 'admission')); 
});

// ២. ទំព័រឱកាសការងារ (Careers)
Route::get('/careers', function () {
    $jobs = Career::where('is_active', true)->latest()->get();
    $banner = CareerBanner::latest()->first(); 
    return view('careers', compact('jobs', 'banner'));
});

// ៣. ទំព័រទំនាក់ទំនង (Contact Us)
Route::get('/contact-us', [ContactController::class, 'index']);
Route::post('/contact-us', [ContactController::class, 'store']);

// ៤. ទំព័រប្រវត្តិសាលា (History & Governance)
Route::get('/history', function () {
    $faculties = \App\Models\Faculty::orderBy('sort_order', 'asc')->get(); 
    $timelines = \App\Models\Timeline::orderBy('year', 'asc')->get(); 
    $historySetting = \App\Models\HistorySetting::first();
    return view('history', compact('faculties', 'timelines', 'historySetting'));
});

// ៥. ទំព័រការទទួលស្គាល់ (Accreditations)
Route::get('/accreditations', function () {
    $accreditations = \App\Models\Accreditation::orderBy('sort_order', 'asc')->get();
    $setting = \App\Models\AccreditationSetting::first(); 
    return view('accreditations', compact('accreditations', 'setting'));
});

// ៦. ទំព័របរិវេណសាលា (Campus)
Route::get('/campus', function () {
    $campus = \App\Models\Campus::first();
    return view('campus', compact('campus'));
});

// ៧. ទំព័រគោលការណ៍កុមារ (Child Safeguarding)
Route::get('/child-safeguarding', function () {
    $safeguardings = \App\Models\ChildSafeguarding::all(); 
    return view('child-safeguarding', compact('safeguardings'));
});

// ៨. ទំព័រចុះឈ្មោះចូលរៀន (Enrollment)
Route::get('/enrollment', function () {
    $enrollment = \App\Models\EnrollmentPage::first();
    return view('enrollment', compact('enrollment'));
});

// ៩. ទំព័រតម្លៃសិក្សា (Tuition Fees)
Route::get('/tuition-fees', function () {
    $tuitionFees = \App\Models\TuitionFee::orderBy('sort_order', 'asc')->get();
    return view('tuition-fees', compact('tuitionFees'));
});

// ១០. ទំព័រព័ត៌មាន (News & Events)
Route::get('/news-events', function () {
    $newsList = News::latest()->get(); 
    return view('news-events', compact('newsList'));
});

// ១១. ទំព័រជីវិតសិស្ស (Student Life & Gallery)
Route::get('/student-life', function () {
    $activities = StudentLife::latest()->get(); 
    return view('student-life', compact('activities'));
});
Route::get('/student-life/{id}/gallery', function ($id) {
    $activity = \App\Models\StudentLife::findOrFail($id);
    return view('student-life-gallery', compact('activity'));
});

// ១២. ទំព័រស្វែងរក (Search Function)
Route::get('/search', [SearchController::class, 'index'])->name('search');

// ១៣. ទំព័រទូទៅតាមរយៈ ID
Route::get('/page/{id}', function ($id) {
    $page = Page::findOrFail($id);
    return view('page', compact('page'));
});

// កូដសម្រាប់កំណត់ការប្តូរភាសា (Language Switcher)
Route::get('lang/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'km'])) {
        session()->put('locale', $locale);
    }
    return redirect()->back();
})->name('lang.switch');


// 📍 ថែម Route ថ្មីនៅទីនេះ (ត្រូវតែនៅពីលើ Route '/{slug}') 📍
Route::get('/setup-db', function () {
    Artisan::call('migrate', ['--force' => true]);

    if (!User::where('email', 'admin@gmail.com')->exists()) {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password123'),
        ]);
        return 'ជោគជ័យ! តារាង Database និងគណនី Admin ត្រូវបានបង្កើតរួចរាល់។ សូមចូលទៅកាន់ទំព័រ /admin';
    }

    return 'គណនី Admin មានរួចរាល់ហើយ! សូមចូលទៅកាន់ទំព័រ /admin';
});


// ១៤. ទំព័រទូទៅតាមរយៈ Slug (Academics Pages) - ត្រូវនៅក្រោមគេបង្អស់ជានិច្ច!
Route::get('/{slug}', function ($slug) {
    $page = Page::where('slug', $slug)->firstOrFail();
    return view('page', compact('page'));
});