@extends('layouts.home')
@section('content')
    <div class="row">
        <div class="col-12">
            <div id="calendar">
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            let events = @json($events);
            let reminders = @json($reminders);

            $('#calendar').fullCalendar({
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'eventsButton, remindersButton'
                },
                customButtons: {
                    eventsButton: {
                        text: '+ Events',
                        click: function() {
                            window.location.href = '{{ route('event.index') }}';
                        }
                    },
                    remindersButton: {
                        text: '+ Reminders',
                        click: function() {
                            window.location.href = '{{ route('reminder.index') }}';
                        }
                    }
                },
                events: events.concat(reminders),
                eventRender: function(event, element) {
                    element.css('background-color', event.color);
                },
                eventClick: function(calEvent, jsEvent, view) {
                    if (calEvent.end) {
                        window.location.href = '{{ route('event.edit', ['event' => ':id']) }}'.replace(
                            ':id', calEvent.id);
                    } else {
                        window.location.href = '{{ route('reminder.edit', ['reminder' => ':id']) }}'
                            .replace(':id', calEvent.id);
                    }
                }

            });
        });
    </script>
@endsection
