<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', config('app.name'))</title>
    <style>
      :root {
        /* Sourced from resources/css/variables.css */
        --background: oklch(1 0 0);
        --foreground: oklch(0.145 0 0);
        --card: oklch(1 0 0);
        --card-foreground: oklch(0.145 0 0);
        --primary: oklch(0.205 0 0);
        --primary-foreground: oklch(0.985 0 0);
        --muted: oklch(0.97 0 0);
        --muted-foreground: oklch(0.556 0 0);
        --border: oklch(0.922 0 0);
        --font: "General Sans", ui-sans-serif, system-ui, sans-serif;
        --font-weight-regular: 400;
        --font-weight-semibold: 600;
        --radius-lg: 1rem;
      }

      /* Base styles (email-safe fallbacks provided before CSS variables) */
      body {
        margin: 0;
        padding: 0;
        background: #ffffff; /* fallback */
        background: var(--background);
        color: #232323; /* fallback */
        color: var(--foreground);
        font-family: -apple-system, Segoe UI, Roboto, Arial, sans-serif; /* fallback */
        font-family: var(--font);
        font-weight: 400; /* fallback */
        font-weight: var(--font-weight-regular);
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
      }
      a { color: inherit; }
      .wrapper { width: 100%; background: #ffffff; background: var(--background); padding: 24px 0; }
      .container {
        width: 100%;
        max-width: 640px;
        margin: 0 auto;
        background: #ffffff; /* fallback */
        background: var(--card, #ffffff);
        border: 1px solid #e6e6e6; /* fallback */
        border: 1px solid var(--border);
        border-radius: 16px; /* fallback */
        border-radius: var(--radius-lg);
        overflow: hidden;
      }
      .header {
        padding: 24px;
        background: #f6f6f6; /* fallback */
        background: var(--muted);
        color: #6b6b6b; /* fallback */
        color: var(--muted-foreground);
      }
      .brand { font-weight: 600; font-weight: var(--font-weight-semibold); font-size: 20px; }
      .content { padding: 24px; }
      .footer { padding: 16px 24px; color: #6b6b6b; color: var(--muted-foreground); font-size: 12px; }
      .btn {
        display: inline-block;
        padding: 12px 16px;
        background: #232323; /* fallback */
        background: var(--primary);
        color: #fafafa !important; /* fallback */
        color: var(--primary-foreground) !important;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 600; /* fallback */
        font-weight: var(--font-weight-semibold);
      }
      .divider { height: 1px; background: #e6e6e6; background: var(--border); }
    </style>
  </head>
  <body>
    <div class="wrapper">
      <div class="container" style="background:#fff;">
        <div class="header">
          <div class="brand">@yield('brand', config('app.name'))</div>
          @hasSection('preheader')
            <div style="font-size:12px;opacity:.8;margin-top:8px">@yield('preheader')</div>
          @endif
        </div>
        <div class="divider"></div>
        <div class="content">
          @yield('content')
          @hasSection('action')
            <div style="margin-top:24px">@yield('action')</div>
          @endif
        </div>
        <div class="divider"></div>
        <div class="footer">
          @yield('footer')
          <div style="margin-top:8px">
            @yield('unsubscribe')
          </div>
        </div>
      </div>
    </div>
  </body>
  </html>


