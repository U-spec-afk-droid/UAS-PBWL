<x-layouts.guest>

    <div style="text-align:center; margin-bottom:22px;">
        <h2 style="font-size:22px; font-weight:700; color:#111827;">
            Welcome
        </h2>
        <p style="font-size:14px; color:#6b7280; margin-top:4px;">
            Silakan login untuk melanjutkan
        </p>
    </div>

    <x-auth-session-status :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email -->
        <div>
            <x-input-label for="email" value="Email" />
            <x-text-input
                id="email"
                type="email"
                name="email"
                :value="old('email')"
                required autofocus />
            <x-input-error :messages="$errors->get('email')" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" value="Password" />
            <x-text-input
                id="password"
                type="password"
                name="password"
                required />
            <x-input-error :messages="$errors->get('password')" />
        </div>

        <!-- Remember & Forgot -->
        <div class="auth-row">
            <label>
                <input type="checkbox" name="remember">
                Remember me
            </label>

            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}">
                    Forgot password?
                </a>
            @endif
        </div>

        <!-- Button -->
        <button type="submit">
            Log in
        </button>
    </form>

</x-layouts.guest>
