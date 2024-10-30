=== Media Cloud Sync ===
Author: Dudlewebs
Author URI: https://dudlewebs.com
Contributors: dudlewebs
Donate link: 
Tags: sync, cloud, offload, media, aws
License: GPLv2 or later
Requires PHP: 7.4
Requires at least: 5.2
Tested up to: 6.6
Stable tag: 1.0.0

Offload media to cloud storage (S3, DigitalOcean, Google Cloud) and rewrite URLs for seamless file delivery.

== Description ==
Media Cloud Sync is an innovative plugin for WordPress that dramatically transforms how you interact with media and increases your website's performance. This plugin allows you to transfer your files, media, and images from a WordPress server to online cloud storage, such as Amazon S3, DigitalOcean Spaces, and Google Cloud Storage Services. It also rewrites URLs to serve files from the same storage provider or another CDN provider.

== Installation ==
Installation of "Media Cloud Sync" can be done either by searching for "Media Cloud Sync" via the "Plugins > Add New" screen in your WordPress dashboard or by using the following steps:

1. Download the plugin via WordPress.org.
2. Upload the ZIP file through the ‘Plugins > Add New > Upload’ screen in your WordPress dashboard.
3. Activate the plugin through the ‘Plugins’ menu in WordPress.

== How to Manage Settings ==
To manage settings in the Media Cloud Sync plugin, follow these steps:

1. **Access the Plugin Menu**:
   - In your WordPress admin dashboard, look for the **Media Cloud Sync** menu item in the left menu bar. This menu provides access to all the settings and features of the plugin.

2. **Manage Settings**:
   - Click on the **Media Cloud Sync** menu to enter the settings area.
   - You will see two main sections: **Configure** and **Settings**.

   **a. Configure**:
   - In this section, you can set up the basic configurations for the plugin, including connecting your cloud storage account (e.g., Amazon S3, Google Cloud Storage, DigitalOcean Spaces) and defining the default options for media offloading.
   - Follow the prompts to authenticate your cloud account and grant the necessary permissions.

   **b. Settings**:
   - The **Settings** section allows for more advanced customization options. Here, you can adjust how media files are uploaded and served from the cloud.
   - Make sure to save your changes after adjusting the settings to ensure they take effect.

3. **Review and Test**:
   - After configuring the settings, it’s advisable to test the plugin to ensure that your media files are being uploaded and served correctly from the cloud storage.
   - Upload a new media file and check if it appears in your cloud storage as expected.

== Basic Features ==
The Media Cloud Sync plugin significantly enhances your website's speed by offloading media to cloud servers. This approach allows your site to load more efficiently, as it reduces the number of server requests, ultimately resulting in faster page load times. Once media files—such as images, videos, PDFs, and ZIP files—are uploaded to the cloud, your server no longer needs to handle these files, freeing up resources.

Here are the key features of the Media Cloud Sync plugin:

🔹 Seamlessly sync your media to popular cloud storage solutions like Amazon S3, Google Cloud Storage, or DigitalOcean Spaces.  
🔹 Automatically delete files from the server after they are uploaded to the cloud, optimizing storage use.  
🔹 Customize the base path for server storage to suit your organizational needs.  
🔹 Tailor the URL structure for your media files to enhance your site's SEO and user experience.  
🔹 Enable object versioning to prevent invalidations of your media files.  
🔹 Utilize a custom CDN for serving your media URLs, improving loading speeds and reliability.  
🔹 Generate pre-signed URLs for secure access to your media files.  
🔹 Enjoy built-in support for WooCommerce, ensuring smooth integration with your online store.  
🔹 Leverage compatibility with Advanced Custom Fields for enhanced flexibility.  
🔹 Benefit from RTL (Right to Left) support for multilingual websites.  
🔹 Access WPML string translation support for seamless multilingual content management.

== Other Useful Links ==
🔹 [Official website](https://dudlewebs.com)  
🔹 [Pro version coming soon](https://dudlewebs.com)  

== Screenshots ==
1. Plugin dashboard page, showcasing the main options for configuring the Media Cloud Sync settings.  
2. Configure wizard welcome screen.  
3. Choosing the appropriate service (e.g., Amazon S3, Google Cloud Storage, and DigitalOcean Spaces) to use.  
4. Configuration settings according to the chosen service.  
5. Choose your bucket to store the media; if the bucket is not created, create one.  
6. Configuration verified successfully; save the settings.  
7. Plugin dashboard page after configuring the service.  
8. Basic settings page.  
9. CDN settings page.  
10. Media properties after uploading the media.  

== Frequently Asked Questions ==

= How do I install the plugin? =
You can install the plugin from the WordPress plugin store or upload it manually.

= Is there a limit on the number of files I can sync? =
No, you can sync as many files as you need. However, syncing existing media will be a feature in the PRO version.

= How do I sync my media files to the cloud? =
After activating the plugin, go to the configure page and follow the prompts to connect your cloud account. Then, navigate to settings and configure them according to your needs. Upload a media file in the Media Library, and you will see that the URL has been replaced by the cloud server URL.

= What cloud providers are supported? =
Currently, the plugin supports major cloud providers such as AWS S3, Google Cloud Storage, and DigitalOcean Spaces.

= Is WPML supported? =
Yes, the Media Cloud Sync plugin is fully compatible with WPML.

== External Services ==
This plugin integrates with third-party services to enhance its functionality. Below is an overview of the external services utilized, the data transmitted, and relevant legal documentation for your reference.

* **Google Cloud Storage**
  - **Description**: Connects to manage media files, allowing upload, download, and delete operations.
  - **Data Sent**: User authentication data, file metadata (name, size, MIME type), user location data (if explicitly provided).
  - **Legal Links**: [Terms of Service](https://policies.google.com/terms), [Privacy Policy](https://policies.google.com/privacy)

* **Amazon S3**
  - **Description**: Facilitates media file management, enabling seamless upload, download, and delete actions.
  - **Data Sent**: User authentication data, file metadata (name, size, MIME type).
  - **Legal Links**: [Terms of Service](https://aws.amazon.com/service-terms/), [Privacy Policy](https://aws.amazon.com/privacy/)

* **DigitalOcean Spaces**
  - **Description**: Manages media files efficiently, allowing file storage, retrieval, and deletion.
  - **Data Sent**: User authentication data, file metadata (name, size, MIME type).
  - **Legal Links**: [Terms of Service](https://www.digitalocean.com/legal/terms-of-service/), [Privacy Policy](https://www.digitalocean.com/legal/privacy-policy/)

== Changelog ==
= 1.0.0 =
* Initial release.
