<x-layout-admin>
    <div class="content-wrapper">
        <!-- Tiêu đề và quay lại -->
        <div class="border border-blue-100 mb-3 rounded-lg p-2">
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-bold text-blue-600">CHI TIẾT LIÊN HỆ</h2>
                <a href="{{ route('contact.index') }}" class="bg-gray-500 px-3 py-2 rounded-xl text-white hover:bg-gray-600">
                    <i class="fa fa-arrow-left"></i> Về danh sách liên hệ
                </a>
            </div>
        </div>

        @if($contact)
        <div class="border border-blue-100 rounded-lg p-3 bg-white">
            <!-- Tên liên hệ -->
            <div class="mb-3">
                <strong>Tên liên hệ:</strong> {{ $contact->name }}
            </div>

            <!-- Email -->
            <div class="mb-3">
                <strong>Email:</strong> {{ $contact->email }}
            </div>

            <!-- Số điện thoại -->
            <div class="mb-3">
                <strong>Số điện thoại:</strong> {{ $contact->phone }}
            </div>

            <!-- Tiêu đề -->
            <div class="mb-3">
                <strong>Tiêu đề:</strong> {{ $contact->title }}
            </div>

            <!-- Nội dung -->
            <div class="mb-3">
                <strong>Nội dung:</strong> {{ $contact->content }}
            </div>

            <!-- Trạng thái -->
            <div class="mb-3">
                <strong>Trạng thái:</strong> {{ $contact->status == 1 ? 'Xuất bản' : 'Không xuất bản' }}
            </div>

            <!-- Thời gian tạo -->
            <div class="mb-3">
                <strong>Ngày tạo:</strong> {{ $contact->created_at->format('d/m/Y H:i') }}
            </div>

            <!-- Thời gian cập nhật -->
            <div class="mb-3">
                <strong>Ngày cập nhật:</strong> {{ $contact->updated_at->format('d/m/Y H:i') }}
            </div>
        </div>
        @else
        <div class="alert alert-danger">
            Liên hệ không tồn tại.
        </div>
        @endif
    </div>
</x-layout-admin>
