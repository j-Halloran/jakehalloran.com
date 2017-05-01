$(document).ready(function(){
/*  //Hide the interests and languages sections
  $("#languagesDiv").hide();
  $("#otherInterests").hide();
  $("#classesDiv").hide();
  $("#introDiv").show();

  //hide the search response
  $("#intResponsePara").hide()

  //Event listener for intro button
  $("#intro").click(function(event){
    $("#languagesDiv").hide();
    $("#otherInterests").hide();
    $("#classesDiv").hide();
    $("#introDiv").show();
  });

  //Event listener for languages Button
  $("#languages").click(function(event){
    $("#otherInterests").hide();
    $("#introDiv").hide();
    $("#languagesDiv").show();
    $("#classesDiv").show();
  });

  //Event listener for interests button
  $("#interests").click(function(event){
    $("#introDiv").hide();
    $("#languagesDiv").hide();
    $("#classesDiv").hide();
    $("#otherInterests").show();
    $("#interestsPicture1").hide();
  });

*/
  //Event listener for search
  $("#interestsForm").submit(function(event){
      //Use ajax to pass form data without a page refresh
      $.ajax({
            type: 'post',
            url: './php/interest.php',
            data: $('#searchBar').val(),
            success: function (response) {
              $("#intResponsePara").text(response);
              $("#intResponsePara").show();
              $('#searchBar').val('');
            }
      });

    return false; //dont refresh page
  });
});
