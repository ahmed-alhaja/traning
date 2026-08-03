@extends('layouts.dashboard')
@section('title', 'Categories')

@section('content')
    <div class="mb-6">
        <a href="{{ route('categories.create') }}">
            <button class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded shadow">
                + Create New Category
            </button>
        </a>
    </div>

    <div class="overflow-x-auto bg-white shadow rounded-lg">
        <table class="min-w-full table-auto border border-gray-200 text-sm text-left">
            <thead class="bg-gray-100 text-gray-700 uppercase tracking-wider">
                <tr>
                    <th class="px-4 py-3 border-b">#</th>
                    <th class="px-4 py-3 border-b">Name</th>
                    <th class="px-4 py-3 border-b">Image</th>
                    <th class="px-4 py-3 border-b">Parent_name</th>
                    <th class="px-4 py-3 border-b">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($categories as $key => $category)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3 border-b">{{ ++$key }}</td>
                        <td class="px-4 py-3 border-b">
                            <a href="{{route('categories.show' , $category->id)}}">
                                {{ $category->name }}
                            </a>
                            
                            <br>
                            {{ $category->allChildrenNames }}
                        </td>
                        <td class="px-4 py-3 border-b">
                            <img src="{{ $category->image }}" class="w-16 h-16 rounded object-cover border shadow"
                                alt="Category Image">
                        </td>
                        <td class="px-4 py-3 border-b">{{ $category->parent->name ?? 'this is parent' }}</td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-primary">Edit</a>

                                <form id="delete-form-{{ $category->id }}" method="POST"
                                    action="{{ route('categories.destroy', $category->id) }}" class="inline-block m-0 p-0">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="confirmDelete(event , {{ $category->id }})"
                                        class="btn btn-danger">Remove</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-4 text-center text-gray-500">
                            No categories found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $categories->links() }}
    </div>
@endsection

@section('scripts')
    <script>
        function confirmDelete(event, id) {
            event.preventDefault();
            Swal.fire({
                title: 'هل أنت متأكد؟',
                text: "لن تتمكن من التراجع بعد الحذف!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'نعم، احذف!',
                cancelButtonText: 'إلغاء'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(`delete-form-${id}`).submit();
                }
            });
        }
    </script>
@endsection
