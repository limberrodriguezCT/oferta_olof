<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="mb-8 text-center">
        <h2 class="text-2xl font-extrabold text-[#003876]">Acceso Administrativo</h2>
        <p class="text-sm text-gray-500 mt-2">Ingrese sus credenciales para gestionar la plataforma</p>
    </div>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email" class="block font-bold text-sm text-[#003876]">Correo Electrónico</label>
            <input id="email" class="block mt-2 w-full rounded-xl border-gray-300 focus:border-[#0089D0] focus:ring-[#0089D0] bg-gray-50 focus:bg-white transition" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-6">
            <label for="password" class="block font-bold text-sm text-[#003876]">Contraseña</label>
            <input id="password" class="block mt-2 w-full rounded-xl border-gray-300 focus:border-[#0089D0] focus:ring-[#0089D0] bg-gray-50 focus:bg-white transition"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-6 bg-gray-50 p-3 rounded-lg border border-gray-100">
            <label for="remember_me" class="inline-flex items-center cursor-pointer">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-[#8cc63f] shadow-sm focus:ring-[#8cc63f]" name="remember">
                <span class="ms-3 text-sm font-medium text-gray-700">Mantener sesión iniciada</span>
            </label>
        </div>

        <div class="flex flex-col space-y-4 mt-8">
            <button type="submit" class="w-full bg-[#0089D0] hover:bg-[#0074B2] text-white font-bold py-3 px-6 rounded-xl shadow-lg transition duration-300 transform hover:-translate-y-1">
                Ingresar al Sistema
            </button>

            @if (Route::has('password.request'))
                <div class="text-center">
                    <a class="underline text-sm text-gray-500 hover:text-[#003876] transition" href="{{ route('password.request') }}">
                        ¿Olvidó su contraseña?
                    </a>
                </div>
            @endif
        </div>
    </form>
</x-guest-layout>