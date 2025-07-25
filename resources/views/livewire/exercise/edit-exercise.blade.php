<div>
    <div>
    <!-- Edit Exercise Form -->
<div class="max-w-[85rem] px-4 py-2 sm:px-6 lg:px-8 lg:py-2 mx-auto">
  <div class="mx-auto max-w-2xl">
    <div class="text-center">
      <h2 class="text-xl text-gray-800 font-bold sm:text-3xl dark:text-white">
        Edit Exercise
      </h2>
    </div>

    <!-- Card -->
    <div class="mt-5 p-4 relative z-10 bg-white border border-gray-200 rounded-xl sm:mt-10 md:p-10 dark:bg-neutral-900 dark:border-neutral-700">
      <form wire:submit="updateExercise">
        <div class="mb-4 sm:mb-8">
          <label for="edit-exercise-title" class="block mb-2 text-sm font-medium dark:text-white">Exercise Title</label>
          <input type="text"
           wire:model="editTitle"
           id="edit-exercise-title"
           class="py-2.5 sm:py-3 px-4 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" placeholder="Enter exercise title">
           @error('editTitle')
                <span class="text-red-500">{{$message}}</span>
           @enderror
        </div>

        <div class="mb-4 sm:mb-8">
          <label for="edit-exercise-subject" class="block mb-2 text-sm font-medium dark:text-white">Subject</label>
          <select wire:model="editSubjectId"
                id="edit-exercise-subject"
                class="py-2.5 sm:py-3 px-4 pe-9 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                <option value="">Select Subject</option>
                @foreach($subjects as $subject)
                    <option wire:key="edit-{{$subject->id}}" value="{{$subject->id}}">{{$subject->name}}</option>
                @endforeach
          </select>
           @error('editSubjectId')
                <span class="text-red-500">{{$message}}</span>
           @enderror
        </div>

        <div class="mb-4 sm:mb-8">
          <label for="edit-exercise-grade" class="block mb-2 text-sm font-medium dark:text-white">Grade</label>
          <select wire:model="editGradeId"
                id="edit-exercise-grade"
                class="py-2.5 sm:py-3 px-4 pe-9 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                <option value="">Select Grade</option>
                @foreach($grades as $grade)
                    <option wire:key="edit-{{$grade->id}}" value="{{$grade->id}}">{{$grade->name}}</option>
                @endforeach
          </select>
           @error('editGradeId')
                <span class="text-red-500">{{$message}}</span>
           @enderror
        </div>

         <div class="mb-4 sm:mb-8">
          <label for="edit-exercise-term" class="block mb-2 text-sm font-medium dark:text-white">Term</label>
          <input wire:model="editTerm"
          id="term"
          class="py-2.5 sm:py-3 px-4 pe-9 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
          type="text" wire:model="term" class="w-full border px-2 py-1 rounded" placeholder="Term"/>
          @error('term') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4 sm:mb-8">
          <label for="edit-exercise-date" class="block mb-2 text-sm font-medium dark:text-white">Exercise Date</label>
          <input type="date"
           wire:model="editDate"
           id="edit-exercise-date"
           class="py-2.5 sm:py-3 px-4 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
            @error('editDate')
                <span class="text-red-500">{{$message}}</span>
           @enderror
        </div>

        <div class="mt-6 grid grid-cols-1 sm:grid-cols-2 gap-4">
          <button type="submit"
          class="w-full py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-hidden focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
            <div wire:loading
                class="animate-spin inline-block size-6 border-3 border-current border-t-transparent text-blue-600 rounded-full dark:text-blue-500" role="status" aria-label="loading">
                <span class="sr-only">Loading...</span>
            </div>
           Update Exercise
          </button>
          
          <button type="button" wire:click="cancelEdit"
          class="w-full py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 hover:bg-gray-50 focus:outline-hidden focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700">
           Cancel
          </button>
        </div>
      </form>
    </div>
    <!-- End Card -->
  </div>
</div>
<!-- End Edit Exercise Form -->
</div>
</div>
