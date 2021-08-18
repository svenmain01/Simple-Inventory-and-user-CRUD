<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-700 leading-tight">
            {{ __('Edit Item') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 ">
            <div class="overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('dashboard.edit', $item->id) }}">
                        @method('PUT')
                        @csrf
                        
                        <!-- Item -->
                        <div class="grid gap-4 lg:grid-cols-3 md:grid-cols-2">
                            <div class="w-full">
                                <x-label for="category" :value="__('Category')" />
                
                                {{-- <x-input id="itemtype" class="block mt-1" type="text" name="itemtype" :value="old('itemtype')" required autofocus /> --}}
                                <select id="category" name="category"  class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-full" required>
                                    <option value="{{$item->category}}">{{$item->category}}</option>
                                    <option disabled>-----</option>
                                    <option value="Electronic Equipment">Electronic Equipment</option>
                                    <option value="Office Equipment">Office Equipment</option>
                                    <option value="Furniture">Furniture</option>
                                    <option value="Utensils" >Utensils</option>
                                    <option value="Others">Others</option>
                                </select>
                            </div>
    
                            <!-- Item-->
                            <div class="w-full">
                                <x-label for="item" :value="__('Item')" />
                
                                <input id="item" class="block w-full" type="text" name="item" value="{{$item->item}}" required autofocus onkeyup="this.value = this.value.toUpperCase();"/>
                            </div>
                
                            <!-- Description -->
                            <div class="w-full">
                                <x-label for="description" :value="__('Description')" />
                
                                <input id="description" class="block w-full" type="text" name="description"  value="{{$item->description}}" required />
                            </div>
                
                            <div class="w-full">
                                <x-label for="quantification" :value="__('Quantification')" />
                
                                <select id="quantification" name="quantification"  class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-full" required>
                                    <option value="{{$item->quantification}}">{{$item->quantification}}</option>
                                    <option disabled>-----</option>
                                    <option value="Bundle">Bundle</option>
                                    <option value="Piece">Piece</option>
                                    <option value="Set" >Set</option>
                                    <option value="Unit">Unit</option>
                                </select>
                            </div>

                            <!-- Quantity -->
                            <div class="w-full">
                                <x-label for="quantity" :value="__('Quantity')" />
                
                                <input id="quantity" class="block w-full" type="number" name="quantity"  value="{{$item->quantity}}" onkeyup="calculatePrice()" required />
                            </div>

                            <!-- Price/Quantification -->
                            <div class="w-full">
                                <x-label for="priceperquantification" :value="__('Price/Quantification')" />
                
                                <input id="priceperquantification" class="block w-full" type="number" name="priceperquantification"  value="{{$item->priceperquantification}}" onkeyup="calculatePrice()" step="any" required />
                            </div>

                            <!-- Total Price -->
                            <div class="w-full">
                                <x-label for="totalprice" :value="__('Total Price')" />
                
                                <input id="totalprice" class="block w-full" type="number" name="totalprice"  value="{{$item->totalprice}}" step="any" required />
                            </div>

                            <!-- Acquisition Date -->
                            <div class="w-full">
                                <x-label for="acquisitiondate" :value="__('Acquisition Date')" />
                
                                <input id="acquisitiondate" class="block w-full" type="date" name="acquisitiondate"  value="{{$item->acquisitiondate}}" required />
                            </div>

                            <!-- Property Number -->
                            <div class="w-full">
                                <x-label for="propertynumber" :value="__('Property Number')" />
                
                                <input id="propertynumber" class="block w-full" type="text" name="propertynumber"  value="{{$item->propertynumber}}" onkeyup="this.value = this.value.toUpperCase();" placeholder="Leave Blank if Not Available"/>
                            </div>

                        </div>

                        <div>
                            <div class="flex items-center justify-end mt-4">
                                {{-- <x-button class="ml-4 bg-red-700 hover:bg-red-400" formaction="/dashboard/remove/{{$item->id}}">
                                    {{ __('Remove From Inventory') }}
                                </x-button>  --}}
                                

                                {{-- Confirmation Modal --}}
                                <div x-data="{ isOpen: false }">
                                    <x-button class="ml-4 bg-red-700 hover:bg-red-400" type="button" @click=" isOpen = true">
                                        Remove From Inventory
                                    </x-button>
                                    <div class="fixed z-10 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true"  x-show="isOpen">
                                        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                                        
                                            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
                                        
                                            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                                        
                                            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                                                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                                    <div class="sm:flex sm:items-start">
                                                        <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                                                            <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                                            </svg>
                                                        </div>
                                                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                                                <strong class="font-bold">{{ $item->item }}</strong>
                                                            </h3>
                                                            <div class="mt-2">
                                                                <p class="text-sm text-gray-500">
                                                                    REMOVE this item from Inventory?
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">                                   
                                                    <button type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm" @click=" isOpen = false">
                                                        Cancel
                                                    </button>
                                                    <x-button class="ml-4 bg-red-700 hover:bg-red-400" formaction="{{ route('dashboard.remove', $item->id) }}">
                                                        {{ __('Confirm') }}
                                                    </x-button> 
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- End Confirmation Modal --}}    
                                

                                <x-button class="ml-4">
                                    {{ __('Save Changes') }}
                                </x-button>
                                
                            </div>                          
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    
    {{-- Modal --}}
    @if(session()->has('message'))
    <div class="fixed z-10 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true" x-data="{ show: true }" x-show="show">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
        
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-green-100 sm:mx-0 sm:h-10 sm:w-10">
                            <svg class="h-6 w-6 text-green-600"width="16" height="16" fill="currentColor" class="bi bi-check-circle" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                <path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z"/>
                              </svg>
                        </div>
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                <strong class="font-bold">{{ session()->get('message') }}</strong>
                            </h3>
                            <div class="mt-2">
                                <p class="text-sm text-gray-500">
                                    information has been UPDATED
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">                                   
                    <button type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm" @click=" show = false">
                        Okay
                    </button>
                </div>
            </div>
        </div>
    </div>  
    @endif
    {{-- Endmodal --}}

    @push('scripts')
        <script>
            function calculatePrice(){
                qty = document.getElementById('quantity').value;
                price = document.getElementById('priceperquantification').value;
                total = document.getElementById('totalprice');

                calculated = qty * price;

                total.value = calculated;
                
            }

            function toggleModal(){
                document.getElementById('confirmationModal').classList.toggle("fixed");
            }
        </script>   
    @endpush
</x-app-layout>
