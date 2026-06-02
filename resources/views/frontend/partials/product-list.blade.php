    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 min-h-[200px]">
        @forelse ($product_list as $product_row)
            <x-product-card :productRow="$product_row" />
        @empty
            <div class="col-span-3 flex justify-center items-center h-full min-h-[200px]">
                <p class="text-gray-500 text-lg font-medium text-center">
                    Không tìm thấy sản phẩm nào phù hợp với từ khóa
                    @if (request('keyword'))
                        "<span class="text-rose-500">{{ request('keyword') }}</span>"
                    @endif
                </p>
            </div>
        @endforelse
    </div>

    @if ($product_list->count() > 0)
        <div class="mt-6 flex justify-center">
            {{ $product_list->links() }}
        </div>
    @endif
