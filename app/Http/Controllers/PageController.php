<?php

namespace App\Http\Controllers;

use App\Models\SchoolSetting;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function __invoke(Request $request)
    {
        $schoolSetting = SchoolSetting::first();

        return response()->json($schoolSetting);
    }
}
