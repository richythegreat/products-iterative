<x-layout>
    <h1 class="mb-4">Produkta detaļas</h1>

    <div class="card p-4">
        <h3>{{ $product->name }}</h3>
        <p><strong>Apraksts:</strong> {{ $product->description ?: 'Nav apraksta' }}</p>
        <p><strong>Cena:</strong> {{ $product->price }} €</p>
    </div>

    <div class="mt-3">
        <a href="{{ route('products.edit', $product) }}" class="btn btn-warning">Rediģēt</a>
        <a href="{{ route('products.index') }}" class="btn btn-secondary">Atpakaļ</a>
    </div>
</x-layout>