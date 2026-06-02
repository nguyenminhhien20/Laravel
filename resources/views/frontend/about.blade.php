<!DOCTYPE html>
<html lang="vi" class="scroll-smooth">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Giới Thiệu - TyuuMei</title>
  <meta name="description" content="Khám phá hành trình và sứ mệnh của TyuuMei - thương hiệu giày dép Việt Nam chất lượng và tinh tế." />
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white text-gray-800 font-sans leading-relaxed">

     <header class="bg-white shadow-md px-6">
        <div class="flex justify-between items-center py-4 w-full">
            <!-- Logo + Brand -->
             <a href="{{ route('site.home') }}">
               <img src="build/assets/images/logo1.jpg" alt="Logo" class="h-12 w-12 rounded-full object-cover">
            </a>
            <span class="text-2xl font-extrabold text-gray-600">
                Tyuu<span class="text-rose-500">Mei</span>
            </span>
                <!-- MainMenu -->
                <x-main-menu />
    </header>

  <main class="max-w-7xl mx-auto px-6 pt-36 pb-24 space-y-32">

    <!-- Giới thiệu tổng quan + Lịch sử hình thành -->
    <section class="space-y-32">
      <div class="md:flex md:items-center md:gap-16">
        <div class="md:w-1/2">
          <h2 class="text-4xl font-bold border-l-8 border-rose-500 pl-6 mb-8 text-gray-900 drop-shadow">Giới thiệu tổng quan</h2>
          <p class="mb-6 text-lg text-gray-700">
            TyuuMei là thương hiệu giày dép Việt Nam được thành lập từ năm 2020, với sứ mệnh mang đến những sản phẩm vừa đẹp mắt, vừa thoải mái, phục vụ mọi đối tượng khách hàng hiện đại.
          </p>
          <p class="text-lg text-gray-700">
            Chúng tôi tự hào tạo ra các mẫu giày thời thượng, đa dạng phong cách, phù hợp cho mọi lứa tuổi và nhu cầu sử dụng.
          </p>
        </div>
        <img src="build/assets/images/logo1.jpg" alt="Giới thiệu TyuuMei"
             class="md:w-1/2 rounded-3xl shadow-lg object-cover h-[400px] w-full mt-10 md:mt-0 hover:scale-105 transition-transform duration-500" loading="lazy" />
      </div>

      <div class="md:flex md:items-center md:gap-16 md:flex-row-reverse">
        <div class="md:w-1/2">
          <h2 class="text-4xl font-bold border-l-8 border-rose-500 pl-6 mb-8 text-gray-900 drop-shadow">Lịch sử hình thành</h2>
          <p class="mb-6 text-lg text-gray-700">
            Khởi nguồn từ một nhóm đam mê thiết kế giày dép trẻ trung và cá tính, TyuuMei đã từng bước phát triển từ cửa hàng nhỏ tại Hà Nội đến thương hiệu được yêu thích trên toàn quốc.
          </p>
          <p class="text-lg text-gray-700">
            Qua hơn 8 năm, chúng tôi không ngừng đổi mới, cập nhật xu hướng, xây dựng niềm tin với khách hàng dựa trên chất lượng và dịch vụ.
          </p>
        </div>
        <img src="build/assets/images/banner33.jpg" alt="Lịch sử TyuuMei"
             class="md:w-1/2 rounded-3xl shadow-lg object-cover h-[400px] w-full mt-10 md:mt-0 hover:scale-105 transition-transform duration-500" loading="lazy" />
      </div>
    </section>

    <!-- Giá trị cốt lõi -->
    <section class="text-center space-y-12">
      <h2 class="text-4xl font-bold border-l-8 border-rose-500 pl-6 mb-10 text-gray-900 drop-shadow inline-block">Giá trị cốt lõi</h2>
      <div class="grid md:grid-cols-2 gap-6 max-w-4xl mx-auto text-left">
        <ul class="space-y-4 text-lg text-gray-700">
          <li><strong class="text-rose-600">Chất lượng:</strong> Cam kết sản phẩm bền đẹp, sử dụng nguyên vật liệu chọn lọc kỹ lưỡng.</li>
          <li><strong class="text-rose-600">Phong cách:</strong> Thiết kế đa dạng, phù hợp nhiều phong cách thời trang và cá tính.</li>
          <li><strong class="text-rose-600">Khách hàng:</strong> Luôn đặt trải nghiệm và sự hài lòng của khách hàng lên hàng đầu.</li>
        </ul>
        <ul class="space-y-4 text-lg text-gray-700">
          <li><strong class="text-rose-600">Đổi mới:</strong> Liên tục cập nhật xu hướng và cải tiến công nghệ sản xuất.</li>
          <li><strong class="text-rose-600">Trách nhiệm:</strong> Tôn trọng đạo đức kinh doanh và bảo vệ môi trường.</li>
        </ul>
      </div>
    </section>

    <!-- Quy trình sản xuất -->
    <section class="md:flex md:gap-16 md:items-center space-y-12 md:space-y-0">
      <div class="md:w-1/2">
        <h2 class="text-4xl font-bold border-l-8 border-rose-500 pl-6 mb-6 text-gray-900 drop-shadow">Quy trình sản xuất</h2>
        <p class="mb-4 text-lg text-gray-700">
          Mỗi đôi giày TyuuMei được tạo nên từ quy trình sản xuất nghiêm ngặt:
        </p>
        <ul class="list-disc list-inside space-y-3 text-lg text-gray-700">
          <li>Chọn lọc nguyên liệu da thật, vải và phụ kiện cao cấp.</li>
          <li>Thiết kế mẫu phù hợp với xu hướng và nhu cầu thị trường.</li>
          <li>Gia công tỉ mỉ, kiểm tra từng chi tiết.</li>
          <li>Kiểm định chất lượng trước khi giao hàng.</li>
        </ul>
      </div>
      <img src="build/assets/images/banner11.jpg" alt="Quy trình sản xuất TyuuMei"
           class="md:w-1/2 rounded-3xl shadow-lg object-cover h-[420px] w-full hover:scale-105 transition-transform duration-500" loading="lazy" />
    </section>

    <!-- Cam kết chất lượng -->
    <section class="text-center max-w-3xl mx-auto space-y-6">
      <h2 class="text-4xl font-bold border-l-8 border-rose-500 pl-6 inline-block text-gray-900 drop-shadow">Cam kết chất lượng</h2>
      <p class="text-lg text-gray-700">
        TyuuMei cam kết mang đến sản phẩm có độ bền cao, thiết kế vừa vặn, thoải mái và được bảo hành 6 tháng với các lỗi kỹ thuật từ nhà sản xuất.
      </p>
    </section>

    <!-- Đội ngũ nhân sự -->
    <section class="max-w-3xl mx-auto space-y-6">
      <h2 class="text-4xl font-bold border-l-8 border-rose-500 pl-6 text-center text-gray-900 drop-shadow">Đội ngũ nhân sự</h2>
      <p class="text-lg text-center text-gray-700">
        Đội ngũ TyuuMei gồm những người trẻ sáng tạo, tâm huyết và chuyên nghiệp trong lĩnh vực thời trang, thiết kế và sản xuất.
      </p>
      <ul class="list-disc list-inside space-y-4 text-lg text-gray-700">
        <li><strong class="text-rose-600">Ban lãnh đạo:</strong> Định hướng phát triển thương hiệu.</li>
        <li><strong class="text-rose-600">Thiết kế:</strong> Sáng tạo mẫu mã độc đáo, hiện đại.</li>
        <li><strong class="text-rose-600">Sản xuất:</strong> Tỉ mỉ, chất lượng, chú trọng từng chi tiết.</li>
        <li><strong class="text-rose-600">Chăm sóc khách hàng:</strong> Luôn lắng nghe và hỗ trợ tận tình.</li>
      </ul>
    </section>

    <!-- Kế hoạch phát triển tương lai -->
    <section class="text-center max-w-3xl mx-auto space-y-6">
      <h2 class="text-4xl font-bold border-l-8 border-rose-500 pl-6 inline-block text-gray-900 drop-shadow">Kế hoạch phát triển</h2>
      <p class="text-lg text-gray-700">
        Trong tương lai, TyuuMei hướng tới mở rộng chuỗi cửa hàng, đa dạng sản phẩm, áp dụng công nghệ mới và thúc đẩy trách nhiệm cộng đồng.
      </p>
    </section>

    <!-- FAQ -->
    <section class="max-w-4xl mx-auto space-y-10">
      <h2 class="text-4xl font-bold text-center text-rose-600 drop-shadow mb-8">Câu Hỏi Thường Gặp</h2>
      <details class="bg-rose-50 rounded-2xl p-6 border border-rose-300 shadow hover:shadow-md">
        <summary class="font-semibold cursor-pointer hover:text-rose-700">Có thể đổi trả sản phẩm không?</summary>
        <p class="mt-3 text-gray-800">Có. TyuuMei hỗ trợ đổi trả trong 7 ngày nếu sản phẩm còn nguyên tem mác và chưa qua sử dụng.</p>
      </details>
      <details class="bg-rose-50 rounded-2xl p-6 border border-rose-300 shadow hover:shadow-md">
        <summary class="font-semibold cursor-pointer hover:text-rose-700">Thời gian giao hàng bao lâu?</summary>
        <p class="mt-3 text-gray-800">Từ 2–5 ngày làm việc tùy khu vực.</p>
      </details>
      <details class="bg-rose-50 rounded-2xl p-6 border border-rose-300 shadow hover:shadow-md">
        <summary class="font-semibold cursor-pointer hover:text-rose-700">TyuuMei có cửa hàng không?</summary>
        <p class="mt-3 text-gray-800">Hiện tại chúng tôi bán hàng online. Dự kiến mở showroom trong tương lai.</p>
      </details>
      <details class="bg-rose-50 rounded-2xl p-6 border border-rose-300 shadow hover:shadow-md">
        <summary class="font-semibold cursor-pointer hover:text-rose-700">Làm sao để đặt hàng?</summary>
        <p class="mt-3 text-gray-800">Chọn sản phẩm trên website và làm theo hướng dẫn thanh toán.</p>
      </details>
    </section>

  </main>

  <footer class="bg-gray-100 mt-32 py-8 text-center text-sm text-gray-600 border-t">
    <p class="mb-2">&copy; 2025 TyuuMei. Bản quyền được bảo lưu.</p>
    <p>Hotline: <a href="tel:0123456789" class="hover:underline">0123 456 789</a> &bull;
      Email: <a href="mailto:support@tyuumei.vn" class="hover:underline">support@tyuumei.vn</a></p>
  </footer>

</body>
</html>
