<x-app-layout>
    <div class="overflow-x-auto">
    <div class="min-w-screen bg-gray-100 flex items-center justify-center font-sans overflow-hidden">
    <div class="w-full lg:w-5/6">
        <div class="mx-auto">
        @if ($message = Session::get('alert'))
            <x-alert  />
        @endif
        <h1 class="text-5xl font-bold leading-tight">Basket</h1>
        </div>
        <div class=" overflow-x-auto bg-white shadow-md rounded my-6">
        <table class="min-w-max w-full table-fixed">
            <thead>
                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                    <th class="py-3 px-6 text-left">Name</th>
                    <th class="py-3 px-6 text-left">Price</th>
                    <th class="py-3 px-6 text-center">Qty</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 text-sm font-light">
                @foreach ($basket as $item)
                <tr class="border-b border-gray-200 hover:bg-gray-100">
                    <td class="py-3 px-6 text-left whitespace-nowrap">
                    <div class="flex items-center">
                        <span class="font-medium">{{ $item->name }}</span>
                    </div>
                    </td>
                    <td class="py-3 px-6 text-left">
                    <div class="flex items-center">
                        <span>{{ $item->price }}</span>
                    </div>
                    </td>
                    <td class="text-center">
                        <a href="{{ route('basket.down', $item->id) }}" class="btn mx-auto lg:mx-0 hover:underline bg-yellow-500 text-gray-800 font-bold py-2 px-4 shadow-lg focus:outline-none focus:shadow-outline transform transition hover:scale-105 duration-300 ease-in-out">
                            −
                        </a>
                        <span class="mx-5">{{ $item->qty }}</span>
                        <a href="{{ route('basket.up', $item->id) }}" class="btn mx-auto lg:mx-0 hover:underline bg-yellow-500 text-gray-800 font-bold py-2 px-4 shadow-lg focus:outline-none focus:shadow-outline transform transition hover:scale-105 duration-300 ease-in-out">
                            +
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        </div>
        <div class="mx-auto">
            <a href="{{ route('products.create') }}" class="btn mx-auto lg:mx-0 hover:underline bg-yellow-500 text-gray-800 font-bold rounded-full py-2 px-8 shadow-lg focus:outline-none focus:shadow-outline transform transition hover:scale-105 duration-300 ease-in-out">
            Add User
            </a>
        </div>
    </div>
</div>
</div>
  </x-app-layout>