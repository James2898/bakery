<x-app-layout>
    <script>
        var product = {
            @foreach ($products as $product)
            {{ $product->id }} : { 'name'  : '{{ $product->name }}', 'price' : '{{ $product->price }}', 'qty' : '{{ $product->qty }}'}, 
            @endforeach
        }

        var order = {};
    </script>
    <div class="overflow-x-auto">
    <div class="min-w-screen  flex items-center justify-center font-sans overflow-hidden">
    <div class="w-full lg:w-5/6">
        <h1 class="text-5xl font-bold leading-tight">Create Order</h1>
        <div class=" overflow-x-auto bg-white shadow-md rounded my-6">
        <div class="grid mt-8 gap-8 grid-cols-1">
        <div class="flex flex-col ">
        <div class="bg-white shadow-md rounded-3xl p-5">
            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />
            <form method="POST" action="{{ route('orders.store') }}" id="idOrderForm">
                @csrf
    
                
                <div>
                    <x-label for="user-id" :value="__('Customer')" />
    
                    <select name="user_id" id="idCustomers" class="w-full h-10 pl-3 pr-6 text-base placeholder-gray-600 border rounded-lg appearance-none focus:shadow-outline" required>
                        <option value="" selected disabled>Select Customer</option>
                        @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>
    
                <div class="mt-4" id="idProducts">
                    <x-label for="user_address" :value="__('Product')" />
                    <div class="block">
                        <div class="mt-2" id="idCheckboxDiv">
                        </div>
                    </div>
                </div>
                <div class="mt-4"> 
                    <x-label for="user_address" :value="__('Order')" />
                    <table class="min-w-max w-full table-fixed">
                        <thead>
                            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                <th class="py-3 px-6 text-left">Name</th>
                                <th class="py-3 px-6 text-left">Price</th>
                                <th class="py-3 px-6 text-center"></th>
                                <th class="py-3 px-6 text-center">Qty</th>
                                <th class="py-3 px-6 text-center"></th>
                                <th class="py-3 px-6 text-center">Stock</th>
                                <th class="py-3 px-6 text-center">Total</th>
                            </tr>
                        </thead>
                        <tbody id="idTbody" class="text-gray-600 text-sm font-light">
                            <tr class="border-b border-gray-200 hover:">
                            <td colspan="6" class="py-3 px-6 text-center whitespace-nowrap">
                                <span class="font-medium">Empty</span>
                            </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="hidden" id="idform"></div>
                <div class="flex items-center justify-end mt-4">
                    <button onclick="check()" class="btn mx-auto lg:mx-0 hover:underline bg-yellow-500 text-gray-800 font-bold rounded-full py-2 px-8 shadow-lg focus:outline-none focus:shadow-outline transform transition hover:scale-105 duration-300 ease-in-out">
                        Add Order
                    </button>
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
    <script>
        $(document).ready(function() {
            checkboxes();
            
            $('.clCheckProducts').change(function () {
                generate();
            })

            $(document).on("click",".upBtn",function (event) {
                id = $(this).attr('id').split(".")[1];
                if(order[id].qty == product[id].qty) {
                    alert('Max Order reached!');
                }else {
                    order[id].qty = order[id].qty + 1;
                }
                generate();
            })

            $(document).on("click",".downBtn",function (event) {
                id = $(this).attr('id').split(".")[1];
                if (order[id].qty == 1) {
                    $('#idChckProduct.'+id).prop("checked",false)
                } else {
                    order[id].qty -= 1;
                }
                generate();
            })

        });
        function checkboxes() {
            
            checkDiv = $('#idCheckboxDiv');
            @foreach ($products as $product)
            div = $('<div>')
            label = $('<label>');
            input = $('<input>')
                .attr({'name':'products[]','type':'checkbox','id':'idChckProduct.{{$product->id}}',})
                .addClass('form-checkbox clCheckProducts')
                .val('{{$product->id}}')
            span = $('<span>')
                .addClass('ml-2')
                .text('{{$product->name}}')
            label.append(input,span)
            div.append(label)
            checkDiv.append(div);
            @endforeach
        }
        function generate() {
            tbody = $("#idTbody")
            form = $('#idform')
            tbody.empty()
            form.empty();
            td_class_r = 'py-3 px-6 text-right whitespace-nowrap';
            td_class_l = 'py-3 px-6 text-left whitespace-nowrap';
            td_class_c = 'py-3 px-6 text-center whitespace-nowrap';
            btn_class = 'btn mx-auto lg:mx-0 hover:underline bg-yellow-500 text-gray-800 font-bold py-2 px-4 shadow-lg focus:outline-none focus:shadow-outline transform transition hover:scale-105 duration-300 ease-in-out';
            $.each($("input[name='products[]']:checked"), function (K, V) {    
                id = V.value;
                
                tr = $('<tr>').addClass('border-b border-gray-200 hover:');
                
                price   = product[id].price;
                qty     = order[id] ? order[id].qty : 1;
                total   = price * qty;

                htmlflex            = $('<div>').addClass('flex items-center');
                htmlproduct_name    = $('<td>').addClass(td_class_l).append(htmlflex.append($('<span>').text(product[id].name)));
                htmlprice           = $('<td>').addClass(td_class_l).text(product[id].price);
                htmldown            = $('<td>').addClass(td_class_l).append($('<a>').attr({'href':'#','id':'idDown.'+id}).addClass(btn_class+" downBtn").text('-'));
                htmlqty             = $('<td>').addClass(td_class_c).attr('id','idQty.'+id).text(qty);
                htmlup              = $('<td>').addClass(td_class_r+" upDiv").append($('<a>').attr({'href':'#','id':'idUp.'+id}).addClass(btn_class+" upBtn").text('+'));
                htmlstock           = $('<td>').addClass(td_class_c).text(product[id].qty);
                htmltotal           = $('<td>').addClass(td_class_c).text(total);
                
                order[id] = {price:price,qty:qty,total:total}

                tr.append(htmlproduct_name,htmlprice,htmldown,htmlqty,htmlup,htmlstock,htmltotal);
                tbody.append(tr);


                formqty = $('<input>').attr({'name' : 'order_qty_'+id,'type':'hidden'}).val(qty);
                form.append(formqty);
            });
        }
        function check() {
            checked = $("input[type=checkbox]:checked").length; 
            customer = $("#idCustomers").val();

            if(!customer) {
                alert("You must select a customer")
                return false;
            }

            if(!checked) {
                alert("You must check at least one checkbox.");
                return false;
            }else {
                $('#idOrderForm').submit();
            }
        }
    </script>