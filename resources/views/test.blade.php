@extends('layouts.content-fluid')

@section('content')

    <template>
        <el-select v-model="value6" placeholder="Select">
            <el-option
                    v-for="item in cities"
                    :label="item.label"
                    :value="item.value">
                <span style="float: left">@{{ item.label }}</span>
                <span style="float: right; color: #8492a6; font-size: 13px">@{{ item.value }}</span>
            </el-option>
        </el-select>
    </template>

@endsection

@section('script')
    <script>
        var Main = {
            data() {
                return {
                    cities: [{
                        value: 'Beijing',
                        label: 'Beijing'
                    }, {
                        value: 'Shanghai',
                        label: 'Shanghai'
                    }, {
                        value: 'Nanjing',
                        label: 'Nanjing'
                    }, {
                        value: 'Chengdu',
                        label: 'Chengdu'
                    }, {
                        value: 'Shenzhen',
                        label: 'Shenzhen'
                    }, {
                        value: 'Guangzhou',
                        label: 'Guangzhou'
                    }],
                    value6: ''
                }
            }
        }
        var Ctor = Vue.extend(Main)
        new Ctor().$mount('#app')
    </script>
@endsection