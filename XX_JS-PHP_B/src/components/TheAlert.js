const Bus = new Vue;

Vue.component('the-alert', {
    template: `
    <!-- alert -->
    <transition name="slide-alert" appear mode="out-in">
        <div class="alert-wrapper" v-if="id" :key="id">
            <div class="alert" :class="'alert-'+type">
                {{msg}}
            </div>
        </div>
    </transition>
    `,
    data() {
        return {
            id: null,
            msg: null,
            type: null,
        };
    },
    mounted() {
        let interval = null;

        Bus.$on('alert', (msg, type='danger') => {
            clearInterval(interval);

            this.id = Date.now();
            this.msg = msg;
            this.type = type;

            interval = setTimeout(() => {
                this.id = null;
                this.msg = null;
                this.type = null;
            }, 5000);
        });
    }
});