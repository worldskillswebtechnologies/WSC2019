const EventRegister = {
    template: `
        <!-- event registration -->
        <div class="box" v-if="event">
            <div class="h3 mb-4">{{event.name}}</div>
            <div class="tickets row mb-3">
            
                <template v-for="ticket in event.tickets">
                    <label class="ticket col-md-4 m-0 px-3 py-4 " :class="{disabled:!ticket.available}">
                    <span class="d-flex justify-content-between align-items-center">
                        <span class="ticket-cb pr-3">
                            <input type="radio" name="ticket_id" v-model="form.ticket_id" :value="ticket.id">
                        </span>
                        <span class="flex-grow-1 d-flex flex-column">
                            <span class="d-flex justify-content-between align-items-center">
                                <span class="h5">{{ticket.name}}</span>
                                <span class="small">{{ticket.cost}}</span>
                            </span>
                            <span class="small">{{ticket.description}}</span>
                        </span>
                    </span>
                    </label>
                </template>
                
            </div>
            <p>
                Select additional workshops you want to book.
            </p>
            <ul class="p-0 mb-5">
                <li class="mb-3" v-for="workshop in workshops" :key="workshop.id">
                    <label class="workshop">
                    <span class="mr-3">
                        <input type="checkbox" v-model="form.session_ids" :value="workshop.id">
                    </span>
                    <span>
                        {{workshop.title}}
                    </span>
                    </label>
                </li>
            </ul>
            <div class="d-flex justify-content-end pt-5">
                <div>
                    <table>
                        <tr>
                            <td class="pr-3">Event ticket:</td>
                            <td id="event-cost">{{ticket_price}}</td>
                        </tr>
                        <tr>
                            <td class="pr-3">Additional workshops:</td>
                            <td id="additional-cost">{{workshops_price}}</td>
                        </tr>
                        <tr class="border-top">
                            <td class="pr-3">Total:</td>
                            <td id="total-cost">{{total_price}}</td>
                        </tr>
                    </table>
                    <div class="text-right mt-5">
                        <button class="btn btn-primary" id="purchase" 
                            :class="{disabled:!form.ticket_id}" @click="purchase">Purchase</button>
                    </div>
                </div>
            </div>
        </div>
    `,
    data() {
        return {
            event: null,
            form: {
                ticket_id: '',
                session_ids: [],
            }
        }
    },
    computed: {
        organizer_slug() {
            const {organizer_slug} = this.$route.params;
            return organizer_slug;
        },
        event_slug() {
            const {event_slug} = this.$route.params;
            return event_slug;
        },

        workshops() {
            const workshops = [];

            if (this.event) {
                this.event.channels.forEach(channel => {
                    channel.rooms.forEach(room => {
                        room.sessions.forEach(session => {
                            if (session.type === 'workshop') {
                                workshops.push(session);
                            }
                        });
                    });
                });
            }
            return workshops;
        },

        ticket_price() {
            let price = 0;
            const ticket = this.event.tickets.find(ticket => ticket.id === this.form.ticket_id);
            if (ticket) {
                price = parseFloat(ticket.cost);
            }
            return price;
        },
        workshops_price() {
            let price = 0;

            this.form.session_ids.forEach(session_id => {
                const workshop = this.workshops.find(x => x.id == session_id);
                price += parseFloat(workshop.cost);
            });

            return price;
        },
        total_price() {
            return this.ticket_price + this.workshops_price;
        }
    },
    methods: {
        purchase() {
            const {organizer_slug, event_slug} = this;
            ajax
                .post(
                    `organizers/${organizer_slug}/events/${event_slug}/registration?token=${store.auth.token}`,
                    this.form,
                    true
                )
                .then(({status, data}) => {
                    if (status === 200) {
                        this.$router.push({ name: 'EventDetail', params: {organizer_slug, event_slug}});
                        Bus.$emit('alert', data.message, 'success');
                    } else {
                        Bus.$emit('alert', data.message);
                    }
                });
        }
    },
    created() {
        const {organizer_slug, event_slug} = this;
        ajax.get(`organizers/${organizer_slug}/events/${event_slug}`)
            .then(({status, data}) => {
                if (status === 200) {
                    this.event = data;
                }
            });
    }
};