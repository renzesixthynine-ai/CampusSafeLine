<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    /**
     * Display a listing of FAQs.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $faqs = Faq::active()
            ->orderBy('order')
            ->get();

        return view('faqs.index', compact('faqs'));
    }
}
