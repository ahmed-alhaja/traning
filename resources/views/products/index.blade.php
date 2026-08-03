@extends('layouts.dashboard')
@section('title', 'Products')
@section('content')
    <div class="form-group mb-5">
        <a href="{{ route('products.create') }}"><button type="submit" class="btn btn-primary bg-blue-700 ">Create New
                Product</button></a>
    </div>
    <div class="form-group">
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th class="px-6 py-3 min-w-[150px]">Title</th>
                        <th class="px-6 py-3 min-w-[200px]">Short Description</th>
                        <th class="px-6 py-3 min-w-[250px]">Long Description</th>
                        <th class="px-6 py-3 w-[80px]">Image</th>
                        <th class="px-6 py-3 w-[120px]"></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($products as $product)
                        <tr
                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <td class="px-6 py-4 break-words whitespace-normal">{{ $product->title }}</td>
                            <td class="px-6 py-4 break-words whitespace-normal">{{ $product->short_description }}</td>
                            <td class="px-6 py-4 break-words whitespace-normal">{{ $product->long_description }}</td>
                            <td class="px-6 py-4 overflow-hidden">
                                @if ($product->firstImage)
                                    <a href="{{ route('products.show', $product->id) }}">
                                        <img class="" src="{{ $product->firstImage->image }}" width="150"
                                            alt="Product Image">
                                    </a>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-primary">Edit</a>

                                    <form id="delete-form-{{ $product->id }}" method="POST"
                                        action="{{ route('products.destroy', $product->id) }}" class="inline-block m-0 p-0">
                                        @csrf
                                        @method('DELETE')
                                        <a type="submit" onclick="confirmDelete(event , {{ $product->id }})"
                                            class="btn btn-danger">Remove</a>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-4">No Categories defined.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>


    {{ $products->links() }}
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
