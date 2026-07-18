<h2 class="text-xl font-bold mt-8 mb-4">
    Product Report
</h2>

<div class="bg-white rounded-lg shadow overflow-hidden mb-8">

<table class="w-full">

    <thead class="bg-gray-100">

        <tr>

            <th class="p-3 text-left">Product</th>
            <th class="p-3 text-left">Category</th>
            <th class="p-3 text-left">Supplier</th>
            <th class="p-3 text-center">Stock</th>
            <th class="p-3 text-center">Minimum</th>

        </tr>

    </thead>

    <tbody>

        @foreach($products as $product)

        <tr class="border-t">

            <td class="p-3">{{ $product->name }}</td>

            <td class="p-3">{{ $product->category->name }}</td>

            <td class="p-3">{{ $product->supplier->name }}</td>

            <td class="p-3 text-center">{{ $product->stock }}</td>

            <td class="p-3 text-center">{{ $product->minimum_stock }}</td>

        </tr>

        @endforeach

    </tbody>

</table>

</div>