import Vue from 'vue';
import Card from './components/Card.vue';

const app = new Vue({
    el: '#app',

    components: {
        'card-list' : Card

    },

    data : {
        list: [
            {type: 'red'},
            {type: 'red'},
            {type: 'red'},
            {type: 'red'},
            {type: 'red'},
            {type: 'red'},

            {type: 'green'},
            {type: 'green'},
            {type: 'green'},
            {type: 'green'},
            {type: 'green'},
            {type: 'green'}

        ]
    }
});