<div class="relative p-4 w-full max-w-2xl max-h-full mx-auto">
    <!-- Modal content -->
    <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
        <!-- Modal header -->
        <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Edit jam</h3>
        </div>
        <!-- Modal body -->
        <form action="/jadwal/{{ $jam['id'] }}" method="POST">
            @method('PATCH')
            @csrf
            <div class="grid gap-4 mb-4 sm:grid-cols-2">
                <div>
                    <label for="mulai" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Start</label>
                    <input type="time" name="start" id="mulai" step="1" value="{{ old('start') ?? $jam['start'] }}" class="@error('start') border-pink-300 @enderror bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                    @error('start')
                        <div class="text-red-500 text-xs">{{ $message }}</div>
                    @enderror
                </div>
                <div>
                    <label for="end" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">End</label>
                    <input type="time" name="end" id="end" step="1" value="{{ old('end') ?? $jam['end'] }}" class="@error('end') border-pink-300 @enderror bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                    @error('end')
                        <div class="text-red-500 text-xs">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <button type="submit" class="text-white inline-flex items-center bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                <svg class="mr-1 -ml-1 w-6 h-6" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                </svg>
                Add
            </button>
        </form>
    </div>
</div>