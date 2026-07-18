<h2 class="text-xl font-bold mt-8 mb-4">
    Category Report
</h2>

<div class="bg-white rounded-lg shadow overflow-hidden mb-8">

<table class="w-full">

    <thead class="bg-gray-100">

        <tr>

            <th class="p-3">Category</th>
            <th class="p-3">Description</th>
            <th class="p-3">Total Product</th>

        </tr>

    </thead>

    <tbody>

        @foreach($categories as $category)

        <tr class="border-t">

            <td class="p-3">

                {{ $category->name }}

            </td>

            <td class="p-3">

                {{ $category->description }}

            </td>

            <td class="p-3 text-center">

                {{ $category->products_count }}

            </td>

        </tr>

        @endforeach

    </tbody>

</table>

</div>