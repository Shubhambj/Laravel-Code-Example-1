function loadModel(e) {
    let _url = $(e).data('url');

    $.get(_url, (data) => {
        $('.modal-body').html(data);
        $('#commonModal').modal('show'); 
    });
}

function deleteRecord(e, callback) {
    let _url = $(e).data('url');
        
    $.ajax({
        type: "POST",
        method: "DELETE",
        url: _url,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(data) {
            callback(data);
        },
        error: function(err) {
            console.log(err);
        }
    });
}

function submitForm(e, callback) {
    let _$form = $(e).closest('form');
    let _formData = new FormData(_$form[0]);

    $.ajax({
        type: "POST",
        url: _$form.attr('action'),
        data: _formData,
        processData: false,
        contentType: false,
        cache: false,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        },
        success: function(data) {
            callback(data);
        },
        error: function(err) {
            console.log(err);
        }
    });
}