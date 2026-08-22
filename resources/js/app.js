document.addEventListener('livewire:navigated', () => {

    const calendarEl = document.getElementById('calendar');

    if (calendarEl) {

        const events = JSON.parse(calendarEl.dataset.events);

        const calendar = new FullCalendar.Calendar(calendarEl, {

            initialView: 'dayGridMonth',

            height: 650,

            locale: 'fr',

            events: events,

            dayMaxEvents: 2,

            eventClick: function(info) {

                Livewire.dispatch('open-petsitting-event', {
                    requestId: info.event.id
                });

            },

        });

        calendar.render();

        Livewire.on('remove-calendar-event', ({ requestId }) => {

            const event = calendar.getEventById(String(requestId));

            if (event) {
                event.remove();
            }

        });
    }
});
