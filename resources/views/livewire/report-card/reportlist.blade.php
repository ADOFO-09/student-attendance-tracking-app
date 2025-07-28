<div>
    <div class="p-6 max-w-7xl mx-auto">
    <h2 class="text-xl font-bold mb-4 text-gray-800 dark:text-white">Generate Report Cards</h2>

    <div class="mb-6 flex gap-4">
        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Select Grade:</label>
            <select wire:model.lazy="gradeId" class="border rounded px-2 py-1 w-64">
                <option value="">-- Select Grade --</option>
                @foreach($grades as $grade)
                    <option value="{{ $grade->id }}">{{ $grade->name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Select Term:</label>
            <select wire:model.lazy="term" class="border rounded px-2 py-1 w-64">
                <option value="">-- Select Term --</option>
                <option value="Term 1">Term 1</option>
                <option value="Term 2">Term 2</option>
                <option value="Term 3">Term 3</option>
            </select>
        </div>
    </div>

    @if(count($students) > 0)
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white dark:bg-zinc-900 rounded shadow text-sm">
                <thead class="bg-gray-100 dark:bg-zinc-800">
                    <tr>
                        <th class="text-left px-4 py-2">Name</th>
                        <th class="text-left px-4 py-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($students as $student)
                        <tr class="border-t dark:border-gray-700">
                            <td class="px-4 py-2">{{ $student->firstname }} {{ $student->lastname }}</td>
                            <td class="px-4 py-2">
                                <a href="{{ route('report-card.download', ['student' => $student->id, 'term' => $term]) }}"
                                   class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700"
                                   target="_blank">
                                    Download PDF
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>

</div>
