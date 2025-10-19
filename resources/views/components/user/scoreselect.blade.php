<!-- Pricing -->
<div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
  <!-- Title -->
  <div class="max-w-2xl mx-auto text-center mb-10 lg:mb-14">
    <h2 class="text-2xl font-bold md:text-4xl md:leading-tight dark:text-white">Pricing</h2>
    <p class="mt-1 text-gray-600 dark:text-neutral-400">Whatever your status, our offers evolve according to your needs.</p>
  </div>
  <!-- End Title -->
  <!-- Grid -->
  @if ($kelases->category->category == 'kelas besar')
    <div class="mt-12 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-2.5">
      <div>
        <div class="max-w-xs flex flex-col mx-auto bg-white border border-gray-200 border-t-4 border-t-blue-600 shadow-2xs rounded-xl dark:bg-neutral-900 dark:border-neutral-700 dark:border-t-blue-500 dark:shadow-neutral-700/70">
          <div class="p-4 md:p-5">
            <h3 class="text-lg font-bold text-gray-800 dark:text-white">
              UTBK
            </h3>
            <p class="mt-2 text-gray-500 dark:text-neutral-400">
              With supporting text below as a natural lead-in to additional content.
            </p>
            <a href="/score/create/utbk" class="mt-3 inline-flex items-center gap-x-1 text-sm font-semibold rounded-lg border border-transparent text-blue-600 decoration-2 hover:text-blue-700 hover:underline focus:underline focus:outline-hidden focus:text-blue-700 disabled:opacity-50 disabled:pointer-events-none dark:text-blue-500 dark:hover:text-blue-600 dark:focus:text-blue-600">
              Go now
              <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="m9 18 6-6-6-6"></path>
              </svg>
            </a>
          </div>
        </div>
    </div>
    <div class="grid sm:grid-cols-2 lg:col-span-2 lg:grid-cols-3 gap-2 lg:items-center">
    <!-- Card -->
      @foreach ($mapels as $mapel)
      <div class="flex flex-col hover:border-2 hover:border-blue-600 text-center border border-gray-200 hover:shadow-xl rounded-xl p-8 hover:dark:border-blue-700 group transition-all peer duration-150 delay-200">
        <h4 class="font-medium text-lg text-gray-800 dark:text-neutral-200">{{ $mapel->nama_mapel }}</h4>
        <span class="mt-5 font-bold text-5xl text-gray-800 dark:text-neutral-200">
          {{ $mapel->siswa_di_kelas_count }}
        </span>
        <p class="mt-2 text-sm text-gray-500 dark:text-neutral-500">All the basics for starting a new business</p>
        <form action="/score/create" method="GET">
          @csrf
          <input type="hidden" name="kelas" value="{{ $kelases['id'] }}">
          <input type="hidden" name="mapel" value="{{ $mapel['id'] }}">
            <button type="submit" class="mt-5 py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 text-gray-800 group-hover:border-transparent bg-white group-hover:text-white group-hover:bg-blue-700 focus:outline-hidden focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none transition-all duration-150 delay-200">
              Insert score
            </button>
        </form>
      </div>
      @endforeach
      <!-- End Card -->
    </div>
  </div>
  @else
    <div class="mt-12 grid sm:grid-cols-2 lg:grid-cols-4 gap-6 lg:items-center">
    <!-- Card -->
      @foreach ($mapels as $mapel)
      <div class="flex flex-col hover:border-2 hover:border-blue-600 text-center border border-gray-200 hover:shadow-xl rounded-xl p-8 hover:dark:border-blue-700 group transition-all peer duration-150 delay-200">
        <h4 class="font-medium text-lg text-gray-800 dark:text-neutral-200">{{ $mapel->nama_mapel }}</h4>
        <span class="mt-5 font-bold text-5xl text-gray-800 dark:text-neutral-200">
          {{ $mapel->siswa_di_kelas_count }}
        </span>
        <p class="mt-2 text-sm text-gray-500 dark:text-neutral-500">All the basics for starting a new business</p>
        <form action="/score/create" method="GET">
          @csrf
          <input type="hidden" name="kelas" value="{{ $kelases['id'] }}">
          <input type="hidden" name="mapel" value="{{ $mapel['id'] }}">
            <button type="submit" class="mt-5 py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 text-gray-800 group-hover:border-transparent bg-white group-hover:text-white group-hover:bg-blue-700 focus:outline-hidden focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none transition-all duration-150 delay-200">
              Insert score
            </button>
        </form>
      </div>
      @endforeach
      <!-- End Card -->
    </div>
  @endif
  <!-- End Grid -->
</div>
<!-- End Pricing -->