@extends('layouts.app')

@section('title', 'پنل تنظیمات قدرتمند سوپر ادمین | زرین بوت (ZarinBot)')

@section('content')
<div style="max-width: 900px; margin: 0 auto;">
    <h1 style="color: var(--accent-blue); font-size: 2rem; margin-bottom: 25px;">⚙️ پنل تنظیمات قدرتمند سوپر ادمین زرین بوت</h1>

    <!-- کارت ویرایش کپی‌رایت پانویس -->
    <div style="background: var(--card-bg); border: 1px solid var(--border-color); border-radius: 16px; padding: 30px; margin-bottom: 25px;">
        <h3 style="color: var(--accent-green); margin-top: 0;">📝 ۱. ویرایش متن کپی‌رایت داینامیک پانویس (HTML)</h3>
        <p style="color: var(--text-muted); font-size: 0.95rem;">متن پانویس تمامی صفحات به صورت زنده بر اساس مقدار این کادر تغییر می‌کند:</p>

        <form id="copyrightForm" onsubmit="saveCopyright(event)">
            <div style="margin-bottom: 20px;">
                <textarea id="copyrightHtml" rows="3" style="width: 100%; padding: 15px; background: #090d16; border: 1px solid var(--border-color); border-radius: 8px; color: white; font-family: Tahoma; font-size: 1rem; box-sizing: border-box;">{{ \App\Models\GlobalSystemSetting::first()?->footer_copyright_html ?? '© تمامی حقوق برای زرین بات محفوظ می باشد. | احسان نادری پناه - 09024561001' }}</textarea>
            </div>
            <button type="submit" style="background: var(--primary-gradient); color: white; border: none; padding: 12px 25px; border-radius: 8px; font-weight: bold; cursor: pointer;">
                ذخیره تغییرات پانویس
            </button>
            <span id="saveMsg" style="margin-right: 15px; color: var(--accent-green); font-weight: bold; display: none;">✅ ذخیره شد!</span>
        </form>
    </div>

    <!-- کارت تنظیمات ری‌برندینگ و آنتی‌فیلتر -->
    <div style="background: var(--card-bg); border: 1px solid var(--border-color); border-radius: 16px; padding: 30px;">
        <h3 style="color: var(--accent-blue); margin-top: 0;">🛡️ ۲. پیکربندی موتور رفع فیلترینگ و نودهای آلمان</h3>
        <p style="color: var(--text-muted); font-size: 0.95rem;">مدیریت آی‌پی‌های تمیز کلودفلر DoH و نودهای سرور اختصاصی Hetzner جهت اتصال بدون VPN کاربران در ایران.</p>
        
        <ul style="list-style: none; padding: 0;">
            <li style="padding: 10px; background: #090d16; border-radius: 6px; margin-bottom: 8px; display: flex; justify-content: space-between;">
                <span>Cloudflare DoH Endpoint:</span>
                <code style="color: var(--accent-blue);">https://1.1.1.1/dns-query</code>
            </li>
            <li style="padding: 10px; background: #090d16; border-radius: 6px; margin-bottom: 8px; display: flex; justify-content: space-between;">
                <span>نود سرور آلمان (Clean IP):</span>
                <code style="color: var(--accent-green);">185.220.101.42</code>
            </li>
        </ul>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function saveCopyright(e) {
        e.preventDefault();
        const htmlVal = document.getElementById('copyrightHtml').value;
        
        fetch('/api/settings/copyright', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ footer_copyright_html: htmlVal })
        })
        .then(res => res.json())
        .then(data => {
            const msg = document.getElementById('saveMsg');
            msg.style.display = 'inline';
            setTimeout(() => {
                location.reload();
            }, 800);
        });
    }
</script>
@endsection
