## Testimonials Video Slider WordPress

:white_check_mark: PHP version >= 7.2    
:white_check_mark: Wordpress - 6.1.1   
:white_check_mark: Animate On Scroll - [AOS.js](https://michalsnik.github.io/aos/)    

The plugin must be installed in the WordPress directory `/wp-content/plugins/`.    
In the plugin directory, create a folder `custom-contact-form` and place the plugin files in it.    
It should be like this: `/wp-content/plugins/custom-contact-form/`.   

To display the styles correctly, the form must be placed in the `.contact-container`.   

For editor:    
```html
      <div class="contact-container">
         [contact_form]
      </div>
```
   
For .php:    

```html
      <div class="contact-container">
         ```php
            <?php echo do_shortcode("[contact_form]") ?>
         ```
      </div>
```

[View Form](https://nastmobile.com/web-test/plugin-example-custom-contact-form/)
