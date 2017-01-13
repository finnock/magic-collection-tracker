import Vue from 'vue';
import Card from './components/Card.vue';

const app = new Vue({
    el: '#app',

    components: {
        'card-list' : Card
    }
});