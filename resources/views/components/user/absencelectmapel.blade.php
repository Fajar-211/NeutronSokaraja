<!-- Pricing -->
<div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
  <!-- Title -->
  <div class="max-w-2xl mx-auto text-center mb-10 lg:mb-14">
    <h2 class="text-2xl font-bold md:text-4xl md:leading-tight dark:text-white">class you have</h2>
    <p class="mt-1 text-gray-600 dark:text-neutral-400">Start taking attendance of your students</p>
  </div>
  <!-- End Title -->
  <!-- Grid -->
  <div class="mt-12 grid sm:grid-cols-2 lg:grid-cols-4 gap-6 lg:items-center">
    <!-- Card -->
    @foreach ($mapels as $mapel)
    <div class="flex flex-col hover:border-2 hover:border-blue-600 text-center border border-gray-200 hover:shadow-xl rounded-xl p-8 hover:dark:border-blue-700 group transition-all peer duration-150 delay-200">
      <h4 class="font-medium text-lg text-gray-800 dark:text-neutral-200">{{ $mapel->nama_mapel }}</h4>
      <span class="mt-5 font-bold text-5xl text-gray-800 dark:text-neutral-200">
        {{-- <span class="font-bold text-2xl -me-2">$</span> --}}
        {{ $mapel->siswa_di_kelas_count }}
      </span>
      <p class="mt-2 text-sm text-gray-500 dark:text-neutral-500">Students take the subject you teach</p>
      <form action="/absent/create" method="GET">
        @csrf
        <input type="hidden" name="kelas" value="{{ $kelases['id'] }}">
        <input type="hidden" name="mapel" value="{{ $mapel['id'] }}">
          <button type="submit" class="mt-5 py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 text-gray-800 group-hover:border-transparent bg-white group-hover:text-white group-hover:bg-blue-700 focus:outline-hidden focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none transition-all duration-150 delay-200">
            Insert absent
          </button>
      </form>
    </div>
    @endforeach
    <!-- End Card -->
  </div>
  <!-- End Grid -->
</div>
<!-- End Pricing -->