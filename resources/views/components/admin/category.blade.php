<!-- Hero -->
<div class="relative overflow-hidden before:absolute before:top-0 before:start-1/2 bg-[url('https://preline.co/assets/svg/examples/polygon-bg-element.svg')] dark:bg-[url('https://preline.co/assets/svg/examples-dark/polygon-bg-element.svg')] before:bg-no-repeat before:bg-top before:bg-cover before:size-full before:-z-1 before:transform before:-translate-x-1/2">
  <div class="max-w-[85rem] mx-auto px-4 sm:px-6 lg:px-8 pt-24 pb-10">
    <!-- Title -->
    <div class="mt-5 max-w-2xl text-center mx-auto">
      <h1 class="block font-bold text-gray-800 text-4xl md:text-5xl lg:text-6xl dark:text-neutral-200">
        Let's Build
        <span class="bg-clip-text bg-linear-to-tl from-blue-600 to-violet-600 text-transparent">Category</span>
      </h1>
    </div>
    <!-- End Title -->

    <div class="mt-5 max-w-3xl text-center mx-auto">
      <p class="text-lg text-gray-600 dark:text-neutral-400">Let's group the Purbalingga neutron classes into class categories. With class categories, you can manage them easily.</p>
    </div>

    <!-- Buttons -->
    <div class="mt-8 gap-3 flex justify-center">
      <a class="inline-flex justify-center items-center gap-x-3 text-center bg-linear-to-tl from-blue-600 to-violet-600 hover:from-violet-600 hover:to-blue-600 border border-transparent text-white text-sm font-medium rounded-md focus:outline-hidden focus:from-violet-600 focus:to-blue-600 py-3 px-4" href="/category/create">
        Add category
        <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
      </a>
    </div>
    <!-- End Buttons -->
  </div>
</div>
<!-- End Hero -->

<!-- Team -->
<div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
  <!-- Title -->
  <div class="max-w-2xl mx-auto text-center mb-10 lg:mb-14">
    <h2 class="text-2xl font-bold md:text-4xl md:leading-tight dark:text-white">Category available</h2>
  </div>
  <!-- End Title -->

  <!-- Grid -->
  <div>
        <div class="grid grid-cols-2 gap-8 md:gap-12 max-w-2xl mx-auto">
        @forelse ($categories as $category)
            <div class="flex flex-col sm:flex-row sm:items-center gap-3 sm:gap-4 outline-1 p-2 outline-slate-200 rounded-lg relative">
              <form action="/category/{{ $category['slug'] }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="inline-block max-w-max absolute top-0 right-0 text-pink-300 hover:text-red-800">
                  <svg class="w-5 h-5 fill-current" viewBox="-6 -6 24 24" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMinYMin" class="jam jam-close"><path d='M7.314 5.9l3.535-3.536A1 1 0 1 0 9.435.95L5.899 4.485 2.364.95A1 1 0 1 0 .95 2.364l3.535 3.535L.95 9.435a1 1 0 1 0 1.414 1.414l3.535-3.535 3.536 3.535a1 1 0 1 0 1.414-1.414L7.314 5.899z' /></svg>
                </button>
              </form>
                <div class="size-20">
                    <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" 
                        viewBox="0 0 32 32" xml:space="preserve">
                    <line style="fill:none;stroke:#000000;stroke-width:2;stroke-miterlimit:10;" x1="3" y1="13" x2="3" y2="24"/>
                    <circle cx="3" cy="24" r="2"/>
                    <polygon style="fill:none;stroke:#000000;stroke-width:2;stroke-miterlimit:10;" points="16,8.833 3.5,13 16,17.167 28.5,13 "/>
                    <path style="fill:none;stroke:#000000;stroke-width:2;stroke-miterlimit:10;" d="M7,14.451V20c0,1.657,4.029,3,9,3s9-1.343,9-3
                        v-5.549"/>
                    </svg>
                </div>

                <div class="grow">
                    <div>
                    <h3 class="font-medium text-gray-800 dark:text-neutral-200">
                        {{ $category['category'] }}
                    </h3>
                    <p class="mt-1 text-xs uppercase text-gray-500 dark:text-neutral-500">
                        {{ count($category->kelas) }} kelas
                    </p>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-2 my-5">
                <h3 class="font-semibold text-2xl text-red-600 text-center">0 Category class</h3>
            </div>
        @endforelse
        </div>
  </div>
  <!-- End Grid -->
</div>
<!-- End Team -->

