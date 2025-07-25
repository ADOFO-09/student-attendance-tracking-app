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

                  <!-- Marks Action -->
                  <td class="h-px w-auto whitespace-nowrap">
                    <a href="{{ route('exam.record', $exam->id) }}" class="flex shrink-0 justify-center items-center gap-2 size-9.5 text-sm font-medium rounded-lg border border-transparent bg-green-600 text-white hover:bg-green-700 focus:outline-hidden focus:bg-green-700 disabled:opacity-50 disabled:pointer-events-none">
                      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c0 .621-.504 1.125-1.125 1.125H18a2.25 2.25 0 0 1-2.25-2.25M6 7.5h3v3H6v-3Z" />
                      </svg>
                    </a>
                  </td>

                  <!-- Edit -->
                  <td class="h-px w-auto whitespace-nowrap">
                    <a href="{{ route('exam.edit', $exam->id) }}"
                       class="inline-flex items-center justify-center gap-2 size-9.5 text-sm font-medium rounded-lg bg-blue-600 text-white hover:bg-blue-700">
                     <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                    </svg>
                    </a>
                  </td>

                  <!-- Delete -->
                  <td class="h-px w-auto whitespace-nowrap">
                    <button wire:click="deleteExam({{ $exam->id }})"
                            class="inline-flex items-center justify-center gap-2 size-9.5 text-sm font-medium rounded-lg bg-red-500 text-white hover:bg-red-600">
                      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
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
