<div>
    <div class="p-6">
    <h2 class="text-xl font-bold mb-4">Record Marks for: {{ $exam->title }}</h2>

    <form wire:submit.prevent="save">
        <table class="w-full table-auto border-collapse mb-6">
            <thead class="bg-gray-100 dark:bg-gray-800">
                <tr>
                    <th class="p-2 text-left">Student</th>
                    <th class="p-2 text-left">Marks</th>
                    <th class="p-2 text-left">Remarks</th>
                </tr>
            </thead>
            <tbody>
                @foreach($students as $student)
                    @php
                        $score = $grades[$student->id]['marks_obtained'] ?? null;
                        $rating = $score !== null ? $this->rate($score) : 'N/A';
                    @endphp
                    <tr class="border-b">
                        <td class="p-2">{{ $student->first_name }} {{ $student->last_name }}</td>
                        <td class="p-2">
                            <input type="number" min="0" max="{{ $exam->total_marks }}"
                                wire:model.lazy="grades.{{ $student->id }}.marks_obtained"
                                class="border rounded px-2 py-1 w-24" />
                        </td>
                        <td class="p-2">{{ $rating }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Save Grades
            <div wire:loading
                class="animate-spin inline-block size-6 border-3 border-current border-t-transparent text-blue-600 rounded-full dark:text-blue-500" role="status" aria-label="loading">
                <span class="sr-only">Loading...</span>
            </div>
        </button>
    </form>
</div>

</div>
