<x-layout-admin>
    <div class="content-wrapper">
        <!-- Header Section -->
        <div class="bg-red-100 mb-6 rounded-lg py-3 px-6 shadow-md">
            <div class="flex items-center justify-between">
                <h2 class="text-2xl font-semibold text-red-700">Thùng rác - Quản lý Contact</h2>
                <a href="{{ route('contact.index') }}" class="bg-gray-500 px-3 py-2 rounded-xl text-white hover:bg-gray-600">
                    <i class="fa fa-arrow-left"></i> Về danh sách
                </a>
            </div>
        </div>

        <!-- Table Section -->
        <div class="bg-white rounded-lg shadow-lg p-6 overflow-x-auto">
            <table class="min-w-full table-auto border-collapse">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="p-4 text-center text-sm font-semibold text-gray-700">Tên</th>
                        <th class="p-4 text-center text-sm font-semibold text-gray-700">Email</th>
                        <th class="p-4 text-center text-sm font-semibold text-gray-700">Số ĐT</th>
                        <th class="p-4 text-center text-sm font-semibold text-gray-700">Tiêu đề</th>
                        <th class="p-4 text-center text-sm font-semibold text-gray-700">Nội dung</th>
                        <th class="p-4 text-center text-sm font-semibold text-gray-700">Chức năng</th>
                        <th class="p-4 text-center text-sm font-semibold text-gray-700">ID</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($list as $item)
                    <tr class="text-center hover:bg-gray-100 transition-all duration-300 border-b">
                        <td class="p-4 text-sm text-gray-800">{{ $item->name }}</td>
                        <td class="p-4 text-sm text-gray-800">{{ $item->email }}</td>
                        <td class="p-4 text-sm text-gray-800">{{ $item->phone }}</td>
                        <td class="p-4 text-sm text-gray-800">{{ $item->title }}</td>
                        <td class="p-4 text-sm text-gray-800">{{ Str::limit($item->content, 50) }}</td>
                        <td class="p-4 text-sm flex justify-center space-x-2">
                            <a href="{{ route('contact.restore', $item->id) }}"
                               class="bg-blue-500 text-white px-2 py-1 rounded hover:bg-blue-600">
                                <i class="fa fa-undo"></i> Khôi phục
                            </a>

                               <form action="{{ route('contact.delete', $item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">Xóa vĩnh viễn</button>
                                </form>
                        </td>
                        <td class="p-4 text-sm text-gray-800">{{ $item->id }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-6">{{ $list->links() }}</div>
</x-layout-admin>
