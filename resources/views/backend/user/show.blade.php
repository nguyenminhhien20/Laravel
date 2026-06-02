<x-layout-admin>
    <div class="content-wrapper">
        <div class="border border-blue-100 mb-3 rounded-lg p-2">
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-bold text-blue-600">Thông tin người dùng</h2>
                <a href="{{ route('user.index') }}" class="bg-gray-500 px-2 py-2 rounded-xl mx-1 text-white">
                    <i class="fa fa-arrow-left" aria-hidden="true"></i> Về danh sách
                </a>
            </div>
        </div>

        <div class="border border-blue-100 rounded-lg p-3">
            <div class="mb-3">
                <strong>Tên:</strong> {{ $user->name }}
            </div>
            <div class="mb-3">
                <strong>Email:</strong> {{ $user->email }}
            </div>
            <div class="mb-3">
                <strong>Số điện thoại:</strong> {{ $user->phone }}
            </div>
            <div class="mb-3">
                <strong>Địa chỉ:</strong> {{ $user->address }}
            </div>
            <div class="mb-3">
                <strong>Tên người dùng:</strong> {{ $user->username }}
            </div>
            <div class="mb-3">
                <strong>Trạng thái:</strong> {{ $user->status == 1 ? 'Xuất bản' : 'Không xuất bản' }}
            </div>
            <div class="mb-3">
                <strong>Avatar:</strong>
                @if ($user->avatar && $user->avatar != 'default.jpg')
                    <img src="{{ asset('assets/images/user/' . $user->avatar) }}" alt="Avatar" class="w-24 h-24 object-cover rounded-lg">
                @else
                    <span>Không có avatar</span>
                @endif
            </div>
        </div>
    </div>
</x-layout-admin>
