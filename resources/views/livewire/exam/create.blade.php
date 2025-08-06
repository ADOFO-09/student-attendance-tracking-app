<div>
<!-- Comment Form -->
<div class="max-w-[85rem] px-4 py-2 sm:px-6 lg:px-8 lg:py-2 mx-auto">
  <div class="mx-auto max-w-2xl">
    <div class="text-center">
      <h2 class="text-xl text-gray-800 font-bold sm:text-3xl dark:text-white">
        Create New Exam
      </h2>
    </div>

    <!-- Card -->
    <div class="mt-5 p-4 relative z-10 bg-white border border-gray-200 rounded-xl sm:mt-10 md:p-10 dark:bg-neutral-900 dark:border-neutral-700">
      <form wire:submit.prevent="createExam">
        <div class="mb-4 sm:mb-8">
          <label for="hs-feedback-post-comment-title-1" class="block mb-2 text-sm font-medium dark:text-white">Exam Title</label>
          <input type="text"
           wire:model="title"
           id="hs-feedback-post-comment-title-1"
           class="py-2.5 sm:py-3 px-4 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" placeholder="Enter exam title">
           @error('title')
                <span class="text-red-500">{{$message}}</span>
           @enderror
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6 mb-4 sm:mb-8">
          <div>
            <label for="hs-feedback-post-comment-subject-1" class="block mb-2 text-sm font-medium dark:text-white">Subject</label>
            <select wire:model="subject_id"
                  id="hs-feedback-post-comment-subject-1"
                  class="py-2.5 sm:py-3 px-4 pe-9 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                  <option value="">-- Select Subject --</option>
                  @foreach($subjects as $subject)
                      <option wire:key="{{$subject->id}}" value="{{$subject->id}}">{{$subject->name}}</option>
                  @endforeach
            </select>
            @error('subject_id')
                  <span class="text-red-500">{{$message}}</span>
            @enderror
          </div>

          <div>
            <label for="hs-feedback-post-comment-grade-1" class="block mb-2 text-sm font-medium dark:text-white">Grade</label>
            <select wire:model="grade_id"
                  id="hs-feedback-post-comment-grade-1"
                  class="py-2.5 sm:py-3 px-4 pe-9 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                  <option value="">-- Select Grade --</option>
                  @foreach($grades as $grade)
                      <option wire:key="{{$grade->id}}" value="{{$grade->id}}">{{$grade->name}}</option>
                  @endforeach
            </select>
            @error('grade_id')
                  <span class="text-red-500">{{$message}}</span>
            @enderror
          </div>
        </div>

        <div class="mb-4 sm:mb-8">
          <label for="hs-feedback-post-comment-term-1" class="block mb-2 text-sm font-medium dark:text-white">Term/Semester</label>
          <select wire:model="term"
            id="hs-feedback-post-comment-term-1"
            class="py-2.5 sm:py-3 px-4 pe-9 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
            <option value="">-- Select Term --</option>
            @foreach(\App\Enums\TermEnum::cases() as $termOption)
              <option value="{{ $termOption->value }}">{{ $termOption->label() }}</option>
            @endforeach
          </select>
          @error('term') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4 sm:mb-8">
          <label for="exam-academic-year" class="block mb-2 text-sm font-medium dark:text-white">Academic Year</label>
          <select wire:model="academicYearId"
                  id="exam-academic-year"
                  class="py-2.5 sm:py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400">
              <option value="">Select Academic Year</option>
              @foreach ($academicYears as $year)
                  <option value="{{ $year->id }}">{{ $year->name }}</option>
              @endforeach
          </select>
          @error('academicYearId') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6 mb-4 sm:mb-8">
          <div>
            <label for="hs-feedback-post-comment-date-1" class="block mb-2 text-sm font-medium dark:text-white">Date</label>
            <input type="date"
             wire:model="date"
             id="hs-feedback-post-comment-date-1"
             class="py-2.5 sm:py-3 px-4 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
             @error('date')
                  <span class="text-red-500">{{$message}}</span>
             @enderror
          </div>

          <div>
            <label for="hs-feedback-post-comment-total-marks-1" class="block mb-2 text-sm font-medium dark:text-white">Total Marks</label>
            <input type="number"
             wire:model="total_marks"
             id="hs-feedback-post-comment-total-marks-1"
             min="1"
             class="py-2.5 sm:py-3 px-4 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" placeholder="Enter total marks">
             @error('total_marks')
                  <span class="text-red-500">{{$message}}</span>
             @enderror
          </div>
        </div>

        <div class="mb-4 sm:mb-8">
          <label for="hs-feedback-post-comment-pass-mark-1" class="block mb-2 text-sm font-medium dark:text-white">Pass Mark</label>
          <input type="number"
           wire:model="pass_mark"
           id="hs-feedback-post-comment-pass-mark-1"
           min="0"
           class="py-2.5 sm:py-3 px-4 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" placeholder="Enter pass mark">
           @error('pass_mark')
                <span class="text-red-500">{{$message}}</span>
           @enderror
        </div>

        <div class="mt-6 grid">
          <button type="submit"
          class="w-full py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-hidden focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
            <div wire:loading
                class="animate-spin inline-block size-6 border-3 border-current border-t-transparent text-blue-600 rounded-full dark:text-blue-500" role="status" aria-label="loading">
                <span class="sr-only">Loading...</span>
            </div>
           Create Exam
          </button>
        </div>
      </form>
    </div>
    <!-- End Card -->
  </div>
</div>
<!-- End Comment Form -->
</div>