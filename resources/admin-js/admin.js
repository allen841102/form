
/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
window.Vue = require('vue');

Vue.component('survey-share', require('./components/SurveyDetails/SurveyShare.vue').default);
Vue.component('survey-review', require('./components/SurveyDetails/SurveyReview.vue').default);
Vue.component('survey-chart', require('./components/SurveyDetails/SurveyChart.vue').default);
Vue.component('survey-details', require('./components/SurveyDetails.vue').default);
Vue.component('survey-creation', require('./components/SurveyCreation.vue').default);
Vue.component('survey-table', require('./components/SurveyTable.vue').default);
Vue.component('side-bar', require('./components/SideBar.vue').default);
Vue.component('nav-header', require('./components/NavHeader.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the body of the page. From here, you may begin adding components to
 * the application, or feel free to tweak this setup for your needs.
 */
//import App from './App.vue';
import ElementUI from 'element-ui';
import 'element-ui/lib/theme-chalk/index.css';

Vue.use(ElementUI);

const app = new Vue({
  el: '#app',
  //render: h => h(App),
});
