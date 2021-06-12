<x-app-layout>
    <div class="overflow-x-auto">
    <div class="min-w-screen bg-gray-100 flex items-center justify-center font-sans overflow-hidden">
    <div class="w-full lg:w-5/6">
        @if ($message = Session::get('alert'))
            <x-alert  />
        @endif
        <div class=" overflow-x-auto bg-white shadow-md rounded my-6">
        <div class="grid mt-8 gap-8 grid-cols-1">
        <div class="flex flex-col ">
        <div class="bg-white shadow-md rounded-3xl p-5">
            <img id="preview_img" class="border border-yellow-700 mb-1 border-solid hover:border-yellow-500" 
            src="{{ asset('storage/img/'.$product->photo) }}" width="200" height="150" />
            <div class="my-5 mx-auto max-w-screen-xl">
                <div>
                    <p class="font-bold text-5xl">{{ $product->name }}</p>
                    @if ($product->qty)
                    <p class="text-green-500 italic font-medium">In Stock ({{$product->qty}} Left)</p>
                    @else
                    <p class="text-red-500 italic font-medium">Out of Stock</p>
                    @endif
                </div>
            </div>
            <form method="POST" action="{{ route('basket.store') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <div class="mt-4">
                    <x-label for="product_qty" :value="__('Quantity')" />
    
                    <input type="number" value="1" min="0" max="{{$product->qty}}" name="product_qty" oninput="this.value = !!this.value && Math.abs(this.value) >= 0 ? Math.abs(this.value) : null" id="idUserEmail" class="w-1/6 h-10 pl-3 pr-6 text-base placeholder-gray-600 border rounded-lg appearance-none focus:shadow-outline"  required>
                    <button class="btn mx-auto lg:mx-0 hover:underline bg-yellow-500 text-gray-800 font-bold rounded-full py-2 px-8 shadow-lg focus:outline-none focus:shadow-outline transform transition hover:scale-105 duration-300 ease-in-out">
                        Add to Cart
                    </button>
                </div>
                <div class="mt-4">
                </div>
            </form>
        </div>
        </div>
        </div>
        </div>
    </div>
    </div>
    </div>
<script type="text/javascript">
    $(document).ready(function (e) {
        $('#idProductPhoto').change(function(){
            let reader = new FileReader();
            reader.onload = (e) => { 
                $('#preview_img').attr('src', e.target.result); 
                $('#preview_img').removeClass('hidden');
            }
            reader.readAsDataURL(this.files[0]); 
        });
    });
</script>
</x-app-layout>