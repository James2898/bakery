<x-app-layout>
  <div class="overflow-x-auto">
  @if(session()->get('success'))
    <div class="alert alert-success">
      {{ session()->get('success') }}  
    </div><br />
  @endif
  <div class="min-w-screen bg-gray-100 flex items-center justify-center font-sans overflow-hidden">
  <div class="w-full lg:w-5/6">
    @if ($message = Session::get('alert'))
        <x-alert  />
    @endif
    <div class="mx-auto">
      <h1 class="text-5xl font-bold leading-tight">Users</h1>
      <a href="{{ route('users.create') }}" class="btn mx-auto lg:mx-0 hover:underline bg-yellow-500 text-gray-800 font-bold rounded-full py-2 px-8 shadow-lg focus:outline-none focus:shadow-outline transform transition hover:scale-105 duration-300 ease-in-out">
        Add User
      </a>
    </div>
    <div class=" overflow-x-auto bg-white shadow-md rounded my-6">
      <table class="min-w-max w-full table-fixed">
          <thead>
              <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                  <th class="py-3 px-6 text-left" >User #</th>
                  <th class="py-3 px-6 text-left">Name</th>
                  <th class="py-3 px-6 text-center">Permission</th>
                  <th class="py-3 px-6 text-center">Actions</th>
              </tr>
          </thead>
          <tbody class="text-gray-600 text-sm font-light">
            @foreach ($users as $user)
            <tr class="border-b border-gray-200 hover:bg-gray-100">
                <td class="py-3 px-6 text-left whitespace-nowrap">
                  <div class="flex items-center">
                      <span class="font-medium">{{$user->id}}</span>
                  </div>
                </td>
                <td class="py-3 px-6 text-left">
                  <div class="flex items-center">
                      <span>{{$user->name}}</span>
                  </div>
                </td>
                <td class="py-3 px-6 text-center">
                  @switch ($user->level)
                    @case(1)
                      <span class="bg-red-200 text-red-600 py-1 px-3 rounded-full text-xs">Admin</span>
                      @break
                    @case(2)
                      <span class="bg-yellow-200 text-yellow-600 py-1 px-3 rounded-full text-xs">Staff</span>
                      @break
                    @case(3)
                      <span class="bg-blue-200 text-blue-600 py-1 px-3 rounded-full text-xs">Customer</span>
                      @break
                  @endswitch
                </td>
                <td class="py-3 px-6 text-center">
                  <div class="flex item-center justify-center">
                    <a href="{{route('users.edit', $user->id)}}">
                      <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                          </svg>
                      </div>
                    </a>
                      <a href="{{ route('users.delete', $user->id) }}" onclick="return confirm('Are you sure?')">
                        <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                        </div>
                      </a>
                  </div>
                </td>
              </tr>
            @endforeach
          </tbody>
      </table>
    </div>
  </div>
  </div>
  </div>
</x-app-layout>