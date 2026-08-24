<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>نصب‌کننده آنلاین ۴ مرحله‌ای زرین بوت (WordPress-Style Installer)</title>
    <style>
        :root {
            --primary: #ff2d20;
            --primary-gradient: linear-gradient(135deg, #ff2d20 0%, #833ab4 50%, #f77737 100%);
            --bg: #0f172a;
            --card-bg: #1e293b;
            --border: #334155;
            --text: #f8fafc;
            --text-muted: #94a3b8;
            --green: #10b981;
            --blue: #38bdf8;
        }

        body {
            font-family: Tahoma, 'Vazirmatn', sans-serif;
            background-color: var(--bg);
            color: var(--text);
            margin: 0;
            padding: 0;
            direction: rtl;
            line-height: 1.8;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .installer-card {
            background: var(--card-bg);
            border: 1px solid var(--border);
            border-radius: 20px;
            padding: 40px;
            width: 100%;
            max-width: 800px;
            box-shadow: 0 20px 50px rgba(0,0,0,0.5);
            margin: 20px;
            box-sizing: border-box;
        }

        .installer-header {
            text-align: center;
            margin-bottom: 35px;
        }

        .installer-header h1 {
            margin: 0;
            font-size: 2.2rem;
            background: var(--primary-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .steps-bar {
            display: flex;
            justify-content: space-between;
            margin-bottom: 35px;
            position: relative;
        }

        .steps-bar::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 2px;
            background: var(--border);
            z-index: 1;
        }

        .step-node {
            position: relative;
            z-index: 2;
            background: var(--card-bg);
            border: 2px solid var(--border);
            color: var(--text-muted);
            width: 45px;
            height: 45px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 1.1rem;
        }

        .step-node.active {
            border-color: var(--blue);
            background: var(--primary);
            color: white;
        }

        .step-node.completed {
            border-color: var(--green);
            background: var(--green);
            color: white;
        }

        .btn {
            background: var(--primary-gradient);
            color: white;
            border: none;
            padding: 14px 28px;
            border-radius: 10px;
            font-size: 1.05rem;
            cursor: pointer;
            font-weight: bold;
            width: 100%;
            margin-top: 25px;
            transition: opacity 0.2s;
        }

        .btn:hover { opacity: 0.9; }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: var(--text);
            font-size: 0.95rem;
        }

        .form-group input, .form-group select, .form-group textarea {
            width: 100%;
            padding: 12px;
            background: #090d16;
            border: 1px solid var(--border);
            border-radius: 8px;
            color: white;
            font-size: 1rem;
            box-sizing: border-box;
            font-family: Tahoma, sans-serif;
        }

        .check-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .check-list li {
            padding: 12px 16px;
            background: #090d16;
            border: 1px solid var(--border);
            border-radius: 8px;
            margin-bottom: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .badge-green { color: var(--green); font-weight: bold; }
        .badge-red { color: #ef4444; font-weight: bold; }
    </style>
</head>
<body>

    <div class="installer-card">
        <div class="installer-header">
            <h1>🚀 راهنمای نصب آنلاین زرین بوت (ZarinBot Installer)</h1>
            <p style="color: var(--text-muted); margin-top: 8px;">راه‌اندازی آسان و خودکار روی هرگونه دامنه، زیردامنه یا ساب‌فولدر</p>
        </div>

        <div class="steps-bar">
            <div class="step-node active" id="node1">۱</div>
            <div class="step-node" id="node2">۲</div>
            <div class="step-node" id="node3">۳</div>
            <div class="step-node" id="node4">۴</div>
        </div>

        <!-- گام ۱: پیش‌نیازها -->
        <div id="step1">
            <h3 style="color: var(--blue); margin-top: 0;">گام ۱: بررسی هوشمند پیش‌نیازهای سرور و هاست</h3>
            <ul class="check-list">
                <li>
                    <span>نسخه PHP (8.2 یا بالاتر)</span>
                    <span class="badge-green">✅ {{ PHP_VERSION }}</span>
                </li>
                <li>
                    <span>افزونه PDO & SQLite / MySQL</span>
                    <span class="badge-green">✅ فعال</span>
                </li>
                <li>
                    <span>افزونه cURL (جهت DoH کلودفلر)</span>
                    <span class="badge-green">✅ فعال</span>
                </li>
                <li>
                    <span>دسترسی نوشتن فایل‌ها (Storage Writable)</span>
                    <span class="badge-green">✅ مجاز</span>
                </li>
            </ul>
            <button class="btn" onclick="nextStep(2)">تایید و ورود به گام دیتابیس ➔</button>
        </div>

        <!-- گام ۲: دیتابیس -->
        <div id="step2" style="display: none;">
            <h3 style="color: var(--blue); margin-top: 0;">گام ۲: پیکربندی دیتابیس</h3>
            <div class="form-group">
                <label>نوع دیتابیس:</label>
                <select id="dbDriver" onchange="toggleDbFields()">
                    <option value="sqlite">دیتابیس درون‌برنامه‌ای SQLite (بدون نیاز به ساخت دیتابیس)</option>
                    <option value="mysql">دیتابیس MySQL / MariaDB / cPanel</option>
                </select>
            </div>

            <div id="mysqlFields" style="display: none;">
                <div class="form-group">
                    <label>آدرس سرور دیتابیس (Host):</label>
                    <input type="text" id="dbHost" value="127.0.0.1">
                </div>
                <div class="form-group">
                    <label>نام دیتابیس (Database Name):</label>
                    <input type="text" id="dbName" value="zarinbot_db">
                </div>
                <div class="form-group">
                    <label>نام کاربری (Username):</label>
                    <input type="text" id="dbUser" value="root">
                </div>
                <div class="form-group">
                    <label>کلمه عبور (Password):</label>
                    <input type="password" id="dbPass">
                </div>
            </div>

            <button type="button" style="background: #334155; color: white; border: none; padding: 10px; border-radius: 6px; cursor: pointer; width: 100%; margin-bottom: 10px;" onclick="testDb()">🧪 تست زنده اتصال دیتابیس</button>
            <div id="dbTestResult" style="display: none; padding: 10px; border-radius: 6px; margin-bottom: 10px; font-size: 0.9rem;"></div>

            <button class="btn" onclick="nextStep(3)">تایید دیتابیس و ادامه ➔</button>
        </div>

        <!-- گام ۳: سوپر ادمین و کپی‌رایت -->
        <div id="step3" style="display: none;">
            <h3 style="color: var(--blue); margin-top: 0;">گام ۳: ساخت حساب سوپر ادمین و تنظیم پانویس سایت</h3>
            
            <div class="form-group">
                <label>نام و نام خانوادگی سوپر ادمین (FullName):</label>
                <input type="text" id="adminName" value="احسان نادری پناه">
            </div>

            <div class="form-group">
                <label>شماره تلفن همراه مدیر (جهت ورود با کد پیامک):</label>
                <input type="text" id="adminPhone" value="09024561001">
            </div>

            <div class="form-group">
                <label>متن کپی‌رایت داینامیک پانویس سایت (HTML):</label>
                <textarea id="footerCopyright" rows="2">© تمامی حقوق برای زرین بات محفوظ می باشد. | احسان نادری پناه - 09024561001</textarea>
            </div>

            <div class="form-group">
                <label style="display: flex; align-items: center; gap: 10px; cursor: pointer;">
                    <input type="checkbox" id="fataCheck" checked style="width: 20px; height: 20px;">
                    <span>پذیرش الزامی قوانین و مقررات پلیس فتا و تجارت الکترونیکی (HasAcceptedTerms = true)</span>
                </label>
            </div>

            <button class="btn" onclick="nextStep(4)">اجرای نهایی نصب ➔</button>
        </div>

        <!-- گام ۴: نتیجه و تکمیل -->
        <div id="step4" style="display: none; text-align: center;">
            <h3 style="color: var(--green); margin-top: 0;">گام ۴: تکمیل نهایی و راه اندازی سامانه</h3>
            <div id="setupLog" style="padding: 20px; background: #090d16; border-radius: 10px; color: var(--green); font-size: 1rem; margin-bottom: 20px;">
                ⏳ در حال ساخت جداول دیتابیس و اعطای لایسنس...
            </div>
            <button class="btn" id="finishBtn" style="display: none; background: var(--green);" onclick="finishSetup()">🎉 ورود به وب‌سایت زرین بوت</button>
        </div>

    </div>

    <script>
        let currentStep = 1;

        function toggleDbFields() {
            const driver = document.getElementById('dbDriver').value;
            document.getElementById('mysqlFields').style.display = driver === 'mysql' ? 'block' : 'none';
        }

        function testDb() {
            const driver = document.getElementById('dbDriver').value;
            const result = document.getElementById('dbTestResult');
            result.style.display = 'block';
            result.style.background = '#090d16';
            result.innerText = '⏳ در حال تست اتصال...';

            fetch('/api/installer/test-db', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({
                    db_driver: driver,
                    db_host: document.getElementById('dbHost')?.value,
                    db_name: document.getElementById('dbName')?.value,
                    db_user: document.getElementById('dbUser')?.value,
                    db_pass: document.getElementById('dbPass')?.value
                })
            })
            .then(res => res.json())
            .then(data => {
                if (data.status === 'success') {
                    result.style.color = '#10b981';
                    result.innerText = data.message;
                } else {
                    result.style.color = '#ef4444';
                    result.innerText = data.message;
                }
            })
            .catch(err => {
                result.style.color = '#ef4444';
                result.innerText = '❌ خطا در برقراری ارتباط با سرور';
            });
        }

        function nextStep(step) {
            document.getElementById('step' + currentStep).style.display = 'none';
            document.getElementById('node' + currentStep).className = 'step-node completed';

            currentStep = step;
            document.getElementById('step' + currentStep).style.display = 'block';
            document.getElementById('node' + currentStep).className = 'step-node active';

            if (step === 4) {
                runSetup();
            }
        }

        function runSetup() {
            fetch('/api/installer/execute', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({
                    admin_full_name: document.getElementById('adminName').value,
                    admin_phone_number: document.getElementById('adminPhone').value,
                    footer_copyright_html: document.getElementById('footerCopyright').value
                })
            })
            .then(res => res.json())
            .then(data => {
                const log = document.getElementById('setupLog');
                if (data.status === 'success') {
                    log.innerHTML = `✨ <strong>نصب پلتفرم زرین بوت با موفقیت تکمیل شد!</strong><br><br>` +
                                    `📌 سوپر ادمین: ${document.getElementById('adminName').value}<br>` +
                                    `📌 لاگ فتا: ثبت گردید (HasAcceptedTerms = true)<br>` +
                                    `🔒 فایل installed.lock صادر شد.`;
                    document.getElementById('finishBtn').style.display = 'block';
                } else {
                    log.style.color = '#ef4444';
                    log.innerText = '❌ خطا در نصب: ' + data.message;
                }
            });
        }

        function finishSetup() {
            window.location.href = '/';
        }
    </script>
</body>
</html>
