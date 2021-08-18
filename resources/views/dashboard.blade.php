<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-700 leading-tight">
            {{ __('IRO Inventory Management System') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-8xl mx-auto sm:px-6 lg:px-8 ">
            <div class="overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                   {{-- --------------------------------------------------------- Content Here --------------------------------------------------------- --}}

                   <!-- component -->
                   
                    <div class="bg-white pb-4 px-4 rounded-md w-full">
                        <div class="overflow-x-auto mt-6" id="itemContainer">     
                            
                            @if(session()->has('remove'))
                                <div x-data="{ isOpen: true }">
                                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mt-4" role="alert" x-show="isOpen">
                                        <strong class="font-bold">{{ session()->get('remove') }}</strong>
                                        <span class="block sm:inline">has been REMOVED from the inventory</span>
                                        <span class="absolute top-0 bottom-0 right-0 px-4 py-3" @click=" isOpen = false">
                                          <svg class="fill-current h-6 w-6 text-gray-900" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
                                        </span>
                                    </div>
                                </div>
                            @endif

                            <div class="flex gap-2 p-4" id="categories">
                                <label class="inline-flex items-center mt-3">
                                    <input type="checkbox" class="form-checkbox h-5 w-5 text-blue-700" name="category" value="Electronic Equipment"><span class="ml-2 text-gray-700">Electronic Equipment</span>
                                </label>

                                <label class="inline-flex items-center mt-3">
                                    <input type="checkbox" class="form-checkbox h-5 w-5 text-blue-700" name="category" value="Office Equipment"><span class="ml-2 text-gray-700">Office Equipment</span>
                                </label>

                                <label class="inline-flex items-center mt-3">
                                    <input type="checkbox" class="form-checkbox h-5 w-5 text-blue-700" name="category" value="Furniture"><span class="ml-2 text-gray-700">Furniture</span>
                                </label>

                                <label class="inline-flex items-center mt-3">
                                    <input type="checkbox" class="form-checkbox h-5 w-5 text-blue-700" name="category" value="Utensils"><span class="ml-2 text-gray-700">Utensils</span>
                                </label>

                                <label class="inline-flex items-center mt-3">
                                    <input type="checkbox" class="form-checkbox h-5 w-5 text-blue-700" name="category" value="Others"><span class="ml-2 text-gray-700">Others</span>
                                </label>
                            </div>

                            <table id="itemTable" class="stripe display">
                                <thead>
                                    <tr class="" style="">
                                        <th class="">ID</th>
                                        <th class="">Category</th>
                                        <th class="">Item</th>
                                        <th class="">Description</th>
                                        <th class="">Quantification</th>
                                        <th class="">Quantity</th>
                                        <th class="">Price per Quantification</th>
                                        <th class="">Total Price</th>
                                        <th class="">Acquisition Date</th>
                                        <th class="">Property Number</th>
                                        <th class=""></th>
                                    </tr>
                                </thead>
                                <tbody class="">
                                    @foreach ($items as $item)
                                        <tr class="">
                                            <td class="">{{$item->id}}</td>
                                            <td class="">{{$item->category}}</td>
                                            <td class="">{{$item->item}}</td>
                                            <td class="">{{$item->description}}</td>
                                            <td class="">{{$item->quantification}}</td>
                                            <td class="">{{$item->quantity}}</td>
                                            <td class="">₱{{$item->priceperquantification}}</td>
                                            <td class="">₱{{$item->totalprice}}</td>
                                            <td class="">{{$item->acquisitiondate}}</td>
                                            <td class="">
                                                @if (is_null($item->propertynumber))
                                                    N/A
                                                @else
                                                    {{$item->propertynumber}}
                                                @endif
                                            </td>
                                            <td class="">
                                                <x-a class="bg-blue-700 hover:bg-blue-400" href="dashboard/update/{{$item->id}}">Update</x-a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>