@extends('layouts.app') <!-- If you're using a common layout -->

@section('content')
        <h2 class="mt-2 ml-2">
            Add New School
        </h2>
    

    <div class="p-6">
        <form action="{{ route('schools.store') }}" method="POST" class="space-y-4">
            @csrf

            <div>
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

             <div>
    <label for="user_id">Assign User</label>
    <select name="user_id" id="user_id" class="w-full rounded border-gray-300" required>
        <option value="">Select a user</option>
        @foreach ($users as $user)
            <option value="{{ $user->id }}">{{ $user->name }}</option>
        @endforeach
    </select>
</div>


            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Add School</button>
        </form>
    </div>
@endsection
