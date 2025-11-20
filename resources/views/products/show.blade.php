<x-layout>
    <h1 class="mb-4">Produkta detaļas</h1>

    <div class="card p-4">
        <h3>{{ $product->name }}</h3>

        <p><strong>Apraksts:</strong> {{ $product->description ?: 'Nav apraksta' }}</p>
        <p><strong>Cena:</strong> {{ $product->price }} €</p>

        <p><strong>Pieejamais daudzums:</strong>
            <span id="quantity">{{ $product->quantity }}</span>
        </p>

        {{-- AJAX + QUANTITY --}}
        <div style="margin-top: 1rem;">
            <form class="ajax-form" action="{{ route('products.increase', $product) }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit" class="btn">📈 Palielināt</button>
            </form>

            <form class="ajax-form" action="{{ route('products.decrease', $product) }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit" class="btn" style="background:#ff6600;">📉 Samazināt</button>
            </form>
        </div>

        {{-- TAGI --}}
        <div style="margin-top:1rem;">
            <h3>Birkas:</h3>

            @if ($product->tags->isEmpty())
                <p>Nav birku</p>
            @else
                <div class="tag-container">
                    @foreach ($product->tags as $tag)
                        <span class="tag-chip">{{ $tag->name }}</span>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

    <div class="mt-3">
        <a href="{{ route('products.index') }}" class="btn btn-secondary">← Atpakaļ</a>
        <a href="{{ route('products.edit', $product) }}" class="btn btn-primary">✏️ Rediģēt</a>
    </div>

    <script src="{{ asset('js/app.js') }}"></script>
</x-layout>
