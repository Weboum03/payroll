$(document).ready(function () {
    const $prevBtns = $(".btn-prev");
    const $nextBtns = $(".btn-next");
    const $progress = $("#progress");
    const $formSteps = $(".form-step");
    const $progressSteps = $(".progress-step");
    
    let formStepsNum = 0;
    
    $nextBtns.click(function (event) {
        event.stopImmediatePropagation();
        if (formStepsNum < $formSteps.length - 1) { // Check if it's not the last step
          formStepsNum++;
          updateFormSteps();
          updateProgressbar();
        }
      });
      
      $prevBtns.click(function (event) {
        event.stopImmediatePropagation();
        if (formStepsNum > 0) { // Check if it's not the first step
          formStepsNum--;
          updateFormSteps();
          updateProgressbar();
        }
      });

    function updateFormSteps() {
      $formSteps.removeClass("form-step-active");
      $formSteps.eq(formStepsNum).addClass("form-step-active");
    }
    
    function updateProgressbar() {
      $progressSteps.each(function (idx) {
        if (idx < formStepsNum + 1) {
          $(this).addClass("progress-step-active");
        } else {
          $(this).removeClass("progress-step-active");
        }
      });
      
      const $progressActive = $(".progress-step-active");
      $progress.width((($progressActive.length - 1) / ($progressSteps.length - 1)) *92  + "%");
    }






    $('#accordion .collapse').removeClass('show'); // Remove the 'show' class from all collapsible elements
    $('#accordion .btn-link').attr('aria-expanded', 'false'); // Set aria-expanded attribute to 'false' for all accordion buttons
  
    $('#accordion .collapse').on('shown.bs.collapse', function() {
        $(this).parent().find('.btn-link').addClass('collapsed');
    });
  
    $('#accordion .collapse').on('hidden.bs.collapse', function() {
        $(this).parent().find('.btn-link').removeClass('collapsed');
    });

      $(".nav-icon").on("click", function(e) {
        e.preventDefault();
        e.stopPropagation();
      });
      
      $(".profile .icon_wrap").click(function(e) {
        e.stopPropagation();
        $(this).toggleClass("active");
        $(".notifi").removeClass("active");
      });
      
      $(".notifi").click(function(e) {
        e.stopPropagation();
        $(this).toggleClass("active");
        $(".profile").removeClass("active");
      });
      
      $(".show_all .link").click(function(e) {
        e.stopPropagation();
        $(".notifi").removeClass("active");
        $(".popup").show();
      });
      
      $(".close").click(function(e) {
        e.stopPropagation();
        $(".popup").hide();
      });
      
      $(document).click(function() {
        $(".notifi").removeClass("active");
        $(".profile").removeClass("active");
        $(".popup").hide();
      });

      $(".removeTask").click(function() {
        var parentElement = $(this).closest('.card-body');
        parentElement.hide();
      });



    });
