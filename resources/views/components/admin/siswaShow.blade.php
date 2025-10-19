{{-- <main class="pt-8 pb-16 lg:pt-16 lg:pb-24 bg-white dark:bg-gray-900 antialiased">
  <div class="flex justify-between px-4 mx-auto max-w-screen-4xl ">
      <article class="mx-auto w-full max-w-2xl format format-sm sm:format-base lg:format-lg format-blue dark:format-invert">
          <header class="mb-4 lg:mb-6 not-format">
              <address class="flex items-center mb-6 not-italic">
                  <div class="inline-flex items-center mr-3 text-sm text-gray-900 dark:text-white">
                      <img class="mr-4 w-16 h-16 rounded-full" src="{{ asset('img/neu.png') }}">
                      <div>
                          <a href="#" rel="author" class="text-xl font-bold text-gray-900 dark:text-white">{{ $siswa['nama'] }}</a>
                          <p class="text-base text-gray-500 dark:text-gray-400">{{ $siswa['nis'] }}</p>
                          <p class="text-base text-gray-500 dark:text-gray-400">{{ $siswa->kelas->kelas }}</p>
                      </div>
                  </div>
              </address>
              <h1 class="mb-4 text-3xl font-extrabold leading-tight text-gray-900 lg:mb-6 lg:text-4xl dark:text-white">Best practices for successful prototypes</h1>
          </header>
          <table>
              <thead>
                  <tr>
                      <th>Mapel</th>
                      <th>Tentor</th>
                  </tr>
              </thead>
              <tbody>
                @foreach ($siswa->mengambil as $mapel)
                    <tr>
                      <td>{{ $mapel['nama_mapel'] }}</td>
                      <td>
                        @foreach ($mapel->diajar as $pengajar)
                            <div>
                                {{ $pengajar->name }}
                            </div>
                      @endforeach</td>
                  </tr>
                @endforeach
              </tbody>
          </table>
          <h3>Detail score</h3>
            <div class="relative overflow-x-auto">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3 rounded-s-lg">
                                Evaluasi
                            </th>
                            @php
                                $nilaiGrouped = $siswa->nilai->groupBy('mapel_id');
                                $maxNilai = $nilaiGrouped->max(fn($group) => $group->count());
                            @endphp
                            @for ($i = 1; $i <= $maxNilai; $i++)
                                @if ($i == 1)
                                    <th>Nilai</th>
                                @else
                                    <th></th>
                                @endif
                            @endfor
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($nilaiGrouped as $mapelId => $nilaiList)
                            <tr class="bg-white dark:bg-gray-800">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $nilaiList->first()->mapel->nama_mapel }}
                                </th>
                                @foreach ($nilaiList as $n)
                                    <td class="px-6 py-4">
                                        {{ $n->nilai }}
                                    </td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                @if ($siswa->note == true)
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3 rounded-s-lg">
                                    UTBK
                                </th>
                                <th scope="col" class="px-6 py-3 rounded-e-lg">
                                    Nilai
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($siswa->note->score as $score)
                                <tr class="bg-white dark:bg-gray-800">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $score->utbk->utbk }}
                                    </th>
                                    <td class="px-6 py-4">
                                        {{ $score->score }}
                                    </td>
                                </tr>
                            @endforeach
                    </tbody>
                </table>
                @endif
            </div>
        <h3>Attendance summary</h3>
            <div class="relative overflow-x-auto">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3 rounded-s-lg">
                                Mapel
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Present
                            </th>
                            <th scope="col" class="px-6 py-3 rounded-e-lg">
                                Absent
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $rekapHadir = $hadir->groupBy('mapel_id')->map->count();
                            $rekapTidak = $tidak->groupBy('mapel_id')->map->count();
                        @endphp
                        @foreach ($siswa->mengambil as $mapel)
                            <tr class="bg-white dark:bg-gray-800">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $mapel['nama_mapel'] }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ $rekapHadir[$mapel['id']] ?? 0 }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $rekapTidak[$mapel['id']] ?? 0 }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr class="font-semibold text-gray-900 dark:text-white">
                            <th scope="row" class="px-6 py-3 text-base">Total</th>
                            <td class="px-6 py-3">{{ $hadir->count() }}</td>
                            <td class="px-6 py-3">{{ $tidak->count() }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="">
                <p class="text-sm text-red-400 italic">Catatan*</p>
                @if ($siswa->note == true)
                    <p>{{ $siswa->note->catatan }}</p>
                @else
                    @foreach ($siswa->nilai as $catatan)
                        <p class="text-sm">{{ $catatan['catatan'] }}</p>
                    @endforeach
                @endif
            </div>
      </article>
  </div>
</main> --}}

<main class="bg-white p-8 max-w-4xl mx-auto text-sm text-gray-900 border border-gray-300">
    <!-- Header -->
    <div class="flex justify-between items-center border-b pb-4 mb-4">
        <div>
            <img src="{{ asset('img/n.png') }}" alt="Logo" class="w-30">
        </div>
        <div class="text-center">
            <h1 class="text-lg font-bold uppercase relative"><img src="{{ asset('img/neu.png') }}" alt="Logo" class="w-5 absolute bottom-1">RAPOR</h1>
            <p class="text-sm">Laporan Hasil Belajar</p>
        </div>
        <div class="text-right">
            <p class="font-bold">Purbalingga</p>
            <p class="">Periode {{ $bulan }} {{ $tahun }}</p>
        </div>
    </div>

    <!-- Identitas -->
    <table class="w-full mb-6 text-sm">
        <tr>
            <td class="w-32">Nama</td>
            <td>: {{ $siswa['nama'] }}</td>
        </tr>
        <tr>
            <td>Asal Sekolah</td>
            <td>: {{ $siswa['sekolah'] }}</td>
        </tr>
        <tr>
            <td>Kelas</td>
            <td>: {{ $siswa->kelas->kelas }}</td>
        </tr>
    </table>

    <!-- Nilai UTBK -->
    @if ($siswa->kelas->category['category'] === 'kelas besar')
    <h2 class="font-bold mb-2">Hasil Tryout Ujian Tulis Berbasis Komputer</h2>
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3 rounded-s-lg">
                        UTBK
                    </th>
                    <th scope="col" class="px-6 py-3 rounded-e-lg">
                        Nilai
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($siswa->note->score as $score)
                    <tr class="bg-white dark:bg-gray-800">
                        <th scope="row" class="px-6 py-1 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $score->utbk->utbk }}
                        </th>
                        <td class="px-6 py-1">
                            {{ $score->score }}
                        </td>
                    </tr>
                @endforeach
        </tbody>
        {{-- <tfoot>
            <tr class="font-semibold text-gray-900 dark:text-white">
                <th scope="row" class="px-6 py-3 text-base">Total</th>
                <td class="px-6 py-3">21,000</td>
            </tr>
            <tr class="font-semibold text-gray-900 dark:text-white">
                <th scope="row" class="px-6 py-3 text-base">Average</th>
                <td class="px-6 py-3">21,000</td>
            </tr>
        </tfoot> --}}
        </table>
    @endif
    <h2 class="font-bold mb-2">Hasil Evaluasi</h2>
    <div class="relative overflow-x-auto">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3 rounded-s-lg">
                        Evaluasi
                    </th>
                    @php
                        $nilaiGrouped = $siswa->nilai->groupBy('mapel_id');
                        $maxNilai = $nilaiGrouped->max(fn($group) => $group->count());
                    @endphp
                    @for ($i = 1; $i <= $maxNilai; $i++)
                        @if ($i == 1)
                            <th>Nilai</th>
                        @else
                            <th></th>
                        @endif
                    @endfor
                    {{-- <th scope="col" class="px-6 py-3 rounded-e-lg">
                        Score
                    </th> --}}
                </tr>
            </thead>
            <tbody>
                @foreach ($nilaiGrouped as $mapelId => $nilaiList)
                    <tr class="bg-white dark:bg-gray-800">
                        <th scope="row" class="px-6 py-1 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $nilaiList->first()->mapel->nama_mapel }}
                        </th>
                        @foreach ($nilaiList as $n)
                            <td class="px-6 py-1">
                                {{ $n->nilai }}
                            </td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Kehadiran -->
    <h2 class="font-bold mb-2">Rekapitulasi Kehadiran Siswa</h2>
    <div class="relative overflow-x-auto">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3 rounded-s-lg">
                        Mapel
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Kehadiran
                    </th>
                    {{-- <th scope="col" class="px-6 py-3 rounded-e-lg">
                        Absent
                    </th> --}}
                </tr>
            </thead>
            <tbody>
                @php
                    $rekapHadir = $hadir->groupBy('mapel_id')->map->count();
                    $rekapTidak = $tidak->groupBy('mapel_id')->map->count();
                @endphp
                @foreach ($siswa->mengambil as $mapel)
                    <tr class="bg-white dark:bg-gray-800">
                        <th scope="row" class="px-6 py-1 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $mapel['nama_mapel'] }}
                        </th>
                        <td class="px-6 py-1">
                            {{ $rekapHadir[$mapel['id']] ?? 0 }}
                        </td>
                        {{-- <td class="px-6 py-1">
                            {{ $rekapTidak[$mapel['id']] ?? 0 }}
                        </td> --}}
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr class="font-semibold text-gray-900 dark:text-white">
                    <th scope="row" class="px-6 py-3 text-base">Total</th>
                    <td class="px-6 py-3">{{ $hadir->count() }}</td>
                    {{-- <td class="px-6 py-3">{{ $tidak->count() }}</td> --}}
                </tr>
            </tfoot>
        </table>
    </div>

    <!-- Catatan -->
    @if ($siswa->note == true)
        <div class="mt-4">
            <p class="font-bold">Catatan</p>
            <p class="italic text-gray-600">
                {{ $siswa->note['catatan'] }}
            </p>
        </div>
    @endif

    <!-- Footer tanda tangan -->
    <div class="flex justify-between mt-12">
        <div>
            <p class="font-semibold">Kepala Cabang</p>
            <p class="mt-16">TRI SANTOSO</p>
        </div>
        <div class="text-right">
            <p class="font-semibold">Koordinator Pendidik</p>
            <p class="mt-16">ARIYANTO TRI KUSUMO</p>
        </div>
    </div>
</main>
