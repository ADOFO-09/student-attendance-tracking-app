<div>
    <div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 mx-auto">
    <!-- Card -->
    <div class="bg-white border border-gray-200 rounded-xl shadow-lg p-6 dark:bg-neutral-900 dark:border-neutral-700">
        <!-- Header -->
        <div class="mb-6">
            <h2 class="text-xl font-semibold text-gray-800 dark:text-neutral-200">Edit Exam: {{ $exam->title }}</h2>
            <p class="text-sm text-gray-600 dark:text-neutral-400">Update exam details below</p>
        </div>

        <!-- Form -->
        <form wire:submit.prevent="updateExam" class="space-y-6">

            <!-- Title -->
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-neutral-200">Title</label>
                <input type="text" 
                wire:model="title" 
                id="edit-exam-title"
                class="mt-1 block w-full border border-gray-300 dark:border-neutral-700 rounded-md px-3 py-2 shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-neutral-800 dark:text-white" />
                @error('title') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Subject and Grade -->
            <div class="flex flex-col md:flex-row gap-4">
                <div class="w-full">
                    <label class="block text-sm font-medium text-gray-700 dark:text-neutral-200">Subject</label>
                    <select wire:model="subject_id" 
                    id="edit-exam-subject"
                    class="mt-1 block w-full border border-gray-300 dark:border-neutral-700 rounded-md px-3 py-2 bg-white dark:bg-neutral-800 dark:text-white focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Select Subject</option>
                        @foreach($subjects as $subject)
                            <option  value="{{ $subject->id }}">{{ $subject->name }}</option>
                        @endforeach
                    </select>
                    @error('subject_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="w-full">
                    <label class="block text-sm font-medium text-gray-700 dark:text-neutral-200">Grade</label>
                    <select wire:model="grade_id" 
                    id="edit-exam-grade"
                    class="mt-1 block w-full border border-gray-300 dark:border-neutral-700 rounded-md px-3 py-2 bg-white dark:bg-neutral-800 dark:text-white focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Select Grade</option>
                        @foreach($grades as $grade)
                            <option  value="{{ $grade->id }}">{{ $grade->name }}</option>
                        @endforeach
                    </select>
                    @error('grade_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>

            <!-- Term -->
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-neutral-200">Term</label>
                <select wire:model="term"
                    id="edit_exam-term"
                    class="mt-1 block w-full border border-gray-300 dark:border-neutral-700 rounded-md px-3 py-2 bg-white dark:bg-neutral-800 dark:text-white focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    <option value="">-- Select Term --</option>
                    @foreach(\App\Enums\TermEnum::cases() as $termOption)
                        <option value="{{ $termOption->value }}">{{ $termOption->label() }}</option>
                    @endforeach
                </select>
                @error('term') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Date and Total Marks -->
            <div class="flex flex-col md:flex-row gap-4">
                <div class="w-full">
                    <label class="block text-sm font-medium text-gray-700 dark:text-neutral-200">Date</label>
                    <input type="date" 
                    id="edit-exam-date"
                    wire:model="date" class="mt-1 block w-full border border-gray-300 dark:border-neutral-700 rounded-md px-3 py-2 shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-neutral-800 dark:text-white" />
                    @error('date') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="w-full">
                    <label class="block text-sm font-medium text-gray-700 dark:text-neutral-200">Total Marks</label>
                    <input type="number" 
                    id="edit-exam-total-marks"
                    wire:model="total_marks" class="mt-1 block w-full border border-gray-300 dark:border-neutral-700 rounded-md px-3 py-2 shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-neutral-800 dark:text-white" />
                    @error('total_marks') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>

            <!-- Pass Mark -->
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-neutral-200">Pass Mark</label>
                <input type="number"
                id="edit-exam-pass-mark" 
                wire:model="pass_mark" class="mt-1 block w-full border border-gray-300 dark:border-neutral-700 rounded-md px-3 py-2 shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-neutral-800 dark:text-white" />
                @error('pass_mark') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Submit Button -->
            <div class="pt-4">
                <button type="submit" 
                class="bg-green-600 hover:bg-green-700 text-white font-medium px-6 py-2 rounded-md">
                <div wire:loading
                    class="animate-spin inline-block size-6 border-3 border-current border-t-transparent text-blue-600 rounded-full dark:text-blue-500" role="status" aria-label="loading">
                    <span class="sr-only">Loading...</span>
                </div>
                    Update Exam
                </button>

            </div>

        </form>
    </div>
</div>


</div>
