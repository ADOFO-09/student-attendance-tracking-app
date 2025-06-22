<div>
    <div class="p-4">
    <h1 class="text-xl font-semibold">Exercise List</h1>

    <table class="table-auto w-full mt-4">
        <thead>
            <tr>
                <th>Title</th>
                <th>Subject</th>
                <th>Grade</th>
                <th>Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($exercises as $exercise)
                <tr>
                    <td>{{ $exercise->title }}</td>
                    <td>{{ $exercise->subject->name }}</td>
                    <td>{{ $exercise->grade->name }}</td>
                    <td>{{ $exercise->date }}</td>
                    <td>
                        <a href="{{ route('exercise.marks', $exercise->id) }}" class="text-blue-600 underline">Marks</a>
                        <a href="#" wire:click.prevent="$emit('editExercise', {{ $exercise->id }})" class="text-yellow-600 underline">Edit</a>
                        <a href="#" wire:click.prevent="deleteExercise({{ $exercise->id }})" class="text-red-600 underline">Delete</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @if($editId)
        <div class="mt-6 p-4 border rounded bg-white dark:bg-zinc-800">
            <h3 class="text-lg font-semibold">Edit Exercise</h3>

            <div class="mt-2">
                <input wire:model="editTitle" type="text" placeholder="Title" class="border px-2 py-1 w-full rounded mb-2" />
                <select wire:model="editSubjectId" class="border px-2 py-1 w-full rounded mb-2">
                    <option value="">Select Subject</option>
                    @foreach(Subject::all() as $subject)
                        <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                    @endforeach
                </select>
                <input wire:model="editDate" type="date" class="border px-2 py-1 w-full rounded mb-2" />
                <button wire:click="updateExercise" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Update</button>
            </div>
        </div>
    @endif
</div>
</div>
