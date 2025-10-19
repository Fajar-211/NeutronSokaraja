<!-- FAQ -->
<div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
  <!-- Grid -->
  <div class="grid md:grid-cols-5 gap-10">
    <div class="md:col-span-2">
      <div class="max-w-xs">
        <h2 class="text-2xl font-bold md:text-4xl md:leading-tight dark:text-white">Frequently<br>asked questions</h2>
        <p class="mt-1 hidden md:block text-gray-600 dark:text-neutral-400">Answers to the most frequently asked questions.</p>
      </div>
    </div>
    <!-- End Col -->

    <div class="md:col-span-3 grid sm:grid-cols-2 items-center gap-6 md:gap-10">
        <!-- Card -->
        @foreach ($kelases as $kelas)
            <div class="size-full bg-white shadow-lg rounded-lg p-5 dark:bg-neutral-900">
                <div class="flex items-center gap-x-4 mb-3">
                    <div class="inline-flex justify-center items-center size-15.5 rounded-full border-4 border-blue-50 bg-blue-100 dark:border-blue-900 dark:bg-blue-800">
                    <svg class="shrink-0 size-6 text-blue-600 dark:text-blue-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 3h20"/><path d="M21 3v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V3"/><path d="m7 21 5-5 5 5"/></svg>
                    </div>
                    <div class="shrink-0">
                    <h3 class="block text-lg font-semibold text-gray-800 dark:text-white">{{ $kelas['kelas'] }}</h3>
                    </div>
                </div>
                <a href="absent/create/{{ $kelas['id'] }}" class="text-gray-600 dark:text-neutral-400 hover:underline">Fill in the absence now &rarr;</a>
            </div>
        @endforeach
        <!-- End Card -->
    </div>
    <!-- End Col -->
  </div>
  <!-- End Grid -->
</div>
<!-- End FAQ -->