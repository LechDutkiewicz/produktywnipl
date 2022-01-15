// import Sticky from 'sticky-js'
/* eslint-disable */
import 'jquery-sticky'
import 'velocity-animate/velocity'

export default {
  init() {
    // JavaScript to be fired on all pages
    $('.banner').sticky({ topSpacing: 0, zIndex: 9 })

    $('.nav-primary .scroll-to a, .scroll-to-btn').on('click', function(e) {
      const windowWidth = $(window).width();
      let additionalOffset;

      if ( windowWidth < 1024 ) {
        additionalOffset = -60;
      } else {
        additionalOffset = 120 - (windowWidth * 0.5 * 0.076);
      }

      $('#open-mobile-nav').removeClass('is-active');
      $('.banner').removeClass('nav-open');

      e.preventDefault();
      e.stopPropagation();
      // set target to anchor's "href" attribute
      const target = $(this).attr('href');

      if (! document.getElementById(target) ) {
        location.href = `/${target}`
      }

      // scroll to each target
      $(target).velocity('scroll', {
        duration: 500,
        offset: additionalOffset,
        easing: [ .71,.29,.15,.99 ],
      });
    });
    
    $('#open-mobile-nav').on('click', function(e) {
      e.preventDefault();
      $(this).toggleClass('is-active');
      $(this).closest('.banner').toggleClass('nav-open');
    })
  },
  finalize() {
    // JavaScript to be fired on all pages, after page specific JS is fired
    // $('form.getresponse-form').on('submit', function (e) {
    //   e.preventDefault()
    //   const formEmail = $(this).find('.email')
    //   const formName = $(this).find('.name')
    //   const formCampaign = $(this).find('.campaign_token')
    //   const formSubmit = $(this).find('.btn--subscribe')
    //   const gaAction = $(this).find('.btn--subscribe').data('ga-action');
    //   const initSubmitVal = formSubmit.val();
    //   const thankYouPage = $(this).find('[name="thankyou_url"]').val();

    //   formSubmit.val('Momencik...')

    //   $.ajax({
    //     url: ajax_object.ajax_url, // url where to submit the request
    //     type : "POST", // type of action POST || GET
    //     // dataType : 'json', // data type
    //     data : {
    //       action: 'handle_getresponse',
    //       email: formEmail.val(),
    //       name: formName.val(),
    //       campaignToken: formCampaign.val()
    //     },
    //     success : function(result) {
    //         // you can see the result from the console
    //         // tab of the developer tools
    //         const res = JSON.parse(result);

    //         // add to dataLayer for Google Tag Manager
    //         window.dataLayer = window.dataLayer || [];
    //         window.dataLayer.push({
    //           "event":                "subscriptionAttempt", 
    //           "subscriptionResponse": res.httpStatus,
    //           "subscriptionPlace":    gaAction,
    //         });

    //         if (res.httpStatus === 409) {
    //           formSubmit.val('Jesteś już zapisany!')
    //         }

    //         if (res.httpStatus === 400) {
    //           formSubmit.val('Coś poszło nie tak, spróbuj jeszcze raz!')
    //         }

    //         if (res.httpStatus === 202) {
    //           formSubmit.val('Zostałeś dopisany do listy!')
    //           window.location = thankYouPage;
    //         }

    //         setTimeout(() => {
    //           formSubmit.val(initSubmitVal)
    //           formEmail.val('')
    //           formName.val('')
    //         }, 3000);
    //       },
    //       error: function(xhr, resp, text) {
    //         console.log(xhr, resp, text);
    //         formSubmit.val('Coś poszło nie tak, spróbuj za chwilę.')

    //         setTimeout(() => {
    //           formSubmit.val(initSubmitVal)
    //           formEmail.val('')
    //           formName.val('')
    //         }, 3000);
    //       }
    //     })

    //   return false;
    // });

  },
};
