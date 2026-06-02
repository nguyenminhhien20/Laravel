@forelse ($product_list as $product_row)
    <x-product-card :productRow="$product_row" />
@empty
    <div class="col-span-3 text-center text-gray-500 py-10">
        Không có sản phẩm nào.
    </div>
@endforelse


