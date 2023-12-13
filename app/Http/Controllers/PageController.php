<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Feedback;
use Illuminate\Http\Request;

class PageController extends Controller
{

    public function about()
    {
        return view('normal-view.pages.about');
    }
}
