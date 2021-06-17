<x-app-layout>
    <div class="overflow-x-auto">
        <div class="mx-auto">
        @if ($message = Session::get('alert'))
            <x-alert  />
        @endif
    </div>
    {{-- <div class="min-w-screen bg-gray-100 flex md:flex-row items-center justify-center font-sans overflow-hidden"> --}}
    <div class="container min-w-screen mx-auto justify-center flex flex-wrap flex-col md:flex-row items-center">
    <span>
    </span>
    <div class="w-full mx-5 lg:w-5/6">
        <h1 class="text-5xl font-bold leading-tight">Order Details</h1>
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
                @php
                  $order_no = 0;
                  $total = 0;
                  $name = '';
                  $address ='';
                  $mobile ='';
                  $email ='';
                  $payment = '';
                  $status = '';
                @endphp
                @foreach ($orders as $item)
                @php
                  $order_no = $item->order_no;
                  $name     = $item->name;
                  $address  = $item->address;
                  $mobile   = $item->mobile;
                  $email    = $item->email;
                  $payment  = $item->order_payment;
                  $status    = $item->order_status;
                @endphp
                <tr class="border-b border-gray-200 hover:bg-gray-100">
                    <td class="py-3 px-6 text-left whitespace-nowrap">
                    <div class="flex items-center">
                        <span class="font-medium">{{ $item->product_name }}</span>
                    </div>
                    </td>
                    <td class="py-3 px-6 text-left">
                    <div class="flex items-center">
                        <span>₱{{number_format($item->order_price, 2)}}</span>
                    </div>
                    </td>
                    <td class="text-center">
                        <span class="mx-5">{{ $item->order_qty }}</span>
                    </td>
                    <td class="text-center">
                        <span>₱{{number_format($item->order_total, 2)}}</span>
                    </td>
                    @php $total += $item->order_qty * $item->order_price @endphp
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
                    {{ $name }}
                </td>
            </tr>
            <tr>
                <th class="py-3 px-6 text-left bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                    Address
                </th>
                <td class="py-3 px-3 border-b border-gray-200">
                    {{ $address }}
                </td>
            </tr>
            <tr>
                <th class="py-3 px-6 text-left bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                    Contact
                </th>
                <td class="py-3 px-3 border-b border-gray-200">
                    {{ $mobile }}
                </td>
            </tr>
            <tr>
                <th class="py-3 px-6 text-left bg-gray-200 text-gray-600 uppercase text-sm leading-normal">Email</th>
                <td class="py-3 px-3 border-b border-gray-200">
                    {{ $email }}
                </td>
            </tr>
            <tr>
                <th class="py-3 px-6 text-left bg-gray-200 text-gray-600 uppercase text-sm leading-normal">Payment</th>
                <td class="py-3 px-3 border-b border-gray-200">
                    <select disabled name="order_payment" class="w-full h-10 pl-3 pr-6 text-base placeholder-gray-600 border rounded-lg appearance-none focus:shadow-outline">
                        <option value="1">Cash On Delivery</option>
                        <option value="2" disabled>Gcash</option>
                    </select>
                </td>
            </tr>
            <tr>
                <th class="py-3 px-6 text-left bg-gray-200 text-gray-600 uppercase text-sm leading-normal">Delivery Status</th>
                @if(session('auth') < 3)
                <form method="POST" action="{{ route('orders.update') }}" id="idOrderUpdate">
                    @csrf
                <td class="py-3 px-3 border-b border-gray-200">
                    <input type="hidden" value="{{ $order_no }}" name="order_no">
                    <select name="order_status" class="w-full h-10 pl-3 pr-6 text-base placeholder-gray-600 border rounded-lg appearance-none focus:shadow-outline">
                        <option value="0" @if ($status == 0) selected @endif>Confirming</option>
                        <option value="1" @if ($status == 1) selected @endif>Preparing</option>
                        <option value="2" @if ($status == 2) selected @endif>Delivering</option>
                        <option value="3" @if ($status == 3) selected @endif>Delivered</option>
                        <option value="4" @if ($status == 4) selected @endif>Cancelled</option>
                    </select>
                </td>
                </form>
                @else
                <td class="py-3 px-3 border-b border-gray-200">
                    @switch ($status)
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
                </td>     
                @endif           
            </tr>
        </table>
        </div>
        <div class="py-5 mx-auto">
            @if($status == 0 && session('auth') == 3)
            <a href="#" class="btn mx-auto lg:mx-0 hover:underline bg-red-500 text-white font-bold rounded-full py-2 px-8 shadow-lg focus:outline-none focus:shadow-outline transform transition hover:scale-105 duration-300 ease-in-out">
                Cancel Order
            </a>
            @endif
            @if(session('auth') < 3)
            <button class="btn mx-auto lg:mx-0 hover:underline bg-yellow-500 text-gray-800 font-bold rounded-full py-2 px-8 shadow-lg focus:outline-none focus:shadow-outline transform transition hover:scale-105 duration-300 ease-in-out" id="idSumbitButton">
                Update Order
        </button> 
            @endif
        </div>
    </div>
    </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function (e) {
            $('#idSumbitButton').click(function(){
                $('#idOrderUpdate').submit();
            });
        });
    </script>
</x-app-layout>