(function() {
  $(function() {
    var dropCalendary;
    dropCalendary = function(nameOfInput) {
      $(nameOfInput + "calendar").daterangepicker({
        drops: 'up',
        locale: {
          format: 'DD/MM/YYYY'
        },
        showDropdowns: true,
        singleDatePicker: true
      }, function(start, end, label) {
        return $("" + nameOfInput).inputmask('dd/mm/yyyy', {
          clearIncomplete: true,
          showMaskOnHover: false,
          yearrange: {
            minyear: 1700,
            maxyear: 2099
          }
        }).val(start.format('DD/MM/YYYY')).attr('disabled', false);
      });
      return $(nameOfInput + "reset").click(function() {
        return $("" + nameOfInput).val('').attr('disabled', true);
      });
    };
    dropCalendary('.birthday');
    $('.select2').select2();
    $(":checkbox").labelauty();
    $('#deleteModal').on('show.bs.modal', function(event) {
      var button, content, modal, route, title;
      button = $(event.relatedTarget);
      route = button.data('route');
      title = button.data('title');
      content = button.data('content');
      modal = $(this);
      modal.find('#formDelete').attr('action', route);
      modal.find('#modalTitle').text(title);
      return modal.find('#modalContent').text(content);
    });
    $(".alert").delay(5000).slideUp(200, function() {
      return $(this).alert('close');
    });
    $('.table-responsive').on('show.bs.dropdown', function() {
      return $('.table-responsive').css('overflow', 'inherit');
    });
    return $('.table-responsive').on('hide.bs.dropdown', function() {
      return $('.table-responsive').css('overflow', 'auto');
    });
  });

}).call(this);
