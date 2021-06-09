<x-app-layout>
<div class="overflow-x-auto">
<div class="min-w-screen bg-gray-100 flex items-center justify-center font-sans overflow-hidden">
<div class="w-full lg:w-5/6">
    @if ($message = Session::get('alert'))
        <x-alert  />
    @endif
    <h1 class="text-5xl font-bold leading-tight">Edit User</h1>
    <div class=" overflow-x-auto bg-white shadow-md rounded my-6">
    <div class="grid mt-8 gap-8 grid-cols-1">
    <div class="flex flex-col ">
    <div class="bg-white shadow-md rounded-3xl p-5">
        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />
        <form method="POST" action="{{ route('users.update') }}">
            @csrf
            @method('PUT')
            <input type="hidden" name="user_no" value="{{ $user->id }}" />

            <div>
                <x-label for="user_email" :value="__('Name')" />

                <input value="{{ $user->name  }}" type="text" name="user_name" id="idUserName" class="w-full h-10 pl-3 pr-6 text-base placeholder-gray-600 border rounded-lg appearance-none focus:shadow-outline" required>
            </div>

            <div class="mt-4">
                <x-label for="user_address" :value="__('Email')" />

                <input value="{{ $user->email }}" type="email" name="user_email" id="idUserEmail" class="w-full h-10 pl-3 pr-6 text-base placeholder-gray-600 border rounded-lg appearance-none focus:shadow-outline"  required>
            </div>

            <div class="mt-4">
                <x-label for="user_password" :value="__('Password')" />

                <input value="" type="text" name="user_password" id="idUserPassword" class="w-full h-10 pl-3 pr-6 text-base placeholder-gray-600 border rounded-lg appearance-none focus:shadow-outline" placeholder="Password will not be changed if empty">
            </div>

            <div class="mt-4">
                <x-label for="user_address" :value="__('Address')" />

                <input value="{{ $user->address }}" type="text" name="user_address" id="idUserAddress" class="w-full h-10 pl-3 pr-6 text-base placeholder-gray-600 border rounded-lg appearance-none focus:shadow-outline"  required>
            </div>

            <div class="mt-4">
                <x-label for="user_mobile" :value="__('Mobile #')" />

                <input value="{{ $user->mobile }}" type="text" name="user_mobile" id="idUserMobile" class="w-full h-10 pl-3 pr-6 text-base placeholder-gray-600 border rounded-lg appearance-none focus:shadow-outline"  required>
            </div>

            <div class="mt-4">
                <x-label for="user_level" :value="__('Level')" />

                <select name="user_level" class="w-full h-10 pl-3 pr-6 text-base placeholder-gray-600 border rounded-lg appearance-none focus:shadow-outline">
                    <option value="1" @if ($user->level == 1) selected @endif>Admin</option>
                    <option value="2" @if ($user->level == 2) selected @endif>Staff</option>
                    <option value="3" @if ($user->level == 3) selected @endif>Customer</option>
                </select>
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button class="ml-3">
                    {{ __('Update User') }}
                </x-button>
            </div>
        </form>
    </div>
    </div>
    </div>
    </div>
</div>
</div>
</div>
</x-app-layout>