$(document).ready(function(){
  //Hide the error and success messages to start
  $("#errorHolder").hide();
  $("#successHolder").hide();
  $("#formTitle").show();
  $("html, body").animate({ scrollTop: 0 }, "slow");
  //Event listener for submit button
  $("#commentForm").submit(function(event){
    if(verifyForm()){
      $("#formHolder").hide();
      $("#errorHolder").hide();
      $("#formTitle").hide();
      $("#successHolder").show();

      //Use ajax to pass form data without a page refresh
      $.ajax({
            type: 'post',
            url: '../home/php/post.php',
            data: $('#commentForm').serialize(),
            success: function (response) {
              console.log(response);
	      console.log($('#commentForm').serialize())
            }
      });
    }

    else{
      $("#errorHolder").show();
    }

    return false; //dont refresh page
  });
});

function verifyForm(){
  //Hide the titlePara
  $("#formTitle").hide();

  //Hide each individual error
  $("#nameError").hide();
  $("#emailError").hide();
  $("#commentError").hide();
  $("#emailFormatError").hide();

  //check for name length
  if($("input[name='name-field']").val().length==0){
    $("formTitle").hide();
    $("#nameError").show();
    return false;
  }

  //check for email length
  else if($("input[name='email-field']").val().length==0){
    $("formTitle").hide();
    $("#emailError").show();
    return false;
  }

  //check for @ in email
  else if($("input[name='email-field']").val().indexOf('@')==-1){
    $("formTitle").hide();
    $("#emailFormatError").show();
    return false;
  }

  //Check for comment length
  else if($("textarea[name='comment-field']").val().length==0){
    $("formTitle").hide();
    $("#commentError").show();
    return false;
  }
  return true;
}
