@push('styles')
    <style>
        /* Tambahkan ini di file CSS atau di tag style */
        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in {
            animation: fadeIn 0.8s ease-out forwards;
        }

        .animate-fade-in-up {
            animation: fadeInUp 0.6s ease-out forwards;
        }
    </style>
@endpush
<x-layout :title="$title">
    {{-- Tambahkan kelas ini untuk efek fade-in --}}
    <div class="relative isolate py-14 px-6 sm:py-20 sm:px-8 lg:py-28 lg:px-10 animate-fade-in">
        <div class="mx-auto max-w-5xl py-10 sm:py-16 lg:py-24">
            {{-- Bagian pengumuman --}}
            <div class="hidden sm:mb-8 sm:flex sm:justify-center">
                <div
                    class="relative rounded-full px-3 py-1 text-sm/6 text-gray-600 ring-1 ring-gray-900/10 hover:ring-gray-900/20 transition-all duration-300">
                    Ingin berkontribusi dalam pergerakan literasi? <a href="/kirim-tulisan"
                        class="font-semibold text-red-600"><span aria-hidden="true" class="absolute inset-0"></span>Kirim
                        Tulisanmu di Sini <span aria-hidden="true">&rarr;</span></a>
                </div>
            </div>

            {{-- Konten utama --}}
            <div class="text-center">
                <h1
                    class="text-5xl font-semibold tracking-tight text-balance text-red-500 sm:text-7xl animate-fade-in-up delay-200">
                    Ruang Karya Tulis Kader: Suara Kader untuk Peradaban
                </h1>
                <p class="mt-8 text-lg font-medium text-pretty text-gray-500 sm:text-xl/8 animate-fade-in-up delay-400">
                    Selamat datang di platform opini, esai, dan karya tulis dari kader Ikatan Mahasiswa Muhammadiyah
                    Fakultas Teknik UMJ. Temukan tulisan-tulisan tajam yang mengupas tuntas isu-isu keilmuan,
                    keislaman, dan kemasyarakatan dari sudut pandang kader IMM FT UMJ.
                </p>
                <div class="mt-10 flex items-center justify-center gap-x-6 animate-fade-in-up delay-600">
                    <a href="/posts"
                        class="rounded-md px-3.5 py-2.5 text-sm font-semibold text-white shadow-xs bg-red-700 transition delay-150 duration-300 ease-in-out hover:-translate-y-1 hover:scale-110 hover:bg-red-400">Jelajahi
                        Tulisan</a>
                    <a href="/about"
                        class="text-sm/6 font-semibold text-gray-900 transition-all duration-300 hover:text-red-600">Tentang
                        IMM <span aria-hidden="true">→</span></a>
                </div>
            </div>
        </div>
    </div>
</x-layout>
