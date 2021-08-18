@if (request()->is('login') || request()->is('/') )
    <div class="bg-gray-100 min-h-screen p-9">
        <div class="flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
            <div>
                {{ $logo }}
            </div>
            
            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div>
        </div>
    </div>
@else
    <div class="flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">        
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            {{ $slot }}
        </div>
    </div>
@endif
