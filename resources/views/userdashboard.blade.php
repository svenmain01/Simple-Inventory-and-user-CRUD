<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard for User') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    {{-- --------------------------------------------------------- Content Here --------------------------------------------------------- --}}

                   <!-- component -->
                   <div class="bg-white pb-4 px-4 rounded-md w-full">
                    <div class="overflow-x-auto mt-6" id="itemContainer">

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
                                        <td class="">{{$item->propertynumber}}</td>
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
