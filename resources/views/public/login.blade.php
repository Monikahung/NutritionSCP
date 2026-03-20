@extends('public.layout')

@section('title', 'Masuk')

@section('content')
    <div class="min-h-[70vh] flex items-center justify-center px-4 py-12 bg-softivory">
        <div class="max-w-6xl w-full grid grid-cols-1 md:grid-cols-2 gap-36 items-center">

            <div class="flex flex-col">
                <h1 class="text-4xl text-jetblack font-bold mb-4">Selamat Datang Kembali!</h1>
                <p class="text-lg text-jetblack font-medium mb-10">Masuk untuk melanjutkan aktivitas Anda dan nikmati
                    berbagai fitur yang telah
                    kami sediakan!</p>

                @if(session('success'))
                    <p style="color: green;">{{ session('success') }}</p>
                @endif

                @if($errors->any())
                    <ul style="color:red;">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif

                <form action="{{ route('login.submit') }}" method="POST" class="space-y-4">
                    @csrf

                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-jetblack/60">
                            <i class="fa-solid fa-user"></i>
                        </span>
                        <input type="email" name="email" placeholder="Email"
                            class="w-full bg-jetblack/10 py-4 pl-12 pr-4 rounded-lg focus:outline-none focus:ring-2 focus:ring-jetblack/30">
                    </div>

                    <div class="relative" x-data="{ show: false }">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-jetblack/60">
                            <i class="fa-solid fa-lock"></i>
                        </span>

                        <input :type="show ? 'text' : 'password'" name="password" placeholder="Password"
                            class="w-full bg-jetblack/10 py-4 pl-12 pr-12 rounded-lg focus:outline-none focus:ring-2 focus:ring-jetblack/30">

                        <button type="button" @click="show = !show"
                            class="absolute inset-y-0 right-0 flex items-center pr-4 text-jetblack/60 hover:text-jetblack transition-colors">

                            <i class="fa-solid" :class="show ? 'fa-eye' : 'fa-eye-slash'"></i>
                        </button>
                    </div>

                    <button type="submit"
                        class="w-full bg-tealmist py-4 mt-4 rounded-lg font-bold text-lg text-softivory hover:bg-tealmist/80 transition-colors">
                        Masuk
                    </button>
                </form>

                <p class="mt-4 text-center text-sm text-jetblack">
                    Belum punya akun? <a href="#"
                        class="underline font-semibold text-jetblack hover:text-jetblack/80">Registrasi Sekarang!</a>
                </p>
            </div>

            <div class="flex items-center justify-center rounded-sm">
                <img src="{{ asset('img/login.png') }}" alt="Ilustrasi Login" class="w-full h-full object-cover">
            </div>
        </div>
    </div>
@endsection