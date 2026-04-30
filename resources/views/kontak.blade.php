@extends('layouts.app')

@section('title', 'Kontak')

@section('content')
<div class="flex-1 max-w-7xl mx-auto w-full px-6 py-12 flex flex-col md:flex-row items-center md:items-start gap-12">

        <!-- Left Side: Mascot & Brand -->
        <div class="w-full md:w-1/3 flex flex-col items-center md:items-start mt-10">

            <div class="relative w-full h-[320px] md:h-[400px] mb-4 flex justify-center md:justify-start">
                <img src="{{ asset('assets/img/rusa.png') }}"
                    class="absolute z-10 w-auto h-[400px] md:h-[500px] max-w-none transform -translate-y-10 md:-translate-y-16 -translate-x-60"
                    alt="Maskot Polije">
            </div>

            <div class="relative z-20 px-4 md:px-0">
                <h2 class="blue-main font-black text-2xl mb-2 text-center md:text-left">
                    SIMPRESMA-POLIJE
                </h2>
                <p class="text-gray-500 text-sm leading-relaxed max-w-xs font-medium text-center md:text-left">
                    Website Resmi Untuk Pusat Data Prestasi Mahasiswa Politeknik Negeri Jember
                </p>
            </div>

        </div>

        <!-- Right Side: Content Box -->
        <div class="w-full md:w-2/3">
            <div class="contact-box extend-left p-8 md:p-10 mb-5 bg-white">
                <h1 class="blue-main text-3xl md:text-4xl font-black mb-2 leading-tight">Layanan Aspirasi dan Masukan Berharga</h1>
                <p class="blue-main font-bold text-lg mb-8">Sampaikan aspirasi Anda langsung kepada admin SIMPRESMA-POLIJE</p>

                <div class="flex flex-wrap gap-4">
                    <a href="https://wa.me/6285179590160" target="_blank" class="bg-blue-main text-white px-8 py-3 rounded-lg font-bold text-sm hover:opacity-90 transition shadow-md inline-block">WhatsApp</a>
                    <a href="mailto:humas@polije.ac.id" class="bg-blue-main text-white px-8 py-3 rounded-lg font-bold text-sm hover:opacity-90 transition shadow-md inline-block">Email</a>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
            </div>

            <!-- Social Media & Maps Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                <!-- Social Media List -->
                <div>
                    <h3 class="blue-main font-black text-2xl mb-5">Media Sosial</h3>
                    <ul class="space-y-4">
                        <li>
                            <a href="https://instagram.com/humaspolije" target="_blank" class="flex items-center space-x-4 group">
                                <div class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center text-pink-600 shadow-sm group-hover:bg-pink-600 group-hover:text-white transition-all">
                                    <i class="fab fa-instagram text-xl"></i>
                                </div>
                                <span class="blue-main font-bold text-lg group-hover:underline">@humaspolije</span>
                            </a>
                        </li>
                        <li>
                            <a href="https://youtube.com/@polijesip" target="_blank" class="flex items-center space-x-4 group">
                                <div class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center text-red-600 shadow-sm group-hover:bg-red-600 group-hover:text-white transition-all">
                                    <i class="fab fa-youtube text-xl"></i>
                                </div>
                                <span class="blue-main font-bold text-lg group-hover:underline">POLIJE SIP</span>
                            </a>
                        </li>
                        <li>
                            <a href="https://tiktok.com/@polijesip" target="_blank" class="flex items-center space-x-4 group">
                                <div class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center text-black shadow-sm group-hover:bg-black group-hover:text-white transition-all">
                                    <i class="fab fa-tiktok text-xl"></i>
                                </div>
                                <span class="blue-main font-bold text-lg group-hover:underline">@polijesip</span>
                            </a>
                        </li>
                        <li>
                            <a href="https://facebook.com/polijesip" target="_blank" class="flex items-center space-x-4 group">
                                <div class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center text-blue-700 shadow-sm group-hover:bg-blue-700 group-hover:text-white transition-all">
                                    <i class="fab fa-facebook-f text-xl"></i>
                                </div>
                                <span class="blue-main font-bold text-lg group-hover:underline">Politeknik Negeri Jember</span>
                            </a>
                        </li>
                        <li>
                            <a href="https://x.com/humaspolije" target="_blank" class="flex items-center space-x-4 group">
                                <div class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center text-black shadow-sm group-hover:bg-black group-hover:text-white transition-all">
                                    <i class="fab fa-x-twitter text-xl"></i>
                                </div>
                                <span class="blue-main font-bold text-lg group-hover:underline">@humaspolije</span>
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Location Map -->
                <div class="flex flex-col">
                    <h3 class="blue-main font-black text-2xl mb-5">Lokasi Kami</h3>
                    <div class="w-full h-72 rounded-3xl overflow-hidden border border-gray-200 shadow-xl">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3949.423502102476!2d113.71961917500854!3d-8.159955491870535!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd695b617d8f623%3A0x1d30205c083bc92c!2sPoliteknik%20Negeri%20Jember!5e0!3m2!1sid!2sid!4v1713250000000!5m2!1sid!2sid"
                            width="100%"
                            height="100%"
                            style="border:0;"
                            allowfullscreen=""
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection