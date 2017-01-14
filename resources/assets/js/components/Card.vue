<template>
    <div class="d-flex flex-wrap justify-content-between">
        <div class="testElement" :class="card.type" v-for="card in list"></div>
    </div>
</template>

<style>
    .testElement{
        width: 100px;
        height: 100px;
        margin: 5px;
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
            }
        },

        props {
            'list'
        }
    }
</script>
