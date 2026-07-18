<h2 class="text-xl font-bold mt-8 mb-4">
    User Report
</h2>

<div class="bg-white rounded-lg shadow overflow-hidden mb-8">

<table class="w-full">

<thead class="bg-gray-100">

<tr>

<th class="p-3">Name</th>

<th class="p-3">Email</th>

<th class="p-3">Role</th>

</tr>

</thead>

<tbody>

@foreach($users as $user)

<tr class="border-t">

<td class="p-3">

{{ $user->name }}

</td>

<td class="p-3">

{{ $user->email }}

</td>

<td class="p-3">

{{ ucfirst($user->role) }}

</td>

</tr>

@endforeach

</tbody>

</table>

</div>