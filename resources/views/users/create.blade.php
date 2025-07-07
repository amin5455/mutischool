<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 leading-tight">
            Add New User (Teacher / Student)
        </h2>
    </x-slot>

    <div class="p-6">
        <form method="POST" action="{{ route('users.store') }}" class="space-y-4">
            @csrf

            <div>
                <label>Name</label>
                <input type="text" name="name" required class="w-full rounded border-gray-300">
            </div>

            <div>
                <label>Email</label>
                <input type="email" name="email" required class="w-full rounded border-gray-300">
            </div>

            <div>
                <label>Password</label>
                <input type="password" name="password" required class="w-full rounded border-gray-300">
            </div>

            <div>
                <label>Role</label>
                <select name="role" required class="w-full rounded border-gray-300">
                    <option value="teacher">Teacher</option>
                    <option value="student">Student</option>
                </select>
            </div>

            <div>
                <label>School</label>
                <select name="school_id" required class="w-full rounded border-gray-300">
                    @foreach(\App\Models\School::all() as $school)
                        <option value="{{ $school->id }}">{{ $school->name }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Create User</button>
        </form>
    </div>
</x-app-layout>
