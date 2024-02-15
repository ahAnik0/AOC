<script nonce ="{{ csp_nonce() }}" >
    // nonce="YKXiTcrg6o4DuumXQDxYRv9gHPlZng6z"
  var calendar = $('#calendar').fullCalendar({
    buttonText: {
        today: 'Today'
    },
    height: 500,
    editable: false,
    eventSources: [{
        url: "{{ url('admin/hall_booking/calendar_data') }}",
        textColor: 'black', // Set the default font color for the events
    }],
    displayEventTime: true,
    eventRender: function(event, element, view) {
        var shiftLabel = event.shift == 0 ? 'Day' : 'Night';
        var hallColor = getHallColor(event.hall);

        element.css('background-color', hallColor);
        element.find('.fc-title').html(
            ' Hall: ' + event.hall.charAt(0).toUpperCase() + event.hall.slice(1) +
            '<br> Shift: ' + shiftLabel
        );
    },
    dayClick: function(date, jsEvent, view) {
            var today = moment().startOf('day');
            if (date.isBefore(today)) {
                return false; 
            }
            window.location.href = "{{ url('admin/hall_booking/create_bokking_form') }}?selectedDate=" + date.format('YYYY-MM-DD');
        },
    selectable: true,
    selectHelper: true,
    });

    function getHallColor(hall) {
        return hall === 'hall_1' ? 'gray' :
            hall === 'hall_2' ? '#BDAB7B' :
            'gray'; // Default color
    }

    function displayMessage(message) {
        toastr.success(message, 'Event');
    }

</script>

{{-- eventRender: function(event, element, view) {
    var shiftLabel = event.shift == 0 ? 'Day' : 'Night';
    element.find('.fc-title').html(
        '<strong>' + event.title + '</strong>' +
        '<br> Hall: ' + event.hall.charAt(0).toUpperCase() + event.hall.slice(1) +
        '<br> Shift: ' + shiftLabel
    );
}, --}}