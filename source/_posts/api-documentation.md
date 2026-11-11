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

## Official integration documentation

Start at the [official LibreSign documentation](https://docs.libresign.coop/). Choose the LibreSign release installed on your Nextcloud server, then open **Developer manual and API**. You will find integration guides, practical examples, the interactive OpenAPI reference, and its downloadable JSON contract. The guides cover signature requests, invitations, status checks, and authorized retrieval of signed documents.

Use the documentation for your installed release: available features and request fields can change over time. The development documentation may describe functionality not yet included in a stable release.

## Authentication and integration with external systems

For a server-to-server integration, use HTTPS and an authorized Nextcloud account with a **revocable App Password**. OCS requests normally use HTTP Basic authentication and the `OCS-APIRequest: true` header. Keep credentials on your backend, never in client-side code. Bearer tokens depend on the authentication configuration of your Nextcloud instance; signing in to another application does not automatically grant API access.

Your backend can create signature requests and track their status through documented endpoints. Depending on the settings enabled in LibreSign, recipients can sign with their Nextcloud accounts or through individual invitations without creating a Nextcloud account. An integration account must not be used to impersonate signers.

## Browser inspection is a diagnostic tool

The browser's Network tab (F12) and the [OCS API Viewer](https://apps.nextcloud.com/apps/ocs_api_viewer) can help investigate requests and responses on a specific installation. They are complementary troubleshooting tools, **not a replacement for the official OpenAPI contract**: browser calls can depend on session cookies or interface-specific behavior. Use the versioned guides and examples first, and avoid exposing credentials, signing links, or document contents when debugging.
