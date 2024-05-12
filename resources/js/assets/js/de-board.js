$(document).ready(function () {

    $(function() {
      var $radios = $('input:radio[name=Re-employable]');
      if($radios.is(':checked') === false) {
          $radios.filter('[value=Yes]').prop('checked', true);
      }
  });
    
    $(".input, .input1 ,select").focus(function() {
      $(this).attr('data-placeholder', $(this).attr('placeholder'));
      $(this).attr('placeholder', '');
  });
  
  // Restore placeholder on blur if input is empty
  $(".input, .input1 ,select").blur(function() {
      if ($(this).val().trim() === '') {
          $(this).attr('placeholder', $(this).attr('data-placeholder'));
      }
  });
  
    $(".removeTask").click(function () {
      var parentElement = $(this).closest('.card-body');
      parentElement.hide();
    });
    $(".close").click(function () {
      $("#confirm-popup").modal('hide');
  });
  
  
  $('.save').on('click', function() {
    // Get the value of the document name input
    var docName = $('#Doc-name').val();
    
    // Create the new card HTML structure dynamically
    var newCard = $('<div>').addClass('col-sm-4');
    var cardDiv = $('<div>').addClass('card card1');
    var cardBodyDiv = $('<div>').addClass('card-body');
    var showAllTaskDiv = $('<div>').addClass('showalltask-card d-flex flex-column');
    var taskCheckboxDiv = $('<div>').addClass('d-flex').css('gap', '.5rem');
    var checkboxInput = $('<input>').attr('type', 'checkbox');
    var taskNameDiv = $('<div>').addClass('p4').text(docName);
    var actionDiv = $('<div>').addClass('d-flex justify-content-center align-items-center').css('gap', '24px');
    var uploadButton = $('<button>').addClass('btn btn-primary removeTask ').text('Remove Task');
  
  
  
    // Append elements to their respective parent elements
    taskCheckboxDiv.append(checkboxInput, taskNameDiv);
    actionDiv.append(uploadButton);
    showAllTaskDiv.append(taskCheckboxDiv, actionDiv);
    cardBodyDiv.append(showAllTaskDiv);
    cardDiv.append(cardBodyDiv);
    newCard.append(cardDiv);
    
  
    // Insert the new card before the specified element
    $('.card2').closest('.col-sm-4').before(newCard);
    
    // Clear the input field after saving
    $('#Doc-name').val('');
    
    // Close the modal
    $('#AddDocModal').modal('hide');
  });
  
  $(document).on('click', '.removeTask', function() {
    // Find the closest card-body and hide it
    $(this).closest('.col-sm-4').remove();
  });
  
  
  
    const $prevBtns = $(".btn-prev");
    const $nextBtns = $(".btn-next");
    const $progress = $("#progress");
    const $formSteps = $(".form-step");
    const $progressSteps = $(".progress-step");
    
    let formStepsNum = 0;
    
    $nextBtns.click(function(event) {
      event.stopImmediatePropagation();
      if (formStepsNum < $formSteps.length - 1) { // Check if it's not the last step
          const $requiredFields = $formSteps.eq(formStepsNum).find("input[required]");
          let isValid = true;
          $requiredFields.each(function() {
              if (!$(this).val()) {
                  isValid = false;
                  // $("#confirm-popup").modal("show"); // Show the modal
              }
          });
          if (isValid) {
              formStepsNum++;
              updateFormSteps();
              updateProgressbar();
             
          }
      }
  });
  
  // $nextBtns.click(function (event) {
  //   event.stopImmediatePropagation();
  //   if (formStepsNum < $formSteps.length - 1) { // Check if it's not the last step
  //     formStepsNum++;
  //     updateFormSteps();
  //     updateProgressbar();
  //   }
  // });
      
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
  
  
  
      $('#de-boardButton').on("click",function(e){
          e.preventDefault();
          window.location.href = "../HTML/de-board.html";
      })
      $('#De-BoardingDate').on('focus',(function(){
           $('.dateIcon').hide(); // Hide the date icon when input is focused
  }))
      $('#finalEmploymentDate').on('focus',(function(){
           $('.dateIcon1').hide(); // Hide the date icon when input is focused
  }))
      $('#finalWorkingDate').on('focus',(function(){
           $('.dateIcon2').hide(); // Hide the date icon when input is focused
  }))
         
  $('#Allemp-ancordien-item').click(function() {
      window.location.href = "../HTML/dashboard.html";
  
    });
  $('#On-board-ancordien-item').click(function() {
      window.location.href = "../HTML/onBoard.html";
  
    });
  
  
  
  
  });