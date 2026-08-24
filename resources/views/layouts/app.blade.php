<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'زرین بوت (ZarinBot) - پلتفرم هوشمند اتوماسیون اینستاگرام و واتساپ')</title>
    
    <meta name="description" content="@yield('meta_description', 'زرین بوت (ZarinBot) - پلتفرم هوشمند اتوماسیون، هوش مصنوعی، بازاریابی اینستاگرام و واتساپ و رفع فیلترینگ بدون نیاز به VPN')" />
    <meta name="keywords" content="زرین بوت, اتوماسیون اینستاگرام, تبلیغات واتساپ, رفع فیلترینگ, هوش مصنوعی, ZarinBot" />
    <meta name="author" content="احسان نادری پناه" />

    <!-- Open Graph Metas -->
    <meta property="og:title" content="@yield('title', 'زرین بوت (ZarinBot)')" />
    <meta property="og:description" content="@yield('meta_description', 'زرین بوت پلتفرم جامع اتوماسیون اینستاگرام و واتساپ با سرویس آنتی‌فیلتر بدون VPN')" />
    <meta property="og:type" content="website" />
    <meta property="og:site_name" content="زرین بوت (ZarinBot)" />

    <!-- JSON-LD Schema.org -->
    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "SoftwareApplication",
            "name": "زرین بوت (ZarinBot)",
            "applicationCategory": "BusinessApplication",
            "operatingSystem": "Web, Windows, Android, iOS",
            "offers": {
                "@type": "Offer",
                "price": "490000",
                "priceCurrency": "IRT"
            },
            "author": {
                "@type": "Person",
                "name": "احسان نادری پناه",
                "telephone": "09024561001"
            }
        }
    </script>

    <style>
        :root {
            --primary: #833ab4;
            --primary-gradient: linear-gradient(135deg, #833ab4 0%, #fd1d1d 50%, #f77737 100%);
            --bg-dark: #0f172a;
            --card-bg: rgba(30, 41, 59, 0.7);
            --border-color: rgba(51, 65, 85, 0.8);
            --text-main: #f8fafc;
            --text-muted: #94a3b8;
            --accent-green: #10b981;
            --accent-blue: #38bdf8;
        }

        body {
            font-family: 'IRANSans', 'Vazirmatn', Tahoma, sans-serif;
            background-color: var(--bg-dark);
            color: var(--text-main);
            margin: 0;
            padding: 0;
            direction: rtl;
            line-height: 1.8;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .navbar {
            background: rgba(15, 23, 42, 0.9);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid var(--border-color);
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .navbar-brand {
            font-size: 1.5rem;
            font-weight: 800;
            background: var(--primary-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            text-decoration: none;
        }

        .nav-links {
            display: flex;
            gap: 20px;
            align-items: center;
        }

        .nav-links a {
            color: var(--text-main);
            text-decoration: none;
            font-size: 0.95rem;
            transition: color 0.2s;
        }

        .nav-links a:hover {
            color: var(--accent-blue);
        }

        .badge-status {
            background: rgba(16, 185, 129, 0.15);
            color: var(--accent-green);
            border: 1px solid var(--accent-green);
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.85rem;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .main-content {
            flex: 1;
            padding: 30px 20px;
            max-width: 1200px;
            margin: 0 auto;
            width: 100%;
            box-sizing: border-box;
        }

        .footer {
            background: #090d16;
            border-top: 1px solid var(--border-color);
            padding: 25px 20px;
            text-align: center;
            color: var(--text-muted);
            font-size: 0.95rem;
            margin-top: auto;
        }

        .footer-custom-content {
            color: #e2e8f0;
            font-weight: 500;
        }
    </style>
    @yield('styles')
</head>
<body>

    <nav class="navbar">
        <a href="/" class="navbar-brand">🚀 زرین بوت (ZarinBot)</a>
        <div class="nav-links">
            <a href="/demo">داشبورد دمو</a>
            <a href="/admin/settings">پنل مدیریت</a>
            <a href="/install">نصب هاست</a>
            <div class="badge-status">
                <span style="width: 8px; height: 8px; background: var(--accent-green); border-radius: 50%; display: inline-block;"></span>
                موتور آنتی‌فیلتر: فعال
            </div>
        </div>
    </nav>

    <main class="main-content">
        @yield('content')
    </main>

    <footer class="footer">
        <div class="footer-custom-content">
            {!! \App\Models\GlobalSystemSetting::first()?->footer_copyright_html ?? '© تمامی حقوق برای زرین بات محفوظ می باشد. | احسان نادری پناه - 09024561001' !!}
        </div>
    </footer>

    @yield('scripts')
</body>
</html>
