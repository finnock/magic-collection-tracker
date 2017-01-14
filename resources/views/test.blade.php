@extends('layouts.content-fluid')

@section('content')
    <div id="app">
        <a href="#" class="btn btn-default" @click=" list = originalList ">Reset</a>
        <a href="#" class="btn btn-default" @click=" list = filterCreature ">Creature</a>
        <a href="#" class="btn btn-default" @click=" list = filterNonCreature ">Non Creature</a>
        <a href="#" class="btn btn-default" @click=" list = filteredList ">Apply Filter</a>
        <card-list :list="list" :list2="list2"></card-list>
    </div>

    <script src="/js/vue.js"></script>

    <template id="card-list">
        <div class="d-flex flex-wrap justify-content-between">
            <div class="mct-card panel panel-default text-center" v-for="card in list">
                <div class="panel-heading">
                    <span>&nbsp;</span>
                </div>
                <div class="panel-body">
                    <img class="mct-image" :src="card.imagePath">
                </div>
                <div class="panel-footer">
                    @{{ card.count }}
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
                    {field : 'type', value : 'Elf'}
                ]
            },

            computed: {
                filteredList: function() {
                    return this.originalList.filter(function (card) {
                        for (var filterID = 0, filterCount = this.filterList.length; filterID < filterCount; filterID++) {
                            if (card[this.filterList[filterID].field].match(new RegExp(this.filterList[filterID].value)))
                                return true;
                        };
                        return false;
                    }.bind(this));
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
                }
            },

            mounted: function () {
                this.list = this.originalList;
            }
        });
    </script>
@endsection