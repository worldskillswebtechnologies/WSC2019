Vue.component('the-nav', {
    template: `
    <!-- nav -->
    <div class="navbar navbar-expand-lg navbar-light">
        <router-link to="/" class="navbar-brand">Event Booking Platform</router-link>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ml-auto">
                <template v-if="isAuth">
                    <li class="nav-item">
                        <button class="btn">
                            {{auth.username}}
                        </button>
                    </li>
                    <li class="nav-item">
                        <button @click="logout" class="btn btn-outline-warning logout-btn">Logout</button>
                    </li>
                </template>
                <template v-else>
                    <li class="nav-item">
                        <router-link :to="{name:'UserLogin'}" class="btn btn-outline-primary login-btn">Login</router-link>
                    </li>
                </template>
            </ul>
        </div>
    </div>
    `,
    data() {
        return {
            auth: store.auth,
        };
    },
    computed: {
        isAuth() {
            const {token, username} = this.auth;
            return token && username;
        }
    },
    methods: {
        logout() {
            ajax.post(`logout?token=${this.auth.token}`)
                .then(({data, status}) => {
                    if (status === 200) {
                        store.removeAuth();
                        this.$router.push({name:'UserLogin'});
                    }
                });
        }
    }
});