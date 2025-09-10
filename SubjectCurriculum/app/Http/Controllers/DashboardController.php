<?php

namespace App\Http\Controllers;

use App\Models\Curriculum;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $collegeCount = Curriculum::where('year_level', 'College')->count();
        $seniorHighCount = Curriculum::where('year_level', 'Senior High')->count();
        $totalSubjects = \App\Models\Subject::count();
        $majorCount = \App\Models\Subject::where('subject_type', 'Major')->count();
        $minorCount = \App\Models\Subject::where('subject_type', 'Minor')->count();
        $electiveCount = \App\Models\Subject::where('subject_type', 'Elective')->count();
        return view('dashboard', compact('collegeCount', 'seniorHighCount', 'totalSubjects', 'majorCount', 'minorCount', 'electiveCount'));
    }
}
