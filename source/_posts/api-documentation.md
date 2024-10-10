---
extends: _layouts.post
title: LibreSign API Guide
author: Vitor Mattos
date: 2024-10-10
description: Provides a practical guide on how to use the LibreSign API, including querying endpoints and understanding usage flows by observing requests in the application.
categories: [features]
icon: dashboard
---

# LibreSign API: Endpoints and usage flows

## API Endpoints

To find out which endpoints are available in the LibreSign API, follow these steps:

1. **Install the OCS API Viewer App**: Start by installing the [OCS API Viewer](https://apps.nextcloud.com/apps/ocs_api_viewer) in your Nextcloud environment.
2. **Access the API Documentation**: In the Nextcloud menu, locate the OCS app. Here, you will find the documentation for the LibreSign API, as well as other Nextcloud APIs.

## Understanding the LibreSign API usage flows

To understand how to perform specific operations, such as requesting a signature, you can use the LibreSign application itself as a reference. Here’s how to do it:

1. **Open Developer Tools**: Press the F12 key in your browser to access the developer tools.
2. **Go to the Network Tab**: Navigate to the "Network" tab to monitor the API requests.
3. **Filter the requests**: Use the filter to show only the requests related to LibreSign by typing "libresign."
4. **Perform actions in LibreSign**: Execute the desired actions in the LibreSign application. Observe the requests sent to the API at each step and analyze how they are structured.

By following these steps, you will be able to query the available endpoints of the LibreSign API and understand the usage flows by monitoring the requests made by the application. This will help you integrate and use the API in your projects.
