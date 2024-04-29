$(document).ready(function () {
    $('#startDate').on('focus',(function(){
         $('.dateIcon').hide(); // Hide the date icon when input is focused
}))
    $('#finalEmploymentDate').on('focus',(function(){
         $('.dateIcon1').hide(); // Hide the date icon when input is focused
}))
    $('#finalWorkingDate').on('focus',(function(){
         $('.dateIcon2').hide(); // Hide the date icon when input is focused
}))



});