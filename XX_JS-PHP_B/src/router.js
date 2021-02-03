const router = new VueRouter({
    routes: [
        {
            path:'/',
            name:'EventList',
            component:EventList,
            meta:'all',
        },
        {
            path:'/organizers/:organizer_slug/events/:event_slug',
            name:'EventDetail',
            component:EventDetail,
            meta:'all',
        },
        {
            path:'/organizers/:organizer_slug/events/:event_slug/sessions/:session_id',
            name:'SessionDetail',
            component:SessionDetail,
            meta:'all',
        },
        {
            path:'/organizers/:organizer_slug/events/:event_slug/register',
            name:'EventRegister',
            component:EventRegister,
            meta:'auth',
        },
        {
            path:'/login',
            name:'UserLogin',
            component:UserLogin,
            meta:'guest'
        },
        {
            path:'*',
            redirect:'/',
        }
    ],
});

router.beforeEach(function (to, from, next) {
    if (to.meta === 'auth' && !store.isAuth()) {
        next({name:'UserLogin'});
        return;
    }

    if (to.meta === 'guest' && store.isAuth()) {
        next({name:'EventList'});
        return;
    }

    next();
});
