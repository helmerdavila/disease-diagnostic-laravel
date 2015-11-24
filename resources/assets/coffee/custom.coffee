$ ->
    dropCalendary = (nameOfInput)-> 
        $("#{nameOfInput}calendar").daterangepicker
            drops: 'up'
            locale:
                format : 'DD/MM/YYYY'
            showDropdowns: true
            singleDatePicker: true
        , (start, end, label)->
            $("#{nameOfInput}").inputmask 'dd/mm/yyyy',
                clearIncomplete: true
                showMaskOnHover: false
                yearrange:
                    minyear: 1700
                    maxyear: 2099
            .val start.format 'DD/MM/YYYY'
            .attr 'disabled', false
        
        $("#{nameOfInput}reset").click ()->
            $("#{nameOfInput}")
            .val ''
            .attr 'disabled', true

    dropCalendary('.birthday')
    $('.select2').select2()
    $(":checkbox").labelauty()

    # dynamic modal
    $('#deleteModal').on 'show.bs.modal' , (event)->
        button = $(event.relatedTarget)
        route = button.data 'route'
        title = button.data 'title'
        content = button.data 'content'

        modal = $(@)
        modal.find('#formDelete').attr 'action', route
        modal.find('#modalTitle').text title
        modal.find('#modalContent').text content

    # hide alert
    $(".alert").delay(5000).slideUp 200, ()->
        $(@).alert 'close'

    # prevent dropdown behind table-responsive
    $('.table-responsive').on 'show.bs.dropdown', ()->
        $('.table-responsive'). css 'overflow', 'inherit'

    $('.table-responsive').on 'hide.bs.dropdown', ()->
        $('.table-responsive'). css 'overflow', 'auto'