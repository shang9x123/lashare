<template>
    <h1>Xin chao {{ message}}</h1>
</template>
<script>
export default {
    name: "App",
    data(){
        return{
            message:'Hien Lashare.info'
        }
    }
}
</script>

<style scoped>
    h1{
        color: red;
        font-size: 3em;
        text-align: center;
        clear: both;
    }
</style>
