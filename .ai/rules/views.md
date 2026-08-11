---
paths:
  - 'resources/views/**'
---

# Views

## Custom UI uses @extends/@section, never Breeze components or Vite
All views use @extends('layouts.app'|'layouts.guest') with @section('content'/'page-title'/'scripts'). CSS is embedded inline (partials/styles.blade.php shared design system + layout-specific blocks). No <x-app-layout>, <x-nav-link>, Alpine, or @vite anywhere — the UI must render without npm run dev. New pages must follow this pattern and reuse the shared classes (.card, .btn, .form-control, .table, .badge, .avatar, .stat-card, .flash, .pagination).
