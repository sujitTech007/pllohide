<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Company;
use App\Models\PostComment;
use App\Models\Post;
use App\Models\Survey;
use App\Models\Portfolio;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;

class SurveyController extends Controller
{

    public function survey()
    {
        return view('survey');
    }

     public function store(Request $request)
    {
        $data = $request->validate([
            'role' => 'nullable|string',
            'frequency' => 'nullable|string',
            'challenges' => 'nullable|string',
            'other_challenges' => 'nullable|string',
            'sustainability_importance' => 'nullable|string',
            'pllohide_offerings' => 'nullable|string',
            'platform_interest' => 'nullable|string',
            'preference1' => 'nullable|string',
            'preference2' => 'nullable|string',
            'feedback' => 'nullable|string',
            'other' => 'nullable|string',
            'improvements' => 'nullable|string',
        ]);      

        Survey::create($data);

        return redirect()->back()->with('success', 'Thank you for your feedback!');
    }


}
