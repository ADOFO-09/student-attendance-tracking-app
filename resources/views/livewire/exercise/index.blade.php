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
                        <a href="{{ route('exercise.marks', $exercise->id) }}" class="text-blue-600 underline">Manage Marks</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
</div>
