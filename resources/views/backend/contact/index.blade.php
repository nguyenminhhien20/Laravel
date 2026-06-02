<x-layout-admin>
    <div class="content-wrapper">
        <!-- Header -->
        <div class="bg-gradient-to-r from-cyan-100 to-blue-100 rounded-2xl p-5 mb-6 shadow flex justify-between items-center">
            <h1 class="text-3xl font-bold text-blue-700 flex items-center gap-3">
                <i class="fa fa-address-book text-blue-600 text-2xl"></i>
                Quản lý Liên hệ
            </h1>
            <div class="flex gap-3">
                <a href="{{ route('contact.create') }}"
                   class="bg-blue-600 text-white px-5 py-2 rounded-xl shadow hover:bg-blue-700 hover:scale-105 transition flex items-center gap-2">
                    <i class="fa fa-plus"></i> Thêm
                </a>
                <a href="{{ route('contact.trash') }}"
                   class="bg-rose-500 text-white px-5 py-2 rounded-xl shadow hover:bg-rose-600 hover:scale-105 transition flex items-center gap-2">
                    <i class="fa fa-trash"></i> Thùng rác
                </a>
            </div>
        </div>

        <!-- Table -->
        <div class="bg-white rounded-2xl shadow p-6 overflow-x-auto">
            <table class="min-w-full table-auto text-sm">
                <thead>
                    <tr class="bg-gray-100 text-gray-700 uppercase text-center">
                        <th class="px-4 py-3">Tên</th>
                        <th class="px-4 py-3">Email</th>
                        <th class="px-4 py-3">SĐT</th>
                        <th class="px-4 py-3">Tiêu đề</th>
                        <th class="px-4 py-3">Nội dung</th>
                        <th class="px-4 py-3">Hành động</th>
                        <th class="px-4 py-3">ID</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($list as $item)
                        <tr class="text-center border-b hover:bg-blue-50 transition">
                            <td class="py-3 px-4 font-medium text-gray-800">{{ $item->name }}</td>
                            <td class="py-3 px-4 text-blue-600 break-words">{{ $item->email }}</td>
                            <td class="py-3 px-4">{{ $item->phone }}</td>
                            <td class="py-3 px-4 text-gray-700">{{ $item->title }}</td>
                            <td class="py-3 px-4 text-gray-600 truncate max-w-xs mx-auto" title="{{ $item->content }}">
                                {{ \Illuminate\Support\Str::limit($item->content, 40) }}
                            </td>
                            <td class="py-3 px-4">
                                <div class="flex justify-center gap-3">
                                    <a href="{{ route('contact.status', ['contact' => $item->id]) }}" title="Trạng thái">
                                        <i class="fa {{ $item->status ? 'fa-toggle-on text-green-500' : 'fa-toggle-off text-red-500' }} text-xl"></i>
                                    </a>
                                    <a href="{{ route('contact.show', ['contact' => $item->id]) }}" class="text-orange-500 hover:text-orange-700" title="Xem">
                                        <i class="fa fa-eye text-xl"></i>
                                    </a>
                                    <a href="{{ route('contact.edit', ['contact' => $item->id]) }}" class="text-blue-500 hover:text-blue-700" title="Sửa">
                                        <i class="fa fa-edit text-xl"></i>
                                    </a>
                                      <form action="{{ route('contact.destroy', ['contact' => $item->id]) }}" method="POST"
                                    class="inline-block"
                                    onsubmit="return confirm('Bạn có chắc chắn muốn xóa Liên hệ này?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-rose-500 hover:text-rose-600 text-xl"
                                        title="Xóa">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
                                </div>
                            </td>
                            <td class="py-3 px-4 text-gray-500">{{ $item->id ?? 'Không có' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-6 text-gray-400 italic">Không có liên hệ nào.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-6">
            {{ $list->links() }}
        </div>
    </div>
</x-layout-admin>
