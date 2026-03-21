@extends('public.layout')

@section('title', 'Masuk')

@section('content')
    <div class="min-h-[70vh] flex items-center justify-center px-4 py-12 bg-softivory">
        <div class="max-w-6xl w-full grid grid-cols-1 md:grid-cols-2 gap-36 items-center">

            <div class="flex flex-col">
                {{-- Title --}}
                <h1 class="text-4xl text-jetblack font-bold mb-4">Selamat Datang Kembali!</h1>
                {{-- Description --}}
                <p class="text-lg text-jetblack font-medium mb-10">Masuk untuk melanjutkan aktivitas Anda dan nikmati
                    berbagai fitur yang telah
                    kami sediakan!</p>

                {{-- Login Form --}}
                <form action="{{ route('login.submit') }}" method="POST" class="space-y-4">
                    @csrf

                    {{-- Email Section --}}
                    <div class="flex flex-col">
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-jetblack/60">
                                <i class="fa-solid fa-user"></i>
                            </span>
                            {{-- Email Input --}}
                            <input type="email" name="email" placeholder="Email" autocomplete="off"
                                value="{{ old('email') }}"
                                class="w-full bg-jetblack/10 py-4 pl-12 pr-4 rounded-lg focus:outline-none focus:ring-2 focus:ring-jetblack/30">
                        </div>

                        {{-- Email Error Message --}}
                        @error('email')
                            <span class="text-red-500 text-xs mt-1 ml-1">{{ $message }}</span>
                        @enderror

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

                        {{-- Password Error Message --}}
                        @error('password')
                            <span class="text-red-500 text-xs mt-1 ml-1">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Login Button --}}
                    <button type="submit"
                        class="w-full bg-tealmist py-4 mt-4 rounded-lg font-bold text-lg text-softivory hover:bg-tealmist/80 transition-colors">
                        Masuk
                    </button>
                </form>

                {{-- Registration Link --}}
                <p class="mt-4 text-center text-sm text-jetblack">
                    Belum punya akun? <a href="#"
                        class="underline font-semibold text-jetblack hover:text-jetblack/80">Registrasi Sekarang!</a>
                </p>
            </div>

            {{-- Login Image --}}
            <div class="flex items-center justify-center rounded-sm">
                <img src="{{ asset('img/login.png') }}" alt="Ilustrasi Login" class="w-full h-full object-cover">
            </div>
        </div>
    </div>

    {{-- Error Alert --}}
    <div id="error-alert"
        class="fixed top-5 right-5 z-9999 max-w-md w-full transition-all duration-500 ease-in-out transform -translate-y-25 opacity-0 hidden">
        <div
            class="bg-white border-l-4 shadow-2xl rounded-r-lg p-4 flex items-center justify-between border border-gray-100">
            <div class="flex items-center">
                {{-- Error Icon --}}
                <div class="shrink-0 bg-red-100 w-10 h-10 flex items-center justify-center rounded-full">
                    <i class="fas fa-exclamation-triangle text-red-700"></i>
                </div>
                <div class="ml-3">
                    {{-- Error Title --}}
                    <p class="text-sm font-bold text-jetblack">Gagal!</p>
                    {{-- Error Message --}}
                    <p class="text-xs text-jetblack" id="error-message"></p>
                </div>
            </div>
            {{-- Close Button --}}
            <button onclick="closeErrorAlert()" class="ml-4 text-jetblack hover:text-jetblack/80 transition-colors">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>

    <script>
        // Alert Error Toggle
        function closeErrorAlert() {
            const alert = document.getElementById('error-alert');
            if (alert) {
                alert.classList.add('-translate-y-25', 'opacity-0');
                alert.classList.remove('translate-y-0', 'opacity-100');
                setTimeout(() => {
                    alert.classList.add('hidden');
                }, 500);
            }
        }

        // Show Alert on Session Error
        document.addEventListener('DOMContentLoaded', function () {
            @if($errors->has('login_error') || session('error'))
                const errorAlert = document.getElementById('error-alert');
                const errorMessage = document.getElementById('error-message');

                errorMessage.innerText = "{{ $errors->first('login_error') ?: session('error') }}";

                errorAlert.classList.remove('hidden');

                setTimeout(() => {
                    errorAlert.classList.remove('-translate-y-25', 'opacity-0');
                    errorAlert.classList.add('translate-y-0', 'opacity-100');
                }, 100);

                if (window.history.replaceState) {
                    window.history.replaceState(null, null, window.location.href);
                }

                setTimeout(() => {
                    closeErrorAlert();
                }, 5000);
            @endif
        });
    </script>
@endsection