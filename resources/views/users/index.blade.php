<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 leading-tight">
            All Users
        </h2>
    </x-slot>

    <div class="p-6">
        <table class="min-w-full bg-white border border-gray-300 rounded-lg">
            <thead>
                <tr class="bg-gray-100 text-left text-sm font-semibold text-gray-700">
                    <th class="p-3 border-b">Name</th>
                    <th class="p-3 border-b">Email</th>
                    <th class="p-3 border-b">Role</th>
                    <th class="p-3 border-b">School</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                <tr class="text-sm text-gray-800">
                    <td class="p-3 border-b">{{ $user->name }}</td>
                    <td class="p-3 border-b">{{ $user->email }}</td>
                    <td class="p-3 border-b">{{ ucfirst($user->role) }}</td>
                    <td class="p-3 border-b">{{ $user->school->name ?? '—' }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="p-3 text-center text-gray-500">No users found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-app-layout>
