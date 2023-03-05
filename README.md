## Custom Contact Form WordPress

:white_check_mark: PHP version >= 7.2    
:white_check_mark: Wordpress - 6.1.1   
:white_check_mark: Animate On Scroll - [AOS.js](https://michalsnik.github.io/aos/)    

The plugin must be installed in the WordPress directory `/wp-content/plugins/`.    
In the plugin directory, create a folder `get-in-touch-form` and place the plugin files in it.    
It should be like this: `/wp-content/plugins/get-in-touch-form/`.    

To display the form styles correctly, it is recommended to connect the [Bootstrap 5 css](https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css) library.    

To send emails correctly without getting into spam, you need to install an SMTP plugin, such as [Easy WP SMTP](https://uk.wordpress.org/plugins/easy-wp-smtp/)  or another one, as you prefer.

To display the styles correctly, the form must be placed in the `.get-in-torch-form-container`.   

For editor:    
```html
      <div class="get-in-torch-form-container p-relative mb-5">
         [get_in_touch_form]
      </div>
```
   
For .php:    

```html
      <div class="get-in-torch-form-container p-relative mb-5">
            <?php echo do_shortcode("[get_in_touch_form]") ?>
      </div>
```

[View Form](https://nastmobile.com/web-test/plugin-example-custom-contact-form/)
