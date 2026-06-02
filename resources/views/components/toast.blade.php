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
<style>
    .toast {
        font-family: 'Inter', sans-serif;
        font-size: 14px;
        border-radius: 10px !important;
        box-shadow: 0 8px 20px rgba(0,0,0,0.15);
    }

    .toast-success {
        background-color: #22c55e !important;
    }

    .toast-info {
        background-color: #3b82f6 !important;
    }

    .toast-warning {
        background-color: #facc15 !important;
        color: #000 !important;
    }

    .toast-error {
        background-color: #ef4444 !important;
    }
</style>
