---
extends: _layouts.post
title: CRL (Certificate Revocation List) Implementation in LibreSign
author: Vitor Mattos
date: 2025-12-22
description: Learn how LibreSign uses certificate revocation lists (CRLs) as one input to certificate validation alongside trust-chain and signing-time evidence.
categories: [features, security]
icon: shield-2-check
---

### CRL (Certificate Revocation List) Implementation in LibreSign

The **Certificate Revocation List (CRL)** is an essential technical feature for any solution that takes digital certification and security seriously. Although it is not always visible to end users, it plays a critical role in the **trustworthiness of digital signatures**.

#### What is a CRL?

Digital certificates used to sign documents are issued by a **Certificate Authority (CA)**. A CA can publish a signed list of the **serial numbers of certificates it has revoked**. The revocation of an intermediate CA certificate is handled by its issuing authority.

When a CA supports CRL, the issued certificate includes a **public URL** pointing to the revocation list. This URL allows systems and validators to check, at any time, whether a specific certificate has been revoked.

#### When can a certificate be revoked?

Certificate revocation may occur for several legitimate reasons, such as:

* An employee leaving the organization
* Death of the certificate holder
* Compromise or loss of the password or private key
* Security incidents

In these situations, keeping the certificate active would represent a security risk.

#### How does CRL-based validation work?

A certificate may reference the CRL distribution point, but that reference does **not** mean the revocation list is embedded in the signed PDF.

When validating the document with a CRL-compatible system, the following process takes place:

1. The CRL URL is queried
2. The certificate serial number is checked against the list
3. The revocation date is compared with the signature date

Revocation **before signing** may invalidate a signature. If the certificate is revoked after signing, the result still depends on trustworthy evidence of the signing time, chain validation, and the applicable validation policy; comparing two dates alone is not sufficient.

#### What has changed in LibreSign?

From now on, CRL support is a **standard feature in LibreSign**.

This means that:

* **Before signing**, LibreSign checks whether the user's certificate has been revoked

  * If it has, the system requests the creation of a new certificate
  * In LibreSign, this simply requires defining a new password, provided that the administrator has enabled internal certificate issuance

* **During document validation**, LibreSign:

  * Queries the CRL (when published and accessible by the certificate authority)
  * Verifies the certificate's validity
  * Displays the CRL URL
  * Presents validity information for both the signer's certificate and the issuer's certificate

* **Certificate management**, administrators can:

  * Manage the certificate revocation list
  * Revoke certificates issued by a certificate authority they manage, when necessary

#### Why is this important?

With the implementation of CRL, LibreSign:

* Raises the level of **cryptographic security**
* Supports stronger **certificate validity checks** when revocation information is available
* Aligns with **international best practices** for digital signature validation
* Helps detect certificates that have been revoked after compromise

This is another step in LibreSign's commitment to **security, transparency, and technical compliance**. Security is not an optional feature: it is a design principle in LibreSign.
