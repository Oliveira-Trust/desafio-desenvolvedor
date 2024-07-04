@if (session('message'))
    <div class="alert flex flex-row items-center bg-green-200 p-5 rounded border-b-2 border-green-300 py-5 mb-4">
        <div class="alert-content ml-4">
            <div class="alert-title font-semibold text-lg text-green-800">
                {{ __('Success') }}
            </div>
            <div class="alert-description text-sm text-green-600">
                {{ session('message') }}
            </div>
        </div>
    </div>
@endif
