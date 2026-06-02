<x-layout-admin>
    <div class="content-wrapper">
        <!-- Header -->
        <div class="bg-white border border-blue-200 rounded-xl shadow px-6 py-4 mb-6">
            <div class="flex items-center justify-between">
                <h2 class="text-2xl font-bold text-blue-600">🗑️ Thùng Rác Bài Viết</h2>
                <a href="{{ route('post.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg transition">
                    <i class="fa fa-arrow-left mr-1"></i> Về danh sách
                </a>
            </div>
        </div>

        <!-- Flash messages -->
        @if(session('success'))
            <div class="mb-4 px-4 py-3 rounded-lg bg-green-100 text-green-800 shadow">
                {{ session('success') }}
            </div>
        @elseif(session('error'))
            <div class="mb-4 px-4 py-3 rounded-lg bg-red-100 text-red-800 shadow">
                {{ session('error') }}
            </div>
        @endif

        <!-- Table -->
        <div class="bg-white border border-blue-200 rounded-xl shadow p-6 overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-blue-100">
                    <tr>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Hình ảnh</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Tiêu Đề</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Chi Tiết</th>
                        <th class="px-4 py-3 text-center text-sm font-semibold text-gray-700">Chức Năng</th>
                        <th class="px-4 py-3 text-center text-sm font-semibold text-gray-700">ID</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100">
                    @foreach ($list as $item)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-4 py-3">
                                <img src="{{ asset('assets/images/post/' . $item->thumbnail) }}"
                                     alt="{{ $item->thumbnail }}"
                                     class="w-16 h-16 object-cover rounded-lg shadow-sm mx-auto">
                            </td>
                            <td class="px-4 py-3 text-sm text-gray-800">{{ $item->title }}</td>
                            <td class="px-4 py-3 text-sm text-gray-700 max-w-sm truncate">
                                {{ Str::limit($item->detail, 100) }}
                            </td>
                            <td class="px-4 py-3 text-center">
                                <a href="{{ route('post.restore', ['post' => $item->id]) }}"
                                   class="inline-flex items-center justify-center text-green-600 hover:text-green-800 transition">
                                    <i class="fa fa-undo mr-1"></i> Khôi phục
                                </a>
                                <form action="{{ route('post.delete', $item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">Xóa vĩnh viễn</button>
                                </form>
                            </td>
                            <td class="px-4 py-3 text-center text-sm text-gray-700">{{ $item->id }}</td>
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
