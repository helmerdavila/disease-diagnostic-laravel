(function() {
  $(function() {
    $('.select2').select2();
    $('#deleteModal').on('show.bs.modal', function(event) {
      var button, content, modal, route, title;
      button = $(event.relatedTarget);
      route = button.data('route');
      title = button.data('title');
      content = button.data('content');
      console.log("ruta " + route + " titulo " + title + " contenido " + content);
      modal = $(this);
      modal.find('#formDelete').attr('action', route);
      modal.find('#modalTitle').text(title);
      return modal.find('#modalContent').text(content);
    });
    return $(".alert").delay(4000).slideUp(200, function() {
      return $(this).alert('close');
    });
  });

}).call(this);
