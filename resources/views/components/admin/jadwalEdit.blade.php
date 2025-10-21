<div class="relative p-4 w-full max-w-2xl max-h-full mx-auto">
    <!-- Modal content -->
    <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
        <!-- Modal header -->
        <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Edit Schedule</h3>
            <a href="/jadwal" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-target="createProductModal" data-modal-toggle="createProductModal">
                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
                <span class="sr-only">Close modal</span>
            </a>
        </div>
        <!-- Modal body -->
        <form action="/update/{{ $schedule['id'] }}" method="POST">
            @method('PATCH')
            @csrf
            <div class="grid gap-4 mb-4 sm:grid-cols-2">
                <div>
                    <label for="pengajar" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tentor</label>
                    <select id="pengajar" name="pengajar" class="@error('pengajar') border-red-500 @enderror bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                        <option selected="" value="">Select Tentor</option>
                        @foreach (App\Models\User::where('is_admin','=', false)->get() as $pengajar)
                            <option value="{{ old('pengajar') ?? $pengajar['id']  }}" @selected((old('pengajar') ?? $pengajar['id']) == $pengajar['id'])>{{ $pengajar['name'] }}</option>
                        @endforeach
                    </select>
                    @error('pengajar')
                        <div class="text-red-500 text-xs">{{ $message }}</div>
                    @enderror
                </div>
                <div>
                    <label for="mapel" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Mapel</label>
                    <select id="mapel" name="mapel" class="@error('mapel') border-red-500 @enderror bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                        <option selected="" value="">Select Mapel</option>
                        @foreach (App\Models\Mapel::get() as $mapel)
                            <option value="{{ old('mapel') ?? $mapel['id']  }}" @selected((old('mapel') ?? $mapel['id']) == $mapel['id'])>{{ $mapel['nama_mapel'] }}</option>
                        @endforeach
                    </select>
                    @error('mapel')
                        <div class="text-red-500 text-xs">{{ $message }}</div>
                    @enderror
                </div>
                <div>
                    <label for="kelas" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kelas</label>
                    <select id="kelas" name="kelas" class="@error('kelas') border-red-500 @enderror bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                        <option selected="" value="">Select Kelas</option>
                        @foreach (App\Models\Kelas::get() as $kelas)
                            <option value="{{ old('kelas') ?? $kelas['id']  }}"  @selected((old('kelas') ?? $kelas['id']) == $kelas['id'])>{{ $kelas['kelas'] }}</option>
                        @endforeach
                    </select>
                    @error('kelas')
                        <div class="text-red-500 text-xs">{{ $message }}</div>
                    @enderror
                </div>
                <div>
                    <label for="jam" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jam</label>
                    <select id="jam" name="jam" class="@error('jam') border-red-500 @enderror bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                        <option selected="" value="">Select Jam</option>
                        @foreach (App\Models\Jam::get() as $jam)
                            <option value="{{ old('jam') ?? $jam['id']  }}"  @selected((old('jam') ?? $jam['id']) == $jam['id'])>{{ $jam['start'] }} - {{ $jam['end'] }}</option>
                        @endforeach
                    </select>
                    @error('jam')
                        <div class="text-red-500 text-xs">{{ $message }}</div>
                    @enderror
                </div>
                <div></div>
                <div>
                    <label for="tanggal">Tanggal</label>
                    <input type="date" name="tanggal" id="tanggal" value="{{ old('tanggal') ?? $schedule['tanggal'] }}" class="border-0 focus:ring-0 focus:outline-0">
                </div>
            </div>
            <button type="submit" class="text-white inline-flex items-center bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                <svg class="mr-1 -ml-1 w-6 h-6" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                </svg>
                Edit schedule
            </button>
        </form>
    </div>
</div>