<x-filament::page>
    <h1 class="text-2xl font-bold mb-4">Subscriber List</h1>

    <table class="min-w-full bg-white rounded shadow">
        <thead>
            <tr>
                <th class="px-4 py-2 text-left">Email</th>
                <th class="px-4 py-2 text-left">Subscribed At</th>
            </tr>
        </thead>
        <tbody>
            @forelse($subscribers as $subscriber)
                <tr>
                    <td class="px-4 py-2">{{ $subscriber->email }}</td>
                    <td class="px-4 py-2">{{ $subscriber->created_at->format('Y-m-d') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="2" class="px-4 py-2 text-center text-gray-500">No subscribers found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</x-filament::page>
