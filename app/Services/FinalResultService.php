<?php

namespace App\Services;

use App\Models\ExerciseMark;
use App\Models\ExamResult;

class FinalResultService
{
    public function calculateFinalScore($studentId, $subjectId, $gradeId, $term)
    {
        $exerciseMarks = ExerciseMark::whereHas('exercise', function ($query) use ($subjectId, $gradeId, $term){
            $query->where('subject_id', $subjectId)
                ->where('grade_id', $gradeId)
                ->where('term', $term);
        })
        ->where('student_id', $studentId)
        ->get();

        $exerciseAverage = 0;
        if($exerciseMarks->count()){
            $totalPercentage = 0;
            foreach($exerciseMarks as $mark){
                if($mark->total_score > 0) {
                    $totalPercentage += ($mark->score / $mark->total_score) * 100;
                }
            }
            $exerciseAverage = $totalPercentage / $exerciseMarks->count();
        }

        $examResult = ExamResult::whereHas('exam', function ($query) use ($subjectId, $gradeId, $term){
            $query->where('subject_id', $subjectId)
                ->where('grade_id', $gradeId)
                ->where('term', $term);
        })
        ->where('student_id', $studentId)
        ->first();

        $examPercentage = 0;
        if($examResult && $examResult->total_marks > 0){
            $examPercentage = ($examResult->marks_obtained / $examResult->total_marks) * 100;
        }

        $finalScore = ($exerciseAverage * 0.3) + ($examPercentage * 0.7);

        return round($finalScore, 2);
    }
}