$ ->
    $('.select2').select2()

    # dynamic modal
    $('#deleteModal').on 'show.bs.modal' , (event)->
        button = $(event.relatedTarget)
        route = button.data 'route'
        title = button.data 'title'
        content = button.data 'content'

        console.log "ruta #{route} titulo #{title} contenido #{content}"

        modal = $(@)
        modal.find('#formDelete').attr 'action', route
        modal.find('#modalTitle').text title
        modal.find('#modalContent').text content

    # hide alert
    $(".alert").delay(4000).slideUp 200, ()->
        $(@).alert 'close'