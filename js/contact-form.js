jQuery(function ($) {
  var $form = $("#contact_form");
  var $submit = $("#form_contact_submit");

  function resetForm() {
    $form[0].reset();
  }

  function submitForm() {
    $($submit).on("click", function () {
      var formData = $($form).serializeArray();
      /**
       * Sending values of the fields
       */
      var options = {
        url: contact_form_object.url,
        data: {
          action: "contact_form_action",
          nonce: contact_form_object.nonce,
          data: formData,
        },
        type: "POST",
        dataType: "json",
        beforeSubmit: function (xhr) {
          /**
           * Change the inscription on the button when sending
           */
          $submit.text("Sending...");
        },
        success: function (request, xhr, status, error) {
          var newRequestData = request.data;

          if (request.success === true) {
            /**
             * If all fields are filled in, send the data
             * and return the button caption to the default state
             */
            $form
              .after(
                '<div class="message-success">' + newRequestData + "</div>"
              )
              .slideDown();
            $submit.text("Submit Message");
          } else {
            /**
             * If the fields are empty, display messages
             * and change the inscription on the button
             */
            $.each(newRequestData, function (key, val) {
              $(".your_" + key).addClass("error");
              $(".your_" + key).before(
                '<span class="error-' + key + '">' + val + "</span>"
              );
              /**
               * Reset field values
               */
              $(".your_name").blur(function () {
                $(this).removeClass("error");
                $(".error-name").slideUp(200, function () {
                  $(this).remove();
                });
              });
              $(".your_email").blur(function () {
                $(this).removeClass("error");
                $(".error-email").slideUp(200, function () {
                  $(this).remove();
                });
              });
              $(".your_comment").blur(function () {
                $(this).removeClass("error");
                $(".error-comment").slideUp(200, function () {
                  $(this).remove();
                });
              });
            });
            $submit.text("Something went wrong......");
          }

          setTimeout(() => {
            $(".message-success").fadeOut();
          }, 3000);

          /**
           * On successful sending, reset the field values
           */
          resetForm();

          // console.log(request);
        },
        error: function (request, status, error) {
          $submit.text("Something went wrong......");
        },
      };
      /**
       * Sending the form
       */
      $form.ajaxForm(options);
    });
  }
  submitForm();
});
