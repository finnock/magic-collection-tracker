@extends('layouts.content-fluid')

@section('content')
    <div id="app">
        <a href="#" class="btn btn-default" @click=" list = originalList ">Reset</a>
        <a href="#" class="btn btn-default" @click=" list = filterCreature ">Creature</a>
        <a href="#" class="btn btn-default" @click=" list = filterNonCreature ">Non Creature</a>
        <a href="#" class="btn btn-default" @click=" list = filteredList ">Apply Filter</a>

        <a href="#" class="btn btn-default" @click=" sortFunction = 'sf_sortNone' " style="margin-left: 100px;">Reset Sort</a>
        <a href="#" class="btn btn-default" @click=" sortFunction = 'sf_sortNumberUp' ">Sort Number Up</a>
        <a href="#" class="btn btn-default" @click=" sortFunction = 'sf_sortCmcUp' ">Sort CMC Up</a>


        <card-list :list="sortedList" :list2="list2"></card-list>
    </div>

    <script src="/js/vue.js"></script>
    <script src="/js/thenBy.js"></script>
    <script src="/js/lodash.js"></script>

    <template id="card-list">
        <div class="d-flex flex-wrap justify-content-between">
            <div class="mct-card panel panel-default text-center" v-for="card in list">
                <div class="panel-heading">
                    <span>&nbsp;</span>{{--@{{ card.type }}--}}
                </div>
                <div class="panel-body">
                    <img class="mct-image" :src="card.imagePath">
                </div>
                <div class="panel-footer">
                    @{{ card.count }} - @{{ card.code }}#@{{ card.number }}
                </div>
            </div>
            <div style="width: 200px; height: 0; margin: 5px 3px;" v-for="card in list2"></div>
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

                originalList:
                    <?php echo json_encode($cardList); ?>
                ,

                list2: [
                    '1', '1', '1', '1', '1', '1', '1', '1', '1'
                ],

                filterList: [
                    {function : 'ff_subType', params: {subType: 'Human'}}
                ],

                sortFunction: 'sf_sortNone'
            },

            computed: {
                cmcSort: function (){
                    parseInt(this.convertedManaCost);
                },

                filteredList: function() {
                    list = this.originalList;
                    for (var i = 0, len = this.filterList.length; i < len; i++) {
                        list = list.filter(window[this.filterList[i].function](window[this.filterList[i].params]));
                    }
                    return list;
                },

                filterCreature: function() {
                    return this.originalList.filter(function (card) {
                        if (card.type.match(new RegExp('Creature')))
                            return true;
                    }).sort(function (a, b){
                        return (parseInt(a.convertedManaCost) - parseInt(b.convertedManaCost));
                    });
                },

                filterNonCreature: function() {
                    return this.originalList.filter(function (card) {
                        if (!card.type.match(/Creature/))
                            return true;
                    });
                },

                sortedList: function () {
                    return this.list.sort(
                        firstBy(window[this.sortFunction])
                            .thenBy('name')
                    );
                }
            },

            mounted: function () {
                this.list = this.originalList;
            }
        });

        function sf_sortNumberUp(cardA, cardB) {
            return (parseInt(cardA.number) - parseInt(cardB.number));
        }

        function sf_sortCmcUp(cardA, cardB) {
            return (parseInt(cardA.cmcSort) - parseInt(cardB.cmcSort));
        }

        function sf_sortNone(cardA, cardB) {
            return 0;
        }

        function ff_subType(filterObject){
            return function(card){
                console.log(card.meta.subtypes);
                console.log(filterObject.subType);
                return _.includes(card.meta.subtypes, filterObject.subType)
            }
        }
    </script>
@endsection