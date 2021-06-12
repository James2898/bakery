<x-app-layout>
<div class="bg-black">
    <div class="flex relative text-center">
    <h1 class="text-3xl tracking-wider text-white text-sha uppercase font-bold p-4 self-center z-10 content-center absolute text-center w-full md:text-4xl">Made Fresh For You</h1>
    <img class="w-full object-cover h-72 block mx-auto  sm:block sm:w-full" 
    src="{{ asset('img/bread_product.jpg') }}"
        alt="Banner" width="1920" height="288" />
    </div>
    </div>
    @if(session('auth') && session('auth') < '3')
    @if ($message = Session::get('alert'))
        <x-alert  />
    @endif
    <div class="my-5 mx-auto max-w-screen-xl">
        <a href="{{ route('products.create') }}" class="btn mx-auto lg:mx-0 hover:underline bg-yellow-500 text-gray-800 font-bold rounded-full py-2 px-8 shadow-lg focus:outline-none focus:shadow-outline transform transition hover:scale-105 duration-300 ease-in-out">
            Add Product
        </a>
    </div>
    @endif
    <div class="p-5 mx-auto max-w-screen-xl">
        <div class="grid grid-flow-row-dense grid-cols-2 gap-3 justify-between sm:grid-cols-3 md:grid-cols-4">
            @foreach ($products as $product)
            <div>
                @if(session('auth') && session('auth') < '3')
                <a href="{{ route('products.edit', $product->id) }}">
                @else  
                <a href="{{ route('products.view', $product->id) }}">
                @endif
                        <img class="border border-yellow-700 mb-1 border-solid w-full hover:border-yellow-500" alt="Best seller" 
                        src="{{ asset('storage/img/'.$product->photo) }}" width="150" height="150" loading="lazy" />
                        <h2 class="pt-2 m-0 leading-4 font-semibold">{{$product->name}}</h2>
                </a>
                <p>₱{{number_format($product->price, 2)}}</p>
                @if(session('auth') && session('auth') < '3')
                <a href="{{ route('products.delete', $product->id) }}" onclick="return confirm('Are you sure?')">
                    <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                    </div>
                </a>
                @endif
                @if ($product->qty)
                <p class="text-green-500 italic font-medium">In Stock</p>
                @else
                <p class="text-red-500 italic font-medium">Out of Stock</p>
                @endif
            </div>
            @endforeach
        </div>
    </div>
</div>
</x-app-layout>  