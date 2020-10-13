<x-admin-master>
    @section('content')

        @if(auth()->user()->hasRole('admin'))
                <h1 class="h3 mb-4 text-gray-800">Dasboard</h1>
        @endif

    @endsection
</x-admin-master>
