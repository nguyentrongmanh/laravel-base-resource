require('./bootstrap');
// require('@coreui/coreui/dist/js/coreui.bundle.min');

import Vue from "vue";

import VeeValidate from "vee-validate";
Vue.use(VeeValidate, { locale: "ja" });

import FormIndex from "./components/Admin/form/index.vue"
import Login from "./components/Admin/auth/Login.vue"

//import form
import CustomInput from "./components/Admin/Commons/form/CustomInput.vue"
import CustomTextArea from "./components/Admin/Commons/form/CustomTextArea.vue"
import CustomSelect from "./components/Admin/Commons/form/CustomSelect.vue"
import CustomRadio from "./components/Admin/Commons/form/CustomRadio.vue"
import CustomCheckbox from "./components/Admin/Commons/form/CustomCheckbox.vue"
import CustomButton from "./components/Admin/Commons/form/CustomButton.vue"

Vue.component('custom-input', CustomInput);
Vue.component('custom-textarea', CustomTextArea);
Vue.component('custom-select', CustomSelect);
Vue.component('custom-radio', CustomRadio);
Vue.component('custom-checkbox', CustomCheckbox);
Vue.component('custom-button', CustomButton);

import PageSize from './components/Admin/Commons/page-size.vue'
import InputSearch from './components/Admin/Commons/input-search.vue'

Vue.component('page-size', PageSize);
Vue.component('input-search', InputSearch);

new Vue({
    created() {
    },
    el: "#app",
    components: {
        Login,
        FormIndex,
    },
    methods: {},
    mounted() {}
});
