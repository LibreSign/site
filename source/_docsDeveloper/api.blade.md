---
extends: _layouts.docs
section: documentation_content
name: Api
type: developer
---

## API

@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/swagger-ui-dist@5.11.0/swagger-ui.css">
@endpush

<div id="swagger-ui"></div>

@push('scripts')
  <script src="https://unpkg.com/swagger-ui-dist@5.11.0/swagger-ui-bundle.js" crossorigin></script>
  <script src="https://unpkg.com/swagger-ui-dist@5.11.0/swagger-ui-standalone-preset.js" crossorigin></script>
  <script>
    window.onload = () => {
      window.ui = SwaggerUIBundle({
        url: 'https://raw.githubusercontent.com/LibreSign/libresign/refs/heads/main/openapi-full.json',
        dom_id: '#swagger-ui',
      });
    };
  </script>
@endpush