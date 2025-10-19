<div class="max-w-3xl mx-auto bg-white dark:bg-gray-800 shadow-lg rounded-2xl p-8">
  <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100 mb-6">Edit Profile</h2>

  <form action="/user/{{ $user['slug'] }}" method="POST" enctype="multipart/form-data" class="space-y-6">
    @csrf
    @method('PATCH')

    <!-- Foto Profil -->
    <div class="flex items-center space-x-6">
      <div class="shrink-0">
        @php
          if(Auth::user()->avatar != null){
              $path = 'storage/' . Auth::user()->avatar;
          }else{
              $path = 'img/neu.png';
          }
      @endphp
        <img class="h-20 w-20 object-cover rounded-full" src="{{ asset($path) }}" alt="Current profile photo">
      </div>
      <label class="block">
        <span class="sr-only">Choose profile photo</span>
        <input type="file" name="avatar" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100"/>
      </label>
      @error('avatar')
        <div class="mt-2 text-xs text-red-600 dark:text-red-500">{{ $message }}</div>
    @enderror
    </div>

    <!-- Nama -->
    <div>
      <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama Lengkap</label>
      <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" class="@error('name') bg-red-50 border border-red-500 text-red-900 placeholder-red-700 @enderror mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700  dark:text-gray-200 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"/>
    @error('name')
        <div class="mt-2 text-xs text-red-600 dark:text-red-500">{{ $message }}</div>
    @enderror
    </div>

    <!-- Email -->
    <div>
      <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
      <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" class="@error('email') bg-red-50 border border-red-500 text-red-900 placeholder-red-700 @enderror mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700  dark:text-gray-200 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"/>
      @error('email')
        <div class="mt-2 text-xs text-red-600 dark:text-red-500">{{ $message }}</div>
    @enderror
    </div>

    <!-- Password -->
    <div>
      <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Password Baru</label>
      <input type="password" name="password" id="password" value="{{ old('password') }}" class="mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700  dark:text-gray-200 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"/>
      <p class="text-xs text-gray-500 mt-1">Kosongkan jika tidak ingin mengubah password.</p>
    </div>

    <!-- Tombol Aksi -->
    <div class="flex items-center justify-end gap-x-4">
      <a href="/dashboard" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 transition">Batal</a>
      <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">Simpan</button>
    </div>
  </form>
</div>
