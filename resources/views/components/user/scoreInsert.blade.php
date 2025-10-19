<div class="relative p-4 w-full max-w-2xl max-h-full mx-auto">
    <!-- Modal content -->
    <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
        <!-- Modal header -->
        <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
            <h3 class="text-lg font-semibold text-gray-400 dark:text-white">Insert score <span class="text-gray-600">{{ $siswa->nama }}</span></h3>
        </div>
        <!-- Modal body -->
        <form action="/score" method="POST">
            @csrf
            <input type="hidden" name="pengajar" value="{{ Auth::user()->id }}">
            <input type="hidden" name="mapel" value="{{ $mapel }}">
            <input type="hidden" name="siswa" value="{{ $siswa['id'] }}">
            <div class="grid gap-4 mb-4 sm:grid-cols-2">
                <div>
                    <label for="score" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Score</label>
                    <input type="number" name="score" id="score" value="{{ old('score') }}" class="@error('score') border-red-300 @enderror bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="score">
                    @error('score')
                        <div class="text-xs text-red-500">{{ $message }}</div>
                    @enderror
                </div>
                <div>
                    <label for="tanggal" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tanggal</label>
                    <input type="date" name="tanggal" id="tanggal" class="@error('score') border-red-300 border-2 bg-red-400 rounded-lg @enderror outline-0 ring-0 border-0">
                    @error('tanggal')
                        <div class="text-xs text-red-500">{{ $message }}</div>
                    @enderror
                </div>
                <div class="sm:col-span-2"><label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Note</label><textarea name="note" id="description" rows="5" class="@error('note') border-red-300 @enderror block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Write a note...">{{ old('note') }}</textarea>
                    @error('note')
                        <div class="text-xs text-red-400">{{ $message }}</div>
                    @enderror</div>
            </div>
            <div class="flex items-center space-x-4">
                <button type="submit" class="text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Insert score</button>
            </div>
        </form>
    </div>
</div>