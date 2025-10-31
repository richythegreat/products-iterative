<!DOCTYPE html>
<html lang="lv">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? '🎃 Halloween Product CRUD' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="halloween-theme">
    <div class="layout-grid">
        <header>
            <h1>🎃 Spooky Produktu Veikals</h1>
        </header>

        <nav>
            <ul>
                <li><a href="{{ route('products.index') }}">🧛 Produktu saraksts</a></li>
                <li><a href="{{ route('products.create') }}">🕸️ Pievienot produktu</a></li>
            </ul>
        </nav>

        <main>
            {{-- Flash ziņojumi --}}
            <x-flash-success />
            <x-flash-error />
            {{ $slot }}
        </main>

        <aside>
            <h3>🕷️ Halloween piedāvājumi</h3>
            <p>👻 Atlaides līdz 50% uz visiem biedējoši labajiem produktiem!</p>
        </aside>

        <footer>
            <p>🦇 &copy; {{ date('Y') }} Halloween CRUD — Beware the bugs 👻</p>
        </footer>
    </div>
</body>

</html>