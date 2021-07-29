# nxt-sharing-buttons
A very simple social sharing button plugin for WordPress

# Usage
Simply add the shortcode [ssb] to a post / your post template to automatically display some social sharing buttons.
The version 1.0.0 of the plugin does NOT include any styling, so I would recommend styling it via your theme's / child theme's style.css.

# Parameters
- class allows you to add your own class to the container
- facebook: 'on' / 'off' (activate / deactive link to facebook)
- twitter: 'on' / 'off'
- linkedin: 'on' / 'off'
- pinterest: 'on' / 'off'

## Example usage:
[ssb facebook='off' class='my-class']

=> Will output the sharing buttons for Twitter, LinkedIn and Pinterest, but NOT for Facebook and add the class "my-class" to the container.
