import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import timeGridPlugin from '@fullcalendar/timegrid';
import listPlugin from '@fullcalendar/list';
import interactionPlugin from '@fullcalendar/interaction';

document.addEventListener('DOMContentLoaded', function() {
    const calendarEl = document.getElementById('calendar');
    if (!calendarEl) return;

    const calendar = new Calendar(calendarEl, {
        plugins: [dayGridPlugin, timeGridPlugin, listPlugin, interactionPlugin],
        initialView: 'dayGridMonth',
        headerToolbar: {
            left:   'prev,next today',
            center: 'title',
            right:  'dayGridMonth,timeGridWeek,listWeek'
        },
        locale: 'id',
        height: 'auto',

        // Fetch events dari UI controller (bukan langsung ke API)
        events: {
            url:    '/admin/calendar/events', // route UI
            method: 'GET',
            failure: function() {
                alert('Gagal memuat data calendar.');
            },
        },

        // Klik event → tampilkan detail
        eventClick: function(info) {
            alert(
                'Meeting: ' + info.event.title + '\n' +
                'Tanggal: ' + info.event.startStr.substring(0, 10) + '\n' +
                'Jam: '     + info.event.startStr.substring(11, 16)
            );
        },

        // Warna event
        eventColor: '#FF8C00',
    });

    calendar.render();
});