<?php

namespace App\Services;

use App\Models\ExamResult;
use App\Models\ExerciseMark;
use Illuminate\Support\Facades\Log;

class FinalResultService
{
    private function normalizeTermFormat($term)
    {
        // Convert different term formats to a standard format
        $term = trim($term);
        
        // Map common variations to standard format
        $termMappings = [
            'Term 1' => '1st Term',
            'Term 2' => '2nd Term', 
            'Term 3' => '3rd Term',
            '1st Term' => '1st Term',
            '2nd Term' => '2nd Term',
            '3rd Term' => '3rd Term',
            // Add more mappings as needed
        ];
        
        return $termMappings[$term] ?? $term;
    }

    public function calculateFinalScore($studentId, $subjectId, $gradeId, $term)
    {
        $normalizedTerm = $this->normalizeTermFormat($term);
        
        Log::debug("Original term: '$term' | Normalized term: '$normalizedTerm' | Student: $studentId | Subject: $subjectId | Grade: $gradeId");

        $exerciseMarks = ExerciseMark::whereHas('exercise', function ($query) use ($subjectId, $gradeId, $normalizedTerm){
            $query->where('subject_id', $subjectId)
                ->where('grade_id', $gradeId)
                ->where('term', $normalizedTerm);
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

        // Try multiple term formats for exam results
        $examResult = $this->findExamResult($studentId, $subjectId, $gradeId, $term);

        $examPercentage = 0;
        if ($examResult && $examResult->exam && $examResult->exam->total_marks > 0) {
            $examPercentage = ($examResult->marks_obtained / $examResult->exam->total_marks) * 100;
        }

        $finalScore = ($exerciseAverage * 0.3) + ($examPercentage * 0.7);

        // Log::debug("Exercise Average: $exerciseAverage | Exam Percentage: $examPercentage | Final Score: $finalScore");

        if (!$examResult) {
            Log::warning("No exam result found for student $studentId subject $subjectId grade $gradeId term $term (tried multiple formats)");
        }

        return round($finalScore, 2);
    }

    private function findExamResult($studentId, $subjectId, $gradeId, $term)
    {
        // Try different term formats
        $termFormats = [
            trim($term),
            $this->normalizeTermFormat($term),
            // Try alternative formats based on your database
            str_replace('Term ', '', trim($term)) . 'st Term', // "1" -> "1st Term"
            str_replace('Term ', '', trim($term)) . 'nd Term', // "2" -> "2nd Term" 
            str_replace('Term ', '', trim($term)) . 'rd Term', // "3" -> "3rd Term"
        ];

        foreach ($termFormats as $termFormat) {
            $examResult = ExamResult::whereHas('exam', function ($query) use ($subjectId, $gradeId, $termFormat){
                $query->where('subject_id', $subjectId)
                    ->where('grade_id', $gradeId)
                    ->where('term', $termFormat);
            })
            ->where('student_id', $studentId)
            ->first();

            // if ($examResult) {
            //     Log::debug("Found exam result with term format: '$termFormat'");
            //     return $examResult;
            // }
        }

        return null;
    }
}