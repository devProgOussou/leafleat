require('./bootstrap');

import Vue from 'vue';

import { InertiaApp } from '@inertiajs/inertia-vue';
import { InertiaForm } from 'laravel-jetstream';
import PortalVue from 'portal-vue';
import { LMap, LTileLayer, LMarker } from 'vue2-leaflet';
import 'leaflet/dist/leaflet.css';
import 'bootstrap';
import 'bootstrap/dist/css/bootstrap.min.css';

Vue.mixin({ methods: { route } });
Vue.use(InertiaApp);
Vue.use(InertiaForm);
Vue.use(PortalVue);

Vue.component('l-map', LMap);
Vue.component('l-tile-layer', LTileLayer);
Vue.component('l-marker', LMarker);

const app = document.getElementById('app');

new Vue({
    render: (h) =>
        h(InertiaApp, {
            props: {
                initialPage: JSON.parse(app.dataset.page),
                resolveComponent: (name) => require(`./Pages/${name}`).default,
            },
        }),
}).$mount(app);
