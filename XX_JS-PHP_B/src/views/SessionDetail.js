const SessionDetail = {
    template: `
        <!-- session detail -->
        <div class="box" v-if="session">
            <div class="h3 mb-3">
                {{session.title}} - {{session.type}}
            </div>
            <p>
                {{session.description}}
            </p>
            <table class="session-table">
                <tr>
                    <th>Speaker:</th>
                    <td>{{session.speaker}}</td>
                </tr>
                <tr>
                    <th>Start:</th>
                    <td>{{format(session.start)}}</td>
                </tr>
                <tr>
                    <th>End:</th>
                    <td>{{format(session.end)}}</td>
                </tr>
                <tr>
                    <th>Cost:</th>
                    <td>{{session.cost ? session.cost : '-'}}</td>
                </tr>
            </table>
        </div>
    `,
    data() {
        return {
            event: null,
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
        session_id() {
            const {session_id} = this.$route.params;
            return session_id;
        },
        session() {
            if (!this.event) return false;

            let result = null;
            this.event.channels.find(channel =>
                channel.rooms.find(room =>
                    room.sessions.find(session => {
                        if (session.id == this.session_id) {
                            result = session;
                            return true;
                        }
                    })
                )
            );
            return result;
        }
    },
    methods: {
        zero(num) {
            return num < 10 ? `0${num}` : num;
        },
        format(datetime) {
            const dt = new Date(datetime);
            const h = dt.getHours();
            const i = dt.getMinutes();
            return `${this.zero(h)}:${this.zero(i)}`;
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