@extends('layouts.content-fluid')

@section('content')
<div>

  <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active">
            <a href="#home" aria-controls="home" role="tab" data-toggle="tab">
                <div class="tab-label">
                    <span>Home</span>
                    <i class="fa fa-times"></i>
                </div>
            </a>
        </li>
        <li role="presentation">
            <a href="#profile" aria-controls="home" role="tab" data-toggle="tab">
                <div class="tab-label">
                    <span>Profile</span>
                    <i class="fa fa-times"></i>
                </div>
            </a>
        </li>
        <li role="presentation">
            <a href="#messages" aria-controls="home" role="tab" data-toggle="tab">
                <div class="tab-label">
                    <span>Messages</span>
                    <i class="fa fa-times"></i>
                </div>
            </a>
        </li>
        <li role="presentation">
            <a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">
                <div class="tab-label" v-if="label">
                    <span @click="label = !label">@{{ name }}</span>
                    <i class="fa fa-times"></i>
                </div>
                <div class="tab-input" v-else>
                    <input type="text" v-model="name" v-on:keyup.enter.preventDefault="label = !label">
                    <i class="fa fa-save" @click="label = !label"></i>
                </div>
            </a>
        </li>
        <li role="presentation" class="new-tab">
            <a>
                    <span style="padding: 3px; display: inline-block"><i class="fa fa-plus-square-o" ></i></span>
            </a>
        </li>
    </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="home">
            <card-list :list="collection"></card-list>
    </div>
    <div role="tabpanel" class="tab-pane" id="profile">
            <card-list :list="collection"></card-list>
    </div>
    <div role="tabpanel" class="tab-pane" id="messages">1124</div>
    <div role="tabpanel" class="tab-pane" id="settings">1532</div>
  </div>

</div>

@endsection

@section('script')

    <template id="card-list">
        <div>
            <div class="row" style="margin: 10px 10px;">
                <div class="form-inline">
                    <div class="form-group" style="margin-bottom: 0;">
                        <div class="dropdown">
                            <a class="btn btn-default" id="dLabel" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              Sort &nbsp; <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu" style="padding: 0; margin: 0;" aria-labelledby="dLabel">
                                <div class="dropdown-btn-menu">
                                    <li><a class="btn btn-sm btn-default" @click="sortFunction = 'sf_sortNumberUp'">Number</a></li>
                                    <li><a class="btn btn-sm btn-default" @click="sortFunction = 'sf_sortCmcUp'">Converted Mana Cost</a></li>
                                    <li><a class="btn btn-sm btn-default" @click="sortFunction = 'sf_sortColor'">Color</a></li>
                                    <li><a class="btn btn-sm btn-default" @click="">Power</a></li>
                                    <li><a class="btn btn-sm btn-default" @click="">Toughness</a></li>
                                </div>
                                <div class="dropdown-pill-menu">
                                    <div class="img-rounded filter-pill">Color <i class="fa fa-times"></i></div>
                                    <div class="img-rounded filter-pill">CMC <i class="fa fa-times"></i></div>
                                    <div class="img-rounded filter-pill">Default: Name</i></div>
                                </div>
                            </ul>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon" id="searchbtn" v-on:click="filter"><i class="fa fa-search"></i></span>
                            <input type="text" class="form-control" placeholder="Search" v-model="filterString" v-on:keyup.enter="filter" style="width: 1000px;">
                            <span class="input-group-addon">@{{ cardCount }} / @{{ allCardCount }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" style="margin: 10px 5px;">
                <div class="d-flex flex-wrap justify-content-between">
                    <div class="mct-card panel panel-default text-center" v-for="card in sortedList">
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
                    <div style="width: 220px; height: 0; margin: 5px 3px;" v-for="card in dummyList"></div>
                </div>
            </div>
        </div>
    </template>

    <script>

        var parser = null;

        axios.get('/js/mtgfilter.pegjs')
          .then(function(response){
            parser = PEG.buildParser(response.data);
          });

        Vue.component('card-list', {
            template: '#card-list',

            props: [ 'list' ],

            data: function(){
                return {
                    dummyList: [ '1', '1', '1', '1', '1', '1', '1', '1', '1' ],
                    sortFunction: 'sf_sortColor',
                    filterString: '',
                    filteredList: []
                }
            },

            computed: {
                cardCount: function() {
                    return this.filteredList.length;
                },

                allCardCount: function() {
                    return this.list.length;
                },

                sortedList: function () {
                    return this.filteredList.sort(
                        firstBy(window[this.sortFunction])
                            .thenBy('name')
                    );
                }
            },

            methods: {
                filter: function(){
                    this.filteredList =  this.list.filter(function(card){
                        try {
                            return parser.parse(this.filterString, card);
                        }
                        catch (error){}
                    }.bind(this));
                }
            }
        });

        const app = new Vue({
            el: '#app',

            data: {
                label: true,

                name: 'Settings',

                collection: []
            },

            mounted: function () {
                axios.get('/ajax/collection')
                  .then(function(response){
                    this.collection = response.data;
                  }.bind(this));
            },

            methods: {
                refresh: function (event) {
                    axios.get('/js/mtgfilter.pegjs')
                      .then(function(response){
                        parser = PEG.buildParser(response.data);
                        console.log(response.data);
                      });
                }
            }
        });



    </script>
@endsection
