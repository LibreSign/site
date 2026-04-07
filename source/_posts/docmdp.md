---
extends: _layouts.post
title: DocMDP (Document Modification Detection and Prevention) in LibreSign
author: Vitor Mattos
date: 2025-12-22
description: Learn how LibreSign implements DocMDP support according to ISO 32000 standards, providing document protection policies that ensure integrity and control over modifications after digital signature.
categories: [features, security]
icon: shield-check
---

## DocMDP in LibreSign

LibreSign now provides **optional support for DocMDP (Document Management Policy)**, allowing administrators to define control policies for digitally signed documents.

DocMDP is a mechanism defined in the PDF format specification, standardized by **ISO 32000 (ISO 32000-1 and ISO 32000-2)**, which makes it possible to establish **restrictions on permitted changes after a document is signed**, ensuring greater **integrity, predictability, and legal reliability** of signed documents.

#### What is DocMDP?

DocMDP allows a PDF document to define **which level of modification is acceptable** after a certifying digital signature is applied. These rules are embedded directly into the document and are interpreted by validators compatible with the PDF standard defined by ISO 32000.

In LibreSign, administrators can choose between different **levels of protection**, according to the needs of the organization’s signing workflow.

#### Available protection levels

LibreSign supports the following DocMDP levels, as defined in the PDF specification standard (ISO 32000):

* **No certification**
  The document is not certified. Edits and additional signatures are allowed; however, any modification will cause previous signatures to be marked as modified.

* **No changes allowed**
  After the first certifying signature, no edits or additional signatures are allowed. Any modification invalidates the document’s certification.

* **Form filling allowed**
  After the first signature, only form filling and the addition of new signatures are allowed. Any other changes invalidate the certification.

* **Form filling and comments allowed**
  After the first signature, form filling, comments, and new signatures are allowed. Any other changes invalidate the certification.

#### LibreSign behavior according to the selected policy

When the **“No changes allowed”** level is enabled, LibreSign **does not allow more than one signer** to be added to the document. This happens because, according to the DocMDP rules defined in ISO 32000, any structural modification, including the addition of new signatures, would violate the certification policy applied to the document.

For this reason, it is essential that administrators understand the impact of the selected policy before starting a signing workflow, in order to avoid configurations that are incompatible with the document’s purpose.

For the other certification levels, LibreSign allows multiple signers.

#### Validation

During the validation of signed documents, LibreSign clearly exposes the **DocMDP information**, indicating the level of protection applied to the document according to the defined policy.

This allows PDF validators compatible with ISO 32000 to:

* Understand the restrictions applied to the document
* Verify that the content integrity has been preserved
* Confirm that the document follows internationally recognized policies

With this support, LibreSign reinforces its commitment to **international best practices for PDF digital signatures**, offering transparency, interoperability, and a high level of technical compliance.
