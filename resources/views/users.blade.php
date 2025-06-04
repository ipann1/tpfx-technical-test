<x-layout>

    <x-slot:title>{{ $title }}</x-slot:title>
    
    <div class="py-4">
        <button type="button" onclick="openModal()" class="cursor-pointer shadow text-white bg-gradient-to-r from-cyan-400 via-cyan-500 to-cyan-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">+ Add User</button>
    </div>

    <!-- Modal Add User -->
<div id="addUserModal" class="fixed inset-0 z-50 hidden flex items-center justify-center" style="background-color: rgba(0, 0, 0, 0.4);">
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg w-full max-w-md p-6">
        <h2 class="text-lg font-bold mb-4 text-gray-800 dark:text-white">Add New User</h2>
        <form method="POST" action="{{ route('users.add') }}">
            @csrf
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Username</label>
                <input type="text" name="name" id="name" required class="w-full p-2 rounded border border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
            </div>
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
                <input type="email" name="email" id="email" required class="w-full p-2 rounded border border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
            </div>
            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Password</label>
                <input type="password" name="password" id="password" required class="w-full p-2 rounded border border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
            </div>
            <div class="flex justify-end">
                <button type="button" onclick="closeModal()" class="mr-2 px-4 py-2 bg-gray-300 dark:bg-gray-600 text-black dark:text-white rounded">Cancel</button>
                <button type="submit" class="px-4 py-2 bg-cyan-600 text-white rounded hover:bg-cyan-700">Save</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Edit User -->
<div id="editUserModal" class="fixed inset-0 z-50 hidden flex items-center justify-center" style="background-color: rgba(0, 0, 0, 0.4);">
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg w-full max-w-md p-6">
        <h2 class="text-lg font-bold mb-4 text-gray-800 dark:text-white">Edit User</h2>
        <form id="editUserForm" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="edit_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Username</label>
                <input type="text" name="name" id="edit_name" required class="w-full p-2 rounded border border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
            </div>
            <div class="mb-4">
                <label for="edit_email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
                <input type="email" name="email" id="edit_email" required class="w-full p-2 rounded border border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
            </div>
            <div class="mb-4">
                <label for="edit_password" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Password (opsional)</label>
                <input type="password" name="password" id="edit_password" class="w-full p-2 rounded border border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-white" placeholder="Biarkan kosong jika tidak diubah">
            </div>
            <div class="flex justify-end">
                <button type="button" onclick="closeEditModal()" class="mr-2 px-4 py-2 bg-gray-300 dark:bg-gray-600 text-black dark:text-white rounded">Cancel</button>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Update</button>
            </div>
        </form>
    </div>
</div>

    <div class="my-2 flex-justify-end pb-4">
        {{ $users->links() }}
    </div>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Username
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Email
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Password
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-gray-200">
                    <th scope="row" class="px-6 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $user->name }}   
                    </th>
                    <td class="px-6 py-3">
                        {{ $user->email }}
                    </td>
                    <td class="px-6 py-3">
                        {{ $user->password }}
                    </td>
                    <td class="px-6 py-3 text-center">
                        <button
                            type="button"
                            onclick="openEditModal({{ $user->id }}, '{{ $user->name }}', '{{ $user->email }}')"
                            class="cursor-pointer shadow text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            Edit
                        </button>
                        <form action="{{ route('users.delete', $user->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure want to delete this user?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="cursor-pointer shadow text-white bg-red-700 hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="my-2 flex-justify-end pb-4">
        {{ $users->links() }}
    </div>


<script>
    function openModal() {
        document.getElementById('addUserModal').classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('addUserModal').classList.add('hidden');
    }

    function openEditModal(id, name, email) {
    const form = document.getElementById('editUserForm');
    form.action = `/users/${id}`;

    document.getElementById('edit_name').value = name;
    document.getElementById('edit_email').value = email;
    document.getElementById('edit_password').value = ''; // pastikan kosong

    document.getElementById('editUserModal').classList.remove('hidden');
}

    function closeEditModal() {
        document.getElementById('editUserModal').classList.add('hidden');
    }
</script>

</x-layout>