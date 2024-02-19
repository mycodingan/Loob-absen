$(document).ready(function() {
    $('.editable').click(function() {
        var $editable = $(this);
        var absen_id = $editable.data('absen-id');
        var day = $editable.data('day');
        var currentValue = $editable.find('span').text();

        var selectOptions = '<select class="form-control">';
        selectOptions += '<option value="1">1</option>';
        selectOptions += '<option value="2">2</option>';
        selectOptions += '<option value="ls">LS</option>';
        selectOptions += '</select>';

        $editable.empty().append(selectOptions);
        $editable.find('select').val(currentValue);

        $editable.find('select').change(function() {
            var selectedValue = $(this).val();
            updateData(absen_id, day, selectedValue, $editable);
        });
    });

    $('.editable_input').click(function() {
        var $editable = $(this);
        var absen_id = $editable.data('absen-id');
        var day = $editable.data('day');
        var currentValue = $editable.find('span').text();

        var input = '<input type="text" class="form-control" >';
        $editable.empty().append(input);
        $editable.find('input').val(currentValue).focus();

        $editable.find('input').keypress(function(event) {
            if (event.which === 13) {
                var selectedValue = $(this).val();
                updateData(absen_id, day, selectedValue, $editable);
            }
        });
    });
});

function updateData(absen_id, day, selectedValue, $editable) {
    $.ajax({
        url: '/absen/' + absen_id,
        method: 'PUT',
        data: {
            _token: '{{ csrf_token() }}',
            _method: 'PUT',
            hari: {
                [day]: selectedValue
            }
        },
        success: function(response) {
            $editable.empty().append('<span>' + selectedValue + '</span>');
        },
        error: function(xhr) {
            console.log(xhr.responseText);
            alert('Error: Data tidak dapat diperbarui.');
        }
    });
}
