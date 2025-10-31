<x-layout>
    <h1 class="mb-4">Produkta detaļas</h1>

    <div class="card p-4">
        <h3>{{ $product->name }}</h3>
        <p><strong>Apraksts:</strong> {{ $product->description ?: 'Nav apraksta' }}</p>
        <p><strong>Cena:</strong> {{ $product->price }} €</p>
        <p><strong>Pieejamais daudzums:</strong> {{ $product->quantity }}</p>

        <div style="margin-top: 1rem;">
            {{-- Palielināt daudzumu --}}
            <form action="{{ route('products.increase', $product) }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit" class="btn">📈 Palielināt</button>
            </form>

            {{-- Samazināt daudzumu --}}
            <form action="{{ route('products.decrease', $product) }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit" class="btn" style="background:#ff6600;">📉 Samazināt</button>
            </form>
        </div>
    </div>

    <div class="mt-3">
        <a href="{{ route('products.index') }}" class="btn btn-secondary">← Atpakaļ</a>
    </div>
</x-layout>