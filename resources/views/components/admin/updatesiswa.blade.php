
    <div class="relative p-4 w-full max-w-4xl mx-auto max-h-full">
        <!-- Modal content -->
        <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
            <!-- Modal header -->
            <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Update student</h3>
            </div>
            <!-- Modal body -->
            <form action="/siswa/{{ $siswa['nis'] }}" method="POST">
                @csrf
                @method('PATCH')
                <div class="grid gap-4 mb-4 sm:grid-cols-2">
                    <div>
                        <label for="nama" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                        <input type="text" name="nama" id="nama" value="{{ old('nama') ?? $siswa['nama'] }}" class="@error('nama') bg-red-50 border border-red-500 text-red-900 placeholder-red-700 @enderror bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Name">
                        @error('nama')
                            <div class="mt-2 text-xs text-red-600 dark:text-red-500">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <label for="nis" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">NIS</label>
                        <input type="text" name="nis" id="nis" value="{{ old('nis') ?? $siswa['nis']}}" class="@error('nis') bg-red-50 border border-red-500 text-red-900 placeholder-red-700 @enderror bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="NIS">
                        @error('nis')
                            <div class="mt-2 text-xs text-red-600 dark:text-red-500">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <label for="sekolah" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">School</label>
                        <input type="text" name="sekolah" id="sekolah" value="{{ old('sekolah') ?? $siswa['sekolah'] }}" class="@error('sekolah') bg-red-50 border border-red-500 text-red-900 placeholder-red-700 @enderror bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="School">
                        @error('sekolah')
                            <div class="mt-2 text-xs text-red-600 dark:text-red-500">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <label for="kelas" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Class</label>
                        <select id="kelas" name="kelas" class="@error('kelas') bg-red-50 border border-red-500 text-red-900 placeholder-red-700 @enderror bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option selected="" value="">Select class</option>
                            @foreach (App\Models\Kelas::get() as $kelas)
                                <option @selected((old('kelas') ?? $siswa->kelas->id)==$kelas['id']) value="{{ $kelas['id'] }}">{{ $kelas['kelas'] }}</option>
                            @endforeach
                        </select>
                        @error('kelas')
                            <div class="mt-2 text-xs text-red-600 dark:text-red-500">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="sm:col-span-2">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Mapel</label>
                        <div class="grid grid-cols-5 gap-2.5">
                            @foreach (App\Models\Mapel::get() as $mapel)
                                <div class="flex items-center w-full">
                                    <input id="checkbox-{{ $mapel['id'] }}" type="checkbox" name="mapel[]" value="{{ $mapel['id'] }}" {{ in_array($mapel->id, old('mapel', $siswa->mengambil->pluck('id')->toArray())) ? 'checked' : '' }} class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="checkbox-{{ $mapel['id'] }}" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ $mapel['nama_mapel'] }}</label>
                                </div>
                            @endforeach
                        </div>
                            @error('mapel')
                                <div class="mt-2 text-xs text-red-600 dark:text-red-500">{{ $message }}</div>
                            @enderror
                    </div>
                </div>
                <button type="submit" class="text-white inline-flex items-center bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                    <svg class="mr-1 -ml-1 w-6 h-6" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                    </svg>
                    Update siswa
                </button>
                <a href="/siswa" class="text-red-600 inline-flex items-center hover:text-white border border-red-600 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">
                        <svg class="mr-1 -ml-1 w-5 h-5" fill="currentColor" viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <g id="icomoon-ignore">
                            </g>
                            <path d="M14.389 7.956v4.374l1.056 0.010c7.335 0.071 11.466 3.333 12.543 9.944-4.029-4.661-8.675-4.663-12.532-4.664h-1.067v4.337l-9.884-7.001 9.884-7zM15.456 5.893l-12.795 9.063 12.795 9.063v-5.332c5.121 0.002 9.869 0.26 13.884 7.42 0-4.547-0.751-14.706-13.884-14.833v-5.381z">
                            </path>
                        </svg>
                        Back
                </a>
            </form>
        </div>
    </div>