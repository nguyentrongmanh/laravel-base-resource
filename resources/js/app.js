require('./bootstrap');
// require('@coreui/coreui/dist/js/coreui.bundle.min');
import VeeValidate from "vee-validate";
import VueSweetalert2 from 'vue-sweetalert2';
import Datepicker from 'vue2-datepicker';
import 'vue2-datepicker/index.css';
import PageLoading from "./components/Admin/Commons/PageLoading.vue"

Vue.use(VeeValidate, { locale: "ja" });
Vue.use(VueSweetalert2);
Vue.component('date-picker', Datepicker);
Vue.component('page-loading', PageLoading);

import Vue from "vue";
import TopPage from "./components/User/top/index.vue"
import LoginUser from "./components/User/auth/login.vue"
import RegisterUser from "./components/User/auth/register.vue"
import PasswordEmail from "./components/User/auth/password/email.vue"

new Vue({
    created() {
    },
    el: "#app",
    components: {
        LoginUser,
        RegisterUser,
        PasswordEmail,
        TopPage,
    },
    methods: {},
    mounted() {}
});
