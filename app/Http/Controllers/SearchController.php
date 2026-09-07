<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use App\Models\Career;
use App\Models\Page;
use App\Models\StudentLife;
use App\Models\Faq;
use App\Models\WhyChooseUs;
use App\Models\ChildSafeguarding;
use App\Models\TuitionFee;
use App\Models\Campus;
use App\Models\Accreditation;
use App\Models\Faculty;
use App\Models\EnrollmentPage;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('query');
        $lowerQuery = strtolower($query); // Convert search query to lowercase

        if (empty($query)) {
            return view('search-results', ['query' => $query, 'totalResults' => 0]);
        }

        $matchedStaticPages = collect();

        // 1. Search Static Pages
        $staticPagesMap = [
            ['title' => 'Child Safeguarding', 'url' => '/child-safeguarding', 'desc' => 'Child protection and safety policies at Life International School.'],
            ['title' => 'History & Governance', 'url' => '/history', 'desc' => 'Our school history and governance structure.'],
            ['title' => 'Accreditations', 'url' => '/accreditations', 'desc' => 'Educational quality recognition from national and international institutions.'],
            ['title' => 'Campus', 'url' => '/campus', 'desc' => 'Explore our campus and modern facilities.'],
            ['title' => 'Enrollment', 'url' => '/enrollment', 'desc' => 'Information and procedures for student enrollment.'],
            ['title' => 'Tuition Fees', 'url' => '/tuition-fees', 'desc' => 'Detailed information about tuition fees and payments.'],
            ['title' => 'Contact Us', 'url' => '/contact-us', 'desc' => 'Contact Life International School.'],
            ['title' => 'Student Life', 'url' => '/student-life', 'desc' => 'Learn about student life and extracurricular activities.'],
            ['title' => 'News / Events', 'url' => '/news-events', 'desc' => 'Latest school news and events.'],
        ];

        foreach ($staticPagesMap as $page) {
            if (str_contains(strtolower($page['title']), $lowerQuery) || str_contains(strtolower($page['desc']), $lowerQuery)) {
                $matchedStaticPages->put($page['url'], $page);
            }
        }

        // 2. Search in Database (Using whereRaw('LOWER(...) LIKE ?') to resolve ILIKE issues)
        $news = collect();
        try { $news = News::whereRaw('LOWER(title) LIKE ?', ["%$lowerQuery%"])->orWhereRaw('LOWER(description) LIKE ?', ["%$lowerQuery%"])->get(); } catch (\Exception $e) {}

        $pages = collect();
        try { $pages = Page::whereRaw('LOWER(title) LIKE ?', ["%$lowerQuery%"])->orWhereRaw('LOWER(content) LIKE ?', ["%$lowerQuery%"])->get(); } catch (\Exception $e) {}

        $careers = collect();
        try { $careers = Career::whereRaw('LOWER(title) LIKE ?', ["%$lowerQuery%"])->orWhereRaw('LOWER(description) LIKE ?', ["%$lowerQuery%"])->get(); } catch (\Exception $e) {}

        $studentLife = collect();
        try { $studentLife = StudentLife::whereRaw('LOWER(title) LIKE ?', ["%$lowerQuery%"])->orWhereRaw('LOWER(description) LIKE ?', ["%$lowerQuery%"])->get(); } catch (\Exception $e) {}

        $faqs = collect();
        try { $faqs = Faq::whereRaw('LOWER(question) LIKE ?', ["%$lowerQuery%"])->orWhereRaw('LOWER(answer) LIKE ?', ["%$lowerQuery%"])->get(); } catch (\Exception $e) {}

        $whyChooseUs = collect();
        try { $whyChooseUs = WhyChooseUs::whereRaw('LOWER(title) LIKE ?', ["%$lowerQuery%"])->orWhereRaw('LOWER(description) LIKE ?', ["%$lowerQuery%"])->get(); } catch (\Exception $e) {}

        $matchedStaticPages = $matchedStaticPages->values();
        $totalResults = $news->count() + $pages->count() + $careers->count() + $studentLife->count() + $faqs->count() + $whyChooseUs->count() + $matchedStaticPages->count();

        return view('search-results', compact(
            'query', 'totalResults', 'matchedStaticPages', 'news', 'pages', 'careers', 'studentLife', 'faqs', 'whyChooseUs'
        ));
    }
}