$(document).ready(function(){
  setTitleDate(); //Fucntion to set the last updated date
});

function setTitleDate(){
  var dayInSeconds = 24*60*60*1000; // hours*minutes*seconds*milliseconds
  var loadTime = new Date();
  var lastUpdate = new Date(2016,10,02);
  var diffDays = Math.round(Math.abs((loadTime.getTime() - lastUpdate.getTime()))/(dayInSeconds));
  $("#resumeHead").text("Resume - Last Updated "+diffDays+" Days Ago");
  return true;
}
