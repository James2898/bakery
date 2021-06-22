<x-app-layout>
    <div class="overflow-x-auto">
        <div class="mx-auto">
        @if ($message = Session::get('alert'))
            <x-alert  />
        @endif
    </div>
    {{-- <div class="min-w-screen flex md:flex-row items-center justify-center font-sans overflow-hidden"> --}}
    <div class="container min-w-screen mx-auto justify-center flex flex-wrap flex-col md:flex-row items-center">
    <span>
    </span>
    <div class="w-full mx-5 lg:w-5/6">
        <h1 class="text-5xl font-bold leading-tight">Checkout</h1>
        <div class=" overflow-x-auto bg-white shadow-md rounded my-6">
        <table class="min-w-max w-full table-fixed">
            <thead>
                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                    <th class="py-3 px-6 text-left">Name</th>
                    <th class="py-3 px-6 text-left">Price</th>
                    <th class="py-3 px-6 text-center">Qty</th>
                    <th class="py-3 px-6 text-center">Total</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 text-sm font-light">
                @php $total = 0 @endphp
                @if (count($basket) > 0)
                @foreach ($basket as $item)
                <tr class="border-b border-gray-200 hover:bg-gray-100">
                    <td class="py-3 px-6 text-left whitespace-nowrap">
                    <div class="flex items-center">
                        <span class="font-medium">{{ $item->name }}</span>
                    </div>
                    </td>
                    <td class="py-3 px-6 text-left">
                    <div class="flex items-center">
                        <span>₱{{number_format($item->price, 2)}}</span>
                    </div>
                    </td>
                    <td class="text-center">
                        <span class="mx-5">{{ $item->qty }}</span>
                    </td>
                    <td class="text-center">
                        <span>₱{{number_format($item->qty * $item->price, 2)}}</span>
                    </td>
                    @php $total += $item->qty * $item->price @endphp
                </tr>
                @endforeach
                <tr class="border-b border-gray-200 hover:bg-gray-100">
                    <td class="py-3 px-6 text-center" colspan="2">
                    </td>
                    <td class="py-3 px-6 font-bold text-center">
                            <span>Total: </span>
                    </td>
                    <td class="text-center font-bold text-yellow-500">
                        <span>₱{{number_format($total, 2)}}</span>
                    </td>
                </tr>
                @else
                <tr>
                    <td class="text-center" colspan="4">
                        <span>Empty Basket</span>
                    </td>
                </tr>
                @endif
            </tbody>
        </table>
        </div>
    </div>
    <div class="w-full mx-5 lg:w-5/6">
        <div class=" overflow-x-auto bg-white shadow-md rounded my-6">
        <table class="min-w-max w-full table-fixed">
            <tr>
                <th class="py-3 px-6 text-left bg-gray-200 text-gray-600 uppercase text-sm leading-normal">Name</th>
                <td width="80%" class="py-3 px-3 border-b border-gray-200">
                    {{ $item->user_name }}
                </td>
                <td width="5%"  class="border-b border-gray-200">
                    <a href="{{route('profile',Auth::id())}}" class="text-sm text-blue-600">Edit</a>
                </td>
            </tr>
            <tr>
                <th class="py-3 px-6 text-left bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                    Address
                </th>
                <td class="py-3 px-3 border-b border-gray-200">
                    {{ $item->address }}
                </td>
                <td   class="border-b border-gray-200">
                    <a href="{{route('profile',Auth::id())}}" class="text-sm text-blue-600">Edit</a>
                </td>
            </tr>
            <tr>
                <th class="py-3 px-6 text-left bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                    Contact
                </th>
                <td class="py-3 px-3 border-b border-gray-200">
                    {{ $item->mobile }}
                </td>
                <td   class="border-b border-gray-200">
                    <a href="{{route('profile',Auth::id())}}" class="text-sm text-blue-600">Edit</a>
                </td>
            </tr>
            <tr>
                <th class="py-3 px-6 text-left bg-gray-200 text-gray-600 uppercase text-sm leading-normal">Email</th>
                <td class="py-3 px-3 border-b border-gray-200">
                    {{ $item->email }}
                </td>
                <td   class="border-b border-gray-200">
                    <a href="{{route('profile',Auth::id())}}" class="text-sm text-blue-600">Edit</a>
                </td>
            </tr>
            <tr>
                <th class="py-3 px-6 text-left bg-gray-200 text-gray-600 uppercase text-sm leading-normal">Payment</th>
                <td class="py-3 px-3 border-b border-gray-200" colspan="2">
                    <select name="order_payment" class="w-full h-10 pl-3 pr-6 text-base placeholder-gray-600 border rounded-lg appearance-none focus:shadow-outline">
                        <option value="1">Cash On Delivery</option>
                        <option value="2" disabled>Gcash</option>
                    </select>
                </td>
            </tr>
        </table>
        </div>
        <div class="py-5 mx-auto">
            <a href="{{ route('orders.checkout') }}" class="btn mx-auto lg:mx-0 hover:underline bg-yellow-500 text-gray-800 font-bold rounded-full py-2 px-8 shadow-lg focus:outline-none focus:shadow-outline transform transition hover:scale-105 duration-300 ease-in-out">
            Place Order
            </a>
        </div>
    </div>
    </div>
    </div>
</x-app-layout>