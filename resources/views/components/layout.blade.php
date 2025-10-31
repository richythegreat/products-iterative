<!DOCTYPE html>
<html lang="lv">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Holy Grail Layout - Product CRUD' }}</title>

    {{-- Pievienots CSS un JS caur Vite --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <div class="layout-grid">

        <header>
            <h1>🧱 Testa Logo</h1>
        </header>

        <nav>
            <ul>
                <li><a href="{{ route('products.index') }}">Produktu saraksts</a></li>
                <li><a href="{{ route('products.create') }}">Pievienot produktu</a></li>
            </ul>
        </nav>

        <main>
            {{ $slot }}
        </main>

        <aside>
            <h3>Reklāma</h3>
            <p>Šeit varētu būt reklāmas laukums vai papildinformācija.</p>
        </aside>

        <footer>
            <p>&copy; {{ date('Y') }} — Testa Copyright teksts</p>
        </footer>

    </div>
</body>

</html>