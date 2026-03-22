@extends('public.layout')

@section('title', 'Buat Akun')

@section('content')
    <div class="min-h-[70vh] flex items-center justify-center px-4 py-12 bg-softivory">
        <div class="max-w-6xl w-full grid grid-cols-1 md:grid-cols-2 gap-12 md:gap-36 items-center">

            <div class="flex flex-col">
                {{-- Title --}}
                <h1 class="text-4xl text-jetblack font-bold mb-4">Ayo Mulai Sekarang!</h1>
                {{-- Description --}}
                <p class="text-lg text-jetblack font-medium mb-10">Buat akun sekarang dan nikmati berbagai fitur yang telah kami sediakan!</p>

                {{-- Register Form --}}
                <form action="#" method="POST" class="space-y-4">
                    @csrf

                    {{-- Name Section --}}
                    <div class="flex flex-col">
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-jetblack/60">
                                <i class="fa-solid fa-user"></i>
                            </span>
                            {{-- Name Input --}}
                            <input type="text" name="name" placeholder="Nama Lengkap" autocomplete="off"
                                value="{{ old('name') }}"
                                class="w-full bg-jetblack/10 py-4 pl-12 pr-4 rounded-lg focus:outline-none focus:ring-2 focus:ring-jetblack/30">
                        </div>
                    </div>

                    {{-- Email Section --}}
                    <div class="flex flex-col">
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-jetblack/60">
                                <i class="fa-solid fa-envelope"></i>
                            </span>
                            {{-- Email Input --}}
                            <input type="email" name="email" placeholder="Email" autocomplete="off"
                                value="{{ old('email') }}"
                                class="w-full bg-jetblack/10 py-4 pl-12 pr-4 rounded-lg focus:outline-none focus:ring-2 focus:ring-jetblack/30">
                        </div>
                    </div>

                    {{-- Password Section --}}
                    <div class="flex flex-col mt-4">
                        <div class="relative" x-data="{ show: false }">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-jetblack/60">
                                <i class="fa-solid fa-lock"></i>
                            </span>

                            {{-- Password Input --}}
                            <input :type="show ? 'text' : 'password'" name="password" placeholder="Password"
                                class="w-full bg-jetblack/10 py-4 pl-12 pr-12 rounded-lg focus:outline-none focus:ring-2 focus:ring-jetblack/30">

                            {{-- Toggle Password Visibility --}}
                            <button type="button" @click="show = !show"
                                class="absolute inset-y-0 right-0 flex items-center pr-4 text-jetblack/60 hover:text-jetblack transition-colors">

                                <i class="fa-solid" :class="show ? 'fa-eye' : 'fa-eye-slash'"></i>
                            </button>
                        </div>
                    </div>

                    {{-- Register Button --}}
                    <button type="submit"
                        class="w-full bg-tealmist py-4 mt-4 rounded-lg font-bold text-lg text-softivory hover:bg-tealmist/80 transition-colors">
                        Buat Akun
                    </button>
                </form>

                {{-- Login Link --}}
                <p class="mt-4 text-center text-sm text-jetblack">
                    Sudah punya akun? <a href="{{ route('login') }}"
                        class="underline font-semibold text-jetblack hover:text-jetblack/80">Masuk Sekarang!</a>
                </p>
            </div>

            {{-- Register Image --}}
            <div class="hidden md:flex items-center justify-center rounded-sm">
                <img src="{{ asset('img/register.png') }}" alt="Ilustrasi Register" class="w-full h-full object-cover">
            </div>
        </div>
    </div>
@endsection