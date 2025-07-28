<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Subject;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Services\FinalResultService;

class ReportCardController extends Controller
{
    public function download($studentId, $term)
    {
        $student = Student::findOrFail($studentId);
        $gradeId = $student->grade_id;
        $subjects = Subject::all();

        $results = [];

        foreach($subjects as $subject){
            $score = (new FinalResultService)->calculateFinalScore($studentId, $subject->id, $gradeId, $term);
            $results[] = [
                'subject' => $subject->name,
                'score' => $score,
            ];
        }

        $pdf = Pdf::loadView('pdf.report-card', [
            'student' => $student,
            'term' => $term,
            'results' => $results,
        ]);

        $filename = "{$student->first_name}_{$term}_report.pdf";
        return $pdf->download($filename);
    }
}
