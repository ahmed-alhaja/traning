@extends('layouts.dashboard')
@section('title', 'Products Images')

@section('content')
    <div class="container mt-4">
        <div class="swiper mySwiper">
            <div class="swiper-wrapper">
                @foreach ($images as $image)
                    <div class="swiper-slide position-relative text-center" style="background-color: #f9f9f9;">
                        <img src="{{ asset($image->image) }}" alt="صورة"
                            style="max-height: 400px; max-width: 100%; object-fit: contain; margin: auto;">

                        <!-- زر الحذف -->
                        <form id="delete-form-{{ $image->id }}" method="POST"
                            onclick="confirmDelete(event , {{ $image->id }})"
                            action="{{ route('products.images.destroy', $image->id) }}"
                            style="position:
                            absolute; left: 40px; top: 10px;">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                style="background-color: rgba(255, 0, 0, 0.7); color: white; border: none;
                                           padding: 5px 10px; border-radius: 5px; cursor: pointer;">
                                🗑
                            </button>
                        </form>
                    </div>
                @endforeach
            </div>


            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>

            <div class="swiper-pagination"></div>
        </div>
    </div>
@endsection

@section('scripts')
    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>

    <script>
        const swiper = new Swiper(".mySwiper", {
            loop: true,
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
        });
    </script>

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
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />

    <style>
        .swiper {
            width: 100%;
            height: 420px;
        }

        .swiper-slide {
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>
@endsection
