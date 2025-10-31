<x-layout>
    <h1 class="mb-4">Produktu saraksts</h1>

    <a href="{{ route('products.create') }}" class="btn btn-primary mb-3">+ Jauns produkts</a>

    @if($products->count())
    <table class="table table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nosaukums</th>
                <th>Cena</th>
                <th>Darbības</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->price }} €</td>
                <td>
                    <a href="{{ route('products.show', $product) }}" class="btn btn-sm btn-info">Skatīt</a>
                    <a href="{{ route('products.edit', $product) }}" class="btn btn-sm btn-warning">Rediģēt</a>

                    <form action="{{ route('products.destroy', $product) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger"
                            onclick="return confirm('Vai tiešām dzēst?')">Dzēst</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <p class="text-muted">Nav produktu.</p>
    @endif
</x-layout>