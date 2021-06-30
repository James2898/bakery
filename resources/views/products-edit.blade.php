<x-app-layout>
    <div class="overflow-x-auto">
    <div class="min-w-screen flex items-center justify-center font-sans overflow-hidden">
    <div class="w-full lg:w-5/6">
        @if ($message = Session::get('alert'))
            <x-alert  />
        @endif
        <h1 class="text-5xl font-bold leading-tight">Edit Product</h1>
        <div class=" overflow-x-auto bg-white shadow-md rounded my-6">
        <div class="grid mt-8 gap-8 grid-cols-1">
        <div class="flex flex-col ">
        <div class="bg-white shadow-md rounded-3xl p-5">
            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />
            <form method="POST" action="{{ route('products.update') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <div class="mt-4">
                    <label for="profile_image"></label>
                    <img id="preview_img" class="border border-yellow-700 mb-1 border-solid hover:border-yellow-500" 
                    src="{{ asset('bread/'.$product->photo) }}" width="200" height="150" />
                
                    <x-label for="product_photo" :value="__('Photo (Photo will not be changed if empty)')" />
                    <input type="file" name="product_photo" id="idProductPhoto" class="w-full h-10 pl-3 pr-6 text-base placeholder-gray-600 border rounded-lg appearance-none focus:shadow-outline">
                </div>

                <div>
                    <x-label for="product_name" :value="__('Name')" />
    
                    <input value="{{ $product->name }}" type="text" name="product_name" id="idProductName" class="w-full h-10 pl-3 pr-6 text-base placeholder-gray-600 border rounded-lg appearance-none focus:shadow-outline" required>
                </div>
    
                <div class="mt-4">
                    <x-label for="product_qty" :value="__('Quantity')" />
    
                    <input value="{{ $product->qty }}" type="number" min="0" name="product_qty" oninput="this.value = !!this.value && Math.abs(this.value) >= 0 ? Math.abs(this.value) : null" id="idUserEmail" class="w-full h-10 pl-3 pr-6 text-base placeholder-gray-600 border rounded-lg appearance-none focus:shadow-outline"  required>
                </div>
    
                <div class="mt-4">
                    <x-label for="product_price" :value="__('Price')" />
    
                    <input value="{{ $product->price }}" type="number" min="1" name="product_price" oninput="this.value = !!this.value && Math.abs(this.value) >= 0 ? Math.abs(this.value) : null" id="idProductPrice" class="w-full h-10 pl-3 pr-6 text-base placeholder-gray-600 border rounded-lg appearance-none focus:shadow-outline"  required>
                </div>
    
                <div class="flex items-center justify-end mt-4">
                    <x-button class="ml-3">
                        {{ __('Update Product') }}
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