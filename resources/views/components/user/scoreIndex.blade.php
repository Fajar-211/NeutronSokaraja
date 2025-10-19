<!-- Pricing -->
<div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
  <!-- Title -->
  <div class="max-w-2xl mx-auto text-center mb-10 lg:mb-14">
    <h2 class="text-2xl font-bold md:text-4xl md:leading-tight dark:text-white">Score experience</h2>
    <p class="mt-1 text-gray-600 dark:text-neutral-400">Let's enter grades and notes to improve your students' development.</p>
  </div>
  <!-- End Title -->
  <!-- Grid -->
  <div class="mt-12 grid sm:grid-cols-2 lg:grid-cols-4 gap-6 lg:items-center">
    <!-- Card -->
    @foreach ($kelases as $kelas)
    <div class="flex flex-col hover:border-2 hover:bg-slate-200 hover:border-blue-600 text-center border border-gray-200 hover:shadow-xl rounded-xl p-8 hover:dark:border-blue-700 group transition-all peer duration-150 delay-200">
      <p class="mb-3 group-hover:inline opacity-0 transition-all transition-discrete group-hover:opacity-100 duration-150 delay-200"><span class="inline-flex items-center gap-1.5 py-1.5 px-3 rounded-lg text-xs uppercase font-semibold group-hover:bg-{{ $kelas->category->color }}-100 group-hover:text-blue-800 dark:bg-blue-600 dark:text-white transition-all duration-150 delay-200">{{ $kelas->category->category }}</span></p>
      <h4 class="font-medium text-lg text-gray-800 dark:text-neutral-200">{{ $kelas['kelas'] }}</h4>
      <div class="max-w-max mx-auto">
          <div class="my-1 font-bold text-5xl text-gray-800 dark:text-neutral-200">
            <svg class="size-7" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M4 6.633c.14-.056.308-.118.503-.181A9.77 9.77 0 0 1 7.5 6a9.77 9.77 0 0 1 2.997.452c.195.063.363.125.503.181v10.88A11.817 11.817 0 0 0 7.5 17c-1.46 0-2.649.248-3.5.513V6.633zm8-1.748a9.257 9.257 0 0 0-.888-.337A11.769 11.769 0 0 0 7.5 4c-1.526 0-2.755.271-3.612.548a8.889 8.889 0 0 0-1.001.389 5.905 5.905 0 0 0-.357.18l-.025.014-.009.005-.003.002h-.001c-.002.002-.247.147-.002.002A1 1 0 0 0 2 6v13a1 1 0 0 0 1.51.86l-.005.003h.001l.002-.001.001-.001.037-.02c.037-.02.098-.05.182-.09.17-.078.43-.188.775-.3A9.77 9.77 0 0 1 7.5 19a9.77 9.77 0 0 1 2.997.451 6.9 6.9 0 0 1 .775.3 3.976 3.976 0 0 1 .223.112m0 0h-.001l-.002-.001-.001-.001c.314.185.704.185 1.018 0l.037-.02c.037-.02.098-.05.182-.09a6.9 6.9 0 0 1 .775-.3A9.77 9.77 0 0 1 16.5 19a9.77 9.77 0 0 1 2.997.451 6.9 6.9 0 0 1 .775.3 3.976 3.976 0 0 1 .219.11A1 1 0 0 0 22 19V6a1 1 0 0 0-.49-.86l-.002-.001h-.001l-.003-.003-.01-.005-.024-.014a5.883 5.883 0 0 0-.357-.18 8.897 8.897 0 0 0-1-.389A11.769 11.769 0 0 0 16.5 4c-1.525 0-2.755.271-3.612.548a9.112 9.112 0 0 0-.888.337m8 1.748v10.88A11.817 11.817 0 0 0 16.5 17c-1.46 0-2.649.248-3.5.513V6.633c.14-.056.308-.118.503-.181A9.77 9.77 0 0 1 16.5 6a9.77 9.77 0 0 1 2.997.452c.195.063.363.125.503.181zm.49.228l.005.002h-.001l-.003-.002zm0 13l.004.002-.002-.002" fill="#0D0D0D"/></svg>
          </div>
      </div>
      <p class="mt-2 text-sm text-gray-500 dark:text-neutral-500">All the basics for starting a new business</p>
      <a href="/score/create/{{ $kelas['id'] }}" class="mt-5 py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 text-gray-800 group-hover:border-transparent bg-white group-hover:text-white group-hover:bg-blue-700 focus:outline-hidden focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none transition-all duration-150 delay-200">
        Entery class
      </a>
    </div>
    @endforeach
    <!-- End Card -->
  </div>
  <!-- End Grid -->
</div>
<!-- End Pricing -->