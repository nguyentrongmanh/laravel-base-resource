require('./bootstrap');
// require('@coreui/coreui/dist/js/coreui.bundle.min');

import Vue from "vue";

import VeeValidate from "vee-validate";
import Datepicker from 'vue2-datepicker';
import VueSweetalert2 from 'vue-sweetalert2';
import 'vue2-datepicker/index.css';
import 'sweetalert2/dist/sweetalert2.min.css';

Vue.component('date-picker', Datepicker);
Vue.use(VeeValidate, { locale: "ja" });
Vue.use(VueSweetalert2);

import FormIndex from "./components/Admin/form/index.vue"
import Login from "./components/Admin/auth/Login.vue"
import UserCreate from "./components/Admin/user/create.vue"
import UserEdit from "./components/Admin/user/edit.vue"

//import form
import CustomInput from "./components/Admin/Commons/form/CustomInput.vue"
import CustomTextArea from "./components/Admin/Commons/form/CustomTextArea.vue"
import CustomSelect from "./components/Admin/Commons/form/CustomSelect.vue"
import CustomRadio from "./components/Admin/Commons/form/CustomRadio.vue"
import CustomCheckbox from "./components/Admin/Commons/form/CustomCheckbox.vue"
import CustomButton from "./components/Admin/Commons/form/CustomButton.vue"
import ImageDropBox from "./components/Admin/Commons/form/ImageDropBox.vue"

Vue.component('custom-input', CustomInput);
Vue.component('custom-textarea', CustomTextArea);
Vue.component('custom-select', CustomSelect);
Vue.component('custom-radio', CustomRadio);
Vue.component('custom-checkbox', CustomCheckbox);
Vue.component('custom-button', CustomButton);
Vue.component('image-drop-box', ImageDropBox);

import PageSize from './components/Admin/Commons/page-size.vue'
import InputSearch from './components/Admin/Commons/input-search.vue'
import PageLoading from "./components/Admin/Commons/PageLoading.vue"
import DeleteItem from "./components/Admin/Commons/delete-item.vue"

Vue.component('page-size', PageSize);
Vue.component('input-search', InputSearch);
Vue.component('page-loading', PageLoading);
Vue.component('delete-item', DeleteItem);

new Vue({
    created() {
    },
    el: "#app",
    components: {
        Login,
        FormIndex,
        UserCreate,
        UserEdit
    },
    methods: {},
    mounted() {}
});
