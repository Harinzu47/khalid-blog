<x-layout :title="$title">
    @push('styles')
        <style>
            @keyframes fadeInUp {
                from {
                    opacity: 0;
                    transform: translateY(30px);
                }

                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            @keyframes fadeInLeft {
                from {
                    opacity: 0;
                    transform: translateX(-30px);
                }

                to {
                    opacity: 1;
                    transform: translateX(0);
                }
            }

            @keyframes fadeInRight {
                from {
                    opacity: 0;
                    transform: translateX(30px);
                }

                to {
                    opacity: 1;
                    transform: translateX(0);
                }
            }

            @keyframes float {

                0%,
                100% {
                    transform: translateY(0px);
                }

                50% {
                    transform: translateY(-20px);
                }
            }

            @keyframes pulse-slow {

                0%,
                100% {
                    opacity: 1;
                }

                50% {
                    opacity: 0.8;
                }
            }

            .animate-float {
                animation: float 6s ease-in-out infinite;
            }

            .animate-pulse-slow {
                animation: pulse-slow 4s ease-in-out infinite;
            }

            /* Scroll animation styles */
            .scroll-animate {
                opacity: 0;
                transition: opacity 0.8s ease-out, transform 0.8s ease-out;
            }

            .scroll-animate.visible {
                opacity: 1;
                transform: translateY(0);
            }

            .scroll-animate.animate-fadeInUp {
                transform: translateY(30px);
            }

            .scroll-animate.animate-fadeInLeft {
                transform: translateX(-30px);
            }

            .scroll-animate.animate-fadeInRight {
                transform: translateX(30px);
            }

            .scroll-animate.visible.animate-fadeInUp {
                animation: fadeInUp 0.8s ease-out forwards;
            }

            .scroll-animate.visible.animate-fadeInLeft {
                animation: fadeInLeft 0.8s ease-out forwards;
            }

            .scroll-animate.visible.animate-fadeInRight {
                animation: fadeInRight 0.8s ease-out forwards;
            }

            .glass-effect {
                background: rgba(255, 255, 255, 0.1);
                backdrop-filter: blur(10px);
                border: 1px solid rgba(255, 255, 255, 0.2);
            }

            .dark .glass-effect {
                background: rgba(0, 0, 0, 0.2);
                border: 1px solid rgba(255, 255, 255, 0.1);
            }

            /* Gradient text */
            .gradient-text {
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
            }

            /* Custom scrollbar */
            ::-webkit-scrollbar {
                width: 8px;
            }

            ::-webkit-scrollbar-track {
                background: #f1f1f1;
            }

            ::-webkit-scrollbar-thumb {
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                border-radius: 10px;
            }

            ::-webkit-scrollbar-thumb:hover {
                background: linear-gradient(135deg, #5a67d8 0%, #6b46c1 100%);
            }
        </style>
    @endpush
    <section class="relative dark:bg-gray-800 antialiased overflow-hidden min-h-screen flex items-center">
        <div class="max-w-screen-xl py-16 mx-auto relative z-10">
            <div class="max-w-screen-md mx-auto text-center mb-12 scroll-animate animate-fadeInUp">
                <div
                    class="mx-auto mb-8 w-52 h-52 bg-gradient-to-br flex items-center justify-center scroll-animate animate-fadeInUpp">
                    <img src="../img/logo-imm-ft-umj.png" alt="Checkmark Icon" class="w-48 h-48 animate-float">
                </div>

                <h1
                    class="text-5xl md:text-7xl font-black tracking-tight mb-6 relative scroll-animate animate-fadeInUp text-red-700">
                    IMM FT UMJ
                    <div class="absolute -bottom-2 left-1/2 transform -translate-x-1/2 w-24 h-1 bg-red-600">
                    </div>
                </h1>

                <p
                    class="mt-6 text-xl md:text-2xl font-light text-gray-700 dark:text-gray-200 leading-relaxed px-4 scroll-animate animate-fadeInUp">
                    <span class="font-semibold text-red-800">Ikatan
                        Mahasiswa Muhammadiyah</span><br>
                    Fakultas Teknik UMJ adalah wadah bagi mahasiswa untuk berorganisasi,
                    mengembangkan potensi diri, dan berkontribusi nyata untuk umat.
                </p>

                <div
                    class="mt-10 flex flex-col sm:flex-row justify-center items-center space-y-4 sm:space-y-0 sm:space-x-6 scroll-animate animate-fadeInUp">
                    <a href="#about"
                        class="group inline-flex items-center px-8 py-4 bg-red-700 text-white font-semibold rounded-full shadow-xl hover:shadow-2xl transform hover:-translate-y-1 transition-all duration-300">
                        <span>Pelajari Lebih Lanjut</span>
                        <svg class="ml-2 w-5 h-5 group-hover:translate-x-1 transition-transform duration-300"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </a>
                    <a href="#gallery"
                        class="group inline-flex items-center px-8 py-4 bg-white dark:bg-gray-800 text-gray-900 dark:text-white font-semibold rounded-full border-2 border-gray-300 dark:border-gray-600 hover:border-red-500 dark:hover:border-red-400 shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300">
                        <span>Lihat Galeri</span>
                        <svg class="ml-2 w-5 h-5 group-hover:scale-110 transition-transform duration-300" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                        </svg>
                    </a>
                </div>
            </div>

            <div
                class="absolute bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce scroll-animate animate-fadeInUp">
                <div class="w-6 h-10 border-2 border-gray-400 dark:border-gray-300 rounded-full flex justify-center">
                    <div class="w-1 h-3 bg-gray-400 dark:bg-gray-300 rounded-full mt-2 animate-pulse"></div>
                </div>
            </div>
        </div>
    </section>

    <section id="about" class="relative py-20 bg-white dark:bg-gray-900 overflow-hidden">
        <div class="absolute inset-0 opacity-5">
            <div class="absolute inset-0"
                style="background-image: url('data:image/svg+xml,%3Csvg width=60 height=60 viewBox=0 0 60 60 xmlns=http://www.w3.org/2000/svg%3E%3Cg fill=none fill-rule=evenodd%3E%3Cg fill=%23000 fill-opacity=0.1%3E%3Cpath d=M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')">
            </div>
        </div>

        <div class="max-w-screen-xl mx-auto px-4 relative z-10">
            <div class="text-center mb-16 scroll-animate animate-fadeInUp">
                <h2 class="text-4xl md:text-5xl font-bold text-gray-900 dark:text-white mb-6">
                    Tentang <span class="text-red-700">IMM FT UMJ</span>
                </h2>
                <div class="w-24 h-1 bg-red-600 mx-auto mb-6"></div>
                <p class="text-lg text-gray-600 dark:text-gray-300 max-w-3xl mx-auto leading-relaxed">
                    Mengenal lebih dalam visi, misi, dan nilai-nilai yang menjadi fondasi pergerakan mahasiswa Islam di
                    Fakultas Teknik UMJ
                </p>
            </div>

            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="scroll-animate animate-fadeInLeft">
                    <div
                        class="bg-white dark:bg-gray-800 p-8 rounded-3xl shadow-2xl hover:shadow-3xl transition-all duration-500 border border-gray-100 dark:border-gray-700 relative overflow-hidden group">
                        <div
                            class="absolute inset-0 bg-red-50 dark:bg-gray-700 opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                        </div>

                        <div class="relative z-10">
                            <div class="mb-8">
                                <div class="flex items-center mb-4">
                                    <div
                                        class="w-12 h-12 bg-red-700 rounded-xl flex items-center justify-center mr-4 shadow-lg">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                                        </svg>
                                    </div>
                                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white">
                                        Tujuan IMM
                                    </h3>
                                </div>
                                <p class="text-gray-600 dark:text-gray-300 leading-relaxed text-lg">
                                    Mengusahakan terbentuknya akademisi Islam yang berakhlak mulia dalam rangka mencapai
                                    tujuan Muhammadiyah.
                                </p>
                            </div>

                            <div class="border-t border-gray-200 dark:border-gray-600 pt-8">
                                <div class="flex items-center mb-4">
                                    <div
                                        class="w-12 h-12 bg-yellow-600 rounded-xl flex items-center justify-center mr-4 shadow-lg">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M7 4V2a1 1 0 011-1h8a1 1 0 011 1v2h4a1 1 0 010 2h-1v12a2 2 0 01-2 2H6a2 2 0 01-2-2V6H3a1 1 0 010-2h4z" />
                                        </svg>
                                    </div>
                                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white">
                                        Slogan IMM
                                    </h3>
                                </div>
                                <div class="bg-red-50 dark:bg-gray-700 p-6 rounded-2xl">
                                    <p
                                        class="text-gray-800 dark:text-gray-200 leading-relaxed text-lg font-medium italic">
                                        "Anggun dalam Moral, Unggul dalam Intelektual"
                                    </p>
                                    <p class="text-gray-600 dark:text-gray-300 mt-2 text-base">
                                        Billahi fi sabililhaq, fastabiqul kairot.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="scroll-animate animate-fadeInRight" style="animation-delay: 0.2s">
                    <div
                        class="bg-white dark:bg-gray-800 p-8 rounded-3xl shadow-2xl hover:shadow-3xl transition-all duration-500 border border-gray-100 dark:border-gray-700 relative overflow-hidden group">
                        <div
                            class="absolute inset-0 bg-red-50 dark:bg-gray-700 opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                        </div>

                        <div class="relative z-10">
                            <div class="flex items-center mb-8">
                                <div
                                    class="w-12 h-12 bg-red-700 rounded-xl flex items-center justify-center mr-4 shadow-lg">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                </div>
                                <h3 class="text-2xl font-bold text-gray-900 dark:text-white">
                                    Enam Penegasan IMM
                                </h3>
                            </div>

                            <div class="space-y-4">
                                <div
                                    class="flex items-start group/item hover:bg-gray-50 dark:hover:bg-gray-700 p-3 rounded-xl transition-colors duration-300">
                                    <span
                                        class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-red-700 text-white text-sm font-bold mr-4 flex-shrink-0 group-hover/item:scale-110 transition-transform duration-300">1</span>
                                    <span class="text-gray-700 dark:text-gray-300 leading-relaxed">Menegaskan bahwa IMM
                                        adalah gerakan mahasiswa Islam.</span>
                                </div>

                                <div
                                    class="flex items-start group/item hover:bg-gray-50 dark:hover:bg-gray-700 p-3 rounded-xl transition-colors duration-300">
                                    <span
                                        class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-yellow-600 text-white text-sm font-bold mr-4 flex-shrink-0 group-hover/item:scale-110 transition-transform duration-300">2</span>
                                    <span class="text-gray-700 dark:text-gray-300 leading-relaxed">Menegaskan bahwa
                                        kepribadian Muhammadiyah adalah landasan perjuangan IMM.</span>
                                </div>

                                <div
                                    class="flex items-start group/item hover:bg-gray-50 dark:hover:bg-gray-700 p-3 rounded-xl transition-colors duration-300">
                                    <span
                                        class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-red-500 text-white text-sm font-bold mr-4 flex-shrink-0 group-hover/item:scale-110 transition-transform duration-300">3</span>
                                    <span class="text-gray-700 dark:text-gray-300 leading-relaxed">Menegaskan bahwa
                                        fungsi adalah eksponen mahasiswa dalam Muhammadiyah.</span>
                                </div>

                                <div
                                    class="flex items-start group/item hover:bg-gray-50 dark:hover:bg-gray-700 p-3 rounded-xl transition-colors duration-300">
                                    <span
                                        class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-red-700 text-white text-sm font-bold mr-4 flex-shrink-0 group-hover/item:scale-110 transition-transform duration-300">4</span>
                                    <span class="text-gray-700 dark:text-gray-300 leading-relaxed">Menegaskan bahwa IMM
                                        adalah organisasi mahasiswa yang sah dengan menindahkan segala hukum,
                                        undang-undang, peraturan, serta dasar dan falsafah negara.</span>
                                </div>

                                <div
                                    class="flex items-start group/item hover:bg-gray-50 dark:hover:bg-gray-700 p-3 rounded-xl transition-colors duration-300">
                                    <span
                                        class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-yellow-600 text-white text-sm font-bold mr-4 flex-shrink-0 group-hover/item:scale-110 transition-transform duration-300">5</span>
                                    <span class="text-gray-700 dark:text-gray-300 leading-relaxed">Menegaskan bahwa
                                        ilmu adalah amaliah dan amal adalah ilmiah.</span>
                                </div>

                                <div
                                    class="flex items-start group/item hover:bg-gray-50 dark:hover:bg-gray-700 p-3 rounded-xl transition-colors duration-300">
                                    <span
                                        class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-red-500 text-white text-sm font-bold mr-4 flex-shrink-0 group-hover/item:scale-110 transition-transform duration-300">6</span>
                                    <span class="text-gray-700 dark:text-gray-300 leading-relaxed">Menegaskan bahwa
                                        amal IMM adalah lillahita'ala dan senantiasa diabadikan untuk kepentingan
                                        rakyat.</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="gallery" class="bg-gray-50 dark:bg-gray-900 py-20 relative overflow-hidden">
        <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6">
            <div class="text-center mb-16 scroll-animate animate-fadeInUp">
                <h2 class="text-4xl md:text-5xl font-bold text-gray-900 dark:text-white mb-6">
                    <span class="text-red-700">Galeri Kegiatan</span> Kami
                </h2>
                <div class="w-24 h-1 bg-gradient-to-r bg-red-600 mx-auto mb-6"></div>
                <p class="text-lg text-gray-600 dark:text-gray-300 max-w-3xl mx-auto">
                    Dokumentasi perjalanan dan aktivitas IMM FT UMJ dalam berkontribusi untuk kemajuan umat
                </p>
            </div>

            <div class="scroll-animate animate-fadeInUp">
                <div id="gallery-carousel" class="relative w-full shadow-2xl rounded-3xl overflow-hidden"
                    data-carousel="slide">
                    <div class="relative h-80 md:h-[32rem]">
                        <div class="hidden duration-700 ease-in-out" data-carousel-item>
                            <img src="https://flowbite.s3.amazonaws.com/docs/gallery/square/image-1.jpg"
                                class="absolute block w-full h-full object-cover" alt="Foto kegiatan 1">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
                            <div class="absolute bottom-8 left-8 text-white">
                                <h3 class="text-2xl font-bold mb-2">Kegiatan Diskusi</h3>
                                <p class="text-gray-200">Membahas isu-isu terkini dengan perspektif Islam</p>
                            </div>
                        </div>
                        <div class="hidden duration-700 ease-in-out" data-carousel-item="active">
                            <img src="https://flowbite.s3.amazonaws.com/docs/gallery/square/image-2.jpg"
                                class="absolute block w-full h-full object-cover" alt="Foto kegiatan 2">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
                            <div class="absolute bottom-8 left-8 text-white">
                                <h3 class="text-2xl font-bold mb-2">Kegiatan Sosial</h3>
                                <p class="text-gray-200">Berbagi kasih dengan masyarakat sekitar</p>
                            </div>
                        </div>
                        <div class="hidden duration-700 ease-in-out" data-carousel-item>
                            <img src="https://flowbite.s3.amazonaws.com/docs/gallery/square/image-3.jpg"
                                class="absolute block w-full h-full object-cover" alt="Foto kegiatan 3">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
                            <div class="absolute bottom-8 left-8 text-white">
                                <h3 class="text-2xl font-bold mb-2">Workshop Teknologi</h3>
                                <p class="text-gray-200">Mengembangkan kompetensi di bidang teknologi</p>
                            </div>
                        </div>
                        <div class="hidden duration-700 ease-in-out" data-carousel-item>
                            <img src="https://flowbite.s3.amazonaws.com/docs/gallery/square/image-4.jpg"
                                class="absolute block w-full h-full object-cover" alt="Foto kegiatan 4">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
                            <div class="absolute bottom-8 left-8 text-white">
                                <h3 class="text-2xl font-bold mb-2">Seminar Nasional</h3>
                                <p class="text-gray-200">Mendatangkan tokoh inspiratif untuk menambah wawasan</p>
                            </div>
                        </div>
                    </div>
                    <button type="button"
                        class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
                        data-carousel-prev>
                        <span
                            class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none transition-all duration-300">
                            <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M5 1 1 5l4 4" />
                            </svg>
                            <span class="sr-only">Previous</span>
                        </span>
                    </button>
                    <button type="button"
                        class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
                        data-carousel-next>
                        <span
                            class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none transition-all duration-300">
                            <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 9 4-4-4-4" />
                            </svg>
                            <span class="sr-only">Next</span>
                        </span>
                    </button>
                </div>
            </div>
        </div>
    </section>

    <section class="dark:bg-gray-800 relative">
        <div class="absolute inset-0 bg-gradient-to-t from-gray-100 to-transparent dark:from-gray-900 opacity-30">
        </div>
        <div class="py-30 px-4 mx-auto max-w-screen-xl text-center relative">
            <h2
                class="mb-6 text-4xl font-extrabold tracking-tight leading-none text-red-700 md:text-5xl lg:text-6xl dark:text-white scroll-animate animate-fadeInUp">
                Mari Bergabung dan<br>Bergerak Bersama Kami
            </h2>
            <p
                class="mb-8 text-lg font-normal text-gray-600 lg:text-xl sm:px-16 xl:px-48 dark:text-gray-300 scroll-animate animate-fadeInUp">
                Mari kita bersama-sama menggali dan mengeluarkan seluruh potensi terbaik yang kita miliki. Beranikan
                diri untuk menyuarakan gagasan-gagasan visioner yang dapat menjadi solusi atas berbagai tantangan.
                Terakhir, jadikan semua itu sebagai pemicu untuk menciptakan karya-karya konkret yang memberikan manfaat
                nyata dan berkelanjutan bagi masyarakat luas, sehingga kita bisa menjadi bagian dari agen perubahan yang
                bermakna.
            </p>
            <div
                class="flex flex-col sm:flex-row justify-center items-center space-y-4 sm:space-y-0 sm:space-x-4 scroll-animate animate-fadeInUp">
                <a href="#"
                    class="inline-flex justify-center items-center py-3 px-8 text-base font-medium text-white rounded-lg bg-red-700 transition delay-150 duration-300 ease-in-out hover:-translate-y-1 hover:scale-110 hover:bg-red-400">
                    Kirim Tulisan
                    <svg class="ml-2 w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z">
                        </path>
                    </svg>
                </a>
                <a href="/hubungi-kami"
                    class="inline-flex justify-center items-center py-3 px-8 text-base font-medium text-gray-900 rounded-lg border border-gray-300 hover:bg-gray-100 transition-colors duration-300 focus:ring-4 focus:ring-gray-100 dark:border-gray-700 dark:text-white dark:hover:bg-gray-700">
                    Hubungi Kami
                </a>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const observerOptions = {
                root: null,
                rootMargin: "0px",
                threshold: 0.1 // Triggers when 10% of the element is visible
            };

            const scrollObserver = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('visible');
                        observer.unobserve(entry.target);
                    }
                });
            }, observerOptions);

            document.querySelectorAll('.scroll-animate').forEach(element => {
                scrollObserver.observe(element);
            });
        });
    </script>
</x-layout>
