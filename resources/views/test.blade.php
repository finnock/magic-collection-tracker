@extends('layouts.content-fluid')

@section('content')
    <div>
        <a href="#" class="btn btn-default" @click=" list = originalList ">Reset</a>
        <a href="#" class="btn btn-default" @click=" list = filterCreature ">Creature</a>
        <a href="#" class="btn btn-default" @click=" list = filterNonCreature ">Non Creature</a>
        <a href="#" class="btn btn-default" @click=" list = filteredList ">Apply Filter</a>

        <a href="#" class="btn btn-default" @click=" sortFunction = 'sf_sortNone' " style="margin-left: 100px;">Reset Sort</a>
        <a href="#" class="btn btn-default" @click=" sortFunction = 'sf_sortNumberUp' ">Sort Number Up</a>
        <a href="#" class="btn btn-default" @click=" sortFunction = 'sf_sortCmcUp' ">Sort CMC Up</a>
        <a href="#" class="btn btn-default" @click=" sortFunction = 'sf_sortColor' ">Sort Color</a>



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
                    {function : 'ff_name', params: {pattern: 'Breath'}}
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
                        var item = this.filterList[i];
                        list = list.filter(window[item.function](item.params));
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

        function sf_sortColor(cardA, cardB) {
            return (sf_sortColor_colorValueAssign(cardA) - sf_sortColor_colorValueAssign(cardB));
        }

        function sf_sortColor_colorValueAssign(card) {
            if('colors' in card.meta){
                if(card.meta.colors.length == 1){
                    if(_.includes(card.meta.colors, 'White')){ return 0; }
                    if(_.includes(card.meta.colors, 'Blue' )){ return 1; }
                    if(_.includes(card.meta.colors, 'Black')){ return 2; }
                    if(_.includes(card.meta.colors, 'Red'  )){ return 3; }
                    if(_.includes(card.meta.colors, 'Green')){ return 4; }
                }
                if(card.meta.colors.length == 2) {
                    if(_.includes(card.meta.colors, 'White') && _.includes(card.meta.colors, 'Blue')){ return 5; }
                    if(_.includes(card.meta.colors, 'Blue') && _.includes(card.meta.colors, 'Black')){ return 6; }
                    if(_.includes(card.meta.colors, 'Black') && _.includes(card.meta.colors, 'Red')){ return 7; }
                    if(_.includes(card.meta.colors, 'Red') && _.includes(card.meta.colors, 'Green')){ return 8; }
                    if(_.includes(card.meta.colors, 'Green') && _.includes(card.meta.colors, 'White')){ return 9; }

                    if(_.includes(card.meta.colors, 'White') && _.includes(card.meta.colors, 'Black')){ return 10; }
                    if(_.includes(card.meta.colors, 'Blue') && _.includes(card.meta.colors, 'Red')){ return 11; }
                    if(_.includes(card.meta.colors, 'Black') && _.includes(card.meta.colors, 'Green')){ return 12; }
                    if(_.includes(card.meta.colors, 'Red') && _.includes(card.meta.colors, 'White')){ return 13; }
                    if(_.includes(card.meta.colors, 'Green') && _.includes(card.meta.colors, 'Blue')){ return 14; }
                }
                if(card.meta.colors.length >= 3) {
                    return 15;
                }
            }else{
                if(_.includes(card.meta.types, 'Land')){
                    return 17;
                }else{
                    return 16;
                }
            }
        }

        function ff_subType(filterObject){
            return function(card){
                return _.includes(card.meta.subtypes, filterObject.subType)
            }
        }

        function ff_type(filterObject){
            return function(card){
                return _.includes(card.meta.types, filterObject.type)
            }
        }

        function ff_name(filterObject){
            return function(card){
                return card.name.match(new RegExp(filterObject.pattern));
            }
        }
    </script>
@endsection