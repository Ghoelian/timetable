const showModalError = (error) => { // Assumes there's an element with ID modal-warning somewhere, preferably within a modal
    let errorMessage = ''

    if (error.errors !== undefined) { // If post validation failed
        Object.keys(error.errors).forEach((key) => {
            errorMessage += `
                                ${error.errors[key]}<br/>
                            `
        })

        showModalError(errorMessage)
    } else if (error.responseJSON !== undefined) { // If response is sent as abort(400, 'text')
        errorMessage = error.responseJSON.message
    } else if (error.responseText !== undefined) { // If response is sent as response('text', 400)
        errorMessage = error.responseText
    } else {
        errorMessage = error
    }

    $('.modal-warning').html(`
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            ${errorMessage}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        `)
}

const showError = (error) => {
    let errorMessage = ''

    if (error.errors !== undefined) { // If post validation failed
        Object.keys(error.errors).forEach((key) => {
            errorMessage += `
                                ${error.errors[key]}<br/>
                            `
        })

        showModalError(errorMessage)
    } else if (error.responseJSON !== undefined) { // If response is sent as abort(400, 'text')
        errorMessage = error.responseJSON.message
    } else if (error.responseText !== undefined) { // If response is sent as response('text', 400)
        errorMessage = error.responseText
    } else {
        errorMessage = error
    }

    $('#warning').html(`
                        <div class="alert alert-danger alert-dismissible fade show col-sm-4 offset-4" role="alert">
                            ${errorMessage}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        `)
}

const showSuccess = (message) => {
    $('#success').html(`
                        <div class="alert alert-success alert-dismissible fade show col-sm-4 offset-4" role="alert">
                            ${message}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        `)
}
