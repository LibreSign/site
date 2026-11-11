---
extends: _layouts.post
title: LibreSign API Guide
author: Vitor Mattos
date: 2024-10-10
updated: 2026-11-10
description: Use LibreSign's versioned OpenAPI contracts, official integration guides, and examples to connect external systems securely.
categories: [features]
icon: dashboard-square-1
---

# LibreSign API: Integrating with other systems

*Updated on November 10, 2026. Originally published on October 10, 2024.*

LibreSign is free and open-source software for electronic signatures on Nextcloud. Its REST API, based on Nextcloud's OCS protocol, lets an external system request signatures, track progress, and validate documents. An existing application can keep its own interface and workflows while its backend communicates with LibreSign. The API is included in the software; you do not need to purchase separate API access. Hosting, integration services, and support are optional.

## Find the documentation for your LibreSign version

Start at the [official LibreSign documentation](https://docs.libresign.coop/) and select the version installed on your Nextcloud server. Each release has its own integration guides, practical examples, and OpenAPI contract:

- **LibreSign 15:** [integration guide](https://docs.libresign.coop/15/developer_manual/integration/index.html), [external signer example](https://docs.libresign.coop/15/developer_manual/api/external-email-signers.html), and [OpenAPI reference](https://docs.libresign.coop/15/developer_manual/api/openapi.html) ([JSON](https://docs.libresign.coop/15/developer_manual/api/openapi.json)).
- **LibreSign 14:** [integration guide](https://docs.libresign.coop/14/developer_manual/integration/index.html), [external signer example](https://docs.libresign.coop/14/developer_manual/api/external-email-signers.html), and [OpenAPI reference](https://docs.libresign.coop/14/developer_manual/api/openapi.html) ([JSON](https://docs.libresign.coop/14/developer_manual/api/openapi.json)).
- **LibreSign 13:** [integration guide](https://docs.libresign.coop/13/developer_manual/integration/index.html), [external signer example](https://docs.libresign.coop/13/developer_manual/api/external-email-signers.html), and [OpenAPI reference](https://docs.libresign.coop/13/developer_manual/api/openapi.html) ([JSON](https://docs.libresign.coop/13/developer_manual/api/openapi.json)).

The `/api/v1` segment in the OCS URL is the API protocol version, **not** the installed LibreSign release. Request fields can differ between LibreSign releases, so follow the matching contract instead of copying calls from development documentation.

## Authentication and integration with external systems

For a server-to-server integration, use HTTPS and an authorized Nextcloud account with a **revocable App Password**. OCS requests normally use HTTP Basic authentication and the `OCS-APIRequest: true` header. Keep credentials on your backend, never in client-side code. Bearer tokens depend on the authentication configuration of your Nextcloud instance; signing in to another application does not automatically grant API access.

Your backend can create signature requests and track their status through documented endpoints. Depending on the settings enabled in LibreSign, recipients can sign with their Nextcloud accounts or through individual invitations without creating a Nextcloud account. An integration account must not be used to impersonate signers.

For an example of the full flow, see the [authentication guide](https://docs.libresign.coop/15/developer_manual/integration/identity.html) and [external signer walkthrough](https://docs.libresign.coop/15/developer_manual/api/external-email-signers.html) for LibreSign 15. If you use another release, follow its links above.

## Browser inspection is a diagnostic tool

The browser's Network tab (F12) and the [OCS API Viewer](https://apps.nextcloud.com/apps/ocs_api_viewer) can help investigate requests and responses on a specific installation. They are complementary troubleshooting tools, **not a replacement for the official OpenAPI contract**: browser calls can depend on session cookies or interface-specific behavior. Use the versioned guides and examples first, and avoid exposing credentials, signing links, or document contents when debugging.
