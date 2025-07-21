<div>
    <div>
  <!-- Table Section -->
  <div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
    <!-- Card -->
    <div class="flex flex-col">
      <div class="-m-1.5 overflow-x-auto">
        <div class="p-1.5 min-w-full inline-block align-middle">
          <div class="bg-white border border-gray-200 rounded-xl shadow-2xs overflow-hidden dark:bg-neutral-900 dark:border-neutral-700">
            <!-- Header -->
            <div class="px-6 py-4 grid gap-3 md:flex md:justify-between md:items-center border-b border-gray-200 dark:border-neutral-700">
              <div>
                <h2 class="text-xl font-semibold text-gray-800 dark:text-neutral-200">
                  Exams
                </h2>
                <p class="text-sm text-gray-600 dark:text-neutral-400">
                  Exam management overview
                </p>
              </div>

              <div>
                <div class="inline-flex gap-x-2">
                  <a class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-hidden focus:bg-blue-700"
                     href="{{ route('exam.create') }}" wire:navigate>
                    <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                         stroke="currentColor">
                      <path d="M12 4v16m8-8H4"/>
                    </svg>
                    Create Exam
                  </a>
                </div>
              </div>
            </div>
            <!-- End Header -->

            <!-- Table -->
            <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700">
              <thead class="bg-gray-50 divide-y divide-gray-200 dark:bg-neutral-800 dark:divide-neutral-700">
                <tr>
                  <th class="px-6 py-3 text-start border-s text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">Title</th>
                  <th class="px-6 py-3 text-start text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">Subject</th>
                  <th class="px-6 py-3 text-start text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">Grade</th>
                  <th class="px-6 py-3 text-start text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">Term</th>
                  <th class="px-6 py-3 text-start text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">Date</th>
                  <th class="px-6 py-3 text-start text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200" colspan="3">Actions</th>
                </tr>
              </thead>

              <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                @foreach ($exams as $exam)
                <tr wire:key="exam-{{ $exam->id }}">
                  <td class="px-6 py-2 text-sm text-gray-800 dark:text-neutral-200">{{ $exam->title }}</td>
                  <td class="px-6 py-2 text-sm text-gray-800 dark:text-neutral-200">{{ $exam->subject->name }}</td>
                  <td class="px-6 py-2 text-sm text-gray-800 dark:text-neutral-200">{{ $exam->grade->name }}</td>
                  <td class="px-6 py-2 text-sm text-gray-800 dark:text-neutral-200">{{ $exam->term }}</td>
                  <td class="px-6 py-2 text-sm text-gray-800 dark:text-neutral-200">{{ $exam->date }}</td>

                  <!-- View Results -->
                  {{-- <td class="px-6 py-2">
                    <a href="{{ route('exam.results', $exam->id) }}"
                       class="inline-flex items-center justify-center gap-2 size-9.5 text-sm font-medium rounded-lg bg-green-600 text-white hover:bg-green-700">
                      <svg class="size-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                           stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75"/>
                      </svg>
                    </a>
                  </td> --}}

                  {{-- <!-- Edit -->
                  <td class="px-6 py-2">
                    <a href="{{ route('exam.edit', $exam->id) }}"
                       class="inline-flex items-center justify-center gap-2 size-9.5 text-sm font-medium rounded-lg bg-blue-600 text-white hover:bg-blue-700">
                      <svg class="size-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                           stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 012.652 2.652L6.832 19.82"/>
                      </svg>
                    </a>
                  </td> --}}

                  <!-- Delete -->
                  <td class="px-6 py-2">
                    <button wire:click="deleteExam({{ $exam->id }})"
                            class="inline-flex items-center justify-center gap-2 size-9.5 text-sm font-medium rounded-lg bg-red-500 text-white hover:bg-red-600">
                      <svg class="size-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                           stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                      </svg>
                    </button>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
            <!-- End Table -->

            <!-- Footer -->
            <div class="px-6 py-4 flex justify-between items-center border-t border-gray-200 dark:border-neutral-700">
              <p class="text-sm text-gray-600 dark:text-neutral-400">
                Showing <span class="font-semibold text-gray-800 dark:text-neutral-200">{{ count($exams) }}</span> exams
              </p>
            </div>
            <!-- End Footer -->
          </div>
        </div>
      </div>
    </div>
    <!-- End Card -->
  </div>
  <!-- End Table Section -->
</div>

</div>
