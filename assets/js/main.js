function changeContent(content) {
  if(content == "landing") {
    $(".container").fadeOut(3000,function (){
      $(".container").fadeIn(3000,function (){
          // Do more stuff
      })
  })
  }
}


function openSearch() {
  $("#search-modal").fadeIn();
}

function closeSearch() {
  $("#search-modal").fadeOut(1000);
};

$('.delete-category').click(function(){
  var el = this;
 
  // Delete id
  var deleteid = $(this).data('id');

  var confirmalert = confirm("Are you sure you want to delete this category ?");
  if (confirmalert == true) {
     // AJAX Request
     $.ajax({
       url: 'categories',
       type: 'POST',
       data: { id:deleteid },
       success: function(response){

         if(response == 1){
           $(el).closest('li').fadeOut(800,function(){
           $(this).remove();
     });
         }else{
     alert('Invalid ID.');
         }

       }
     });
  }

});

$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})