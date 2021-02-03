const LOCAL_TOKEN = '200907_token';
const LOCAL_USERNAME = '200907_username';

const store = {
    auth: {
        token: localStorage.getItem(LOCAL_TOKEN) || null,
        username: localStorage.getItem(LOCAL_USERNAME) || null,
    },
    setAuth({token, username}) {
        this.auth.token = token;
        this.auth.username = username;

        localStorage.setItem(LOCAL_TOKEN, this.auth.token);
        localStorage.setItem(LOCAL_USERNAME, this.auth.username);
    },
    isAuth() {
        const {token, username} = this.auth;
        return token && username;
    },
    removeAuth() {
        this.auth.token = null;
        this.auth.username = null;

        localStorage.removeItem(LOCAL_TOKEN);
        localStorage.removeItem(LOCAL_USERNAME);
    }
};