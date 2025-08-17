<x-guest-layout>

    <div class="p-6">
        <form action="{{ route('schools.store') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <input type="hidden" name="user_id" value="{{ $id }}">

                <label for="name">School Name</label>
                <input type="text" name="name" id="name" class="w-full rounded border-gray-300" required>
            </div>

            <div>
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="w-full rounded border-gray-300">
            </div>

            <div>
                <label for="phone">Phone</label>
                <input type="text" name="phone" id="phone" class="w-full rounded border-gray-300">
            </div>

            <div>
                <label for="address">Address</label>
                <textarea name="address" id="address" class="w-full rounded border-gray-300"></textarea>
            </div>


            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Add School</button>
        </form>
    </div>

</x-guest-layout>
