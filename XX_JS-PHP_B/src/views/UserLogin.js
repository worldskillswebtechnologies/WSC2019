const UserLogin = {
    template: `
        <!-- login -->
        <div class="box">
            <div class="h3 mb-3">Login</div>
            <table>
                <tr>
                    <td class="pr-5">
                        Lastname
                    </td>
                    <td>
                        <input type="text" class="form-control" placeholder="Lastname" id="lastname"
                            v-model="form.lastname">
                    </td>
                </tr>
                <tr>
                    <td class="pr-5">Registration Code</td>
                    <td>
                        <input type="password" class="form-control" placeholder="Code" id="registration_code"
                            v-model="form.registration_code">
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td class="pt-3">
                        <button id="login" class="btn btn-primary" @click="login">Login</button>
                    </td>
                </tr>
            </table>
        </div>
    `,
    data() {
        return {
            form: {
                lastname: '',
                registration_code: '',
            }
        }
    },
    methods: {
        login() {
            ajax.post('login', this.form)
                .then(({data, status}) => {
                    if (status === 200) {
                        store.setAuth(data);
                        this.$router.push({name:'EventList'});
                    } else {
                        Bus.$emit('alert', 'Lastname or registration code not correct');
                    }
                });
        }
    }
};