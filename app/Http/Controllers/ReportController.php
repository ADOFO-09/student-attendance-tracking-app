<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\Student;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\ExerciseMark;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function exportPerformance($gradeId)
    {
        $grade = Grade::findOrFail($gradeId);
        $students = Student::with('exerciseMarks')
            ->where('grade_id', $gradeId)
            ->get();

        $data = $students->map(function ($student){
            $marks = $student->exerciseMarks;
            
            $total = $marks->sum('total_score');
            $scored = $marks->sum('score');
            $average = $total > 0 ? ($scored / $total) * 100 : 0;

            $rating = match (true) {
                $average >= 90 => 'Excellent',
                $average >= 75 => 'Very Good',
                $average >= 60 => 'Good',
                $average >= 50 => 'Fair',
                default => 'Needs Improvement',
            };

            return [
                'name' => $student->first_name . ' ' . $student->last_name,
                'average' => round($average, 2),
                'rating' => $rating,
                'count' => $marks->count(),
            ];
        });

        $pdf = PDF::loadView('pdf.performance-report', [
            'grade' => $grade,
            'data' => $data
        ]);

        return $pdf->download("Performance_Report_{$grade->name}.pdf");
    }
}
