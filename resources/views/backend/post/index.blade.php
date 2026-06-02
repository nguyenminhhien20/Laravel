<x-layout-admin>
    <div class="content-wrapper space-y-6">
        <!-- Header Section -->
        <div class="bg-gradient-to-r from-blue-100 to-blue-50 mb-4 rounded-2xl py-4 px-6 shadow-lg">
            <div class="flex items-center justify-between">
                <h2 class="text-2xl font-bold text-blue-700 flex items-center gap-2">
                    <i class="fa fa-newspaper-o text-blue-500"></i> Quản lý Bài Viết
                </h2>
                <div class="flex gap-3">
                    <a href="{{ route('post.create') }}"
                       class="bg-blue-600 hover:bg-green-600 text-white px-4 py-2 rounded-full flex items-center gap-2 shadow transition">
                        <i class="fa fa-plus"></i> Thêm
                    </a>
                    <a href="{{ route('post.trash') }}"
                       class="bg-rose-500 hover:bg-rose-600 text-white px-4 py-2 rounded-full flex items-center gap-2 shadow transition">
                        <i class="fa fa-trash"></i> Thùng Rác
                    </a>
                </div>
            </div>
        </div>

        <!-- Table Section -->
        <div class="bg-white rounded-xl shadow-lg p-6 overflow-x-auto">
            <table class="min-w-full table-auto bg-gray-50 text-sm">
                <thead>
                    <tr class="bg-gray-200 text-gray-700 font-semibold">
                        <th class="p-3 text-center">Hình Ảnh</th>
                        <th class="p-3 text-center">Chủ Đề</th>
                        <th class="p-3 text-center">Tiêu Đề</th>
                        <th class="p-3 text-center">Nội Dung</th>
                        <th class="p-3 text-center">Mô Tả</th>
                        <th class="p-3 text-center">Chức Năng</th>
                        <th class="p-3 text-center">ID</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach ($list as $item)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="p-3 text-center">
                                <img src="{{ asset('assets/images/post/' . $item->thumbnail) }}"
                                     alt="{{ $item->thumbnail }}"
                                     class="h-16 w-16 object-cover rounded-lg shadow mx-auto">
                            </td>
                            <td class="p-3 text-center text-gray-800">{{ $item->topic_name }}</td>
                            <td class="p-3 text-center text-gray-800 font-medium">{{ $item->title }}</td>
                            <td class="p-3 text-gray-600 max-w-xs truncate text-center">{{ Str::limit($item->detail, 80) }}</td>
                            <td class="p-3 text-gray-600 max-w-xs truncate text-center">{{ Str::limit($item->description, 60) }}</td>
                            <td class="p-3 text-center">
                                <div class="flex justify-center gap-2 text-xl">
                                    <a href="{{ route('post.status', ['post' => $item->id]) }}"
                                       class="hover:scale-110 transition text-green-500"
                                       title="Trạng thái">
                                        @if ($item->status == 1)
                                            <i class="fa fa-toggle-on"></i>
                                        @else
                                            <i class="fa fa-toggle-off text-red-500"></i>
                                        @endif
                                    </a>
                                    <a href="{{ route('post.show', ['post' => $item->id]) }}"
                                       class="text-orange-500 hover:text-orange-600"
                                       title="Xem">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    <a href="{{ route('post.edit', ['post' => $item->id]) }}"
                                       class="text-blue-500 hover:text-blue-600"
                                       title="Sửa">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                  <form action="{{ route('post.destroy', ['post' => $item->id]) }}" method="POST"
                                    class="inline-block"
                                    onsubmit="return confirm('Bạn có chắc chắn muốn xóa bài viết này?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-rose-500 hover:text-rose-600 text-xl"
                                        title="Xóa">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
                                </div>
                            </td>
                            <td class="p-3 text-center text-gray-700">{{ $item->id ?? 'N/A' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-6 text-center">
            {{ $list->links() }}
        </div>
    </div>
</x-layout-admin>
