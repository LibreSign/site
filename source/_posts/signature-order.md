---
extends: _layouts.post
title: Signature Order - Sequential or Parallel Signing in LibreSign
author: Vitor Mattos
date: 2025-12-22
description: LibreSign now supports signature order control, allowing documents to be signed sequentially or in parallel. Administrators can define the default workflow while maintaining flexibility for approval processes and compliance requirements.
categories: [features]
icon: dashboard
---

### Signature Order: Sequential or Parallel Signing in LibreSign

LibreSign now supports **signature order control**, allowing documents to be signed **sequentially** or **in parallel**, providing greater flexibility and control over signing workflows.

Administrators can define the **default signature flow** for their environment:

* **Parallel signing**: all signers can sign the document simultaneously, without a predefined order.
* **Sequential signing**: signers must sign the document following a defined order, where each signer is notified only after the previous one has completed their signature.

If the administrator does not define a default signing order, the person requesting the signature can choose whether the document should follow a **sequential signing flow** when creating the signing request.

This feature enables LibreSign to better support structured approval processes, compliance requirements, and real-world business workflows, while maintaining the simplicity and flexibility expected from a modern digital signature solution.

In the administration settings, administrators can configure the default signing order for the organization:

![Admin settings](/assets/images/posts/signature-order/admin-settings.png)

When creating a new signing request, the requester can choose the signing order:

![Configuring signing order](/assets/images/posts/signature-order/configuring.png)

The signing order can also be viewed during the signing process:

![Viewing signing order](/assets/images/posts/signature-order/view-signing-order.png)

When a signing order is defined, LibreSign enforces the sequence during the signing process, ensuring that each signer only receives the notification and is able to sign the document when it is their turn in the defined order.
