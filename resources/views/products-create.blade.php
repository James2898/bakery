<x-app-layout>
    <div class="overflow-x-auto">
    <div class="min-w-screen bg-gray-100 flex items-center justify-center font-sans overflow-hidden">
    <div class="w-full lg:w-5/6">
        <h1 class="text-5xl font-bold leading-tight">Create Product</h1>
        <div class=" overflow-x-auto bg-white shadow-md rounded my-6">
        <div class="grid mt-8 gap-8 grid-cols-1">
        <div class="flex flex-col ">
        <div class="bg-white shadow-md rounded-3xl p-5">
            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />
            <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="mt-4">
                    <label for="profile_image"></label>
                    <img id="preview_img" class="border border-yellow-700 mb-1 border-solid hover:border-yellow-500 hidden" 
                    src="https://w3adda.com/wp-content/uploads/2019/09/No_Image-128.png" width="480" height="150" />
                
                    <x-label for="product_photo" :value="__('Photo')" />
                    <input type="file" name="product_photo" id="idProductPhoto" class="w-full h-10 pl-3 pr-6 text-base placeholder-gray-600 border rounded-lg appearance-none focus:shadow-outline"  required>
                </div>

                <div>
                    <x-label for="product_name" :value="__('Name')" />
    
                    <input value="" type="text" name="product_name" id="idProductName" class="w-full h-10 pl-3 pr-6 text-base placeholder-gray-600 border rounded-lg appearance-none focus:shadow-outline" required>
                </div>
    
                <div class="mt-4">
                    <x-label for="product_qty" :value="__('Quantity')" />
    
                    <input value="0" type="number" min="0" name="product_qty" oninput="this.value = !!this.value && Math.abs(this.value) >= 0 ? Math.abs(this.value) : null" id="idUserEmail" class="w-full h-10 pl-3 pr-6 text-base placeholder-gray-600 border rounded-lg appearance-none focus:shadow-outline"  required>
                </div>
    
                <div class="mt-4">
                    <x-label for="product_price" :value="__('Price')" />
    
                    <input value="" type="number" name="product_price" id="idProductPrice" class="w-full h-10 pl-3 pr-6 text-base placeholder-gray-600 border rounded-lg appearance-none focus:shadow-outline"  required>
                </div>
    
                <div class="flex items-center justify-end mt-4">
                    <x-button class="ml-3">
                        {{ __('Add Product') }}
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