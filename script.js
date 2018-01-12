$(function () {
  $('[data-toggle="tooltip"]').tooltip();

  $('.btn-delete').on('click', function(e) {
    e.preventDefault();
    var id = $(this).attr("data-id");
    console.log(id);
    $('.modal-data-id').val(id);
    $('#delete-confirm').modal('show');
  });
})
