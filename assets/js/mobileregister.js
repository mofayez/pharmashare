$(document).ready(function () {
    var telInput = $("#phones"),
      errorMsg = $("#error-msg"),
      validMsg = $("#valid-msg"),
      phonevalidate = $('#phone-validate');
    // initialise plugin
    telInput.intlTelInput({
      utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/javascript.util/0.12.12/javascript.util.min.js",
      initialCountry: "auto",
      // separateDialCode: true,
      geoIpLookup: function(callback) {
          $.get('https://ipinfo.io', function() {}, "jsonp").always(function(resp) {
            var countryCode = (resp && resp.country) ? resp.country : "";
            callback(countryCode);
          });
      },
    });
      telInput.change(
              function () {
                  $('#phone_validate').show();
                  if (telInput.intlTelInput("isValidNumber")) {
                      $('#phone_validate').removeClass('text-danger').addClass('text-success');
                      $('#phone_validate').children('i').removeClass('icon-cancel-circle2').addClass('icon-checkmark-circle2');
                  }else {
                      console.log('dsadas');
                      $('#phone_validate').removeClass('text-success').addClass('text-danger');
                      $('#phone_validate').children('i').removeClass('icon-checkmark-circle2').addClass('icon-cancel-circle2');

                  }
              }
          );
    var reset = function() {
      telInput.removeClass("error");
      errorMsg.addClass("hide");
      validMsg.addClass("hide");
      if ($.trim(telInput.val())) {
        if (telInput.intlTelInput("isValidNumber")) {
          validMsg.removeClass("hide");
        } else {
          telInput.addClass("error");
          errorMsg.removeClass("hide");
        }
      }
    };
    setInterval(function () {
      reset();
      var code =  $("#phones").intlTelInput('getSelectedCountryData').dialCode;
      $("#code").val('+' + code);
    },2000)

    // on blur: validate
    // telInput.blur(function() {
    //   reset();
    //   if ($.trim(telInput.val())) {
    //     if (telInput.intlTelInput("isValidNumber")) {
    //       validMsg.removeClass("hide");
    //     } else {
    //       telInput.addClass("error");
    //       errorMsg.removeClass("hide");
    //     }
    //   }
    // });

    // on keyup / change flag: reset
    telInput.on("keyup change", reset);

})
