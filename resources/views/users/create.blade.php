@extends('layouts.app') <!-- If you're using a common layout -->

@section('content')
        <h2 class="mt-2 ml-2">
            Add New User (Teacher / Student)
        </h2>
    

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
@endsection

