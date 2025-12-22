---
extends: _layouts.post
title: CRL (Certificate Revocation List) Implementation in LibreSign
author: Vitor Mattos
date: 2025-12-22
description: Learn how the Certificate Revocation List (CRL) implementation in LibreSign enhances digital signature security and ensures compliance with international best practices.
categories: [features, security]
icon: shield-check
---

### CRL (Certificate Revocation List) Implementation in LibreSign

The **Certificate Revocation List (CRL)** is an essential technical feature for any solution that takes digital certification and security seriously. Although it is not always visible to end users, it plays a critical role in the **trustworthiness of digital signatures**.

#### What is a CRL?

The digital certificates used to sign documents are issued by a **Certificate Authority (CA)**. This authority is responsible for maintaining a list containing the **serial numbers of all revoked certificates**, including the certificate of the certificate authority itself.

When a CA supports CRL, the issued certificate includes a **public URL** pointing to the revocation list. This URL allows systems and validators to check, at any time, whether a specific certificate has been revoked.

#### When can a certificate be revoked?

Certificate revocation may occur for several legitimate reasons, such as:

* An employee leaving the organization
* Death of the certificate holder
* Compromise or loss of the password or private key
* Security incidents

In these situations, keeping the certificate active would represent a security risk.

#### How does CRL-based validation work?

When a document is signed using a certificate that has an associated CRL, this information is embedded in the signature data.

When validating the document with a CRL-compatible system, the following process takes place:

1. The CRL URL is queried
2. The certificate serial number is checked against the list
3. The revocation date is compared with the signature date

If the certificate was revoked **before the signing date**, the document is considered **invalid**, as it was signed using a certificate that was no longer trustworthy at that time. If the revocation occurred after the signing date, the signature remains valid.

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

#### Why is this important?

With the implementation of CRL, LibreSign:

* Raises the level of **cryptographic security**
* Ensures greater **legal reliability**
* Aligns with **international best practices** for digital signature validation
* Prevents the misuse of compromised certificates

This is another step in LibreSign's commitment to **security, transparency, and technical compliance**. Security is not an optional feature — it is a design principle in LibreSign.
