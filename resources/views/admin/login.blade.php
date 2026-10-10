<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login Admin - MAN 2 TASIKMALAYA</title>

   <style>
    :root {
        --brand: #198754;
        --brand2: #0f5132;
        --ink: #111827;
        --muted: #6b7280;
        --line: #e5e7eb;
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI",
            Roboto, Helvetica, Arial, sans-serif;
        min-height: 100vh;
        display: flex;
        background: #fff;
        color: var(--ink);
    }

    /* PANEL KIRI */
    .panel {
        flex: 1;

        background:
            linear-gradient(
                135deg,
                rgba(25, 135, 84, .92),
                rgba(15, 81, 50, .92)
            ),
            url("{{ asset('assets/images/sekolah.jpg') }}");

        background-size: cover;
        background-position: center;

        color: #fff;

        display: none;
        flex-direction: column;
        justify-content: space-between;

        padding: 56px;
    }

    .panel .logo {
        font-weight: 800;
        font-size: 1.25rem;
        letter-spacing: -.02em;
    }

    .panel h2 {
        font-size: 2.1rem;
        line-height: 1.2;
        letter-spacing: -.03em;
        max-width: 22ch;
    }

    .panel p {
        margin-top: 14px;
        opacity: .85;
        max-width: 40ch;
        line-height: 1.6;
    }

    .panel .quote {
        font-size: .9rem;
        opacity: .75;
    }

    /* FORM LOGIN */
    .form-side {
        flex: 1;

        display: flex;
        align-items: center;
        justify-content: center;

        padding: 32px;
    }

    .form-box {
        width: 100%;
        max-width: 380px;
    }

    .form-box h1 {
        font-size: 1.6rem;
        letter-spacing: -.02em;
        margin-bottom: 6px;
    }

    .form-box > p {
        color: var(--muted);
        font-size: .95rem;
        margin-bottom: 28px;
    }

    label {
        display: block;
        font-size: .85rem;
        font-weight: 600;
        margin-bottom: 6px;
    }

   
    input[type=text],
    input[type=password] {
        width: 100%;
        padding: 12px 14px;

        border: 1px solid var(--line);
        border-radius: 10px;

        font-size: .95rem;

        transition: border-color .15s, box-shadow .15s;

        margin-bottom: 18px;
    }

    input:focus {
        outline: none;

        border-color: var(--brand);

        box-shadow:
            0 0 0 3px rgba(25, 135, 84, .15);
    }

    .row {
        display: flex;
        justify-content: space-between;
        align-items: center;

        margin-bottom: 22px;

        font-size: .85rem;
    }

    .row label {
        display: flex;
        align-items: center;
        gap: 7px;

        margin: 0;

        font-weight: 500;
        color: var(--muted);
    }

    .row input[type=checkbox] {
        width: auto;
        margin: 0;
    }

    .row a {
        color: var(--brand);
        text-decoration: none;
        font-weight: 600;
    }

    .row a:hover {
        text-decoration: underline;
    }

    /* BUTTON HIJAU GRADASI */
    button {
        width: 100%;
        padding: 13px;

        border: 0;
        border-radius: 10px;

        background: linear-gradient(
            135deg,
            #198754,
            #0f5132
        );

        color: #fff;

        font-size: .98rem;
        font-weight: 700;

        cursor: pointer;

        transition: all .2s ease;
    }

    button:hover {
        background: linear-gradient(
            135deg,
            #157347,
            #0a3622
        );

        transform: translateY(-1px);

        box-shadow:
            0 5px 15px rgba(25, 135, 84, .25);
    }

    /* ERROR */
    .error-box {
        background: #fef2f2;

        border: 1px solid #fecaca;

        color: #b91c1c;

        border-radius: 10px;

        padding: 12px 14px;

        margin-bottom: 20px;

        font-size: .85rem;
    }

    .error-box ul {
        padding-left: 18px;
    }

    .error-box li {
        margin-bottom: 3px;
    }

    /* DESKTOP */
    @media (min-width: 880px) {
        .panel {
            display: flex;
        }
    }

    /* MOBILE */
    @media (max-width: 879px) {
        .form-side {
            min-height: 100vh;
        }
    }
</style>

</head>

<body>

    <!-- PANEL KIRI -->

    <aside class="panel">

        <div class="logo">
            MAN 2 TASIKMALAYA
        </div>

        <div>
            <h2>
                Selamat datang di sistem administrasi sekolah.
            </h2>

            <p>
                Kelola data sekolah, guru, siswa, berita,
                dan administrasi dalam satu sistem.
            </p>
        </div>

        <p class="quote">
            Sistem Informasi Administrasi Sekolah
        </p>

    </aside>


    <!-- FORM LOGIN -->

    <main class="form-side">

        <form
            class="form-box"
            method="POST"
            action="{{ route('proses.login') }}"
        >

            @csrf

            <h1>
                Welcome back
            </h1>

            <p>
                Sign in to continue to your workspace.
            </p>


            {{-- ERROR --}}

            @if ($errors->any())

                <div class="error-box">

                    <ul>

                        @foreach ($errors->all() as $error)

                            <li>{{ $error }}</li>

                        @endforeach

                    </ul>

                </div>

            @endif


            {{-- USERNAME --}}

            <label for="username">
                Username
            </label>

            <input
                type="text"
                id="username"
                name="username"
                value="{{ old('username') }}"
                autocomplete="username"
                placeholder="Masukkan username"
                required
            >


            {{-- PASSWORD --}}

            <label for="password">
                Password
            </label>

            <input
                type="password"
                id="password"
                name="password"
                autocomplete="current-password"
                placeholder="••••••••"
                required
            >


            {{-- REMEMBER --}}

            <div class="row">

                <label>

                    <input
                        type="checkbox"
                        name="remember"
                        value="1"
                    >

                    Remember me

                </label>

                <a href="#">
                    Forgot password?
                </a>

            </div>


            {{-- LOGIN --}}

            <button type="submit">
                Sign in
            </button>

        </form>

    </main>

</body>

</html>