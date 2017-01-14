@extends('layouts.content')

@section('content')
    <div id="app">
        <a href="#" class="btn btn-default" @click=" list = originalList ">Reset</a>
        <a href="#" class="btn btn-default" @click=" list = filterRed ">Red</a>
        <a href="#" class="btn btn-default" @click=" list = filterGreen ">Green</a>
        <a href="#" class="btn btn-default" @click=" list = filterBlue ">Blue</a>
        <card-list :list="list" :list2="list2"></card-list>
    </div>

    <script src="/js/vue.js"></script>

    <style>
        .testElement{
            width: 100px;
            height: 100px;
            margin: 5px;
        }

        .dummyElement{
            width: 100px;
            heigh: 0px;
            margin: 5px;
        }

        .red{ background-color: red; }

        .green{ background-color: green; }

        .blue{ background-color: blue; }
    </style>


    <template id="card-list">
        <div class="d-flex flex-wrap justify-content-between">
            <div class="testElement" :class="card.type" v-for="card in list"></div>
            <div class="dummyElement" v-for="card in list2"></div>
        </div>
    </template>

    <script>
        Vue.component('card-list', {
           template: '#card-list',

            props: [ 'list', 'list2' ]
        });

        const app = new Vue({
            el: '#app',

            /*components: {
                'card-list' : Card
            },*/

            data : {

                list: [],

                originalList: [
                    {type: 'red'},
                    {type: 'red'},
                    {type: 'red'},
                    {type: 'green'},
                    {type: 'green'},
                    {type: 'green'},
                    {type: 'green'},
                    {type: 'green'},
                    {type: 'green'},
                    {type: 'blue'},
                    {type: 'blue'},
                    {type: 'blue'}

                ],

                list2: [
                    '1', '1', '1', '1', '1', '1', '1', '1', '1'
                ]
            },

            computed: {
                filterRed: function() {
                    return this.originalList.filter(function (card) {
                        if (card.type === 'red')
                            return true;
                    });
                },
                filterGreen: function() {
                    return this.originalList.filter(function (card) {
                        if (card.type === 'green')
                            return true;
                    });
                },
                filterBlue: function() {
                    return this.originalList.filter(function (card) {
                        if (card.type === 'blue')
                            return true;
                    });
                }
            },

            mounted: function () {
                this.list = this.originalList;
            }
        });
    </script>
@endsection