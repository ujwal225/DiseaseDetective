@extends('layouts.doctor_master')

@section('title', 'Verify Token')
@section('content')

    <div class="container mx-auto p-6 bg-white shadow-md rounded-lg">
        <!-- Display Success/Error Messages -->
        @if(session('success'))
            <div class="mb-4 p-4 bg-green-200 text-green-800 border border-green-400 rounded">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="mb-4 p-4 bg-red-200 text-red-800 border border-red-400 rounded">
                {{ session('error') }}
            </div>
        @endif

        <h2 class="text-2xl font-bold text-blue-800 mb-4 text-center">Search Token</h2>

        <!-- Search Bar -->
        <div class="flex justify-center mb-6">
            <input type="text" id="searchToken" class="w-1/2 px-4 py-2 border border-blue-300 rounded-md focus:ring-2 focus:ring-blue-500" placeholder="Search by Token Number" onkeyup="searchToken()">
        </div>

        <!-- Tokens Table -->
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200 rounded-lg">
                <thead class="bg-blue-700 text-white">
                <tr>
                    <th class="py-2 px-4">Token Number</th>
                    <th class="py-2 px-4">Appointment Date & Time</th>
                    <th class="py-2 px-4">Status</th>
                    <th class="py-2 px-4">Action</th>
                </tr>
                </thead>
                <tbody id="tokensTable">
                @forelse ($tokens as $token)
                    <tr class="bg-gray-100 hover:bg-gray-200 transition duration-300">
                        <td class="py-2 px-4">{{ $token->token_number }}</td>
                        <td class="py-2 px-4">
                            {{ \Carbon\Carbon::parse($token->appointment->appointment_date)->format('l, F j, Y') }} at
                            {{ \Carbon\Carbon::parse($token->appointment->appointment_time)->format('g:i A') }}
                        </td>
                        <td class="py-2 px-4">
                            <span class="px-2 py-1 rounded-md text-white {{ $token->status == 'active' ? 'bg-green-500' : 'bg-red-500' }}">
                                {{ ucfirst($token->status) }}
                            </span>
                        </td>
                        <td class="py-2 px-4">
                            <form action="{{ route('doctor.verifyToken.update', $token->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to mark this token as used?');">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 focus:ring-2 focus:ring-blue-400 transition duration-300">
                                    Mark as Used
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="py-2 px-4 text-center">No tokens found.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination Links -->
        <div class="mt-6">
            {{ $tokens->links('pagination::tailwind') }}
        </div>
    </div>

    <script>
        // JavaScript function to search token dynamically
        function searchToken() {
            let input = document.getElementById('searchToken').value.toUpperCase();
            let table = document.getElementById('tokensTable');
            let tr = table.getElementsByTagName('tr');

            for (let i = 0; i < tr.length; i++) {
                let td = tr[i].getElementsByTagName('td')[0]; // Token number is in the first column
                if (td) {
                    let tokenNumber = td.textContent || td.innerText;
                    if (tokenNumber.toUpperCase().indexOf(input) > -1) {
                        tr[i].style.display = '';
                    } else {
                        tr[i].style.display = 'none';
                    }
                }
            }
        }
    </script>

@endsection
