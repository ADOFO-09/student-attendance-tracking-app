<div>
    <div class="p-6">
    <h2 class="text-xl font-bold mb-4">Student Performance Report</h2>

    <div class="mb-4">
        <label for="grade">Select Grade:</label>
        <select wire:model="gradeId" class="border rounded px-2 py-1 w-64">
            <option value="">-- Select Grade --</option>
            @foreach($grades as $grade)
                <option value="{{ $grade->id }}">{{ $grade->name }}</option>
            @endforeach
        </select>
    </div>

    @if ($gradeId)
        <a href="{{ route('reports.performance.export', $gradeId)}}"
        taget="_blank"
        class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 mb-4 inline-block">
        Export PDF
        </a>
    @endif

    @if($gradeId && count($students))
        <table class="w-full table-auto border-collapse mt-4">
            <thead class="bg-gray-100 dark:bg-gray-700">
                <tr>
                    <th class="p-2 text-left">Student</th>
                    <th class="p-2 text-left">Exercises</th>
                    <th class="p-2 text-left">Average (%)</th>
                    <th class="p-2 text-left">Rating</th>
                </tr>
            </thead>
            <tbody>
                @foreach($students as $student)
                    @php
                        [$avg, $count, $rating] = $this->getStudentStats($student->id);
                    @endphp
                    <tr class="border-b dark:border-gray-600">
                        <td class="p-2">{{ $student->firstname }} {{ $student->lastname }}</td>
                        <td class="p-2">{{ $count }}</td>
                        <td class="p-2">{{ $avg }}%</td>
                        <td class="p-2 font-medium">{{ $rating }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>

</div>
