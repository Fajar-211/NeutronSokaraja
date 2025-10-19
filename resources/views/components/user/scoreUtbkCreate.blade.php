<!-- Table Section -->
<div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
  <!-- Card -->
  <div class="flex flex-col">
    <div class="-m-1.5 overflow-x-auto">
      <div class="p-1.5 min-w-full inline-block align-middle">
        <div class="bg-white border border-gray-200 rounded-xl shadow-2xs overflow-hidden dark:bg-neutral-900 dark:border-neutral-700">
          <!-- Header -->
          <form action="/score/create/utbk" method="POST">
            @method('PATCH')
            @csrf
          <div class="px-6 py-4 grid gap-3 md:flex md:justify-between md:items-center border-b border-gray-200 dark:border-neutral-700">
            <div>
              <h2 class="text-xl font-semibold text-gray-800 dark:text-neutral-200">
                {{ $siswas->count() }} existing
              </h2>
              <p class="text-sm text-gray-600 dark:text-neutral-400">
                Overview
              </p>
            </div>

            <div>
              <div class="inline-flex gap-x-2">
                <button type="submit" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-hidden focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                  <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="M12 5v14"/></svg>
                  Create
                </button>
              </div>
            </div>
          </div>
          <!-- End Header -->

          <!-- Table -->
          <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700">
            <thead class="bg-gray-50 divide-y divide-gray-200 dark:bg-neutral-800 dark:divide-neutral-700">
              <tr>
                <th scope="col" class="px-6 py-3 text-start border-s border-gray-200 dark:border-neutral-700">
                  <span class="text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">
                    Nama
                  </span>
                </th>

                <th scope="col" class="px-6 py-3 text-start">
                  <span class="text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">
                    Nis
                  </span>
                </th>
                <th scope="col" class="px-6 py-3 text-start">
                  <span class="text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">
                    Note
                  </span>
                </th>
                @foreach (App\Models\Utbk::get() as $utbk)
                <th scope="col" class="px-6 py-3 text-start">
                  <span class="text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">
                    {{ $utbk['utbk'] }}
                  </span>
                </th>
                @endforeach
              </tr>
            </thead>

            <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                @foreach ($siswas as $siswa)
                <tr>
                    <td class="h-px w-auto whitespace-nowrap">
                        <div class="px-6 py-2 flex items-center gap-x-3">
                        <span class="text-sm text-gray-600 dark:text-neutral-400">{{ $loop->iteration }}.</span>
                        <span class="text-sm text-blue-600 decoration-2 hover:underline dark:text-blue-500">{{ $siswa['nama'] }}</span>
                        </div>
                    </td>
                    <td class="h-px w-auto whitespace-nowrap">
                        <div class="px-6 py-2">
                        <span class="font-semibold text-sm text-gray-800 dark:text-neutral-200">{{ $siswa['nis'] }}</span>
                        </div>
                    </td>
                    <td class="h-px w-auto whitespace-nowrap min-w-[200px] sm:w-72">
                        <div class="px-6 py-3">
                            <textarea name="catatan[{{ $siswa['id'] }}]"
                              rows="3"
                              class="@error("catatan.$siswa->id") border-red-500 bg-pink-100 @enderror w-full min-h-[40px] text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 
                                    focus:ring-primary-500 focus:border-primary-500 
                                    dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                              placeholder="Write note here">{{ old("catatan.$siswa->id", optional($siswa->note)->catatan) }}</textarea>
                              @error("catatan.$siswa->id")
                                  <div class="text-xs text-red-500 my-1">{{ $message }}</div>
                              @enderror
                        </div>
                    </td>
                    @foreach ($siswa->note->score as $nilai)
                    <td class="h-px w-auto whitespace-nowrap">
                        <div class="px-6 py-2">
                        <span class="text-sm text-gray-800 dark:text-neutral-200">{{ $nilai['score'] }}</span>
                        </div>
                    </td>
                    @endforeach
                </tr>
                @endforeach
            </tbody>
          </table>
          <!-- End Table -->
          </form>
          <!-- Footer -->
          <div class="px-6 py-4 grid gap-3 md:flex md:justify-between md:items-center border-t border-gray-200 dark:border-neutral-700">
          </div>
          <!-- End Footer -->
        </div>
      </div>
    </div>
  </div>
  <!-- End Card -->
</div>
<!-- End Table Section -->