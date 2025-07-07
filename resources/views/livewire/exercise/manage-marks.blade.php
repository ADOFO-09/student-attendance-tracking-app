<div>
    <div class="p-6">
    <h2 class="text-xl font-bold mb-4">Recording Marks for: {{ $exercise->title }}</h2>


    <form wire:submit.prevent="save">
        <table class="w-full border-collapse table-auto">
            <thead>
                <tr class="bg-gray-100 dark:bg-gray-800">
                    <th class="p-2 text-left">Student</th>
                    <th class="p-2 text-left">Score</th>
                    <th class="p-2 text-left">Total Score</th>
                    <th class="p-2 text-left">Performance</th>
                </tr>
            </thead>
            <tbody>
                @foreach($students as $student)
                    <tr class="border-b dark:border-gray-600">
                        <td class="p-2">{{ $student->first_name }} {{ $student->last_name }}</td>
                        <td class="p-2">
                            <input type="number" wire:model.lazy="marks.{{ $student->id }}.score"
                                class="border rounded px-2 py-1 w-24" step="0.01" min="0">
                        </td>
                        <td class="p-2">
                            <input type="number" wire:model.lazy="marks.{{ $student->id }}.total_score"
                                class="border rounded px-2 py-1 w-24" step="0.01" min="1">
                        </td>
                        <td class="p-2">
                            @php
                                $score = $marks[$student->id]['score'] ?? null;
                                $total = $marks[$student->id]['total_score'] ?? null;
                                $rating = ($score && $total) ? $this->ratePerformance($score, $total) : 'N/A';
                            @endphp
                            {{ $rating }}
                        </td>
                    </tr>
                @endforeach
                @if(empty($students))
                    <p class="text-red-600">No students found for this grade. Check exercise->grade_id.</p>
                @endif
            </tbody>
        </table>

        <div class="mt-4">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Save Marks
            </button>
            
        </div>
    </form>
</div>
