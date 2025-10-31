<x-layout>
    <h1>Produktu saraksts</h1>

    <a href="{{ route('products.create') }}" class="btn btn-primary mb-3">+ Jauns produkts</a>

    @if($products->count())
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nosaukums</th>
                <th>Cena (€)</th>
                <th>Darbības</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->price }}</td>
                <td>
                    <a href="{{ route('products.show', $product) }}">Skatīt</a> |
                    <a href="{{ route('products.edit', $product) }}">Rediģēt</a> |
                    <form action="{{ route('products.destroy', $product) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Dzēst</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <p>Nav produktu.</p>
    @endif
</x-layout>