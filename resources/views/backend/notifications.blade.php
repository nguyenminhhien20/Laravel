<script>
    @if(session('success'))
        toastr.success("{{ session('success') }}", "🎉 Thành công");
    @endif

    @if(session('info'))
        toastr.info("{{ session('info') }}", "ℹ️ Thông báo");
    @endif

    @if(session('warning'))
        toastr.warning("{{ session('warning') }}", "⚠️ Cảnh báo");
    @endif

    @if(session('error'))
        toastr.error("{{ session('error') }}", "❌ Lỗi");
    @endif
</script>
