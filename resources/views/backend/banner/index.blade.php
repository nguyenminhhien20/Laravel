<x-layout-admin>
    <div class="content-wrapper space-y-6">

        <!-- Header -->
        <div class="bg-blue-100 px-6 py-4 rounded-2xl shadow flex items-center justify-between">
            <h2 class="text-2xl font-bold text-blue-700 flex items-center gap-2">
                <i class="fa fa-image text-xl"></i>
                Quản lý Banner
            </h2>
            <div class="flex gap-3">
                <a href="{{ route('banner.create') }}"
                   class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-xl shadow flex items-center gap-2 transition">
                    <i class="fa fa-plus"></i> Thêm
                </a>
                <a href="{{ route('banner.trash') }}"
                   class="bg-rose-500 hover:bg-rose-600 text-white px-4 py-2 rounded-xl shadow flex items-center gap-2 transition">
                    <i class="fa fa-trash"></i> Thùng Rác
                </a>
            </div>
        </div>

        <!-- Table -->
        <div class="bg-white shadow rounded-2xl overflow-x-auto">
            <table class="w-full table-auto text-sm text-gray-700">
                <thead class="bg-gray-100 text-gray-600 uppercase text-xs">
                    <tr>
                        <th class="px-6 py-4 text-center">Hình ảnh</th>
                        <th class="px-6 py-4 text-center">Tên Banner</th>
                        <th class="px-6 py-4 text-center">Vị trí</th>
                        <th class="px-6 py-4 text-center">Chức năng</th>
                        <th class="px-6 py-4 text-center">ID</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($list as $item)
                        <tr class="border-t hover:bg-blue-50 transition">
                            <td class="px-6 py-3 text-center">
                                <img src="{{ asset('assets/images/banner/'.$item->image) }}"
                                     alt="{{ $item->image }}"
                                     class="h-16 w-16 object-cover rounded-lg shadow mx-auto">
                            </td>
                            <td class="px-6 py-3 text-center font-medium">{{ $item->name }}</td>
                            <td class="px-6 py-3 text-center">{{ $item->position }}</td>
                            <td class="px-6 py-3 text-center">
                                <div class="flex justify-center items-center gap-3">
                                    <a href="{{ route('banner.status', ['banner' => $item->id]) }}" title="Đổi trạng thái">
                                        @if ($item->status == 1)
                                            <i class="fa fa-toggle-on text-green-500 text-xl hover:text-green-700 transition"></i>
                                        @else
                                            <i class="fa fa-toggle-off text-red-500 text-xl hover:text-red-700 transition"></i>
                                        @endif
                                    </a>
                                    <a href="{{ route('banner.show', ['banner' => $item->id]) }}"
                                       title="Xem chi tiết"
                                       class="text-orange-500 hover:text-orange-700 transition">
                                        <i class="fa fa-eye text-xl"></i>
                                    </a>
                                    <a href="{{ route('banner.edit', ['banner' => $item->id]) }}"
                                       title="Chỉnh sửa"
                                       class="text-blue-500 hover:text-blue-700 transition">
                                        <i class="fa fa-edit text-xl"></i>
                                    </a>
                                        <form action="{{ route('banner.destroy', ['banner' => $item->id]) }}" method="POST"
                                    class="inline-block"
                                    onsubmit="return confirm('Bạn có chắc chắn muốn xóa banner này?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-rose-500 hover:text-rose-600 text-xl"
                                        title="Xóa">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
                                </div>
                            </td>
                            <td class="px-6 py-3 text-center">{{ $item->id ?? 'Không có' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-6 text-gray-500 italic">Không có banner nào.</td>
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
