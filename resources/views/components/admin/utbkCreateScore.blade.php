<!-- Table Section -->
<div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
  <!-- Card -->
  <div class="flex flex-col">
    <div class="-m-1.5 overflow-x-auto">
      <div class="p-1.5 min-w-full inline-block align-middle">
        <form action="/utbk/score" method="POST">
            @csrf
            <div class="bg-white border border-gray-200 rounded-xl shadow-2xs overflow-hidden dark:bg-neutral-900 dark:border-neutral-700">
          <!-- Header -->
          <div class="px-6 py-4 grid gap-3 md:flex md:justify-between md:items-center border-b border-gray-200 dark:border-neutral-700">
            <div>
              <h2 class="text-xl font-semibold text-gray-800 dark:text-neutral-200">
                UTBK score form
              </h2>
              <p class="text-sm text-gray-600 dark:text-neutral-400">
                @if ($notes->count() == 0)
                    <span class="text-red-500">Please insert students first!</span>
                @else
                    {{ $notes->count() }} students
                @endif
              </p>
            </div>

            <div>
              <div class="inline-flex gap-x-2">
                <button type="submit" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-hidden focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none" href="#">
                  <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="M12 5v14"/></svg>
                  Create
                </button>
              </div>
            </div>
          </div>
          <div class="px-6 py-4 grid gap-3 md:flex md:justify-between md:items-center border-b border-gray-200 dark:border-neutral-700">
            <form class="flex items-center">
                @csrf
                <label for="simple-search" class="sr-only">Search</label>
                <div class="relative w-full">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <input name="cari" type="text" id="simple-search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Search name">
                </div>
            </form>
          </div>
          <div>
          </div>
          <!-- End Header -->

          <!-- Table -->
          <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700">
            <thead class="bg-gray-50 divide-y divide-gray-200 dark:bg-neutral-800 dark:divide-neutral-700">
              <tr>
                <th scope="col" class="px-6 py-3 text-start border-s border-gray-200 dark:border-neutral-700">
                  <span class="text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">
                    Name
                  </span>
                </th>
                @foreach ($utbks as $utbk)
                    <th scope="col" class="px-6 py-3 text-start">
                        <span class="text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">
                            {{ $utbk['utbk'] }}
                        </span>
                    </th>
                @endforeach
              </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                @foreach ($notes as $note)
                    <tr>
                        <td class="h-px w-auto whitespace-nowrap">
                            <div class="px-6 py-2 flex items-center gap-x-3">
                                <span class="text-sm text-gray-600 dark:text-neutral-400">{{ $loop->iteration }}</span>
                                <p class="text-sm text-blue-600 decoration-2 hover:underline dark:text-blue-500">{{ $note['nama'] }}</p>
                            </div>
                        </td>
                        @foreach ($utbks as $utbk)
                            <td class="h-px w-auto whitespace-nowrap">
                                <div class="px-6 py-2">
                                  {{-- old('scores.' . $note->id . '.' . $utbk['id']) -> didalam value --}}
                                    <input type="number" name="scores[{{ $note->id }}][{{ $utbk['id'] }}]" value="{{ old('scores.' . $note->id . '.' . $utbk->id, $scores[$note->id . '_' . $utbk->id] ?? 0) }}"  class="@error('scores.' . $note->id . '.' . $utbk['id']) border-red-600 bg-red-100 @enderror py-2.5 sm:py-3 px-4 block w-full min-w-24 border-gray-200 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" placeholder="{{ $note['nama'] }} score">
                                @error('scores.' . $note->id . '.' . $utbk['id'])
                                    <div class="mt-2 text-xs text-red-600 dark:text-red-500">{{ $message }}</div>
                                @enderror
                                </div>
                            </td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
          </table>
          <!-- End Table -->
        </div>
        </form>
      </div>
    </div>
  </div>
  <!-- End Card -->
</div>
@push('ajax')
<script>
  const cari = document.getElementById('simple-search');
  cari.addEventListener('keyup', function(){
    let filter = cari.value.toLowerCase();
    let rows = document.querySelectorAll("tbody tr");

    rows.forEach(row => {
      let nama = row.querySelector("td p").textContent.toLowerCase(); // ambil nama siswa
      if (nama.includes(filter)) {
        row.style.display = "";
      } else {
        row.style.display = "none";
      }
    });
  });
</script>
@endpush
<!-- End Table Section -->