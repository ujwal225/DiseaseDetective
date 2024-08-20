@extends('layouts.admin_master')
@section('title', 'Manage Doctors')
@section('content')

    <div class="container mx-auto p-4">
        <h1 class="text-3xl font-bold mb-4 text-gray-900">Manage Doctors</h1>

        @if (session('success'))
            <div class="bg-green-100 text-green-800 p-4 rounded-lg mb-4">
                {{ session('success') }}
            </div>
        @endif

        <!-- Search Bar -->
        <div class="mb-4">
            <input type="text" id="searchInput" placeholder="Search doctors..." class="w-full p-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div class="bg-white shadow-lg rounded-lg overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-blue-500 text-white">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Specialization</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Actions</th>
                </tr>
                </thead>
                <tbody id="doctorTableBody" class="bg-white divide-y divide-gray-200">
                @foreach ($doctors as $user)
                    @if ($user->doctor)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">Dr. {{ $user->first_name }} {{ $user->last_name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $user->doctor->specialization }}</td>
                            <td class="px-6 py-4 whitespace-nowrap"><span class="px-2 py-1 rounded text-white
        @if($user->doctor->is_approved == 1)
            bg-green-500
        @else
            bg-yellow-500
        @endif
    ">
        @if($user->doctor->is_approved == 1)
                                        Approved
                                    @else
                                        Pending
                                    @endif
    </span></td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <form action="{{ route('admin.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this doctor?');" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800 transition duration-150 ease-in-out">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline-block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endif
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- JavaScript for Search Functionality -->
    <script>
        document.getElementById('searchInput').addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            const rows = document.querySelectorAll('#doctorTableBody tr');

            rows.forEach(row => {
                const cells = row.querySelectorAll('td');
                const name = (cells[0].textContent || '').toLowerCase();
                const specialization = (cells[1].textContent || '').toLowerCase();

                if (name.includes(searchTerm) || specialization.includes(searchTerm)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    </script>


@endsection

