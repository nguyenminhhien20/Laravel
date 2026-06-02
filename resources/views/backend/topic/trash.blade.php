<x-layout-admin>
    <div class="content-wrapper">
        <!-- Header -->
        <div class="bg-blue-100 mb-6 rounded-xl px-6 py-4 shadow flex items-center justify-between">
            <h2 class="text-2xl font-bold text-blue-700">🗑️ Thùng rác - Topic</h2>
            <a href="{{ route('topic.index') }}"
               class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-xl flex items-center gap-2 shadow transition">
                <i class="fa fa-arrow-left"></i> Về danh sách
            </a>
        </div>

        <!-- Table Section -->
        <div class="bg-white rounded-xl shadow-lg p-6 overflow-x-auto">
            <table class="min-w-full table-auto border-collapse">
                <thead>
                    <tr class="bg-blue-100 text-blue-800 uppercase text-sm font-semibold">
                        <th class="p-4 text-center w-1/4">Tên</th>
                        <th class="p-4 text-center w-2/4">Mô tả</th>
                        <th class="p-4 text-center w-1/6">Chức năng</th>
                        <th class="p-4 text-center w-1/12">ID</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    @foreach ($list as $item)
                        <tr class="text-center hover:bg-gray-50 transition">
                            <td class="p-4 font-medium">{{ $item->name }}</td>
                            <td class="p-4 text-gray-600">{{ Str::limit($item->description, 80) }}</td>
                            <td class="p-4">
                                <div class="flex justify-center items-center gap-4">
                                    <!-- Khôi phục -->
                                    <a href="{{ route('topic.restore', ['topic' => $item->id]) }}"
                                       class="text-green-500 hover:text-green-700 transition" title="Khôi phục">
                                        <i class="fa fa-rotate-left text-xl"></i>
                                    </a>

                                    <!-- Xóa vĩnh viễn -->
                                    <form action="{{ route('topic.delete', $item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">Xóa vĩnh viễn</button>
                                </form>
                                </div>
                            </td>
                            <td class="p-4 text-gray-500">{{ $item->id ?? 'N/A' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-6">
            {{ $list->links() }}
        </div>
    </div>
</x-layout-admin>
