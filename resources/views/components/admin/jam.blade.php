<!-- Hero -->
<div class="overflow-hidden bg-neutral-900">
  <div class="max-w-5xl mx-auto xl:px-0 pt-24 lg:pt-32 pb-24">
    <h1 class="font-light text-white text-5xl md:text-6xl text-center">
      <span class="text-[#ff0] font-semibold">TIME</span> Overview
    </h1>
    <div class="mt-5 max-w-4xl px-2">
      <p class="text-neutral-400 text-lg">
        It is a creative hub where imagination meets craftsmanship to transform ideas into tangible realities. At Preline Agency, we specialize in turning conceptual visions into concrete forms, whether it be through design, artistry, or technological innovation.
      </p>
    </div>
    <div class="flex">
      <a class="sm:w-auto py-3 px-4 inline-flex items-center m-auto gap-x-2 text-sm font-light hover:shadow-xl/30 shadow-white rounded-lg border border-transparent bg-neutral-900 text-white outline-1 outline-slate-500 transition-all duration-700" href="/jadwal/jam/create">
        Try <span class="font-semibold">Now</span>
      </a>
    </div>
  </div>
</div>
<!-- End Hero -->
  
<!-- Clients -->
<div class="relative overflow-hidden pt-4 bg-neutral-900">
  <svg class="absolute  -bottom-20 start-1/2 w-[1900px] transform -translate-x-1/2" width="2745" height="488" viewBox="0 0 2745 488" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M0.5 330.864C232.505 403.801 853.749 527.683 1482.69 439.719C2111.63 351.756 2585.54 434.588 2743.87 487" class="stroke-neutral-700/50" stroke="currentColor"/>
    <path d="M0.5 308.873C232.505 381.81 853.749 505.692 1482.69 417.728C2111.63 329.765 2585.54 412.597 2743.87 465.009" class="stroke-neutral-700/50" stroke="currentColor"/>
    <path d="M0.5 286.882C232.505 359.819 853.749 483.701 1482.69 395.738C2111.63 307.774 2585.54 390.606 2743.87 443.018" class="stroke-neutral-700/50" stroke="currentColor"/>
    <path d="M0.5 264.891C232.505 337.828 853.749 461.71 1482.69 373.747C2111.63 285.783 2585.54 368.615 2743.87 421.027" class="stroke-neutral-700/50" stroke="currentColor"/>
    <path d="M0.5 242.9C232.505 315.837 853.749 439.719 1482.69 351.756C2111.63 263.792 2585.54 346.624 2743.87 399.036" class="stroke-neutral-700/50" stroke="currentColor"/>
    <path d="M0.5 220.909C232.505 293.846 853.749 417.728 1482.69 329.765C2111.63 241.801 2585.54 324.633 2743.87 377.045" class="stroke-neutral-700/50" stroke="currentColor"/>
    <path d="M0.5 198.918C232.505 271.855 853.749 395.737 1482.69 307.774C2111.63 219.81 2585.54 302.642 2743.87 355.054" class="stroke-neutral-700/50" stroke="currentColor"/>
    <path d="M0.5 176.927C232.505 249.864 853.749 373.746 1482.69 285.783C2111.63 197.819 2585.54 280.651 2743.87 333.063" class="stroke-neutral-700/50" stroke="currentColor"/>
    <path d="M0.5 154.937C232.505 227.873 853.749 351.756 1482.69 263.792C2111.63 175.828 2585.54 258.661 2743.87 311.072" class="stroke-neutral-700/50" stroke="currentColor"/>
    <path d="M0.5 132.946C232.505 205.882 853.749 329.765 1482.69 241.801C2111.63 153.837 2585.54 236.67 2743.87 289.082" class="stroke-neutral-700/50" stroke="currentColor"/>
    <path d="M0.5 110.955C232.505 183.891 853.749 307.774 1482.69 219.81C2111.63 131.846 2585.54 214.679 2743.87 267.091" class="stroke-neutral-700/50" stroke="currentColor"/>
    <path d="M0.5 88.9639C232.505 161.901 853.749 285.783 1482.69 197.819C2111.63 109.855 2585.54 192.688 2743.87 245.1" class="stroke-neutral-700/50" stroke="currentColor"/>
    <path d="M0.5 66.9729C232.505 139.91 853.749 263.792 1482.69 175.828C2111.63 87.8643 2585.54 170.697 2743.87 223.109" class="stroke-neutral-700/50" stroke="currentColor"/>
    <path d="M0.5 44.9819C232.505 117.919 853.749 241.801 1482.69 153.837C2111.63 65.8733 2585.54 148.706 2743.87 201.118" class="stroke-neutral-700/50" stroke="currentColor"/>
    <path d="M0.5 22.991C232.505 95.9276 853.749 219.81 1482.69 131.846C2111.63 43.8824 2585.54 126.715 2743.87 179.127" class="stroke-neutral-700/50" stroke="currentColor"/>
    <path d="M0.5 1C232.505 73.9367 853.749 197.819 1482.69 109.855C2111.63 21.8914 2585.54 104.724 2743.87 157.136" class="stroke-neutral-700/50" stroke="currentColor"/>
  </svg>

  <div class="relative">
    <!-- Card Section -->
    <div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
      <!-- Grid -->
      <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 kotak">
        <!-- Card -->
        @foreach ($jams as $jam)
          <div class="flex card flex-col bg-white border relative overflow-hidden border-gray-200 shadow-2xs rounded-xl dark:bg-neutral-800 dark:border-neutral-700 group">
            <div class="p-4 md:p-5 group-hover:opacity-60 group-hover:duration-700 group-hover:delay-500">
              <div class="flex items-center gap-x-2">
                <p class="text-xs uppercase text-gray-500 dark:text-neutral-500">
                  Sessions
                </p>
              </div>

              <div class="mt-1 flex items-center gap-x-2">
                <h3 class="text-xl sm:text-2xl font-medium text-gray-800 dark:text-neutral-200">
                  {{ $jam['start'] }} - {{ $jam['end'] }}
                </h3>
              </div>
            </div>
            <div class="absolute right-0 h-full px-3 flex pilihan translate-x-full transition-all duration-500">
              <a href="/jadwal/{{ $jam['id'] }}/edit" class="m-auto">
                <svg fill="#000000" class="w-4 h-4" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"  viewBox="0 0 20 20" enable-background="new 0 0 20 20" xml:space="preserve">
                <path d="M17,20H1c-0.6,0-1-0.4-1-1V3c0-0.6,0.4-1,1-1h9v2H2v14h14v-8h2v9C18,19.6,17.6,20,17,20z"/>
                <path d="M9.3,10.7c-0.4-0.4-0.4-1,0-1.4l9-9c0.4-0.4,1-0.4,1.4,0s0.4,1,0,1.4l-9,9C10.3,11.1,9.7,11.1,9.3,10.7z"/>
                </svg>
              </a>
              <form action="/jadwal/{{ $jam['id'] }}" method="POST">
                @method('DELETE')
                @csrf
                <button type="submit" class="max-w-max absolute top-0 right-0 bg-pink-400 text-red-600 rounded-full">
                  <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M16.95 8.464a1 1 0 0 0-1.414-1.414L12 10.586 8.464 7.05A1 1 0 1 0 7.05 8.464L10.586 12 7.05 15.536a1 1 0 1 0 1.414 1.414L12 13.414l3.536 3.536a1 1 0 0 0 1.414-1.414L13.414 12l3.536-3.536Z"/></svg>
              </button>
              </form>
            </div>
          </div>
        @endforeach
        <!-- End Card -->
      </div>
      <!-- End Grid -->
    </div>
    <!-- End Card Section -->
  </div>
</div>
<!-- End Clients -->
@push('jam')
  <script>
    const kotak = document.querySelector('.kotak');
    const card = kotak.querySelectorAll('.card');
    card.forEach(function(e){
      e.addEventListener('mouseover', function(){
        const pilihan = e.querySelector('.pilihan');
        pilihan.classList.remove('translate-x-full')
      });
      e.addEventListener('mouseleave', function(){
        const pilihan = e.querySelector('.pilihan');
        pilihan.classList.add('translate-x-full');
      });
    });
  </script>
@endpush