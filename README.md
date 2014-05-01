### Magento - Responsive Email Templates with CSS Inliner

#### About

This module automatically converts an external set of stylesheets to inline CSS for transactional email templates, to make it easier to write and maintain them.

#### Features

*   Module enable/disable
*   Directory config
*   HTML Encoding config
*   Add viewport & config
*   Add new variable `{{var edm_image}}` - get image path - `{{var edm_path}}` - get base url
*   Automatic convert CSS to inline
*   Automatic insert CSS to Template Styles field
*   Automatic insert font path & background image path

#### Customization

You can add your own stylesheet to add some customization on top of our base CSS by going into *System* > *Configuration* > *System* > *Email Responsive - Settings*.

![alt tag](https://raw.githubusercontent.com/kiennt2/Magento-Responsive-Email/master/guide/01.config.png)

#### Structure

![alt tag](https://raw.githubusercontent.com/kiennt2/Magento-Responsive-Email/master/guide/02.structure-theme.png)

#### Create New Email Template

Customize your email in *System* > *Transactional Emails*

![alt tag](https://raw.githubusercontent.com/kiennt2/Magento-Responsive-Email/master/guide/03.create-new-email.png)

#### Supported CSS selectors

*   `E F`
*   `E > F`
*   `E + F`
*   `E:first-child`
*   `E[foo]`
*   `E[foo="value"]`
*   `E.className` <=> `E[class~="className"]`
*   `.className` <=> `*[class~="className"]`
*   `E#myid`
*   `#myid`

#### Output - Demo

![alt tag](https://raw.githubusercontent.com/kiennt2/Magento-Responsive-Email/master/guide/04.output.png)

#### Bonus

The Ultimate Guide to Email Style
http://www.campaignmonitor.com/resources/will-it-work/