const EventList = {
    template: `
        <!-- event list -->
        <div class="box">
            <div class="h2">Event List</div>
            <div class="list-group" v-if="events">
                <router-link 
                    v-for="event in events"
                    :to="{name:'EventDetail', params:{organizer_slug:event.organizer.slug,event_slug:event.slug}}"
                    :key="event.id" 
                    class="list-group-item list-group-item-action event">
                    <div>
                        <div class="h3">{{event.name}}</div>
                        <p class="m-0">
                            {{event.organizer.name}}, {{event.date}}
                        </p>
                    </div>
                </router-link>
            </div>
        </div>
    `,
    data() {
        return {
            events: null,
        }
    },
    created() {
        ajax.get('events')
            .then(({status, data}) => {
                if (status === 200) {
                    this.events = data.events;
                }
            });
    }
};