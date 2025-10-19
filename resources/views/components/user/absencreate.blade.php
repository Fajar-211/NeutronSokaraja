<section class="py-3 sm:py-5">
  <div class="px-4 mx-auto max-w-screen-2xl lg:px-6">
      <div class="relative overflow-hidden bg-white shadow-md dark:bg-gray-800 sm:rounded-lg">
          <div class="flex flex-col px-4 py-3 space-y-3 lg:flex-row lg:items-center lg:justify-between lg:space-y-0 lg:space-x-4">
              <div class="flex items-center flex-1 space-x-4">
                  <h5>
                      <span class="text-gray-500">All Students:</span>
                      @php
                          $jml = [];
                          $mape = [];
                          foreach($siswas as $siswa):
                            $jml[] = $siswa['nama'];
                            endforeach;
                          foreach($mapels as $mapel):
                                $mape[] = $mapel['id'];
                            endforeach;
                      @endphp
                      <span class="dark:text-white">{{ count($jml) }}</span>
                  </h5>
              </div>
        <form action="/absent" method="POST">
            @csrf
            <input type="hidden" name="pengajar" value="{{ Auth::user()->id }}">
            <input type="hidden" name="mapel" value="{{ $mape[0] }}">
              <div class="flex flex-col flex-shrink-0 space-y-3 md:flex-row md:items-center lg:justify-end md:space-y-0 md:space-x-3">
                  <button type="submit" class="flex items-center justify-center px-4 py-2 text-sm font-medium text-white rounded-lg bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">
                      <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                          <path clip-rule="evenodd" fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                      </svg>
                      Submit now
                  </button>
              </div>
          </div>
          <div class="grid lg:grid-cols-3 sm:grid-cols-1 gap-2 lg:gap-4">
            <div class="lg:col-span-2">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 @error('siswa') bg-red-50 border text-red-900 @enderror">
                  <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                      <tr>
                          <th scope="col" class="p-4">
                              
                          </th>
                          <th scope="col" class="px-4 py-3">Nama</th>
                          <th scope="col" class="px-4 py-3">NIS</th>
                          <th scope="col" class="px-4 py-3">Sekolah</th>
                      </tr>
                  </thead>
                  <tbody>
                    @foreach ($siswas as $siswa)
                      <tr class="border-b dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700">
                        <input type="hidden" name="all[]" value="{{ $siswa['id'] }}">
                          <td class="w-4 px-4 py-3">
                              <div class="flex items-center">
                                  <input name="siswa[]" value="{{ $siswa['id'] }}" {{ in_array($siswa->id, old('siswa', [])) ? 'checked' : '' }} id="checkbox-table-search-1" type="checkbox" onclick="event.stopPropagation()" class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                  <label for="checkbox-table-search-1" class="sr-only">checkbox</label>
                                  @php
                                      $siswa[$siswa['id']] = 'hadir'; 
                                  @endphp
                              </div>
                          </td>
                          <th scope="row" class="flex items-center px-4 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                              {{ $siswa['nama'] }}
                          </th>
                          <td class="px-4 py-2">
                              <span class="bg-primary-100 text-primary-800 text-xs font-medium px-2 py-0.5 rounded dark:bg-primary-900 dark:text-primary-300">{{ $siswa['nis'] }}</span>
                          </td>
                          <td class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $siswa['sekolah'] }}</td>
                      </tr>
                    @endforeach
                  </tbody>
              </table>
              @error('siswa')
                    <div class="mt-2 text-xs text-red-600 dark:text-red-500 px-3">{{ $message }}</div>
                @enderror
            </div>
            <div class="px-5 pb-5">
                <div>       
                    <div class="relative max-w-sm">
                        <input name="tanggal" value="{{ old('tanggal') }}" type="date" class="@error('tanggal') bg-red-50 border border-red-500 text-red-900 placeholder-red-700 @enderror bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select date">
                    </div>
                    @error('tanggal')
                        <div class="py-2 text-xs text-red-600 dark:text-red-500">{{ $message }}</div>
                    @enderror
                </div>
                <div class="sm:col-span-2 my-2.5">
                    <label for="sumary" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Summary</label>
                    <textarea name="sumary" id="sumary" rows="4" class="@error('sumary') bg-red-50 border border-red-500 text-red-900 placeholder-red-700 @enderror block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Summary">{{ old('sumary') }}</textarea>
                    @error('sumary')
                        <div class="mt-2 text-xs text-red-600 dark:text-red-500">{{ $message }}</div>
                    @enderror
                </div>
            </div>
          </div>
        </form>
      </div>
  </div>
</section>