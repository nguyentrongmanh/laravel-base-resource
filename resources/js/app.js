require('./bootstrap');
// require('@coreui/coreui/dist/js/coreui.bundle.min');

import Vue from "vue";
import TopPage from "./components/User/top/index.vue"

new Vue({
    created() {
    },
    el: "#app",
    components: {
        TopPage,
    },
    methods: {},
    mounted() {}
});
