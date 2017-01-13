<template>
    <div class="d-flex flex-wrap justify-content-between">
        <div class="testElement red" v-for="card in list"></div>
    </div>
</template>

<style>
    .testElement{
        width: 100px;
        height: 100px;
    }

    .red{
        background-color: red;
    }

    .green{
        background-color: green;
    }
</style>

<script>

    export default{
        data(){
            return{
                list: [
                    'red',
                    'red',
                    'green',
                    'red',
                    'green',
                    'green'
                ]
            }
        }
    }
</script>
