<x-app-layout>
  <div class="overflow-x-auto">
  <div class="min-w-screen flex items-center justify-center font-sans overflow-hidden">
  <div class="w-full lg:w-5/6">
    @if ($message = Session::get('alert'))
        <x-alert  />
    @endif
    <div class="mx-auto">
      <h1 class="text-5xl font-bold leading-tight">Orders</h1>
      @if (session('auth') == 1 || session('auth') == 2 )
      <a href="{{ route('orders.create') }}" class="btn mx-auto lg:mx-0 hover:underline bg-yellow-500 text-gray-800 font-bold rounded-full py-2 px-8 shadow-lg focus:outline-none focus:shadow-outline transform transition hover:scale-105 duration-300 ease-in-out">
        Add Order
      </a>
      @endif
    </div>
    <div class=" overflow-x-auto bg-white shadow-md rounded my-6">
      <table class="min-w-max w-full table-fixed">
          <thead>
              <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                  <th class="py-3 px-6 text-left hidden md:table-cell">Order #</th>
                  <th class="py-3 px-6 text-left hidden md:table-cell">Date</th>
                  <th class="py-3 px-6 text-left">Name</th>
                  <th class="py-3 px-6 text-left">Items</th>
                  <th class="py-3 px-6 text-left">Total</th>
                  <th class="py-3 px-6 text-left">Status</th>
                  <th class="py-3 px-6 text-center">Actions</th>
              </tr>
          </thead>
          <tbody class="text-gray-600 text-sm font-light">
            @php
              $order_no = '';
            @endphp
            @foreach ($orders as $order)
            <tr class="border-b border-gray-200 hover:bg-gray-100">
              <td class="py-3 px-6 text-left whitespace-nowrap hidden md:table-cell">
                <div class="flex items-center">
                    <span>{{ $order['order_no'] }}</span>
                </div>
              </td>
              <td class="py-3 px-6 text-left whitespace-nowrap hidden md:table-cell">
                <div class="flex items-center">
                    <span>{{ $order['order_date'] }}</span>
                </div>
              </td>
              <td class="py-3 px-6 text-left">
                <div class="flex items-center">
                    <span>{{ $order['name'] }}</span>
                </div>
              </td>
              <td class="py-3 px-6 text-left">
                <div class="flex items-center">
                    <span>{{ implode(", ",$order['products']) }}</span>
                </div>
              </td>
              <td class="py-3 px-6 text-center">
                <div class="flex items-center">
                    <span>{{ $order['total'] }}</span>
                </div>
              </td>
              <td class="py-3 px-6 text-center">
                <div class="flex items-center">
                  @switch ($order['status'])
                    @case(1)
                      <span class="bg-purple-200 text-purple-600 py-1 px-3 rounded-full text-xs">Preparing</span>
                      @break
                    @case(2)
                      <span class="bg-yellow-200 text-yellow-600 py-1 px-3 rounded-full text-xs">Delivering</span>
                      @break
                    @case(3)
                      <span class="bg-green-200 text-green-600 py-1 px-3 rounded-full text-xs">Delivered</span>
                      @break
                    @case(4)
                      <span class="bg-red-200 text-red-600 py-1 px-3 rounded-full text-xs">Cancelled</span>
                      @break
                    @default
                      <span class="bg-blue-200 text-blue-600 py-1 px-3 rounded-full text-xs">Confirming</span>
                      @break  
                  @endswitch
                </div>
              </td>
              <td class="py-3 px-6 text-center">
                <div class="flex item-center justify-center">
                  <a href="{{route('orders.view', $order['order_no'])}}">
                    <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </div>
                  </a>
                </div>
              </td>
            </tr>
            @php
              // $order_no = ($order_no != $order->order_no) ?: $order->order_no;
            @endphp
            @endforeach
          </tbody>
      </table>
    </div>
  </div>
  </div>
  </div>
</x-app-layout>