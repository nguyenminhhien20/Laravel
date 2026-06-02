<x-layout-admin>
    <div class="content-wrapper space-y-6">

        <!-- Header Section -->
        <div class="bg-blue-100 px-6 py-4 rounded-2xl shadow flex items-center justify-between">
            <h2 class="text-2xl font-bold text-blue-700 flex items-center gap-2">
                <i class="fa fa-trash-alt text-lg"></i>
                Thùng Rác Banner
            </h2>
            <a href="{{ route('product.index') }}"
               class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-xl shadow flex items-center gap-2 transition">
                <i class="fa fa-arrow-left"></i> Về danh sách
            </a>
        </div>

        <!-- Table Section -->
        <div class="bg-white rounded-2xl shadow p-4 overflow-x-auto">
            <table class="w-full table-auto text-sm text-gray-700">
                <thead class="bg-gray-100 text-gray-600 uppercase text-xs">
                    <tr>
                        <th class="px-6 py-3 text-center">Hình ảnh</th>
                        <th class="px-6 py-3 text-center">Tên Banner</th>
                        <th class="px-6 py-3 text-center">Liên kết</th>
                        <th class="px-6 py-3 text-center">Vị trí</th>
                        <th class="px-6 py-3 text-center">Chức năng</th>
                        <th class="px-6 py-3 text-center">ID</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($list as $item)
                        <tr class="border-t hover:bg-blue-50 transition">
                            <td class="px-6 py-3 text-center">
                                <img src="{{ asset('assets/images/banner/' . $item->image) }}"
                                     alt="{{ $item->image }}"
                                     class="h-16 w-16 object-cover rounded-lg shadow mx-auto">
                            </td>
                            <td class="px-6 py-3 text-center font-medium">{{ $item->name }}</td>
                            <td class="px-6 py-3 text-center text-blue-600 hover:underline">
                                <a href="{{ $item->link }}" target="_blank">{{ Str::limit($item->link, 30) }}</a>
                            </td>
                            <td class="px-6 py-3 text-center">{{ $item->position }}</td>
                            <td class="px-6 py-3 text-center">
                                <div class="flex justify-center gap-3">
                                    <a href="{{ route('banner.restore', ['banner' => $item->id]) }}"
                                       title="Khôi phục"
                                       class="text-green-500 hover:text-green-700 transition">
                                        <i class="fa fa-rotate-left text-xl"></i>
                                    </a>
                                  <form action="{{ route('banner.delete', $item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">Xóa vĩnh viễn</button>
                                </form>
                                </div>
                            </td>
                            <td class="px-6 py-3 text-center">{{ $item->id ?? 'Không có ID' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-6 text-gray-500 italic">
                                Không có banner nào trong thùng rác.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="text-center">
            {{ $list->links() }}
        </div>
    </div>
</x-layout-admin>
