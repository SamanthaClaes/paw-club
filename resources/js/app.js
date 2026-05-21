document.addEventListener('livewire:navigated', () => {

    const calendarEl = document.getElementById('calendar');

    if (calendarEl) {

        const events = JSON.parse(calendarEl.dataset.events);

        const calendar = new FullCalendar.Calendar(calendarEl, {

            initialView: 'dayGridMonth',

            height: 650,

            locale: 'fr',

            events: events,

        });

        calendar.render();
    }
});
