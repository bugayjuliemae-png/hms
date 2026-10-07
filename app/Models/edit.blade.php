<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit User
        </h2>
    </x-slot>

    <div class="py-8">

        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow-sm sm:rounded-lg p-6">

                <form method="POST"
                      action="{{ route('users.update', $user->id) }}">

                    @csrf
                    @method('PUT')

                    <!-- Name -->
                    <div class="mb-4">
                        <label class="block font-medium mb-2">
                            Name
                        </label>

                        <input type="text"
                               name="name"
                               value="{{ old('name', $user->name) }}"
                               class="w-full border-gray-300 rounded-lg"
                               required>

                        @error('name')
                            <p class="text-red-600 text-sm mt-1">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="mb-4">
                        <label class="block font-medium mb-2">
                            Email
                        </label>

                        <input type="email"
                               name="email"
                               value="{{ old('email', $user->email) }}"
                               class="w-full border-gray-300 rounded-lg"
                               required>

                        @error('email')
                            <p class="text-red-600 text-sm mt-1">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="mb-4">
                        <label class="block font-medium mb-2">
                            New Password
                        </label>

                        <input type="password"
                               name="password"
                               class="w-full border-gray-300 rounded-lg">

                        <p class="text-gray-500 text-sm mt-1">
                            Leave blank if you don't want to change the password.
                        </p>

                        @error('password')
                            <p class="text-red-600 text-sm mt-1">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div class="mb-4">
                        <label class="block font-medium mb-2">
                            Confirm New Password
                        </label>

                        <input type="password"
                               name="password_confirmation"
                               class="w-full border-gray-300 rounded-lg">
                    </div>

                    <!-- Role -->
                    <div class="mb-6">
                        <label class="block font-medium mb-2">
                            Role
                        </label>

                        <select name="role"
                                class="w-full border-gray-300 rounded-lg"
                                required>

                            <option value="Administrator"
                                {{ $user->role == 'Administrator' ? 'selected' : '' }}>
                                Administrator
                            </option>

                            <option value="Hotel Staff"
                                {{ $user->role == 'Hotel Staff' ? 'selected' : '' }}>
                                Hotel Staff
                            </option>

                            <option value="Customer/Guest"
                                {{ $user->role == 'Customer/Guest' ? 'selected' : '' }}>
                                Customer/Guest
                            </option>

                        </select>

                        @error('role')
                            <p class="text-red-600 text-sm mt-1">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div class="flex gap-3">

                        <button type="submit"
                                class="bg-green-600 text-white px-5 py-2 rounded-lg hover:bg-green-700">
                            Update User
                        </button>

                        <a href="{{ route('users.index') }}"
                           class="bg-gray-500 text-white px-5 py-2 rounded-lg hover:bg-gray-600">
                            Cancel
                        </a>

                    </div>

                </form>

            </div>

        </div>

    </div>

</x-app-layout>