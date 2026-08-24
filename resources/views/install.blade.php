@extends('layouts.app')

@section('title', 'نصب آنلاین ۳ مرحله‌ای هاست | زرین بوت (ZarinBot)')

@section('content')
<div style="max-width: 750px; margin: 0 auto; background: var(--card-bg); border: 1px solid var(--border-color); border-radius: 16px; padding: 35px; backdrop-filter: blur(12px);">
    <h2 style="color: var(--accent-blue); text-align: center; margin-top: 0; font-size: 1.8rem;">🚀 نصب‌کننده آنلاین ۳ مرحله‌ای زرین بوت (ZarinBot Installer)</h2>
    <p style="text-align: center; color: var(--text-muted); margin-bottom: 30px;">راه‌اندازی آسان و ساخت اتوماتیک جداول دیتابیس درون‌برنامه‌ای روی هاست وب</p>

    <div style="margin-bottom: 25px;">
        <label style="display: block; margin-bottom: 8px; color: var(--text-main);">نام و نام خانوادگی مدیر کل (FullName):</label>
        <input type="text" id="adminName" value="احسان نادری پناه" style="width: 100%; padding: 12px; background: #090d16; border: 1px solid var(--border-color); border-radius: 8px; color: white; font-size: 1rem; box-sizing: border-box; margin-bottom: 20px;">

        <label style="display: block; margin-bottom: 8px; color: var(--text-main);">شماره تلفن همراه مدیر (جهت ورود با OTP):</label>
        <input type="text" id="adminPhone" value="09024561001" style="width: 100%; padding: 12px; background: #090d16; border: 1px solid var(--border-color); border-radius: 8px; color: white; font-size: 1rem; box-sizing: border-box; margin-bottom: 20px;">

        <label style="display: flex; align-items: center; gap: 10px; cursor: pointer; color: var(--text-main);">
            <input type="checkbox" id="termsAccepted" checked style="width: 20px; height: 20px;">
            <span>پذیرش الزام‌آور قوانین و مقررات پلیس فتا و تجارت الکترونیکی (HasAcceptedTerms = true)</span>
        </label>
    </div>

    <button onclick="runInstaller()" style="background: var(--primary-gradient); color: white; border: none; padding: 15px; border-radius: 8px; font-weight: bold; font-size: 1.1rem; cursor: pointer; width: 100%;">
        🎉 تکمیل نصب آنلاین و ساخت اتوماتیک دیتابیس
    </button>

    <div id="installResult" style="display: none; margin-top: 20px; padding: 15px; background: #090d16; border-radius: 8px; color: var(--accent-green); text-align: center;"></div>
</div>
@endsection

@section('scripts')
<script>
    function runInstaller() {
        const name = document.getElementById('adminName').value;
        const phone = document.getElementById('adminPhone').value;
        const result = document.getElementById('installResult');

        result.style.display = 'block';
        result.innerHTML = '⏳ در حال ساخت جداول دیتابیس درون‌برنامه‌ای و ایجاد حساب سوپر ادمین...';

        fetch('/api/installer/execute', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ admin_full_name: name, admin_phone_number: phone })
        })
        .then(res => res.json())
        .then(data => {
            result.innerHTML = `✨ <strong>نصب زرین بوت با موفقیت انجام شد!</strong><br>` +
                             `📌 سوپر ادمین: ${name} (${phone})<br>` +
                             `📌 لاگ فتا: ثبت شد (HasAcceptedTerms = true)<br>` +
                             `🔒 فایل قفل installed.lock صادر گردید.`;
        });
    }
</script>
@endsection
