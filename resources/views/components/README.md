# Blade Components

## Nav Item

`nav-item.blade.php` provides a reusable navigation link with optional icon support. It automatically highlights the active route based on the current URL and applies an Alpine `x-transition` for smooth appearance.

### Props

- `href`: Destination URL.
- `icon`: Optional character or HTML for the icon displayed before the label.
- `label`: The text for the navigation link.

### Usage

```blade
<x-nav-item href="/admin" icon="📊" label="Dashboard" />
```

The component will render the icon and label, adding active styles when visiting the provided `href`.
